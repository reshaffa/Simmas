<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$generateID = date('ymdhis').mt_rand().mt_rand();
		$ip_address = $_SERVER['REMOTE_ADDR'];

		$data = array(
			'title' => 'SISTEM INFORMASI MENEJEMAN KEMASYARAKATAN'
		);
		$contentLog =
			"generateID=".urlencode($generateID)."\t".
			"browse_url=".urlencode(current_url())."\t".
			"ip_address=".urlencode($ip_address)."\n"
		;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"users_access_simmas_admission_login_pages_",".log",1,true);
		$this->load->view('login',$data);
	}

}