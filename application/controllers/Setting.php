<?php

class Setting extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->database();
		$this->class = strtolower(get_class($this));
		$this->load->library('acl');
		$this->acl->_resource($this->class);
		$this->load->model('m_setting');
        $this->load->model('m_sidebar');
    }

    public function index(){
        $task = $this->input->post('task');
        switch($task){
            case 1:
                $this->updatePassword();
                break;
            case 2:
                $this->_insert();
                break;
            case 3:
                $this->_update();
                break;
            case 4:
                $this->savePassword();
                break;
			case 5:
                $this->deletePassword();
                break;
            default:
                $query = $this->m_setting->getData();
                if($query->num_rows() > 0){
                    $task = 3;
                } else {
                    $task = 2;
                }

                $temp = array(
                    'task'   => $task,
                    'query' => $query
                );
                $sidebar = array('setting' => 'active');
                $data = array(
                    'header' => $this->load->view('slice/header',array(),true),
                    'sidebar'=>   $this->load->view('slice/sidebar',$sidebar,true),
                    'content'=>  $this->load->view('setting/_form',$temp,true)
                );
                $this->load->view('layout/backend',$data);
        }
    }

    public function _insert(){
        $nama_unit   = $this->input->post('setting_nama_unit',true);
        $detail_unit = $this->input->post('setting_detail_unit',true);
        $email_unit  = $this->input->post('setting_email_unit',true);

        $data = array(
            'setting_nama_unit' => $nama_unit,
            'setting_detail_unit'=> $detail_unit,
            'setting_email_unit' => $email_unit
        );

        $query = $this->m_setting->insertData($data);

        if($query > 0){
            $message = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>Gagal menyimpan data.</div>';
            $this->session->set_flashdata('message',$message);
        } else {
            $message = '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Success:</span>Data berhasil disimpan.</div>';
            $this->session->set_flashdata('message',$message);
        }
        redirect('setting', 'refresh');
    }


    public function _update(){
        $id          = $this->input->post('setting_id',true);
        $nama_unit   = $this->input->post('setting_nama_unit',true);
        $detail_unit = $this->input->post('setting_detail_unit',true);
        $email_unit  = $this->input->post('setting_email_unit',true);

        $data = array(
            'setting_nama_unit' => $nama_unit,
            'setting_detail_unit'=> $detail_unit,
            'setting_email_unit' => $email_unit
        );

        $query = $this->m_setting->updateData($data,$id);


        if($query > 0){
            $message = '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Success:</span>Data berhasil disimpan.</div>';
            $this->session->set_flashdata('message',$message);
        } else {
            $message = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>Gagal menyimpan data.</div>';
            $this->session->set_flashdata('message',$message);


        }
        redirect('setting', 'refresh');
    }

    public function jsonPassword(){
        $query= $this->m_setting->getAllPassword();
        $data = array();
		foreach($query->result() as $q){
			$data[] =  $q;
		}
		$final = array('data' => $data);
    	echo json_encode($final);
    }

    public function formPassword($id = null){
		$sql = $this->m_sidebar->getAll();
		$arr['menu'] = $this->db->query($sql);
		$sidebar  = array('artikel' => 'active');
		if($id != null){
			$arr['query'] = $this->m_setting->getAuthById($id);
			$content  = array('task' => 1 , 'id' => $id , 'query' => $arr );
		} else {
			$content  = array('task' => 4 , 'query' => $arr);
		}
		$data = array(
			'header' => $this->load->view('slice/header',array(),true),
			'sidebar'=> $this->load->view('slice/sidebar',$sidebar,true),
			'content'=> $this->load->view('setting/_formPassword',$content,true)
		);
		$this->load->view('layout/backend',$data);
    }

    private function savePassword(){
        $data = array(
            'sidebar_id' => $this->input->post('m_sidebar_id'),
            'password'   => $this->input->post('password')
        );
        $query = $this->m_setting->insertPassword($data);
        return redirect('setting', 'refresh');
    }

    private function updatePassword(){
        $id = $this->input->post('id');
        $data = array(
            'sidebar_id' => $this->input->post('m_sidebar_id'),
            'password'   => $this->input->post('password')
        );
        $query = $this->m_setting->updatePassword($id, $data);
        return redirect('setting', 'refresh');
    }
	
	private function deletePassword(){
        $id = $this->input->post('id');
        $query = $this->m_setting->deletePassword($id);
        return redirect('setting', 'refresh');
    }

}
