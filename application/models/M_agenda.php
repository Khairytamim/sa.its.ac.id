<?php

class M_agenda extends CI_Model {

	protected $sql;
	protected $table;

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table = "m_agenda";
	}

	public function getAll(){
		$this->sql = "SELECT * FROM ".$this->table." LEFT JOIN m_users ON agenda_users = users_id";
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
		$this->sql = $this->getAll()." WHERE agenda_id = ? ";
		return $this->sql;
	}

	public function _update($id , $data){
		$this->db->trans_begin();
		$this->db->where('agenda_id',$id);
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
		$this->db->where('agenda_id',$id);
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
