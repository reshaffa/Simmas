<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kependudukan extends MY_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){
		$data = array(
			"title"		=> "DATA KEPENDUDUKAN",
			"pageTitle"	=> "DATA KEPENDUDUKAN"
		);
		$this->template->load("pages/index","settings/kependudukan",$data);
	}
}