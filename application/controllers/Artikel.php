<?php

class Artikel extends CI_Controller {

	protected $class;
	protected $action;

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->class = strtolower(get_class($this));
		$this->load->library('acl');
		$this->acl->_resource($this->class);
		$this->load->model('m_artikel');
		$this->load->model('m_sidebar');
	}

	public function index(){
		$task = $this->input->post('task');
		switch($task){
			case 1:
				if($this->input->post('tambah')){
					$this->action = "2";
					$this->_form($this->action);
				} else {
					show_404();
				}
				break;
			case 2:
				$this->_insert();
				break;
			case 3:
				if($this->input->post('ubah')){
					$this->action = "4";
					$this->_form($this->action);
				}
				else if($this->input->post('hapus')){
					$this->_delete();
				}
				break;
			case 4:
				$this->_update();
				break;
			default:
				$sidebar = array('artikel' => 'active');
				$data = array(
					'header' => $this->load->view('slice/header',array(),true),
					'sidebar'=> $this->load->view('slice/sidebar',$sidebar,true),
					'content'=> $this->load->view('artikel/_list',array(),true)
				);
				$this->load->view('layout/backend',$data);
		}

	}

	public function json(){
		$sql = $this->m_artikel->getAll()." order by artikel_time desc";
		$query = $this->db->query($sql);
		$data = array();
		foreach($query->result() as $q){
			$data[] =  $q;
		}
		$final = array('data' => $data);
    	echo json_encode($final);
    }

	public function _form($task){
		$id  = $this->input->post('id');
		$sql = $this->m_sidebar->getAll();
		$arr['menu'] = $this->db->query($sql);
		$sidebar  = array('artikel' => 'active');
		if(isset($id)){
			$sql   	  = $this->m_artikel->getDataById();
			$arr['query'] = $this->db->query($sql, array($id));
			$content  = array('task' => $task , 'id' => $id , 'query' => $arr );
		} else {
			$content  = array('task' => $task , 'query' => $arr);
		}
		$data = array(
			'header' => $this->load->view('slice/header',array(),true),
			'sidebar'=> $this->load->view('slice/sidebar',$sidebar,true),
			'content'=> $this->load->view('artikel/_form',$content,true)
		);
		$this->load->view('layout/backend',$data);
	}

	public function _insert(){
		$data = array(
			'judul_ing'     => strtoupper($this->input->post('judul_ing')),
			'judul_ind'     => strtoupper($this->input->post('judul_ind')),
			'artikel_ing'   => $this->input->post('artikel_ing',false),
			'artikel_ind'   => $this->input->post('artikel_ind',false),
			'm_sidebar_id'  => $this->input->post('m_sidebar_id'),

			'artikel_time'  => date('Y-m-d H:i:s',strtotime($this->input->post('artikel_time'))),
			'artikel_user'  => $this->session->userdata('id')
		);
		$this->m_artikel->_insert($data);
		redirect('artikel', 'refresh');
	}

	public function _update(){
		$id = $this->input->post('id');
		$data = array(
			'judul_ing'     => strtoupper($this->input->post('judul_ing')),
			'judul_ind'     => strtoupper($this->input->post('judul_ind')),
			'artikel_ing'   => $this->input->post('artikel_ing',false),
			'artikel_ind'   => $this->input->post('artikel_ind',false),
			'm_sidebar_id'  => $this->input->post('m_sidebar_id'),
			'artikel_user'  => $this->session->userdata('id'),
			'artikel_time'  => date('Y-m-d H:i:s',strtotime($this->input->post('artikel_time'))),
		);
		$query = $this->m_artikel->_update($id,$data);

		if($query == 1){
			$message =  "Success, data berhasil di hapus";
		    $alert   =  "alert-success";
		} else {
			$message =  "Sorry, gagal menghapus data";
		    $alert   =  "alert-danger";
		}
		$this->session->set_flashdata('message',"<div class='alert ".$alert."' role='alert'>".$message."</div>");
		redirect('artikel', 'refresh');
	}

	public function _delete(){
		$id = $this->input->post('id');
		$query = $this->m_artikel->_delete($id);

		if($query == 1){
			$message =  "Success, data berhasil di hapus";
		    $alert   =  "alert-success";
		} else {
			$message =  "Sorry, gagal menghapus data";
		    $alert   =  "alert-danger";
		}
		$this->session->set_flashdata('message',"<div class='alert ".$alert."' role='alert'>".$message."</div>");
		redirect('artikel', 'refresh');
	}

}
