<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersAccess extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}

	function index(){
		$data = array(
			"title"		=> "MENEJEMEN AKSES SIMMAS",
			"breadCrumb"=> array(
				array(
					"sub"	=> "DASHBOARD",
					"link"	=> $this->site_app."dashboard.aspx"
				),
				array(
					"sub"	=> "DAFTAR PENGGUNA",
					"link"	=> $this->site_app."dashboard/access-users.aspx"
				)
			),
			"pageTitle"	=> "MENEJEMEN AKSES USERS"
		);
		$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_access_init_",".log",1,true);
		$this->template->load("pages/index","settings/user_access",$data);
	}

	function listUsers(){
		$data = json_decode($this->input->get("sendParam"),true);
		$error = false;

		$contentLog =
			"idLog=".urlencode($this->id_log)."\t".
			"request_url=".urlencode(json_encode($this->url))."\t".
			"username=".urlencode($this->username)."\t".
			"ip_address=".urlencode($this->ip_address)."\n"
		;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_users_init_",".log",1,true);

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
			$actions = $this->mouse->fetchUsers($data);
			if($actions){
				$response = array(
					"status"	=> "SUCCESS",
					"errorCode"	=> "E.200",
					"desc"		=> "List data users sukses !",
					"data"		=> $actions
				);
				$contentLog =
					"idLog=".urlencode($this->id_log)."\t".
					"request_url=".urlencode(json_encode($this->url))."\t".
					"username=".urlencode($this->username)."\t".
					"ip_address=".urlencode($this->ip_address)."\t".
					"response=".urlencode(json_encode($response))."\n"
				;
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_users_success_",".log",1,true);
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
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_users_empty_response_",".log",1,true);
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
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_users_error_validation_input_",".log",1,true);
			echo json_encode($response);
		}
	}

	function getOfAccess(){
		$keyword = json_decode($this->input->get("keyword"),true);
		if(!empty($keyword)){
			$query = $this->db->query(
				"SELECT * FROM application_access
				WHERE access_name LIKE '%$keyword%' ORDER BY access_name ASC
				"
			)->result_array();
			$response = array();
			$no = 0;
			foreach ($query as $keys) {
				$response[$no]['id'] = $keys['access_id'];
				$response[$no]['text'] = $keys['access_name'];
				$no++;
			}
			echo json_encode($response);
		}else{
			return false;
		}
	}

	function addUsers(){
		$data  = json_decode($this->input->get('data'),true);

		$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_users_init_",".log",1,true);

		$error = false;

		if(!empty($data['username']) && strlen($data['username']) > 0){
			if(!preg_match('/[a-zA-Z0-9.,-_+?*$]/',$data['username'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Username harus kombinasi huruf, angka & spesial karakter !"
				);
				$error = true;
			}

			if(strlen($data['username']) < 8){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Username minimal 8 digit karakter !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.202",
				"desc"		=> "Silahkan isikan username terlebih dahulu !"
			);
			$error = true;
		}

		if(!empty($data['access']) && strlen($data['access']) > 0){
			if(!preg_match('/^[a-zA-Z]+$/',$data['access'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Kode akses tidak terdeteksi !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.202",
				"desc"		=> "Silahkan pilih akses terlebih dahulu !"
			);
			$error = true;
		}

		if(!empty($data['telepon']) && strlen($data['telepon']) > 0){
			if(!preg_match('/^[\d]+$/',$data['telepon'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Telepon hanya bisa diisi angka !"
				);
				$error = true;
			}

			if(strlen($data['telepon']) < 10){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Telepon minimal 10 digit angka !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.202",
				"desc"		=> "Silahkan isikan telepon terlebih dahulu !"
			);
			$error = true;
		}

		if(!empty($data['email']) && strlen($data['email']) > 0){
			if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Format penulisan email salah !"
				);
				$error = true;
			}

			if(strlen($data['email']) < 8){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Email minimal 8 digit karakter !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.202",
				"desc"		=> "Silahkan isikan email terlebih dahulu !"
			);
			$error = true;
		}

		if(!empty($data['password']) && strlen($data['password']) > 0){
			if(!preg_match('/^[a-zA-Z0-9!.@_+-^,:;?*]+$/',$data['password'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Password harus kombinasi huruf, angka & spesial karakter !"
				);
				$error = true;
			}

			if(strlen($data['password']) < 8){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Password minimal 8 digit angka !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.202",
				"desc"		=> "Silahkan isikan password terlebih dahulu !"
			);
			$error = true;
		}

		if(!$error){
			$actions = $this->saveUsers($data);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($actions))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_users_finished_",".log",1,true);
			echo json_encode($actions);
		}else{
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_users_error_validation_input_",".log",1,true);
			echo json_encode($response);
		}
	}

	function saveUsers($parameter){
		$data = array(
			"user_id"		=> "usims".date("ydmish").mt_rand(),
			"username"		=> array_shift($parameter),
			"access_id"		=> array_shift($parameter),
			"phone_number"	=> array_shift($parameter),
			"email"			=> array_shift($parameter),
			"password"		=> array_shift($parameter),
			"account_status"=> "active",
			"login_status"	=> "off"
		);

		$this->db->trans_start();
		$actions = $this->db->insert("application_users",$data);
		$this->db->trans_complete();
		if($this->db->trans_status()==TRUE){
			$response = array(
				"status"	=> "SUCCESS",
				"errorCode"	=> "SUCCESS_INSERT_USERS",
				"desc"		=> "Sukses menambahkan user baru !"
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"parameter=".urlencode(json_encode($data))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"contentData=".urlencode(json_encode($data))."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_users_success_save_to_database_",".log",1,true);
        	return $response;
		}else{
			$this->db->trans_rollback();
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "ERROR_INSERT_USERS",
				"desc"		=> "Upss, gagal menambahakan users baru !"
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"parameter=".urlencode(json_encode($data))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"contentData=".urlencode(json_encode($data))."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_users_error_save_to_database_",".log",1,true);
        	return $response;
		}
	}

	function editUsers(){

	}

	function updateUsers(){

	}

	function deleteUsers(){
		$data = json_decode($this->input->get("sendParam"),true);

		$contentLog =
			"idLog=".urlencode($this->id_log)."\t".
			"request_url=".urlencode(json_encode($this->url))."\t".
			"username=".urlencode($this->username)."\t".
			"ip_address=".urlencode($this->ip_address)."\n"
		;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_delete_users_init_",".log",1,true);

		$error = false;

		if(empty($data['user_id'])){
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.201",
				"desc"		=> "Data tidak tersedia !"
			);
			$error = true;
		}

		if(!$error){
			$actions   = $this->deleteActions($data);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"response=".urlencode(json_encode($actions))."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_delete_users_finished_",".log",1,true);
			echo json_encode($actions);
		}else{
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"response=".urlencode(json_encode($response))."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_delete_users_error_validation_",".log",1,true);
			echo json_encode($response);
		}
	}

	function deleteActions($parameter){
		
		$querySQL = $this->db->delete("application_users",array("user_id"=>$parameter['user_id']));

		if($querySQL){
			$response = array(
				"status"	=> "SUCCESS",
				"errorCode"	=> "E.200",
				"desc"		=> "Berhasil menghapus user !"
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"response=".urlencode(json_encode($response))."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_delete_users_success_",".log",1,true);
			return $response;
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.201",
				"desc"		=> "Upss, gagal menghapus user !"
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"response=".urlencode(json_encode($response))."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_delete_users_error_",".log",1,true);
			return $response;
		}
	}

	function listAccess(){
		$data = json_decode($this->input->get("sendParam"),true);
		$error = false;

		$contentLog =
			"idLog=".urlencode($this->id_log)."\t".
			"request_url=".urlencode(json_encode($this->url))."\t".
			"username=".urlencode($this->username)."\t".
			"ip_address=".urlencode($this->ip_address)."\n"
		;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_access_init_",".log",1,true);

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
			$actions = $this->mouse->fetchAccess($data);
			if($actions){
				$response = array(
					"status"	=> "SUCCESS",
					"errorCode"	=> "E.200",
					"desc"		=> "List data access sukses !",
					"data"		=> $actions
				);
				$contentLog =
					"idLog=".urlencode($this->id_log)."\t".
					"request_url=".urlencode(json_encode($this->url))."\t".
					"username=".urlencode($this->username)."\t".
					"ip_address=".urlencode($this->ip_address)."\t".
					"response=".urlencode(json_encode($response))."\n"
				;
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_access_success_",".log",1,true);
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
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_access_empty_response_",".log",1,true);
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
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_access_error_validation_input_",".log",1,true);
			echo json_encode($response);
		}
	}

	function addAccess(){

	}

	function saveAccess($parameter){

	}

}