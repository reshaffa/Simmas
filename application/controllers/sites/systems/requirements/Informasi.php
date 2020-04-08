<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends MY_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){
		$data = array(
			"title"		=> "PORTAL SIMMAS INFORMASI",
			"breadCrumb"=> array(
				array(
					"sub"	=> "DASHBOARD",
					"link"	=> $this->site_app."dashboard.aspx"
				),
				array(
					"sub"	=> "PORTAL INFORMASI",
					"link"	=> $this->site_app."dashboard/users-info.aspx"
				)
			),
			"pageTitle"	=> "PORTAL SIMMAS INFORMASI"
		);
		$this->template->load("pages/index","settings/info-umum",$data);
	}
}