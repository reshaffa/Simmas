<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_locations extends CI_Model{
	
	function propFetchAll(){
		$this->db->order_by("nm_propinsi");
		$query = $this->db->get("tbl_propinsi");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	function fetchPropinsi(){
		$this->db->order_by("nm_propinsi");
		$query = $this->db->get("tbl_propinsi");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	function fetchKabupaten($propinsi_id=null){
		$this->db->where("id_propinsi",$propinsi_id);
		$this->db->order_by("nm_kabupaten");
		$query = $this->db->get("tbl_kabupaten");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	function fetchKecamatan($kabupaten_id=null){
		$this->db->where("id_kabupaten",$kabupaten_id);
		$this->db->order_by("nm_kecamatan");
		$query = $this->db->get("tbl_kecamatan");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	function fetchKelurahan($kecamatan_id=null){
		$this->db->where("id_kecamatan",$kecamatan_id);
		$this->db->order_by("nm_kelurahan");
		$query = $this->db->get("tbl_kelurahan");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	function fetchLocations($kelurahan_id=null){
		$querySQL = "
			SELECT
				tkel.id_kelurahan,
				tkel.nm_kelurahan,
				tkel.kd_pos,
				tkel.sites,
				tkec.id_kecamatan,
				tkec.nm_kecamatan,
				tkab.id_kabupaten,
				tkab.nm_kabupaten,
				tprop.id_propinsi,
				tprop.nm_propinsi
			FROM tbl_propinsi AS tprop
			RIGHT JOIN tbl_kabupaten AS tkab ON tkab.id_propinsi=tprop.id_propinsi
			RIGHT JOIN tbl_kecamatan AS tkec ON tkec.id_kabupaten=tkab.id_kabupaten
			RIGHT JOIN tbl_kelurahan AS tkel ON tkel.id_kecamatan=tkec.id_kecamatan
			WHERE tkel.id_kelurahan='$kelurahan_id'
		";

		$query = $this->db->query($querySQL);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	function fetchLocationsCount($keywords="",$limit=10){
		$querySQL = "
			SELECT
				tprop.id_propinsi,
				tprop.nm_propinsi,
				count(tkab.id_kabupaten) AS total_kabupaten
			FROM tbl_propinsi AS tprop
			LEFT JOIN tbl_kabupaten AS tkab ON tkab.id_propinsi=tprop.id_propinsi
			WHERE tprop.nm_propinsi LIKE '%".$keywords."%' GROUP BY tprop.id_propinsi ORDER BY tprop.nm_propinsi ASC LIMIT ".$limit;
		;
		$query = $this->db->query($querySQL);
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}

	function fetchCountKabupaten($parameter = array()){
		$propinsi_id = array_shift($parameter);
		$keywords 	 = array_shift($parameter);
		$limit 		 = array_shift($parameter);
		$querySQL = "
			SELECT
				tkab.id_kabupaten,
				tkab.id_propinsi,
				tkab.nm_kabupaten,
				count(tkec.id_kecamatan) AS total_kecamatan
			FROM tbl_kabupaten AS tkab
			LEFT JOIN tbl_kecamatan AS tkec ON tkec.id_kabupaten=tkab.id_kabupaten
			WHERE tkab.nm_kabupaten LIKE '%".$keywords."%' AND tkab.id_propinsi=$propinsi_id GROUP BY tkab.id_kabupaten LIMIT ".$limit;
		;
		$query = $this->db->query($querySQL);
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}

	function fetchCountKecamatan($parameter = array() ){
		$kabupaten_id = array_shift($parameter);
		$keywords 	 = array_shift($parameter);
		$limit 		 = array_shift($parameter);
		$querySQL = "
			SELECT
				tkec.id_kecamatan,
				tkec.nm_kecamatan,
				count(tkel.id_kelurahan) AS total_kelurahan
			FROM tbl_kecamatan AS tkec
			LEFT JOIN tbl_kelurahan AS tkel ON tkel.id_kecamatan=tkec.id_kecamatan
			WHERE tkec.nm_kecamatan LIKE '%".$keywords."%' AND tkec.id_kabupaten=$kabupaten_id GROUP BY tkec.id_kecamatan LIMIT ".$limit;
		;
		$query = $this->db->query($querySQL);
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}

	function fetchCountKelurahan($parameter = array() ){
		$kecamatan_id = array_shift($parameter);
		$keywords 	 = array_shift($parameter);
		$limit 		 = array_shift($parameter);
		$querySQL = "
			SELECT
				tkel.id_kelurahan,
				tkel.nm_kelurahan,
				tdkel.nm_kades,
				tdkel.alamat,
				tdkel.email,
				tdkel.telepon
			FROM tbl_kelurahan AS tkel
			LEFT JOIN tbl_detail_kelurahan AS tdkel ON tdkel.id_kelurahan=tkel.id_kelurahan
			WHERE tkel.nm_kelurahan LIKE '%".$keywords."%' AND tkel.id_kecamatan=$kecamatan_id GROUP BY tkel.id_kelurahan ORDER BY tkel.nm_kelurahan LIMIT ".$limit;
		;
		$query = $this->db->query($querySQL);
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}

	function searchByKabupatenName($parameter){
		$keyword= array_shift($parameter);
		$this->db->like('nm_kabupaten',$keyword);
		$querySQL = $this->db->get('tbl_kabupaten');
		if($querySQL->num_rows() > 0){
			return $querySQL->result_array();
		}else{
			return false;
		}
	}

}