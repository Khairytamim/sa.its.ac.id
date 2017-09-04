<?php

class M_artikel extends CI_Model{

	protected $sql;
	protected $table;

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table = "m_artikel";
	}

	public function getAll(){
		$this->sql = "SELECT * FROM ".$this->table." LEFT JOIN m_users ON artikel_user = users_id";
		return $this->sql;
	}

	public function _insert($data){

		$this->db->trans_begin();
		$query = $this->db->insert($this->table,$data);
		if ($this->db->trans_status() === FALSE)
		{
	        $this->db->trans_rollback();
	        return FALSE;
		}
		else
		{
	        $this->db->trans_commit();
	        return TRUE;
		}

	}

	public function getDataById(){
		$this->sql = $this->getAll()." WHERE artikel_id = ? ";
		return $this->sql;
	}

	public function getDataByKeyword(){
		$this->sql = $this->getAll()." WHERE m_sidebar_id = ? ";
		return $this->sql;
	}


	public function getDataByRequest(){
		$this->sql = $this->getAll()." LEFT JOIN m_sidebar ON m_sidebar_id = sidebar_id WHERE keyword = ? ";
		return $this->sql;
	}

	public function _update($id , $data){
		$this->db->trans_begin();
		$this->db->where('artikel_id',$id);
		$this->db->update($this->table,$data);
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function _delete($id){

		$this->db->trans_begin();
		$this->db->where('artikel_id',$id);
		$this->db->delete($this->table);
		if ($this->db->trans_status() === FALSE)
		{
	        $this->db->trans_rollback();
			return FALSE;
		}
		else
		{
	        $this->db->trans_commit();
			return TRUE;
		}

	}

}
