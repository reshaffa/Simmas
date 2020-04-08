<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_informasi extends CI_Model{

	////// USE BY $this->moin->function_name();
	public function fetchInfoByType($data = array()){
		$querySQL = $this->db->get_where("tbl_information",$data);
		if($querySQL->num_rows() > 0){
			return $querySQL->result_array();
		}else{
			return false;
		}
	}

}