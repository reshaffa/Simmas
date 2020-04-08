<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){
		$data = array(
			"title"		=> "SIMMAS DASHBOARD",
			"breadCrumb"=> array(
				array(
					"sub"	=> "DASHBOARD",
					"link"	=> $this->site_app."dashboard.aspx"
				)
			),
			"pageTitle"	=> "SIMMAS DASHBOARD"
		);
		$this->template->load("pages/index","settings/dashboard",$data);
	}
}