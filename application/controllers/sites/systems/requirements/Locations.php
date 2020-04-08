<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locations extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}

	function index(){
		$data = array(
			"title"		=> "SETUP LOCATIONS ON MAPS",
			"breadCrumb"=> array(
				array(
					"sub"	=> "DASHBOARD",
					"link"	=> $this->site_app."dashboard.aspx"
				),
				array(
					"sub"	=> "DAFTAR LOKASI",
					"link"	=> $this->site_app."dashboard/access-locations.aspx"
				)
			),
			"pageTitle"	=> "SETUP LOCATIONS ON MAPS"
		);
		$contentLog =
			"idLog=".urlencode($this->id_log)."\t".
			"request_url=".urlencode(json_encode($this->url))."\t".
			"username=".urlencode($this->username)."\t".
			"ip_address=".urlencode($this->ip_address)."\n"
		;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_locations_init_",".log",1,true);
		$this->template->load("pages/index","settings/locations",$data);
	}
	
	function getOfpropinsi(){
		$keyword = $this->input->get("keyword");
		if(!empty($keyword)){
			$this->db->like("nm_propinsi",$keyword);
			$this->db->limit(10);
			$query = $this->db->get("tbl_propinsi")->result_array();
			$response = array();
			$no = 0;
			foreach ($query as $keys) {
				$response[$no]['id'] = $keys['id_propinsi'];
				$response[$no]['text'] = $keys['nm_propinsi'];
				$no++;
			}
			echo json_encode($response);
		}else{
			return false;
		}
	}

	function getOfkabupaten(){
		$keyword = $this->input->get("keyword");
		$prop_id = $this->input->get("prop_id");
		if(!empty($keyword) && !empty($prop_id)){
			$query = $this->db->query(
				"SELECT * FROM tbl_propinsi AS tprop
				INNER JOIN tbl_kabupaten AS tkab ON tkab.id_propinsi=tprop.id_propinsi
				WHERE tprop.id_propinsi=$prop_id AND tkab.nm_kabupaten LIKE '%$keyword%'
				"
			)->result_array();
			$response = array();
			$no = 0;
			foreach ($query as $keys) {
				$response[$no]['id'] = $keys['id_kabupaten'];
				$response[$no]['text'] = $keys['nm_kabupaten'];
				$no++;
			}
			echo json_encode($response);
		}else{
			return false;
		}
	}

	function getOfkecamatan(){
		$keyword = $this->input->get("keyword");
		$kab_id = $this->input->get("kab_id");
		if(!empty($keyword) && !empty($kab_id)){
			$query = $this->db->query(
				"SELECT * FROM tbl_kabupaten AS tkab
				INNER JOIN tbl_kecamatan AS tkec ON tkec.id_kabupaten=tkab.id_kabupaten
				WHERE tkab.id_kabupaten=$kab_id AND tkec.nm_kecamatan LIKE '%$keyword%'
				"
			)->result_array();
			$response = array();
			$no = 0;
			foreach ($query as $keys) {
				$response[$no]['id'] = $keys['id_kecamatan'];
				$response[$no]['text'] = $keys['nm_kecamatan'];
				$no++;
			}
			echo json_encode($response);
		}else{
			return false;
		}
	}

	function getOfKelurahan(){
		$keyword = $this->input->get("keyword");
		$kec_id = $this->input->get("kec_id");
		if(!empty($keyword) && !empty($kec_id)){
			$query = $this->db->query(
				"SELECT * FROM tbl_kecamatan AS tkec
				INNER JOIN tbl_kelurahan AS tkel ON tkel.id_kecamatan=tkec.id_kecamatan
				WHERE tkec.id_kecamatan=$kec_id AND tkel.nm_kelurahan LIKE '%$keyword%'
				"
			)->result_array();
			$response = array();
			$no = 0;
			foreach ($query as $keys) {
				$response[$no]['id'] = $keys['id_kelurahan'];
				$response[$no]['text'] = $keys['nm_kelurahan'];
				$no++;
			}
			echo json_encode($response);
		}else{
			return false;
		}
	}

	function addPropinsi(){
		$data  = json_decode($this->input->get('data'),true);

		$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_propinsi_init_",".log",1,true);

		$error = false;

		if(empty($data['propinsi'])){
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "PROPINSI_IS_NOT_EMPTY",
				"desc"		=> "Silahkan isikan nama propinsi terlebih dahulu !"
			);
			$error = true;
		}

		if(!$error){
			$actions = $this->savePropinsi($data);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($actions))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_propinsi_finished_",".log",1,true);
			echo json_encode($actions);
		}else{
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_propinsi_error_validation_input_",".log",1,true);
			echo json_encode($response);
		}
	}

	function savePropinsi($parameter){
		$data = array(
			"nm_propinsi"=>strtoupper($parameter['propinsi'])
		);
		$this->db->trans_start();
		$actions = $this->db->insert("tbl_propinsi",$data);
		$this->db->trans_complete();
		if($this->db->trans_status()==TRUE){
			$response = array(
				"status"	=> "SUCCESS",
				"errorCode"	=> "SUCCESS_INSERT_PROPINSI",
				"desc"		=> "Sukses menambah propinsi baru !"
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"parameter=".urlencode(json_encode($data))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_kabupaten_success_save_to_database_",".log",1,true);
        	return $response;
		}else{
			$this->db->trans_rollback();
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "ERROR_INSERT_PROPINSI",
				"desc"		=> "Upss, gagal menambahakan propinsi baru !"
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"parameter=".urlencode(json_encode($data))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_propinsi_error_save_to_database_",".log",1,true);
        	return $response;
		}
	}

	function addKabupaten(){
		$data  = json_decode($this->input->get('data'),true);

		$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_kabupaten_init_",".log",1,true);

		$error = false;

		if(!empty($data['propinsi_id'])){
			if(!preg_match("/^[\d]+$/",$data['propinsi_id'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "PROPINSI_IS_NOT_VALIDATED",
					"desc"		=> "Propinsi belumterdaftar untuk saat ini !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "PROPINSI_IS_NOT_EMPTY",
				"desc"		=> "Silahkan pilih propinsi terlebih dahulu !"
			);
			$error = true;
		}

		if(!empty($data['nm_kabupaten'])){
			if(!preg_match('/[a-zZ-a ]/',$data['nm_kabupaten'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "KABUPATEN_IS_NOT_VALIDATED",
					"desc"		=> "Format penulisan nama kabupaten salah !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "KABUPATEN_IS_NOT_EMPTY",
				"desc"		=> "Silahkan isikan nama kabupaten terlebih dahulu !"
			);
			$error = true;
		}

		if(!$error){
			$actions = $this->saveKabupaten($data);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($actions))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_kabupaten_finished_",".log",1,true);
			echo json_encode($actions);
		}else{
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_kabupaten_error_validation_input_",".log",1,true);
			echo json_encode($response);
		}
	}

	function saveKabupaten($parameter){
		$data = array(
			"id_propinsi"=>$parameter['propinsi_id'],
			"nm_kabupaten"=>$parameter['nm_kabupaten']
		);
		$this->db->trans_start();
		$actions = $this->db->insert("tbl_kabupaten",$data);
		$this->db->trans_complete();
		if($this->db->trans_status()==TRUE){
			$response = array(
				"status"	=> "SUCCESS",
				"errorCode"	=> "SUCCESS_INSERT_KABUPATEN",
				"desc"		=> "Sukses menambahkan kabupaten baru !"
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"parameter=".urlencode(json_encode($data))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_kabupaten_success_save_to_database_",".log",1,true);
        	return $response;
		}else{
			$this->db->trans_rollback();
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "ERROR_INSERT_KABUPATEN",
				"desc"		=> "Upss, gagal menambahkan kabupaten baru !"
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"parameter=".urlencode(json_encode($data))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_kabupaten_error_save_to_database_",".log",1,true);
        	return $response;
		}
	}

	function addKecamatan(){
		$data  = json_decode($this->input->get('data'),true);

		$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_kecamatan_init_",".log",1,true);

		$error = false;

		if(!empty($data['propinsi_id'])){
			if(!preg_match("/^[\d]+$/",$data['propinsi_id'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "PROPINSI_IS_NOT_VALIDATED",
					"desc"		=> "Propinsi belum terdaftar untuk saat ini !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "PROPINSI_IS_NOT_EMPTY",
				"desc"		=> "Silahkan pilih propinsi terlebih dahulu !"
			);
			$error = true;
		}

		if(!empty($data['kabupaten_id'])){
			if(!preg_match("/^[\d]+$/",$data['kabupaten_id'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "KABUPATEN_IS_NOT_VALIDATED",
					"desc"		=> "Kabupaten belum terdaftar untuk saat ini !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "KABUPATEN_IS_NOT_EMPTY",
				"desc"		=> "Silahkan pilih kabupaten terlebih dahulu !"
			);
			$error = true;
		}

		if(!empty($data['nm_kecamatan'])){
			if(!preg_match('/[a-zZ-a ]/',$data['nm_kecamatan'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "KECAMATAN_IS_NOT_VALIDATED",
					"desc"		=> "Format penulisan nama kecamatan salah !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "KECAMATAN_IS_NOT_EMPTY",
				"desc"		=> "Silahkan isikan nama kecamatan terlebih dahulu !"
			);
			$error = true;
		}

		if(!$error){
			$actions = $this->saveKecamatan($data);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($actions))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_kecamatan_finished_",".log",1,true);
			echo json_encode($actions);
		}else{
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_kecamatan_error_validation_input_",".log",1,true);
			echo json_encode($response);
		}
	}

	function saveKecamatan($parameter){
		$data = array(
			"id_kabupaten"=>$parameter['kabupaten_id'],
			"nm_kecamatan"=>$parameter['nm_kecamatan'] 
		);

		$this->db->trans_start();
		$actions = $this->db->insert("tbl_kecamatan",$data);
		$this->db->trans_complete();
		if($this->db->trans_status()==TRUE){
			$response = array(
				"status"	=> "SUCCESS",
				"errorCode"	=> "SUCCESS_INSERT_KECAMATAN",
				"desc"		=> "Sukses menambahkan kecamatan baru !"
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"parameter=".urlencode(json_encode($data))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_kecamatan_success_save_to_database_",".log",1,true);
        	return $response;
		}else{
			$this->db->trans_rollback();
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "ERROR_INSERT_KECAMATAN",
				"desc"		=> "Upss, gagal menambahkan kecamatan baru !"
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"parameter=".urlencode(json_encode($data))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_kecamatan_error_save_to_database_",".log",1,true);
        	return $response;
		}
	}

	function addKelurahan(){
		$data  = json_decode($this->input->get('data'),true);

		$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\n"
			;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_kelurahan_init_",".log",1,true);

		$error = false;

		if(!empty($data['propinsi'])){
			if(!is_numeric($data['propinsi'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "PROPINSI_IS_NOT_VALIDATED",
					"desc"		=> "Propinsi tidak terdaftar !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "PROPINSI_IS_NOT_EMPTY",
				"desc"		=> "Silahkan pilih propinsi terlebih dahulu !"
			);
			$error = true;
		}

		if(!empty($data['kabupaten'])){
			if(!is_numeric($data['kabupaten'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "KABUPATEN_IS_NOT_VALIDATED",
					"desc"		=> "Kabupaten tidak terdaftar !"
				);
				$error = true;
			}	
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "KABUPATEN_IS_NOT_EMPTY",
				"desc"		=> "Silahkan pilih kabupaten terlebih dahulu !"
			);
			$error = true;
		}

		if(!empty($data['kecamatan'])){
			if(!is_numeric($data['kecamatan'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "KECAMATAN_IS_NOT_VALIDATED",
					"desc"		=> "Kecamatan tidak terdaftar !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "KECAMATAN_IS_NOT_EMPTY",
				"desc"		=> "Silahkan pilih kecamatan terlebih dahulu !"
			);
			$error = true;
		}

		if(!empty($data['kelurahan'])){
			if(!preg_match("/[a-zA-Z ]/",$data['kelurahan'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "KELURAHAN_IS_NOT_VALIDATED",
					"desc"		=> "Format penulisan kelurahan salah !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "KELURAHAN_IS_NOT_EMPTY",
				"desc"		=> "Silahkan isikan terlebih dahulu nama kelurahan"
			);
			$error = true;
		}

		if(!empty($data['kodepos'])){
			if(!is_numeric($data['kodepos'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "KODE_POS_IS_NOT_VALIDATED",
					"desc"		=> "Format penulisan kode pos salah !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "KODE_POS_IS_EMPTY",
				"desc"		=> "Silahkan isikan kode pos terlebih dahulu !"
			);
			$error = true;
		}

		if(!$error){
			$actions = $this->saveKelurahan($data);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($actions))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_kelurahan_finished_",".log",1,true);
			echo json_encode($actions);
		}else{
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_kelurahan_error_validation_input_",".log",1,true);
			echo json_encode($response);
		}
	}

	function saveKelurahan($parameter){
		$data = array(
			"id_kecamatan"=>$parameter['kecamatan'],
			"nm_kelurahan"=>$parameter['kelurahan'],
			"kd_pos"=>$parameter['kodepos'] 
		);

		$this->db->trans_start();
		$actions = $this->db->insert("tbl_kelurahan",$data);
		$this->db->trans_complete();
		if($this->db->trans_status()==TRUE){
			$response = array(
				"status"	=> "SUCCESS",
				"errorCode"	=> "SUCCESS_INSERT_KELURAHAN",
				"desc"		=> "Sukses menambahkan kelurahan baru !"
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"parameter=".urlencode(json_encode($data))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_kelurahan_success_save_to_database_",".log",1,true);
        	return $response;
		}else{
			$this->db->trans_rollback();
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "ERROR_INSERT_KECAMATAN",
				"desc"		=> "Upss, gagal menambahkan kelurahan baru !"
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"request_url=".urlencode(json_encode($this->url))."\t".
				"parameter=".urlencode(json_encode($data))."\t".
				"username=".urlencode($this->username)."\t".
				"ip_address=".urlencode($this->ip_address)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_add_kelurahan_error_save_to_database_",".log",1,true);
        	return $response;
		}
	}

	function listLocations(){
		$data = json_decode($this->input->get("sendParam"),true);
		$error = false;

		$contentLog =
			"idLog=".urlencode($this->id_log)."\t".
			"request_url=".urlencode(json_encode($this->url))."\t".
			"username=".urlencode($this->username)."\t".
			"ip_address=".urlencode($this->ip_address)."\n"
		;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_locations_init_",".log",1,true);

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
			$actions = $this->motions->fetchLocationsCount(
							$data['search'],
							$data['limit'],
							$data['offset']
						);
			if($actions){
				$response = array(
					"status"	=> "SUCCESS",
					"errorCode"	=> "E.200",
					"desc"		=> "List data propinsi sukses !",
					"data"		=> $actions
				);
				$contentLog =
					"idLog=".urlencode($this->id_log)."\t".
					"request_url=".urlencode(json_encode($this->url))."\t".
					"username=".urlencode($this->username)."\t".
					"ip_address=".urlencode($this->ip_address)."\t".
					"response=".urlencode(json_encode($response))."\n"
				;
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_locations_success_",".log",1,true);
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
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_locations_empty_response_",".log",1,true);
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
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_locations_error_validation_input_",".log",1,true);
		}
	}

	function listKabupaten(){
		$data = json_decode($this->input->get("sendParam"),true);
		$error = false;

		$contentLog =
			"idLog=".urlencode($this->id_log)."\t".
			"request_url=".urlencode(json_encode($this->url))."\t".
			"username=".urlencode($this->username)."\t".
			"ip_address=".urlencode($this->ip_address)."\n"
		;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_kabupaten_init_",".log",1,true);

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

		if(!empty($data['propinsi_id'])){
			if(!preg_match("/^[\d]+$/",$data['propinsi_id'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Format kecamatan tidak benar !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.202",
				"desc"		=> "Tidak ada propinsi terdeteksi !"
			);
			$error = true;
		}

		if(!$error){
			$actions = $this->motions->fetchCountKabupaten($data);
			if($actions){
				$response = array(
					"status"	=> "SUCCESS",
					"errorCode"	=> "E.200",
					"desc"		=> "List data kabupaten sukses !",
					"data"		=> $actions
				);
				$contentLog =
					"idLog=".urlencode($this->id_log)."\t".
					"request_url=".urlencode(json_encode($this->url))."\t".
					"username=".urlencode($this->username)."\t".
					"ip_address=".urlencode($this->ip_address)."\t".
					"response=".urlencode(json_encode($response))."\n"
				;
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_kabupaten_success_",".log",1,true);
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
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_kabupaten_empty_response_",".log",1,true);
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
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_kabupaten_error_validation_input_",".log",1,true);
			echo json_encode($response);
		}
	}

	function listKecamatan(){
		$data = json_decode($this->input->get("sendParam"),true);
		$error = false;

		$contentLog =
			"idLog=".urlencode($this->id_log)."\t".
			"request_url=".urlencode(json_encode($this->url))."\t".
			"username=".urlencode($this->username)."\t".
			"ip_address=".urlencode($this->ip_address)."\n"
		;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_kecamatan_init_",".log",1,true);

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

		if(!empty($data['kabupaten_id'])){
			if(!is_numeric($data['kabupaten_id'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Format kabupaten tidak benar !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.202",
				"desc"		=> "Tidak ada kabupaten terdeteksi !"
			);
			$error = true;
		}

		if(!$error){
			$actions = $this->motions->fetchCountKecamatan($data);
			if($actions){
				$response = array(
					"status"	=> "SUCCESS",
					"errorCode"	=> "E.200",
					"desc"		=> "List data kecamatan sukses !",
					"data"		=> $actions
				);
				$contentLog =
					"idLog=".urlencode($this->id_log)."\t".
					"request_url=".urlencode(json_encode($this->url))."\t".
					"username=".urlencode($this->username)."\t".
					"ip_address=".urlencode($this->ip_address)."\t".
					"response=".urlencode(json_encode($response))."\n"
				;
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_kecamatan_success_",".log",1,true);
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
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_kecamatan_empty_response_",".log",1,true);
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
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_kecamatan_error_validation_input_",".log",1,true);
			echo json_encode($response);
		}
	}

	function listKelurahan(){
		$data = json_decode($this->input->get("sendParam"),true);
		$error = false;

		$contentLog =
			"idLog=".urlencode($this->id_log)."\t".
			"request_url=".urlencode(json_encode($this->url))."\t".
			"username=".urlencode($this->username)."\t".
			"ip_address=".urlencode($this->ip_address)."\n"
		;
		$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_kelurahan_init_",".log",1,true);

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

		if(!empty($data['kecamatan_id'])){
			if(!is_numeric($data['kecamatan_id'])){
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.203",
					"desc"		=> "Format kecamatan tidak benar !"
				);
				$error = true;
			}
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.202",
				"desc"		=> "Tidak ada kecamatan terdeteksi !"
			);
			$error = true;
		}

		if(!$error){
			$actions = $this->motions->fetchCountKelurahan($data);
			if($actions){
				$response = array(
					"status"	=> "SUCCESS",
					"errorCode"	=> "E.200",
					"desc"		=> "List data kelurahan sukses !",
					"data"		=> $actions
				);
				$contentLog =
					"idLog=".urlencode($this->id_log)."\t".
					"request_url=".urlencode(json_encode($this->url))."\t".
					"username=".urlencode($this->username)."\t".
					"ip_address=".urlencode($this->ip_address)."\t".
					"response=".urlencode(json_encode($response))."\n"
				;
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_kelurahan_success_",".log",1,true);
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
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_kelurahan_empty_response_",".log",1,true);
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
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_list_kelurahan_error_validation_input_",".log",1,true);
			echo json_encode($response);
		}
	}

}