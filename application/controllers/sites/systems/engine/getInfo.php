<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class getInfo extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	function getListInformasi(){
		$data = json_decode($this->input->get('data'),true);

		$error = false;

		if(!empty($data['username'])){
			$error = false;
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.401",
				"desc"		=> "Username tidak terdaftar !"
			);
			$error = true;
		}

		if(!empty($data['api_keys'])){
			$error = false;
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.401",
				"desc"		=> "Api-keys tidak terdaftar !"
			);
			$error = true;
		}

		if(!empty($data['type_info'])){
			$error = false;
		}else{
			$response = array(
				"status"	=> "ERROR",
				"errorCode"	=> "E.201",
				"desc"		=> "Saat ini tidak ada informasi !"
			);
			$error = true;
		}

		if(!$error){
			$users = $this->mouse->getApiUsers($data['api_keys'],$data['username']);
			if($users){

				///////// GETTING INFO TYPE /////////
				$parameter = array(
					"target_to" => $data['type_info'],
					"status"	=> "active"
				);

				$actions = $this->moin->fetchInfoByType($parameter);
				if($actions){
					$response = array(
						"status"	=> "SUCCESS",
						"errorCode"	=> "E.200",
						"desc"		=> "Berhasil mengambil informasi !",
						"data"		=> $actions
					);
					echo json_encode($response);
				}else{
					$response = array(
						"status"	=> "ERROR",
						"errorCode"	=> "E.201",
						"desc"		=> "Tidak ada informasi untuk ditampilkan !"
					);
					echo json_encode($response);
				}
			}else{
				$response = array(
					"status"	=> "ERROR",
					"errorCode"	=> "E.401",
					"desc"		=> "Username atau api-keys tidak terdaftar !"
				);
				echo json_encode($response);
			}
		}else{
			echo json_encode($response);
		}
	}
}