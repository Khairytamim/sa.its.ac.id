<?php

class M_setting extends CI_Model {

    protected $sql;
    protected $id;
	protected $table;

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table = "m_setting";
        $this->id    = "setting_id";
	}

    public function getData(){
        return $this->db->get($this->table);
    }

    public function insertData($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function updateData($data,$id){
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function getAllPassword(){
        $this->db->select('auth_artikel.*, sidebar_ind');
        $this->db->from('auth_artikel');
        $this->db->join('m_sidebar', 'auth_artikel.sidebar_id = m_sidebar.sidebar_id', 'left');
        return $this->db->get();
    }

    public function getCheckAuth($id){
        $this->db->where('sidebar_id', $id);
        return $this->db->get('auth_artikel');
    }

    public function getAuthById($id){
        $this->db->where('id', $id);
        return $this->db->get('auth_artikel');
    }

    public function checkAuth($id, $password){
        $this->db->where('sidebar_id', $id);
        $this->db->where('password', $password);
        return $this->db->get('auth_artikel');
    }

    public function insertPassword($data){
        $this->db->insert('auth_artikel', $data);
        return $this->db->insert_id();
    }

    public function updatePassword($id,$data){
        $this->db->where('id',$id);
        $this->db->update('auth_artikel', $data);
        return $this->db->affected_rows();
    }
	
	public function deletePassword($id){
        $this->db->where('id',$id);
        $this->db->delete('auth_artikel');
        return $this->db->affected_rows();
    }


}
