<?php


class Sidebar extends CI_Controller {

	protected $class;

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->class = strtolower(get_class($this));
		$this->load->library('acl');
		$this->acl->_resource($this->class);
		$this->load->library('parser');
		$this->load->model('m_sidebar');
	}

	public function index(){
		$task = $this->input->post('task');
		switch ($task) {
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
				$sidebar = array('sidebar' => 'active');
				$data = array(
					'header' => $this->parser->parse('slice/header',array(),true),
					'sidebar'=> $this->parser->parse('slice/sidebar',$sidebar,true),
					'content'=> $this->parser->parse('sidebar/_list',array(),true)
				);
				$this->parser->parse('layout/backend',$data);
		}
	}


	public function json(){
		$sql = $this->m_sidebar->getAll();
		$query = $this->db->query($sql);
		$data = array();
		foreach($query->result() as $q){
			$data[] =  $q;
		}
		$final = array('data' => $data);
    	echo json_encode($final);
	}

	private function _form($task){
		$id = $this->input->post('id');
		$sidebar  = array('sidebar' => 'active');
		if(isset($id)){
			$sql   	  = $this->m_sidebar->getDataById();
			$arr['query'] = $this->db->query($sql, array($id));
			$content  = array('task' => $task , 'id' => $id , 'query' => $arr );
		} else {
			$content  = array('task' => $task , 'query' => '');
		}
		$sql = $this->m_sidebar->getAll()." WHERE sidebar_parent = 0 ";
		$content['parent'] = $this->db->query($sql)->result();
		$data = array(
			'header' => $this->parser->parse('slice/header',array(),true),
			'sidebar'=> $this->parser->parse('slice/sidebar',$sidebar,true),
			'content'=> $this->parser->parse('sidebar/_form',$content,true)
		);
		$this->parser->parse('layout/backend',$data);
	}

	private function _insert(){
		$data = array(
			'sidebar_parent' => 0,
			'sidebar_ing'    => strtoupper($this->input->post('sidebar_ing')),
			'sidebar_ind'    => strtoupper($this->input->post('sidebar_ind')),
			'sidebar_users'  => $this->session->userdata('id'),
			'sidebar_urutan' => $this->input->post('sidebar_urutan'),
			'keyword' 	     => $this->input->post('keyword'),
			'flag' => 1
		);
		$this->m_sidebar->_insert($data);
		redirect('sidebar', 'refresh');
	}

	private function _update(){
		$id = $this->input->post('id');
		$data = array(
			'sidebar_parent' => 0,
			'sidebar_ing'    => $this->input->post('sidebar_ing'),
			'sidebar_ind'    => $this->input->post('sidebar_ind'),
			'sidebar_users'  => $this->session->userdata('id'),
			'sidebar_urutan' => $this->input->post('sidebar_urutan'),
			'keyword' 	     => $this->input->post('keyword'),
			'flag' => 1
		);
		$query = $this->m_sidebar->_update($id,$data);

		if($query == 1){
			$message =  "Success, data berhasil di hapus";
		    $alert   =  "alert-success";
		} else {
			$message =  "Sorry, gagal menghapus data";
		    $alert   =  "alert-danger";
		}
		$this->session->set_flashdata('message',"<div class='alert ".$alert."' role='alert'>".$message."</div>");
		redirect('sidebar', 'refresh');
	}

	private function _delete(){
		$id = $this->input->post('id');
		$query = $this->m_sidebar->_delete($id);

		if($query == 1){
			$message =  "Success, data berhasil di hapus";
		    $alert   =  "alert-success";
		} else {
			$message =  "Sorry, gagal menghapus data";
		    $alert   =  "alert-danger";
		}
		$this->session->set_flashdata('message',"<div class='alert ".$alert."' role='alert'>".$message."</div>");
		redirect('sidebar', 'refresh');
	}

}
