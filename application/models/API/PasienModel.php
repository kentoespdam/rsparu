<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PasienModel
 *
 * @author user
 */
class PasienModel extends CI_Model {

    public function __construct() {
	  parent::__construct();
	  $this->simrs = $this->load->database("simrs", TRUE);
    }

    public function findData_new($fnama, $fdesa, $fkecamatan, $fkabupaten) {
	  $arrData = [];

	  ($fdesa != "") ? $wDs = " AND kkelurahan LIKE '%" . $fdesa . "%'" : $wDs = "";
	  ($fkecamatan != "") ? $wKc = " AND kkecamatan LIKE '%" . $fkecamatan . "%'" : $wKc = "";
	  ($fkabupaten != "") ? $wKb = " AND kkabupaten LIKE '%" . $fkabupaten . "%'" : $wKb = "";
	  $where = "WHERE nama LIKE '%" . $fnama . "%'" . $wDs . $wKc . $wKb;
	  $sql = "SELECT * FROM v_find_pasien "
		    . $where;

	  $q = $this->simrs->query($sql);
//	  echo $this->simrs->last_query();
	  if ($q->num_rows() > 0) {
		foreach ($q->result() as $d) {
		    array_push($arrData, $d);
		}
		$res = $this->ResponseModel->res200(['data' => $arrData, "count" => $q->num_rows()]);
	  } else {
		$res = $this->ResponseModel->res204(['data' => $arrData, "count" => $q->num_rows()]);
	  }

	  return json_encode($res);
    }

    public function findNorm($norm) {
	  $arrData = [];
	  $this->simrs->select(
		    "m_pasien.inorm, "
		    . "m_pasien.norm, "
		    . "m_pasien.rmlama, "
		    . "m_pasien.tgldaftar, "
		    . "m_pasien.jamdaftar, "
		    . "m_pasien.kkelompok, "
		    . "m_pasien.noasuransi,"
		    . "m_pasien.noktp, "
		    . "m_pasien.nama, "
		    . "m_pasien.alamat, "
		    . "m_pasien.kprovinsi, "
		    . "m_pasien.kkabupaten, "
		    . "m_pasien.kkecamatan, "
		    . "m_pasien.kkelurahan, "
		    . "m_pasien.rtrw, "
		    . "m_pasien.jeniskel, "
		    . "m_pasien.tmptlahir, "
		    . "m_pasien.tgllahir, "
		    . "m_pasien.kdAgama, "
		    . "m_pasien.kdPendidikan, "
		    . "m_pasien.nohp,"
		    . "m_pasien.statKawin, "
		    . "m_pasien.pekerjaan, "
		    . "m_pasien.pjwb,"
		    . "m_pasien.ibuKandung,"
		    . "m_pasien.jctkkartu,"
		    . "m_pasien.goldarah, "
		    . "'L' AS kunj"
	  );
	  $q = $this->simrs->get_where('m_pasien', ['inorm' => $norm]);
//	  echo $this->simrs->last_query();
	  if ($q->num_rows() > 0) {
		foreach ($q->result() as $d) {
		    array_push($arrData, $d);
		}
		$res = $this->ResponseModel->res200(['data' => $arrData, "count" => $q->num_rows()]);
	  } else {
		$res = $this->ResponseModel->res204(['data' => $arrData, "count" => $q->num_rows()]);
	  }

	  return json_encode($res);
    }

    public function findNormOld($norm) {
	  $arrData = [];
	  $this->simrs->where("CAST(RIGHT(v_find_pasien.norm,5) AS UNSIGNED) = '$norm'");
	  $this->simrs->or_where("CAST(RIGHT(v_find_pasien.rmlama,5) AS UNSIGNED) = '$norm'");
	  $q = $this->simrs->get('v_find_pasien');
//	   echo $this->simrs->last_query(); 

	  if ($q->num_rows() > 0) {
		foreach ($q->result() as $d) {
		    array_push($arrData, $d);
		}
		$res = $this->ResponseModel->res200(['data' => $arrData, "count" => $q->num_rows()]);
	  } else {
		$res = $this->ResponseModel->res204(['data' => $arrData, "count" => $q->num_rows()]);
	  }

	  return json_encode($res);
    }

    public function findBiodata($norm) {
	  $arrData = [];
	  $q = $this->simrs->get_where('v_biodata', ['inorm' => $norm]);
	  if ($q->num_rows() > 0) {
		foreach ($q->result() as $d) {
		    array_push($arrData, $d);
		}
		$res = $this->ResponseModel->res200(['data' => $arrData, "count" => $q->num_rows()]);
	  } else {
		$res = $this->ResponseModel->res204(['data' => $arrData, "count" => $q->num_rows()]);
	  }

	  return json_encode($res);
    }

    public function findBy($field, $data) {
	  $arrData = [];
	  $this->simrs->select(
		    "m_pasien.inorm, "
		    . "m_pasien.norm, "
		    . "m_pasien.rmlama, "
		    . "m_pasien.tgldaftar, "
		    . "m_pasien.jamdaftar, "
		    . "m_pasien.kkelompok, "
		    . "m_pasien.noasuransi,"
		    . "m_pasien.noktp, "
		    . "m_pasien.nama, "
		    . "m_pasien.alamat, "
		    . "m_pasien.kprovinsi, "
		    . "m_pasien.kkabupaten, "
		    . "m_pasien.kkecamatan, "
		    . "m_pasien.kkelurahan, "
		    . "m_pasien.rtrw, "
		    . "m_pasien.jeniskel, "
		    . "m_pasien.tmptlahir, "
		    . "m_pasien.tgllahir, "
		    . "m_pasien.kdAgama, "
		    . "m_pasien.kdPendidikan, "
		    . "m_pasien.nohp,"
		    . "m_pasien.statKawin, "
		    . "m_pasien.pekerjaan, "
		    . "m_pasien.pjwb,"
		    . "m_pasien.ibuKandung,"
		    . "m_pasien.jctkkartu,"
		    . "m_pasien.goldarah, "
		    . "'L' AS kunj"
	  );
	  $q = $this->simrs->get_where('m_pasien', [$field => $data]);

	  if ($q->num_rows() > 0) {
		foreach ($q->result() as $d) {
		    array_push($arrData, $d);
		}
		$res = $this->ResponseModel->res200(['data' => $arrData, "count" => $q->num_rows()]);
	  } else {
		$res = $this->ResponseModel->res204(['data' => $arrData, "count" => $q->num_rows()]);
	  }

	  return json_encode($res);
    }
    
    public function checkTb($norm) {
	  $arrData=[];
	  $q = $this->simrs->get_where('m_rm_poli_tb', ['norm' => $norm]);

	  if ($q->num_rows() > 0) {
		foreach ($q->result() as $d) {
		    array_push($arrData, $d);
		}
		$res = $this->ResponseModel->res200(['data' => $arrData, "count" => $q->num_rows()]);
	  } else {
		$res = $this->ResponseModel->res204(['data' => $arrData, "count" => $q->num_rows()]);
	  }
	  
	  return json_encode($res);
    }

}
