<?php

class Upload extends CI_Controller {

	protected $class;

	public function __construct(){
		parent::__construct();
		$this->load->library('acl');
		$this->class = strtolower(get_class($this));
		$this->acl->_resource($this->class);
		$this->load->library('parser');
		$this->load->model('m_upload');
	}

	public function index(){
		$sql     = $this->m_upload->getAll();
		$query   = $this->db->query($sql);
		$sidebar = array('upload' => 'active');
		$content = array(
			'result' => $query->result()
		);
		$data = array(
			'header' => $this->parser->parse('slice/header',array(),true),
			'sidebar'=> $this->parser->parse('slice/sidebar',$sidebar,true),
			'content'=> $this->parser->parse('upload/_list',$content,true)
		);
		$this->parser->parse('layout/backend',$data);
	}

	public function filemanager(){
		$sql     = $this->m_upload->getAll();
		$query   = $this->db->query($sql);
		$sidebar = array('upload' => 'active');
		$content = array(
			'result' => $query->result(),
			'task'   => 1,
 		);

		echo $this->load->view('upload/filemanager',$content,true);
	}


	public function process(){

		$target_dir  = "./upload/";
		$target_file = $target_dir.basename($_FILES["file"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$uploadOk = 1;
		$message  = "";
		$alert    = "";
		if (file_exists($target_file)) {
			$message =  "Maaf, existen file terjadi kesalahanan.";
		    $uploadOk = 0;
		}

		// Check file size
		if ($_FILES["file"]["size"] > 5000000) {
			$message =  "Maaf, upload terlalu besar.";
		    $uploadOk = 0;
		}


		$allowed =  array('jpg', 'jpeg', 'png','gif','pdf','doc','docx','xls','xlsx');
		$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		// Allow certain file formats
		if(!in_array($ext,$allowed) ) {
		    $message =  "Maaf, ext yang diupload tidak sesuai dengan yang ada.";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    $alert   =  "alert-danger";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
		        $message =  "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
		    	$alert   =  "alert-success";
		    	$data = array(
		    		'upload_nama'  => $_FILES['file']['name'],
		    		'upload_users' => $this->session->userdata('id'),
		    		'upload_ext'   => $ext
    			);
    			$this->m_upload->_insert($data);
		    } else {
		        $message =  "Sorry, there was an error uploading your file.";
		        $alert   =  "alert-danger";
		    }
		}
		$this->session->set_flashdata('message',"<div class='alert ".$alert."' role='alert'>".$message."</div>");

		if($this->input->post('task')){
			redirect('upload/filemanager');
		} else {
			redirect('upload', 'refresh');
		}


	}

	public function delete($id){
		$result = $this->db->query($this->m_upload->getId(),array($id));
		$target_dir  = "./upload/";
		$target_file = $target_dir.$result->row('upload_nama');
		if (file_exists($target_file)) {
		    unlink($target_file);
		}
		$query = $this->m_upload->_delete($id);
		if($query == FALSE){
			$message =  "Maaf, File tidak dapat terhapus.";
			$alert   =  "alert-danger";
		} else {
			$message =  "File berhasil terhapus.";
			$alert   =  "alert-success";
		}

		$this->session->set_flashdata('message',"<div class='alert ".$alert."' role='alert'>".$message."</div>");
		redirect('upload', 'refresh');
	}
}
