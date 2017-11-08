<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	protected $site;
	protected $content;
	private $sidebar;
	private $sidebarMobile;

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->driver('session');
		$this->load->model('m_pengumuman');
		$this->load->model('m_artikel');
		$this->load->model('m_agenda');
		$this->load->model('m_sidebar');
		$this->load->model('m_upload');
		$this->load->model('m_quicklink');
		$this->load->model('m_setting');
		$this->load->library('template');

	}

	public function site(){
		$sql   	    = $this->m_pengumuman->getAll();
		$pengumuman = $this->db->query($sql);
		$sql        = $this->m_agenda->getAll();
		$agenda     = $this->db->query($sql);
		$sidebar 	= $this->sidebar();
		$sidebarMobile 	= $this->sidebarMobile();
		$sql        = $this->m_quicklink->getAll();
		$quicklink  = $this->db->query($sql);

		$arr['pengumuman'] = $pengumuman->result();
		$arr['agenda']	   = $agenda->result();
		$arr['sidebar']	   = $sidebar;
		$arr['sidebarMobile'] = $sidebarMobile;
		$arr['quicklink']  = $quicklink->result();
		$arr['hr']		   = "";
		$arr['setting']	   = $this->m_setting->getData();


		$resource = $this->uri->segment(2);
		$id		  = $this->uri->segment(3);

		$this->setSite();
		$this->setContent();

		if(array_key_exists($resource, $this->site)){
			$sql   = $this->site[$resource];
		
			$query = $this->db->query($sql,array($id));
			if($query->num_rows()){
				$arr['content'] = $query->result();
				$this->template->setContent($this->content[$resource]);
				$this->template->display($arr);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	private function setSite(){
		$this->site = array(
			'pengumuman' => $this->m_pengumuman->getDataById(),
			'artikel'	 => $this->m_artikel->getDataById(),
			'agenda'	 => $this->m_agenda->getDataById()
		);
	}

	private function setContent(){
		$this->content = array(
			'pengumuman' => 'page/pengumuman',
			'artikel'	 => 'home/content',
			'agenda'	 => 'page/agenda'
		);
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
		$this->sidebar .= "<li><a href='".base_url()."'><span>haha</span></a></li>";
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

	// public function sidebar(){
	// 	$sql   = $this->m_sidebar->getAllUnion();
	// 	$query = $this->db->query($sql);
	// 	$this->sidebar = '';
	// 	$this->recursive($query->result(), $query->num_rows(), 0 );
	// 	return $this->sidebar;
	// }

	// private function recursive($obj , $count , $iterasi){
	// 	if($iterasi >= $count - 1  ){
	// 		if($obj[$iterasi]->sidebar_parent == $obj[$iterasi - 1]->sidebar_id ){
	// 			$this->sidebar .= "<ul class='side-nav'>";
	// 		} else if($obj[$iterasi]->level != $obj[$iterasi - 1]->level){
	// 			$this->sidebar .= "</li></ul>";
	// 		}
	// 		if($this->session->userdata('bahasa') == 'eng'){
	// 			$this->sidebar .= "  <li><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ing."</a></li> </ul>";
	// 		} else {
	// 			$this->sidebar .= "  <li><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ind."</a></li> </ul>";
	// 		}
	//
	// 		if($obj[$iterasi]->level != $obj[$iterasi - 1]->level) {
	// 			$this->sidebar .= "</li></ul>";
	// 		}
	// 	} else {
	// 		if($iterasi == 0){
	// 			$this->sidebar .= "<ul class='side-nav'>";
	// 			$this->sidebar .= "<li><a href='".base_url('index.php/home')."' >BERANDA</a></li>";
	// 		} else {
	// 			if($obj[$iterasi]->sidebar_parent == $obj[$iterasi - 1]->sidebar_id ){
	// 				$this->sidebar .= "<ul class='side-nav'>";
	// 			} else if($obj[$iterasi]->level != $obj[$iterasi - 1]->level) {
	// 				$this->sidebar .= "</li></ul>";
	// 			}
	// 		}
	// 		if($obj[$iterasi]->sidebar_id == $obj[$iterasi + 1]->sidebar_parent ){
	// 			if($this->session->userdata('bahasa') == 'eng'){
	// 				$this->sidebar .= "<li><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ing."</a>";
	// 			} else {
	// 				$this->sidebar .= "<li><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ind."</a>";
	// 			}
	// 			$this->recursive($obj , $count , $iterasi+1);
	// 		} else {
	// 			if($this->session->userdata('bahasa') == 'eng'){
	// 				$this->sidebar .= "<li><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ing."</a></li>";
	// 			} else {
	// 				$this->sidebar .= "<li><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ind."</a></li>";
	// 			}
	// 			$this->recursive($obj , $count , $iterasi+1);
	// 		}
	// 	}
	// }
	//
	// private function sidebarMobile(){
	// 	$sql   = $this->m_sidebar->getAllUnion();
	// 	$query = $this->db->query($sql);
	// 	$this->sidebarMobile = '';
	// 	// $this->recursiveMobile($query->result(), $query->num_rows(), 0 );
	// 	$this->recursiveMobile();
	// 	return $this->sidebarMobile;
	//
	// }

	// private function recursiveMobile($obj , $count , $iterasi){
	// 	if($iterasi >= $count - 1  ){
	//
	// 		if($obj[$iterasi]->sidebar_parent == $obj[$iterasi - 1]->sidebar_id ){
	// 			$this->sidebarMobile .= "<ul class='left-submenu'>";
	// 			$this->sidebarMobile .= "<li class='back'><a href='#'>back</a></li>";
	// 		} else if($obj[$iterasi]->level != $obj[$iterasi - 1]->level){
	// 			$this->sidebarMobile .= "</li></ul>";
	// 		}
	// 		if($this->session->userdata('bahasa') == 'eng'){
	// 			$this->sidebarMobile .= "  <li><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ing."</a></li> </ul>";
	// 		} else {
	// 			$this->sidebarMobile .= "  <li><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ind."</a></li> </ul>";
	// 		}
	//
	// 		if($obj[$iterasi]->level != $obj[$iterasi - 1]->level) {
	// 			$this->sidebarMobile .= "</li></ul>";
	// 		}
	// 	} else {
	// 		if($iterasi == 0){
	// 			$this->sidebarMobile .= "<ul class='off-canvas-list'>";
	// 			$this->sidebarMobile .= "<li><a href='".base_url('index.php/home')."' >Beranda</a></li>";
	// 		} else {
	// 			if($obj[$iterasi]->sidebar_parent == $obj[$iterasi - 1]->sidebar_id ){
	// 				$this->sidebarMobile .= "<ul class='left-submenu'>";
	// 				$this->sidebarMobile .= "<li class='back'><a href='#'>back</a></li>";
	// 			} else if($obj[$iterasi]->level != $obj[$iterasi - 1]->level) {
	// 				$this->sidebarMobile .= "</li></ul>";
	// 			}
	// 		}
	// 		if($obj[$iterasi]->sidebar_id == $obj[$iterasi + 1]->sidebar_parent ){
	// 			if($this->session->userdata('bahasa') == 'eng'){
	// 				$this->sidebarMobile .= "<li class='has-submenu'><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ing."</a>";
	// 			} else {
	// 				$this->sidebarMobile .= "<li class='has-submenu'><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ind."</a>";
	// 			}
	// 			$this->recursiveMobile($obj , $count , $iterasi+1);
	// 		} else {
	// 			if($this->session->userdata('bahasa') == 'eng'){
	// 				$this->sidebarMobile .= "<li><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ing."</a></li>";
	// 			} else {
	// 				$this->sidebarMobile .= "<li><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ind."</a></li>";
	// 			}
	// 			$this->recursiveMobile($obj , $count , $iterasi+1);
	// 		}
	// 	}
	// }

}
