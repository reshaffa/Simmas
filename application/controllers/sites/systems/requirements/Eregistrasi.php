<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eregistrasi extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}

	function index(){
		$data = array(
			"title"		=> "REGISTRASI AKSES SIMMAS",
			"breadCrumb"=> array(
				array(
					"sub"	=> "DASHBOARD",
					"link"	=> $this->site_app."dashboard.aspx"
				),
				array(
					"sub"	=> "REGISTRASI DESA",
					"link"	=> $this->site_app."dashboard/register.aspx"
				)
			),
			"pageTitle"	=> "REGISTRASI SISTEM INFORMASI MENEJEMEN KEMASYARAKATAN"
		);
		$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_registrations_init_",".log",1,true);
		$this->template->load("pages/index","settings/eregistrasi",$data);
	}

	function listRegistrasi(){
		$data = json_decode($this->input->get("sendParam"),true);
		$error = false;

		$contentLog =
			"idLog=".urlencode($this->id_log)."\t".
			"request_url=".urlencode(json_encode($this->url))."\t".
			"username=".urlencode($this->username)."\t".
			"ip_address=".urlencode($this->ip_address)."\n"
		;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_registrasi_init_",".log",1,true);

		if(!empty($data['search'])){
			if(!preg_match("/[a-zA-Z ]/",$data['search'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Keyword pencarian tidak boleh menggunakan karakter khusus !"
				);
				$error = true;
			}
		}

		if(!$error){
			$actions = $this->mogis->fetchRegistrasi($data);
			if($actions){
				$response = array(
					"status"	=> "SUCCESS",
					"errorCode"	=> "E.200",
					"desc"		=> "List data registrasi sukses !",
					"data"		=> $actions
				);
				$contentLog =
					"idLog=".urlencode($this->id_log)."\t".
					"request_url=".urlencode(json_encode($this->url))."\t".
					"username=".urlencode($this->username)."\t".
					"ip_address=".urlencode($this->ip_address)."\t".
					"response=".urlencode(json_encode($response))."\n"
				;
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_registrasi_success_",".log",1,true);
				echo json_encode($response);
			}else{
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.201",
					"desc"		=> "Data tidak tersedia !"
				);
				$contentLog =
					"idLog=".urlencode($this->id_log)."\t".
					"request_url=".urlencode(json_encode($this->url))."\t".
					"username=".urlencode($this->username)."\t".
					"ip_address=".urlencode($this->ip_address)."\t".
					"response=".urlencode(json_encode($response))."\n"
				;
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_registrasi_empty_response_",".log",1,true);
				echo json_encode($response);
			}
		}else{
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_registrasi_error_validation_input_",".log",1,true);
			echo json_encode($response);
		}
	}

	function addRegister(){
		$data  = json_decode($this->input->get('sendParam'),true);

		$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_registrasi_kelurahan_init_",".log",1,true);

		$error = false;

		///// TESTING VALIDATION INPUT /////
		if(!empty($data['kelurahan_id']) && strlen($data['kelurahan_id']) > 0){
			if(!preg_match('/^[\d]+$/',$data['kelurahan_id'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Kelurahan tidak terdeteksi !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.202",
				"desc"		=> "Silahkan pilih kelurahan terlebih dulu !"
			);
			$error = true;
		}

		if(!empty($data['kades']) && strlen($data['kades']) > 0){
			if(preg_match('/[\'^£$%&*}{@#~?><>,|=+¬]/',$data['kades'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Nama kades hanya boleh terdiri dari huruf !"
				);
				$error = true;
			}
			if(strlen($data['kades']) < 5){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Nama kades minimal 5 digit karakter !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.202",
				"desc"		=> "Nama kades harus diisi !"
			);
			$error = true;
		}

		if(!empty($data['email']) && strlen($data['email']) > 0){
			if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Format penulisan email harus benar !"
				);
				$error = true;
			}	
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.202",
				"desc"		=> "Email harus diisi !"
			);
			$error = true;
		}

		if(!empty($data['telepon']) && strlen($data['telepon']) > 0){
			if(!preg_match("/^[\d]+$/",$data['telepon'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Nomor telepon harus angka !"
				);
				$error = true;
			}

			if(strlen($data['telepon']) < 8){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Nomor telepon minimal 8 digit angka !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.202",
				"desc"		=> "Nomor telepon harus diisi !"
			);
			$error = true;
		}

		if(!empty($data['alamat']) && strlen($data['alamat']) > 0){
			if(preg_match('/[\'^£$%&*}{@#~?><>|=+¬]/',$data['alamat'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Format penulisan alamat tidak benar !"
				);
				$error = true;
			}elseif(strlen($data['alamat']) < 5){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Alamat minimal 10 digit karakter !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.202",
				"desc"		=> "Alamat kelurahan harus diisi !"
			);
			$error = true;
		}

		if(!$error){
			$actions = $this->saveRegister($data);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($actions))
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_registrasi_kelurahan_finished_",".log",1,true);
			echo json_encode($actions);
		}else{	
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_registrasi_kelurahan_error_validation_input_",".log",1,true);
			echo json_encode($response);
		}

	}

	function saveRegister($param){
		$username = "usr".date("ydmhis").mt_rand();
		$password = random_string("alnum",16);

		$data = array(
			"user_id"		=> $username,
			"id_kelurahan"	=> array_shift($param),
			"nm_kades"		=> array_shift($param),
			"email"			=> array_shift($param),
			"telepon"		=> array_shift($param),
			"alamat"		=> array_shift($param),
			"username"		=> $username,
			"password"		=> md5($password),
			"status_access"	=> "non-active"
		);

		$this->db->trans_start();
		$actions = $this->db->insert("tbl_detail_kelurahan",$data);
		$this->db->trans_complete();
		if($this->db->trans_status()==TRUE){
			///// IF SUCCESS THEN SEND INFO TO EMAIL USER /////
			$response = array(
				"status"	=> "SUCCESS",
				"errorCode"	=> "SUCCESS_REGISTRASI_KELURAHAN",
				"desc"		=> "Sukses meregistrasikan kelurahan !"
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"parameter=".urlencode(json_encode($data))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_registrasi_kelurahan_success_save_to_database_",".log",1,true);
        	return $response;
		}else{
			$this->db->trans_rollback();
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "ERROR_REGISTRASI_KELURAHAN",
				"desc"		=> "Upss, gagal meregistrasi kelurahan !"
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"parameter=".urlencode(json_encode($data))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_registrasi_error_save_to_database_",".log",1,true);
        	return $response;
		}
	}

	function editRegister(){

	}

	function deleteRegister(){
		$data = json_decode($this->input->get("sendParam"),true);
		$error  = false;

		$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_delete_registrasi_kelurahan_init_",".log",1,true);

		if(empty($data['user_id'])){
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.201",
				"desc"		=> "Kelurahan tidak tersedia !"
			);
			$error = true;
		}

		if(!$error){
			$actions = $this->registerDeleted($data);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"response=".urlencode(json_encode($actions))."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_delete_registrasi_kelurahan_finished_",".log",1,true);
			echo json_encode($actions);
		}else{
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"response=".urlencode(json_encode($response))."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_delete_registrasi_kelurahan_error_validations_",".log",1,true);
			echo json_encode($response);
		}
	}

	function registerDeleted($parameter){
		$querySQL = $this->db->delete("tbl_detail_kelurahan",$parameter);

		if($querySQL){
			$response = array(
				"status"	=> "SUCCESS",
				"errorCode"	=> "E.200",
				"desc"		=> "Berhasil menghapus kelurahan !"
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"response=".urlencode(json_encode($response))."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_delete_registrasi_kelurahan_success_",".log",1,true);
			return $response;
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.901",
				"desc"		=> "Internal sistem error !"
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"response=".urlencode(json_encode($response))."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_delete_registrasi_kelurahan_error_mysql_query_",".log",1,true);
			return $response;
		}
	}
	
}