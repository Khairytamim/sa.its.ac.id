<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acl {

	protected $ci;

	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->driver('session');
	}

	public function _validation(){
		$access = $this->ci->session->userdata('access');
		$resource = array(
			'administrator' => array('all'),
			'contributor'	=> array('artikel','admin')
		);
		if(array_key_exists($access,$resource)){
			$this->ci->session->set_userdata('resource',$resource[$access]);
			redirect('artikel');
		}
	}

	public function _register($query){
		$result = $query->row();
		$this->ci->session->set_userdata('username',$result->users_nama);
		$this->ci->session->set_userdata('id',$result->users_id);
		$this->ci->session->set_userdata('access',$result->role_nama);
	}

	public function _logout(){
		$this->ci->session->sess_destroy();
	}

	public function _resource($class){
		$resource = $this->ci->session->userdata('resource');
		if(is_null($resource)){
			show_404();
		} else {
			if(in_array('all',$resource)){
				return true;
			} else if(in_array($class,$resource)){
				return true;
			} else {
				show_404();
			}
		}
	}

}
