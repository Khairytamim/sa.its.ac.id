<?php

class M_users extends CI_Model {

	protected $sql;

	public function _login(){
		$this->sql = "
			SElECT * FROM m_users
		    LEFT JOIN m_role ON users_roles = role_id
		    WHERE users_nama = ? AND users_password = ? ";
		return $this->sql;
	}


	public function _update($id, $data){

		$this->db->trans_begin();

		$this->db->where('users_id',$id);
		$query = $this->db->update('m_users',$data);

		if ($this->db->trans_status() === FALSE)
		{
	        $this->db->trans_rollback();
			return 0;
		}
		else
		{
	        $this->db->trans_commit();
			return 1;
		}
	}

	public function _checkPassword($id, $password){
		$this->db->where('users_id',$id);
		$this->db->where('users_password',$password);
		return $this->db->get('m_users');
	}
}
