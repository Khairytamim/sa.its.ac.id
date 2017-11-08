<?php

class M_upload extends CI_Model {

	protected $sql;
	protected $table;

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table = "m_upload";
	}

	public function _insert($data){

		$this->db->trans_begin();

		$query = $this->db->insert($this->table,$data);

		if ($this->db->trans_status() === FALSE)
		{
	        $this->db->trans_rollback();
		}
		else
		{
	        $this->db->trans_commit();
		}

	}

	public function getId(){
		$this->sql = "SELECT * FROM ".$this->table." WHERE upload_id = ? ";
		return $this->sql;
	}

	public function getPdf(){
		$this->sql = "SELECT * FROM ".$this->table." where upload_ext = 'pdf' order by upload_time desc";
		return $this->sql;
	}

	public function getPhoto(){
		$this->sql = "SELECT * FROM ".$this->table." where upload_ext in ('jpg','png') order by upload_time desc";
		return $this->sql;
	}

	public function getAll(){
		$this->sql = "SELECT * FROM ".$this->table." ORDER BY upload_id DESC ";
		return $this->sql;
	}

	public function _delete($id){
		$this->db->trans_begin();

		$this->db->where('upload_id',$id);
		$query = $this->db->delete($this->table);

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
