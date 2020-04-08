<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->id_log 	  = date('ymdhis').mt_rand().mt_rand();
		$this->ip_address = $_SERVER['REMOTE_ADDR'];
		$this->username   = $this->session->username;
		$this->url 		  = site_url().$this->uri->uri_string();
		$this->mdb = $this->load->database("simmas",true);
		$this->site_app   = "sites-app/";
	}

}