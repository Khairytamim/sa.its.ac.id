<?php

class Users extends CI_Controller {


	protected $class;

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->class = strtolower(get_class($this));
	}

	private function _insert(){
		$data = array(
			'users_nama' 	 => 'rahmad',
			'users_password' => md5('kuM1nt4!'.'123456'),
			'users_active'	 => 1,
			'users_roles'	 => 2
		);

		$this->db->trans_begin();

		$query = $this->db->insert('m_users',$data);

		if ($this->db->trans_status() === FALSE)
		{
	        $this->db->trans_rollback();
	        echo "data tidak berhasil di simpan";
		}
		else
		{
	        $this->db->trans_commit();
	        echo "data berhasil di tambahkan";
		}
	}

	
}
