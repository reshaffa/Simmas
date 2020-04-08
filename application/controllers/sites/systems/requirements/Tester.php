<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tester extends MY_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->load->database("default",true);
		$test = $this->db->get("kependudukan")->result();
		var_dump($test);
	}
	
}

