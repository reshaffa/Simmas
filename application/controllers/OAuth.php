<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OAuth extends MY_Controller{

	function __construct(){
		parent::__construct();
	}

	function login(){
		$generateID = date('ymdhis').mt_rand().mt_rand();
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$this->load->library("form_validation");
		if($this->form_validation->run('simmas-oauth')==FALSE){
			$response	= array(
				"status"	=> "ERROR",
				"errorCode"	=> "E-101",
				"desc"		=> "Username or password not defined !"
			);
			$contentLog =
				"idLog=".urlencode($generateID)."\t".
				"request_url=".urlencode(json_encode($_GET))."\t".
				"username=".urlencode(set_value('username'))."\t".
				"password=".urlencode(md5(set_value('password')))."\t".
				"ip_address=".urlencode($ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_admission_system_login_error_",".log",1,true);
			echo json_encode($response);
		}else{
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$login = $this->mouse->getUsersLogin($username,$password);

			if($login){
				$this->session->set_userdata($login);
				$response = array(
					"status"		=> "SUCCESS",
					"errorCode"		=> "E-200",
					"desc"			=> "Selamat login berhasil, halaman anda akan segera dialihkan !",
					"redirect_link"	=> site_url("sites/systems/requirements/dashboard")
				);
				$contentLog =
					"idLog=".urlencode($generateID)."\t".
					"request_url=".urlencode(json_encode($_GET))."\t".
					"username=".urlencode($username)."\t".
					"password=".urlencode(md5($password))."\t".
					"ip_address=".urlencode($ip_address)."\t".
					"response=".urlencode(json_encode($response))."\n"
				;
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_addmission_system_login_success_",".log",1,true);
				echo json_encode($response);
			}else{
				$response	= array(
					"status"	=> "ERROR",
					"errorCode"	=> "E-101",
					"desc"		=> "Your account not registered !"
				);
				$contentLog =
					"idLog=".urlencode($generateID)."\t".
					"request_url=".urlencode(json_encode($_GET))."\t".
					"username=".urlencode($username)."\t".
					"password=".urlencode(md5($password))."\t".
					"ip_address=".urlencode($ip_address)."\t".
					"response=".urlencode(json_encode($response))."\n"
				;
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_admission_system_login_error_accounts_not_detected_",".log",1,true);
				echo json_encode($response);
			}
		}
	}
}