<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template {

	protected $ci;

	protected $content = 'home/content';

	public function __construct(){
		$this->ci =& get_instance();
	}

	public function setContent($content){
		$this->content = $content;
	}

	public function display($arr = array()){
		$data = array(
			'mobile' => $this->ci->load->view('home/mobile',$arr,true),
			'header' => $this->ci->load->view('home/header',array(),true),
			'sidebar'=> $this->ci->load->view('home/sidebar',$arr,true),
			'content'=> $this->ci->load->view($this->content,$arr,true),
			'footer' => $this->ci->load->view('home/footer',array(),true)
		);
		$this->ci->load->view('layout/main',$data);
	}
}
