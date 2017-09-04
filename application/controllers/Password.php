<?php

class Password extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
		$this->class = strtolower(get_class($this));
		$this->load->library('acl');
		$this->acl->_resource($this->class);
        $this->load->model('M_users');
    }


    public function index(){
        $task = $this->input->post('task');
        switch ($task) {
            case 3:
                $this->_update();
                break;
            default:
                $temp    = array( 'task' => 3);
                $sidebar = array();
                $data    = array(
                    'header' => $this->load->view('slice/header',array(),true),
                    'sidebar'=>   $this->load->view('slice/sidebar',$sidebar,true),
                    'content'=>  $this->load->view('password/_form',$temp,true)
                );
                $this->load->view('layout/backend',$data);
                // break;
        }
    }

    private function _update(){

        $password_old = $this->input->post('old_password',true);
        $password_new = $this->input->post('new_password',true);
        $password_repeat = $this->input->post('repeat_password',true);

        if($password_new === $password_repeat){
            $password = md5('kuM1nt4!'.$password_repeat);
            $password_old = md5('kuM1nt4!'.$password_old);
            $id = $this->session->userdata('id');
            $check = $this->M_users->_checkPassword($id, $password_old);
            if($check->num_rows() > 0){
                $data = array('users_password' => $password);
                $query = $this->M_users->_update($id, $data);

                if($query > 0 ){
                    $message =  "Sucess, password berhasil di ubah";
                    $alert   =  "alert-success";
                } else {
                    $message =  "Sorry, gagal merubah password";
                    $alert   =  "alert-danger";
                }
            } else {
                $message =  "Sorry, password lama tidak sama";
                $alert   =  "alert-danger";
            }

        } else {
            $message =  "Sorry, password baru tidak sama dengan password repeat";
		    $alert   =  "alert-danger";
        }
        $this->session->set_flashdata('message',"<div class='alert ".$alert."' role='alert'>".$message."</div>");

        redirect('password', 'refresh');
    }
}
