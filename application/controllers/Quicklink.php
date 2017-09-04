<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quicklink extends CI_Controller {

	protected $class;
	protected $action;

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->class = strtolower(get_class($this));
		$this->load->library('acl');
		$this->acl->_resource($this->class);
		$this->load->library('parser');
		$this->load->model('m_quicklink');
	}

	public function index(){
		$task = $this->input->post('task');
		switch ($task) {
			case 1:
				if($this->input->post('tambah')){
					$this->action = 2;
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
				$sidebar = array('quicklink' => 'active');
				$data = array(
					'header' => $this->load->view('slice/header',array(),true),
					'sidebar'=> $this->load->view('slice/sidebar',$sidebar,true),
					'content'=> $this->load->view('quicklink/_list',array(),true)
				);
				$this->load->view('layout/backend',$data);
		}
	}

	public function json(){
		$sql = $this->m_quicklink->getAll();
		$query = $this->db->query($sql);
		$data = array();
		foreach($query->result() as $q){
			$data[] =  $q;
		}
		$final = array('data' => $data);
    	echo json_encode($final);
	}

	private function _insert(){
		$data = array(
			'quicklink_nama'  => $this->input->post('quicklink_nama'),
			'quicklink_url'   => $this->input->post('quicklink_url'),
			'quicklink_image' => $this->input->post('quicklink_image')
		);
		$this->m_quicklink->_insert($data);
		redirect('quicklink', 'refresh');
	}

	private function _form($task){
		$id = $this->input->post('id');
		$sidebar  = array('quicklink' => 'active');
		if(isset($id)){
			$sql   	      = $this->m_quicklink->getDataById();
			$arr['query'] = $this->db->query($sql, array($id));
			$content      = array('task' => $task , 'id' => $id , 'query' => $arr );
		} else {
			$content  = array('task' => $task , 'query' => '');
		}
		$data = array(
			'header' => $this->parser->parse('slice/header',array(),true),
			'sidebar'=> $this->parser->parse('slice/sidebar',$sidebar,true),
			'content'=> $this->parser->parse('quicklink/_form',$content,true)
		);
		$this->parser->parse('layout/backend',$data);
	}

	private function _delete(){
		$id = $this->input->post('id');
		$query = $this->m_quicklink->_delete($id);

		if($query == 1){
			$message =  "Success, data berhasil di hapus";
		    $alert   =  "alert-success";
		} else {
			$message =  "Sorry, gagal menghapus data";
		    $alert   =  "alert-danger";
		}
		$this->session->set_flashdata('message',"<div class='alert ".$alert."' role='alert'>".$message."</div>");
		redirect('quicklink', 'refresh');
	}

	private function _update(){
		$id = $this->input->post('id');
		$data = array(
			'quicklink_nama'  => $this->input->post('quicklink_nama'),
			'quicklink_url'   => $this->input->post('quicklink_url'),
			'quicklink_image' => $this->input->post('quicklink_image')
		);
		$query = $this->m_quicklink->_update($id,$data);

		if($query == 1){
			$message =  "Success, data berhasil di update";
		    $alert   =  "alert-success";
		} else {
			$message =  "Sorry, gagal update data";
		    $alert   =  "alert-danger";
		}
		$this->session->set_flashdata('message',"<div class='alert ".$alert."' role='alert'>".$message."</div>");
		redirect('quicklink', 'refresh');
	}
}
