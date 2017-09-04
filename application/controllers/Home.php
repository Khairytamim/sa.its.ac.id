<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	private $limit  = 5;
	private $offset = 0;
	protected $sidebar;
	protected $sidebarMobile;

	public function __construct(){
		parent::__construct();
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
		if($this->uri->segment(3)){
			$this->offset = $this->uri->segment(3) - 1;
		}
		$sql        = $this->m_artikel->getDataByKeyword();
		$artikel    = $this->db->query($sql,array(0));


		$this->load->library('pagination');
		$config['base_url']    = base_url('home/index');
		$config['total_rows']  = $artikel->num_rows();
		$config['per_page']	   = $this->limit;
		$config['full_tag_open'] = "<ul class='pagination right'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='current'><a href='#'>";
		$config['cur_tag_close'] = "</a></li>";
		$config['next_tag_open'] = "<li class='arrow'>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li class='arrow'>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		$config['first_link'] = "First";
		$config['last_link'] = "Last";
		$config['next_link'] = '&raquo;';
		$config['prev_link'] = '&laquo;';
		$this->pagination->initialize($config);



		$sql        .= " order by artikel_time desc LIMIT ? OFFSET ? ";
		$artikel     = $this->db->query($sql,array(0,$this->limit, (int) $this->offset));


		$sql   	    = $this->m_pengumuman->getAll();
		$pengumuman = $this->db->query($sql);
		$sql        = $this->m_agenda->getAll();
		$agenda     = $this->db->query($sql);
		$sidebar 	= $this->sidebar();
		$sidebarMobile = $this->sidebarMobile();
		$sql        = $this->m_quicklink->getAll();
		$quicklink  = $this->db->query($sql);

		$arr['pagination'] = $this->pagination->create_links();
		$arr['content']    = $artikel->result();
		$arr['pengumuman'] = $pengumuman->result();
		$arr['agenda']	   = $agenda->result();
		$arr['sidebar']	   = $sidebar;
		$arr['sidebarMobile'] = $sidebarMobile;
		$arr['quicklink']  = $quicklink->result();
		$arr['setting']	   = $this->m_setting->getData();
		$arr['hr']		   = "<hr />";
		$arr['date'] = true;
		$this->template->display($arr);
	}

	public function site(){
		$id   		= $this->uri->segment(2);

		$sql        = $this->m_artikel->getDataByRequest().' order by artikel_time desc';

		$artikel    = $this->db->query($sql,array($id));
		$sidebar_id = $this->m_setting->getCheckAuth($artikel->row('sidebar_id'));

		$sql   	    = $this->m_pengumuman->getAll();
		$pengumuman = $this->db->query($sql);
		$sql        = $this->m_agenda->getAll();
		$agenda     = $this->db->query($sql);
		$sidebar 	= $this->sidebar();
		$sidebarMobile = $this->sidebarMobile();
		$sql        = $this->m_quicklink->getAll();
		$quicklink  = $this->db->query($sql);

		if($this->session->userdata('artikel') != $id){
			$this->session->unset_userdata('artikel');
		}
		if($sidebar_id->num_rows() > 0 && $this->session->userdata('artikel') == ""){
			$this->secure($id, $artikel->row('sidebar_id'));
		} else {
			if($artikel->num_rows()){
				$arr['content']    = $artikel->result();
				$arr['pengumuman'] = $pengumuman->result();
				$arr['agenda']	   = $agenda->result();
				$arr['sidebar']	   = $sidebar;
				$arr['sidebarMobile'] = $sidebarMobile;
				$arr['quicklink']  = $quicklink->result();
				$arr['setting']	   = $this->m_setting->getData();
				$arr['hr']		   = "<hr />";
				$arr['pagination'] = "";
				$this->template->display($arr);
			} else {
				show_404();
			}

		}


	}

	public function setLanguage(){
		$url   = $this->input->post('url');
		$param = $this->input->post('translate');
		if(isset($param)) {
			$arr = array('ind' , 'eng');
			if(in_array($param, $arr)){
				$this->session->set_userdata('bahasa', $param);
				redirect($url, 'refresh');
			} else {
				show_404();
			}
		} else {
			show_404();
		}

	}

	public function secure($keyword, $sidebar_id){
		$this->template->setContent('home/password');
		$sql   	    = $this->m_pengumuman->getAll();
		$pengumuman = $this->db->query($sql);
		$sql        = $this->m_agenda->getAll();
		$agenda     = $this->db->query($sql);
		$sidebar 	= $this->sidebar();
		$sidebarMobile = $this->sidebarMobile();
		$sql        = $this->m_quicklink->getAll();
		$quicklink  = $this->db->query($sql);
		$arr['pengumuman'] = $pengumuman->result();
		$arr['agenda']	   = $agenda->result();
		$arr['sidebar']	   = $sidebar;
		$arr['sidebarMobile'] = $sidebarMobile;
		$arr['quicklink']  = $quicklink->result();
		$arr['setting']	   = $this->m_setting->getData();
		$arr['keyword']    = $keyword;
		$arr['sidebar_id']    = $sidebar_id;
		return $this->template->display($arr);
	}

	public function set_secure(){
		$password 	= $this->input->post('password');
		$sidebar_id = $this->input->post('sidebar_id');
		$keyword	= $this->input->post('keyword');
		$setting  	= $this->m_setting->checkAuth($sidebar_id, $password);
		if($setting->num_rows()){
			$this->session->set_userdata('artikel', $keyword);
		} else {
			$this->session->set_flashdata('message', 'Not valid password');
		}
		return redirect('site/'.$keyword,  'refresh');
	}

	// check bahasa;
	private function getLanguage(){
		echo $this->session->userdata('bahasa');
	}

	public function detail(){
		$id   		= $this->uri->segment(3);
		$sql        = $this->m_artikel->getDataById();
		$artikel    = $this->db->query($sql,array($id));
		$sql   	    = $this->m_pengumuman->getAll();
		$pengumuman = $this->db->query($sql);
		$sql        = $this->m_agenda->getAll();
		$agenda     = $this->db->query($sql);
		$sidebar 	= $this->sidebar();
		$sidebarMobile = $this->sidebarMobile();
		$sql        = $this->m_quicklink->getAll();
		$quicklink  = $this->db->query($sql);

		$this->template->setContent('home/detail');

		if($artikel->num_rows()){
			$arr['content']    = $artikel->result();
			$arr['pengumuman'] = $pengumuman->result();
			$arr['agenda']	   = $agenda->result();
			$arr['sidebar']	   = $sidebar;
			$arr['sidebarMobile'] = $sidebarMobile;
			$arr['quicklink']  = $quicklink->result();
			$arr['setting']	   = $this->m_setting->getData();
			$arr['hr']		   = "<hr />";
			$arr['date'] = true;
			$this->template->display($arr);
		} else {
			show_404();
		}
	}

	private function sidebar(){
		$sql   = $this->m_sidebar->tampilan();
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

	// private function recursive($obj , $count , $iterasi){
		// if($iterasi >= $count - 1  ){
		//
		// 	if($obj[$iterasi]->sidebar_parent == $obj[$iterasi - 1]->sidebar_id ){
		// 		$this->sidebar .= "<ul class='side-nav'>";
		// 	} else if($obj[$iterasi]->level != $obj[$iterasi - 1]->level){
		// 		$this->sidebar .= "</li></ul>";
		// 	}
		// 	if($this->session->userdata('bahasa') == 'eng'){
		// 		$this->sidebar .= "  <li><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ing."</a></li> </ul>";
		// 	} else {
		// 		$this->sidebar .= "  <li><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ind."</a></li> </ul>";
		// 	}
		//
		// 	if($obj[$iterasi]->level != $obj[$iterasi - 1]->level) {
		// 		$this->sidebar .= "</li></ul>";
		// 	}
		// } else {
		// 	if($iterasi == 0){
		// 		$this->sidebar .= "<ul class='side-nav'>";
		// 		$this->sidebar .= "<li><a href='".base_url('index.php/home')."' >BERANDA</a></li>";
		// 	} else {
		// 		if($obj[$iterasi]->sidebar_parent == $obj[$iterasi - 1]->sidebar_id ){
		// 			$this->sidebar .= "<ul class='side-nav'>";
		// 		} else if($obj[$iterasi]->level != $obj[$iterasi - 1]->level) {
		// 			$this->sidebar .= "</li></ul>";
		// 		}
		// 	}
		// 	if($obj[$iterasi]->sidebar_id == $obj[$iterasi + 1]->sidebar_parent ){
		// 		if($this->session->userdata('bahasa') == 'eng'){
		// 			$this->sidebar .= "<li><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ing."</a>";
		// 		} else {
		// 			$this->sidebar .= "<li><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ind."</a>";
		// 		}
		// 		$this->recursive($obj , $count , $iterasi+1);
		// 	} else {
		// 		if($this->session->userdata('bahasa') == 'eng'){
		// 			$this->sidebar .= "<li><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ing."</a></li>";
		// 		} else {
		// 			$this->sidebar .= "<li><a href='".base_url('index.php/site/'.$obj[$iterasi]->sidebar_id)."'>".$obj[$iterasi]->sidebar_ind."</a></li>";
		// 		}
		// 		$this->recursive($obj , $count , $iterasi+1);
		// 	}
		// }
	// }

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

	// private function recursiveMobile($obj , $count , $iterasi){
	// 	if($iterasi >= $count - 1  ){
	//
	// 		if($obj[$iterasi]->sidebar_parent == $obj[$iterasi - 1]->sidebar_id ){
	// 			$this->sidebarMobile .= "<ul class='left-submenu'>";
	// 			$this->sidebarMobile .= "<li class='back'><a href='#'>BACK</a></li>";
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
	// 			$this->sidebarMobile .= "<li><a href='".base_url('index.php/home')."' >BERANDA</a></li>";
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
