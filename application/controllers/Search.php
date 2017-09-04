<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	protected $sidebar;
	protected $sidebarMobile;

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->driver('session');
		$this->load->model('m_artikel');
		$this->load->model('m_pengumuman');
		$this->load->model('m_agenda');
		$this->load->model('m_sidebar');
		$this->load->model('m_quicklink');
		$this->load->model('m_setting');
		$this->load->library('template');
	}

	public function index(){
		$keyword = $this->input->post('keyword');
		if(!empty($keyword)){
			$sql = $this->m_artikel->getAll();
			if($this->session->userdata('bahasa') == 'eng'){
				$sql .= " WHERE judul_ing LIKE ? ";
			} else {
				$sql .= " WHERE judul_ind LIKE ? ";
			}
			$keyword = '%'.$keyword.'%';
			$query   = $this->db->query($sql , array($keyword));

			$data['query'] = $query->result();
			$data['count'] = $query->num_rows();

			$sql   	    = $this->m_pengumuman->getAll();
			$pengumuman = $this->db->query($sql);
			$sql        = $this->m_agenda->getAll();
			$agenda     = $this->db->query($sql);
			$sidebar 	= $this->sidebar();
			$sidebarMobile 	= $this->sidebarMobile();
			$sql        = $this->m_quicklink->getAll();
			$quicklink  = $this->db->query($sql);

			$data['keyword']	= $this->input->post('keyword');
			$data['pengumuman'] = $pengumuman->result();
			$data['agenda']	    = $agenda->result();
			$data['setting']	   = $this->m_setting->getData();
			$data['sidebar']	= $sidebar;
			$data['sidebarMobile']	= $sidebarMobile;
			$data['quicklink']  = $quicklink->result();
			$this->template->setContent('search/_list');
			$this->template->display($data);
		} else {
			redirect('home', 'refresh');
		}
	}

	private function sidebar(){
		$sql   = $this->m_sidebar->getAll();
		$query = $this->db->query($sql);
		$this->sidebar = '';
		// $this->recursive($query->result(), $query->num_rows(), 0 );
		$this->recursive($query);
		return $this->sidebar;

	}

	private function recursive($obj){
		$this->sidebar .= "<div id='cssmenu'><ul>";
		$this->sidebar .= "<li><a href='".base_url()."'><span>HOME</span></a></li>";
		foreach ($obj->result() as $k) {
			$src   = base_url('index.php/site/'.$k->keyword);
			if($this->session->userdata('bahasa') == 'eng'){
				$title = $k->sidebar_ing;
			} else {
				$title = $k->sidebar_ind;
			}
			$this->sidebar .= "<li><a href='".$src."'><span>".$title."</span></a></li>";
		}
		$this->sidebar .= "</ul></div>";
	}

	private function sidebarMobile(){
		$sql   = $this->m_sidebar->getAll();
		$query = $this->db->query($sql);
		$this->sidebarMobile = '';
		// $this->recursiveMobile($query->result(), $query->num_rows(), 0 );
		$this->recursiveMobile($query);
		return $this->sidebarMobile;
	}

	private function recursiveMobile($obj){
		$this->sidebarMobile .= "<ul class='off-canvas-list'>";
		$this->sidebar .= "<li><a href='".base_url()."'>HOME</a></li>";
		foreach ($obj->result() as $k) {
			$src   = base_url('index.php/site/'.$k->keyword);
			if($this->session->userdata('bahasa') == 'eng'){
				$title = $k->sidebar_ing;
			} else {
				$title = $k->sidebar_ind;
			}
			$this->sidebarMobile .= "<li><a href='".$src."'>".$title."</a></li>";
		}
		$this->sidebarMobile .= "</ul>";
	}
}
