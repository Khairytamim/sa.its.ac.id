<?php

class M_sidebar extends CI_Model {

	protected $table;
	protected $sql;


	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table = "m_sidebar";
	}

	public function _update($id,$data){
		$this->db->trans_begin();
		$this->db->where('sidebar_id',$id);
		$this->db->update($this->table,$data);
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function getAllUnion(){
		$this->sql = "  SELECT  *
						FROM (SELECT  r.sidebar_id, r.sidebar_ind, r.sidebar_ing, r.sidebar_parent , r.sidebar_id as nourut , r.sidebar_urutan , 1 as level , 0 as sidebar_urutan2
						      FROM    m_sidebar r
							  WHERE   r.sidebar_parent = 0 ) AS root
						UNION ALL
						SELECT  t.sidebar_id, t.sidebar_ind, t.sidebar_ing, t.sidebar_parent , t.sidebar_parent as nourut , parent.sidebar_urutan , 2 as level , t.sidebar_urutan as sidebar_urutan2
						FROM    m_sidebar t
						INNER JOIN (SELECT   p.sidebar_id,  p.sidebar_ind, p.sidebar_ing,  p.sidebar_parent  , p.sidebar_urutan
						            FROM  m_sidebar p WHERE   p.sidebar_parent = 0 ) AS parent
						ON t.sidebar_parent = parent.sidebar_id
						ORDER BY sidebar_urutan ASC, nourut ASC , level ASC , sidebar_urutan2 ASC ";
		return $this->sql;
	}

	public function getAll(){
		$this->sql = "SELECT * FROM ".$this->table." LEFT JOIN m_users ON sidebar_users = users_id";
		return $this->sql;
	}
	public function tampilan(){
		$this->sql = "SELECT * FROM ".$this->table." LEFT JOIN m_users ON sidebar_users = users_id ORDER BY sidebar_urutan ASC";
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
		$this->sql = $this->getAll()." WHERE sidebar_id = ? ";
		return $this->sql;
	}

	public function getDataByParent(){
		$this->sql = $this->getAll()." WHERE sidebar_parent = ? ";
		return $this->sql;
	}



	public function _delete($id){
		$this->db->trans_begin();
		$this->db->where('sidebar_id',$id);
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
