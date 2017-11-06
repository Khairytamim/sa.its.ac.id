<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->driver('session');
		$this->load->database();
		$this->load->model('m_users');
		$this->load->library('acl');
	}


	public function index(){
		$this->acl->_validation();
		$task = $this->input->post('task');
		switch($task){
			case 1:
				$this->_login();
				break;
			default:
				$this->load->view('login/index');
		}

	}

	private function _login(){
		$username = $this->input->post('users_nama');
		// $password = md5('kuM1nt4!'.$this->input->post('users_password'));
		$password = $this->input->post('users_password');

		$data  = array($username,$password);
		$sql   = $this->m_users->_login();
		$query = $this->db->query($sql,$data);
		if($query->num_rows() > 0){
			$this->acl->_register($query);
			redirect('auth', 'refresh');
		} else {
			echo "gagal login";
		}
	}


	public function logout(){
		$this->acl->_logout();
		redirect('auth', 'refresh');
	}

}
