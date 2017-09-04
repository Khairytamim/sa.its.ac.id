<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	protected $class;

	public function __construct(){
		parent::__construct();
		$this->load->library('acl');
		$this->class = strtolower(get_class($this));
		$this->acl->_resource($this->class);
		$this->load->library('parser');
	}

	public function index(){
		$sidebar = array('dashboard' => 'active');
		$data 	 = array(
			'header' => $this->parser->parse('slice/header',array(),true),
			'sidebar'=> $this->parser->parse('slice/sidebar',$sidebar,true),
			'content'=> $this->parser->parse('slice/content',array(),true)
		);
		$this->parser->parse('layout/backend',$data);
	}

	public function ping(){
		$host = 'ars.its.ac.id'; 
		$port = 80; 
		$waitTimeoutInSeconds = 1; 
		if($fp = fsockopen($host,$port,$errCode,$errStr,$waitTimeoutInSeconds)){   
		   // It worked 
			echo "nyala";
		} else {
			echo "mati";
		   // It didn't work 
		} 
		fclose($fp);
	}

}