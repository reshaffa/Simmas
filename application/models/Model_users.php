<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_users extends CI_Model{

	public function getUsersLogin($username=null,$password=null){
		$this->db->group_start();
		$this->db->where("username",$username);
		$this->db->or_where("email",$username);
		$this->db->or_where("user_id",$username);
		$this->db->group_end();
		$this->db->where('password',md5($password));
		$this->db->where('account_status','active');
		$query=$this->db->get('application_users');
		if($query->num_rows()==1){
			return $query->row_array();
		}else{
			return false;
		}
	}

	public function getApiUsers($api_key,$username){
		$this->db->where("api_key",$api_key);
		$this->db->where("username",$username);
		$this->db->where("status_keys","on");
		$query=$this->db->get("tbl_api_keys");
		if($query->num_rows()==1){
			return true;
		}else{
			return false;
		}
	}

	public function fetchUsers($data = array()){
		$keywords = array_shift($data);
		$limit	  = array_shift($data);
		$this->db->select("user_id,username,email,phone_number");
		$this->db->like("username",$keywords);
		$this->db->or_like("email",$keywords);
		$this->db->or_like("phone_number",$keywords);
		$this->db->order_by("username","ASC");
		$this->db->limit($limit);
		$query = $this->db->get("application_users");
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}

	public function fetchAccess($data = array()){
		$keywords = array_shift($data);
		$limit	  = array_shift($data);
		$this->db->select("*");
		$this->db->like("access_name",$keywords);
		$this->db->order_by("access_name","ASC");
		$this->db->limit($limit);
		$query = $this->db->get("application_access");
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}

}