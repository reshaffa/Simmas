<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_registrasi extends CI_Model{
	
	function fetchRegistrasi($data){
		$keywords = array_shift($data);
		$limits   = array_shift($data);

		if(!empty($keywords) && strlen($keywords) > 0){
			$whereLikeQuery = "WHERE tdkel.id_kelurahan IS NOT NULL AND tkel.nm_kelurahan LIKE '%".$keywords."%'";
		}else{
			$whereLikeQuery = "WHERE tdkel.id_kelurahan IS NOT NULL";
		}

		$querySQL = "
			SELECT tdkel.user_id,
			tdkel.id_kelurahan,
			tdkel.nm_kades,
			tdkel.alamat,
			tdkel.email,
			tdkel.telepon,
			tdkel.status_access,
			tkel.nm_kelurahan,
			tkec.nm_kecamatan,
			tkab.nm_kabupaten,
			tprop.nm_propinsi,
			tkel.sites
			FROM tbl_detail_kelurahan AS tdkel
			LEFT JOIN tbl_kelurahan AS tkel ON tkel.id_kelurahan=tdkel.id_kelurahan
			LEFT JOIN tbl_kecamatan AS tkec ON tkec.id_kecamatan=tkel.id_kecamatan
			LEFT JOIN tbl_kabupaten AS tkab ON tkab.id_kabupaten=tkec.id_kabupaten
			LEFT JOIN tbl_propinsi AS tprop ON tprop.id_propinsi=tkab.id_propinsi
			".$whereLikeQuery." ORDER BY tkel.nm_kelurahan LIMIT $limits
		";
		$query = $this->db->query($querySQL);
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}

}