<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class getData extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function getOfPropinsi(){
		$getParam = $this->input->get("data");
		$data 	  = json_decode($getParam,true);
		if(!empty($data['api_keys']) && !empty($data['username'])){
			$users = $this->mouse->getApiUsers($data['api_keys'],$data['username']);
			if($users){
				$data=$this->motions->fetchPropinsi();
				if($data){
					$response= array(
						'status'	=> 'OK',
						'statusCode'=> 'E.200',
						'desc'		=> 'Data tersedia !',
						'response'	=> array(
							'data'	=> $data
						)
					);
					$contentLog =
						"idLog=".urlencode($this->id_log)."\t".
						"client_request=".urlencode($getParam)."\n"
					;
					$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_propinsi_success_",".log",1,true);

					$this->output
				        ->set_status_header(200)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
					exit;
				}else{
					$response= array(
						'status'	=> 'OK',
						'statusCode'=> 'E.201',
						'desc'		=> 'Data propinsi belum tersedia !',
						'response'	=> array(
							"data"	=> null
						)
					);
					$contentLog =
						"idLog=".urlencode($this->id_log)."\t".
						"client_request=".urlencode($getParam)."\t".
						"response=".urlencode(json_encode($response))."\n"
					;
					$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_propinsi_error_empty_response_",".log",1,true);
					$this->output
				        ->set_status_header(201)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
					exit;
				}
			}else{
				$response= array(
					'status'	=> 'ERROR_ACCOUNT_NOT_EXISTS',
					'statusCode'=> 'E.404',
					'desc'		=> 'Api keys atau username tidak terdaftar !'
				);
				$contentLog =
					"idLog=".urlencode($this->id_log)."\t".
					"client_request=".urlencode($getParam)."\t".
					"response=".urlencode(json_encode($response))."\n"
				;
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_propinsi_error_accounts_",".log",1,true);
				$this->output
			        ->set_status_header(404)
			        ->set_content_type('application/json', 'utf-8')
			        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			        ->_display();
				exit;
			}
		}else{
			$response= array(
				'status'	=> 'ERROR_ACCOUNT_NOT_EMPTY',
				'statusCode'=> 'E.401',
				'desc'	=> 'Username atau api keys tidak boleh kosong !'
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"client_request=".urlencode($getParam)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_propinsi_error_accounts_",".log",1,true);
			$this->output
		        ->set_status_header(401)
		        ->set_content_type('application/json', 'utf-8')
		        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		        ->_display();
			exit;
		}
	}

	public function getOfKabupaten(){
		$getParam = $this->input->get("data");
		$data 	  = json_decode($getParam,true);
		if(!empty($data['api_keys']) && !empty($data['username'])){
			$users = $this->mouse->getApiUsers($data['api_keys'],$data['username']);
			if($users){
				if(!empty($data['propinsi_id']) && $data['propinsi_id'] > 0){
					if(preg_match("/^[\d]+$/",$data['propinsi_id'])){
						$data=$this->motions->fetchKabupaten($data['propinsi_id']);
						if($data){
							$response= array(
								'status'	=> 'OK',
								'statusCode'=> 'E.200',
								'desc'		=> 'Data tersedia !',
								'response'	=> array(
									'data'	=> $data
								)
							);
							$contentLog =
								"idLog=".urlencode($this->id_log)."\t".
								"client_request=".urlencode($getParam)."\t".
								"response=".urlencode(json_encode($response))."\n"
							;
							$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kabupaten_success_",".log",1,true);
							$this->output
						        ->set_status_header(200)
						        ->set_content_type('application/json', 'utf-8')
						        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						        ->_display();
							exit;
						}else{
							$response= array(
								'status'	=> 'OK',
								'statusCode'=> 'E.201',
								'desc'		=> 'Data kabupaten belum tersedia !',
								'response'	=> array(
									'data'	=> null
								)
							);
							$contentLog =
								"idLog=".urlencode($this->id_log)."\t".
								"client_request=".urlencode($getParam)."\t".
								"response=".urlencode(json_encode($response))."\n"
							;
							$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kabupaten_empty_response_",".log",1,true);
							$this->output
						        ->set_status_header(201)
						        ->set_content_type('application/json', 'utf-8')
						        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						        ->_display();
							exit;
						}
					}else{
						$response = array(
							'status'	=> 'OK',
							'statusCode'=> 'E.203',
							'desc'		=> 'Format propinsi salah !'
						);
						$contentLog =
								"idLog=".urlencode($this->id_log)."\t".
								"client_request=".urlencode($getParam)."\t".
								"response=".urlencode(json_encode($response))."\n"
							;
						$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kabupaten_error_validations_",".log",1,true);
						$this->output
					        ->set_status_header(203)
					        ->set_content_type('application/json', 'utf-8')
					        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					        ->_display();
						exit;
					}
				}else{
					$response = array(
						'status'	=> 'OK',
						'statusCode'=> 'E.202',
						'desc'		=> 'Propinsi tidak boleh kosong !'
					);
					$contentLog =
						"idLog=".urlencode($this->id_log)."\t".
						"client_request=".urlencode($getParam)."\t".
						"response=".urlencode(json_encode($response))."\n"
					;
					$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kabupaten_error_validations_",".log",1,true);
					$this->output
				        ->set_status_header(202)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
					exit;
				}
			}else{
				$response= array(
					'status'	=> 'ERROR_ACCOUNT_NOT_EXISTS',
					'statusCode'=> 'E.404',
					'desc'	=> 'Username atau api keys tidak terdaftar !'
				);
				$contentLog =
					"idLog=".urlencode($this->id_log)."\t".
					"client_request=".urlencode($getParam)."\t".
					"response=".urlencode(json_encode($response))."\n"
				;
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kabupaten_error_accounts_",".log",1,true);
				$this->output
			        ->set_status_header(404)
			        ->set_content_type('application/json', 'utf-8')
			        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			        ->_display();
				exit;
			}
		}else{
			$response= array(
				'status'	=> 'ERROR_ACCOUNT_NOT_EMPTY',
				'statusCode'=> 'E.401',
				'desc'		=> 'Username atau api keys tidak boleh kosong !'
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"client_request=".urlencode($getParam)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kabupaten_error_accounts_",".log",1,true);
			$this->output
		        ->set_status_header(401)
		        ->set_content_type('application/json', 'utf-8')
		        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		        ->_display();
			exit;
		}
	}

	public function getOfKecamatan(){
		$getParam = $this->input->get("data");
		$data 	  = json_decode($getParam,true);
		if(!empty($data['api_keys']) && !empty($data['username'])){
			$users = $this->mouse->getApiUsers($data['api_keys'],$data['username']);
			if($users){
				if(!empty($data['kabupaten_id']) && $data['kabupaten_id'] > 0){
					if(preg_match("/^[\d]+$/",$data['kabupaten_id'])){
						$data=$this->motions->fetchKecamatan($data['kabupaten_id']);
						if($data){
							$response= array(
								'status'	=> 'OK',
								'statusCode'=> 'E.200',
								'desc'		=> 'Data tersedia !',
								'response'	=> array(
									'data'	=> $data
								)
							);
							$contentLog =
								"idLog=".urlencode($this->id_log)."\t".
								"client_request=".urlencode($getParam)."\t".
								"response=".urlencode(json_encode($response))."\n"
							;
							$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kecamatan_success_",".log",1,true);
							$this->output
						        ->set_status_header(200)
						        ->set_content_type('application/json', 'utf-8')
						        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						        ->_display();
							exit;
						}else{
							$response= array(
								'status'	=> 'OK',
								'statusCode'=> 'E.201',
								'desc'		=> 'Data kecamatan belum tersedia !',
								'response'	=> array(
									'data'	=> null
								)
							);
							$contentLog =
								"idLog=".urlencode($this->id_log)."\t".
								"client_request=".urlencode($getParam)."\t".
								"response=".urlencode(json_encode($response))."\n"
							;
							$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kecamatan_empty_response_",".log",1,true);
							$this->output
					        ->set_status_header(201)
					        ->set_content_type('application/json', 'utf-8')
					        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					        ->_display();
						exit;
						}
					}else{
						$response = array(
							'status'	=> 'ERROR',
							'statusCode'=> 'E.203',
							'desc'		=> 'Format kabupaten tidak benar!'
						);
						$contentLog =
								"idLog=".urlencode($this->id_log)."\t".
								"client_request=".urlencode($getParam)."\t".
								"response=".urlencode(json_encode($response))."\n"
							;
						$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kecamatan_error_validations_",".log",1,true);
						$this->output
					        ->set_status_header(203)
					        ->set_content_type('application/json', 'utf-8')
					        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					        ->_display();
						exit;
					}
				}else{
					$response = array(
						'status'	=> 'OK',
						'statusCode'=> 'E.202',
						'desc'		=> 'Kecamatan tidak boleh kosong !'
					);
					$contentLog =
						"idLog=".urlencode($this->id_log)."\t".
						"client_request=".urlencode($getParam)."\t".
						"response=".urlencode(json_encode($response))."\n"
					;
					$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kecamatan_error_validations_",".log",1,true);
					$this->output
				        ->set_status_header(202)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
					exit;
				}
			}else{
				$response= array(
					'status'	=> 'ERROR_ACCOUNT_NOT_EXISTS',
					'statusCode'=> 'E.404',
					'desc'		=> 'Username atau api keys tidak terdaftar !'
				);
				$contentLog =
					"idLog=".urlencode($this->id_log)."\t".
					"client_request=".urlencode($getParam)."\t".
					"response=".urlencode(json_encode($response))."\n"
				;
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_error_accounts_",".log",1,true);
				$this->output
			        ->set_status_header(404)
			        ->set_content_type('application/json', 'utf-8')
			        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			        ->_display();
				exit;
			}
		}else{
			$response= array(
				'status'	=> 'ERROR_ACCOUNT_NOT_EMPTY',
				'statusCode'=> 'E.401',
				'desc'		=> 'Username atau api keys tidak boleh kosong !'
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"client_request=".urlencode($getParam)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kecamatan_error_accounts_",".log",1,true);
			$this->output
		        ->set_status_header(401)
		        ->set_content_type('application/json', 'utf-8')
		        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		        ->_display();
			exit;
		}
	}

	public function getOfKelurahan(){
		$getParam = $this->input->get("data");
		$data 	  = json_decode($getParam,true);
		if(!empty($data['api_keys']) && !empty($data['username'])){
			$users = $this->mouse->getApiUsers($data['api_keys'],$data['username']);
			if($users){
				if(!empty($data['kecamatan_id']) && $data['kecamatan_id'] > 0){
					if(preg_match("/^[\d]+$/",$data['kecamatan_id'])){
						$data=$this->motions->fetchKelurahan($data['kecamatan_id']);
						if($data){
							$response= array(
								'status'	=> 'OK',
								'statusCode'=> 'E.200',
								'desc'		=> 'Data tersedia !',
								'response'	=> $data
							);
							$contentLog =
								"idLog=".urlencode($this->id_log)."\t".
								"client_request=".urlencode($getParam)."\t".
								"response=".urlencode(json_encode($response))."\n"
							;
							$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kelurahan_success_",".log",1,true);
							$this->output
						        ->set_status_header(200)
						        ->set_content_type('application/json', 'utf-8')
						        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						        ->_display();
							exit;
						}else{
							$response= array(
								'status'	=> 'OK',
								'statusCode'=> 'E.201',
								'desc'		=> 'Data kelurahan belum tersedia !',
								'response'	=> $data
							);
							$contentLog =
								"idLog=".urlencode($this->id_log)."\t".
								"client_request=".urlencode($getParam)."\t".
								"response=".urlencode(json_encode($response))."\n"
							;
							$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kelurahan_empty_response_",".log",1,true);
							$this->output
						        ->set_status_header(201)
						        ->set_content_type('application/json', 'utf-8')
						        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						        ->_display();
							exit;
						}
					}else{
						$response = array(
							'status'	=> 'ERROR',
							'statusCode'=> 'E.203',
							'desc'		=> 'Format kecamatan tidak benar!'
						);
						$contentLog =
							"idLog=".urlencode($this->id_log)."\t".
							"client_request=".urlencode($getParam)."\t".
							"response=".urlencode(json_encode($response))."\n"
						;
						$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kelurahan_error_validations_",".log",1,true);
						$this->output
					        ->set_status_header(203)
					        ->set_content_type('application/json', 'utf-8')
					        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					        ->_display();
						exit;
					}
				}else{
					$response = array(
						'status'	=> 'ERROR',
						'statusCode'=> 'E.202',
						'desc'		=> 'Kecamatan tidak boleh kosong !'
					);
					$contentLog =
						"idLog=".urlencode($this->id_log)."\t".
						"client_request=".urlencode($getParam)."\t".
						"response=".urlencode(json_encode($response))."\n"
					;
					$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kelurahan_error_validations_",".log",1,true);
					$this->output
				        ->set_status_header(202)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
					exit;
				}
			}else{
				$response= array(
					'status'	=> 'ERROR_ACCOUNT_NOT_EXISTS',
					'statusCode'=> 'E.404',
					'response'	=> 'Username atau api keys tidak terdaftar !'
				);
				$contentLog =
					"idLog=".urlencode($this->id_log)."\t".
					"client_request=".urlencode($getParam)."\t".
					"response=".urlencode(json_encode($response))."\n"
				;
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kelurahan_error_accounts_",".log",1,true);
				$this->output
			        ->set_status_header(203)
			        ->set_content_type('application/json', 'utf-8')
			        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			        ->_display();
				exit;
			}
		}else{
			$response= array(
				'status'	=> 'ERROR_ACCOUNT_NOT_EMPTY',
				'statusCode'=> 'E.401',
				'response'	=> 'Username atau api keys tidak boleh kosong !'
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"client_request=".urlencode($getParam)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_kelurahan_error_accounts_",".log",1,true);
			$this->output
		        ->set_status_header(203)
		        ->set_content_type('application/json', 'utf-8')
		        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		        ->_display();
			exit;
		}
	}

	public function getOfLocations(){
		$getParam = $this->input->get("data");
		$data 	  = json_decode($getParam,true);
		if(!empty($data['api_keys']) && !empty($data['username'])){
			$users = $this->mouse->getApiUsers($data['api_keys'],$data['username']);
			if($users){
				if(!empty($data['kelurahan_id']) && $data['kelurahan_id'] > 0){
					if(preg_match("/^[\d]+$/",$data['kelurahan_id'])){
						$data=$this->motions->fetchLocations($data['kelurahan_id']);
						if($data){
							$response= array(
								'status'	=> 'OK',
								'statusCode'=> 'E.200',
								'desc'		=> 'Data tersedia !',
								'response'	=> $data
							);
							$contentLog =
								"idLog=".urlencode($this->id_log)."\t".
								"client_request=".urlencode($getParam)."\t".
								"response=".urlencode(json_encode($response))."\n"
							;
							$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_locations_success_",".log",1,true);
							$this->output
						        ->set_status_header(200)
						        ->set_content_type('application/json', 'utf-8')
						        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						        ->_display();
							exit;
						}else{
							$response = array(
								'status'	=> 'OK',
								'statusCode'=> 'E.201',
								'desc'		=> 'Kelurahan tidak tersedia !'
							);
							$contentLog =
								"idLog=".urlencode($this->id_log)."\t".
								"client_request=".urlencode($getParam)."\t".
								"response=".urlencode(json_encode($response))."\n"
							;
							$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_locations_empty_response_",".log",1,true);
							$this->output
						        ->set_status_header(201)
						        ->set_content_type('application/json', 'utf-8')
						        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						        ->_display();
							exit;
						}
					}else{
						$response = array(
							'status'	=> 'OK',
							'statusCode'=> 'E.203',
							'desc'		=> 'Format kode kelurahan tidak benar !'
						);
						$contentLog =
							"idLog=".urlencode($this->id_log)."\t".
							"client_request=".urlencode($getParam)."\t".
							"response=".urlencode(json_encode($response))."\n"
						;
						$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_locations_error_validations_",".log",1,true);
						$this->output
					        ->set_status_header(203)
					        ->set_content_type('application/json', 'utf-8')
					        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					        ->_display();
						exit;
					}
				}else{
					$response = array(
						'status'	=> 'OK',
						'statusCode'=> 'E.202',
						'desc'		=> 'Kode kelurahan tidak boleh kosong !'
					);
					$contentLog =
						"idLog=".urlencode($this->id_log)."\t".
						"client_request=".urlencode($getParam)."\t".
						"response=".urlencode(json_encode($response))."\n"
					;
					$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_locations_error_validations_",".log",1,true);
					$this->output
				        ->set_status_header(202)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
					exit;
				}
			}else{
				$response= array(
					'status'	=> 'ERROR_ACCOUNT_NOT_EXISTS',
					'statusCode'=> 'E.404',
					'response'	=> 'Username atau api keys tidak terdaftar !'
				);
				$contentLog =
					"idLog=".urlencode($this->id_log)."\t".
					"client_request=".urlencode($getParam)."\t".
					"response=".urlencode(json_encode($response))."\n"
				;
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_locations_error_accounts_",".log",1,true);
				$this->output
			        ->set_status_header(203)
			        ->set_content_type('application/json', 'utf-8')
			        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			        ->_display();
				exit;
			}
		}else{
			$response= array(
				'status'	=> 'ERROR_ACCOUNT',
				'statusCode'=> 'E.401',
				'response'	=> 'Username atau api keys tidak boleh kosong !'
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"client_request=".urlencode($getParam)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_locations_error_accounts_",".log",1,true);
			$this->output
		        ->set_status_header(202)
		        ->set_content_type('application/json', 'utf-8')
		        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		        ->_display();
			exit;
		}
	}

	public function searchByKabupatenName(){
		$getParam = $this->input->get("data");
		$data 	  = json_decode($getParam,true);

		if(!empty($data['api_keys']) && !empty($data['username'])){
			$users = $this->mouse->getApiUsers($data['api_keys'],$data['username']);
			if($users){
				if(!empty($data['keyword']) && strlen($data['keyword']) > 0 ){
					if(preg_match("/^[\a-zA-Z ]+$/",$data['keyword'])){
						$data=$this->motions->searchByKabupatenName($data);
						if($data){
							$response= array(
								'status'	=> 'OK',
								'statusCode'=> 'E.200',
								'desc'		=> 'Data tersedia !',
								'response'	=> $data
							);
							$contentLog =
								"idLog=".urlencode($this->id_log)."\t".
								"client_request=".urlencode($getParam)."\t".
								"response=".urlencode(json_encode($response))."\n"
							;
							$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_search_kabupaten_success_",".log",1,true);
							$this->output
						        ->set_status_header(200)
						        ->set_content_type('application/json', 'utf-8')
						        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						        ->_display();
							exit;
						}else{
							$response= array(
								'status'	=> 'OK',
								'statusCode'=> 'E.201',
								'desc'		=> 'Data kabupaten tidak tersedia !',
								'response'	=> $data
							);
							$contentLog =
								"idLog=".urlencode($this->id_log)."\t".
								"client_request=".urlencode($getParam)."\t".
								"response=".urlencode(json_encode($response))."\n"
							;
							$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_search_kabupaten_empty_response_",".log",1,true);
							$this->output
						        ->set_status_header(201)
						        ->set_content_type('application/json', 'utf-8')
						        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						        ->_display();
							exit;
						}
					}else{
						$response = array(
							'status'	=> 'ERROR',
							'statusCode'=> 'E.203',
							'desc'		=> 'Format parameter tidak benar!'
						);
						$contentLog =
							"idLog=".urlencode($this->id_log)."\t".
							"client_request=".urlencode($getParam)."\t".
							"response=".urlencode(json_encode($response))."\n"
						;
						$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_search_kabupaten_error_validations_",".log",1,true);
						$this->output
					        ->set_status_header(203)
					        ->set_content_type('application/json', 'utf-8')
					        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					        ->_display();
						exit;
					}
				}else{
					$response = array(
						'status'	=> 'ERROR',
						'statusCode'=> 'E.202',
						'desc'		=> 'Parameter tidak boleh kosong !'
					);
					$contentLog =
						"idLog=".urlencode($this->id_log)."\t".
						"client_request=".urlencode($getParam)."\t".
						"response=".urlencode(json_encode($response))."\n"
					;
					$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_search_kabupaten_error_validations_",".log",1,true);
					$this->output
				        ->set_status_header(202)
				        ->set_content_type('application/json', 'utf-8')
				        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				        ->_display();
					exit;
				}
			}else{
				$response= array(
					'status'	=> 'ERROR_ACCOUNT_NOT_EXISTS',
					'statusCode'=> 'E.404',
					'response'	=> 'Username atau api keys tidak terdaftar !'
				);
				$contentLog =
					"idLog=".urlencode($this->id_log)."\t".
					"client_request=".urlencode($getParam)."\t".
					"response=".urlencode(json_encode($response))."\n"
				;
				$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_search_kabupaten_error_accounts_",".log",1,true);
				$this->output
			        ->set_status_header(203)
			        ->set_content_type('application/json', 'utf-8')
			        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			        ->_display();
				exit;
			}
		}else{
			$response= array(
				'status'	=> 'ERROR_ACCOUNT_NOT_EMPTY',
				'statusCode'=> 'E.401',
				'response'	=> 'Username atau api keys tidak boleh kosong !'
			);
			$contentLog =
				"idLog=".urlencode($this->id_log)."\t".
				"client_request=".urlencode($getParam)."\t".
				"response=".urlencode(json_encode($response))."\n"
			;
			$this->logs->logging($contentLog,$this->config->item("log_path"),"simmas_users_request_search_kabupaten_error_accounts_",".log",1,true);
			$this->output
		        ->set_status_header(203)
		        ->set_content_type('application/json', 'utf-8')
		        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		        ->_display();
			exit;
		}
	}

}