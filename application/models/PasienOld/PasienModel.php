<?php
/* 
* To change this license header, choose License Headers in Project Properties. 
* To change this template file, choose Tools | Templates 
* and open the template in the editor. */

/** 
* Description of PasienModel * 
* @author user */
class PasienModel extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function findData($fnama, $fdesa, $fkecamatan, $fkabupaten) {
		$arrData = [];
		($fdesa != "") ? $wDs = " AND kkelurahan LIKE '%" . $fdesa . "%'" : $wDs = "";
		($fkecamatan != "") ? $wKc = " AND kkecamatan LIKE '%" . $fkecamatan . "%'" : $wKc = "";
		($fkabupaten != "") ? $wKb = " AND kkabupaten LIKE '%" . $fkabupaten . "%'" : $wKb = "";
		$where = "WHERE NAMA LIKE '%$fnama%'" . $wDs . $wKc . $wKb;
		$sql = "SELECT * FROM v_find_pasien " . $where;
		$q = $this->bp4->query($sql);
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $d) {
				array_push($arrData, $d);
			}
			$res = $this->ResponseModel->res200(['data' => $arrData, $q->num_rows()]);
		} else {
			$res = $this->ResponseModel->res204(['data' => $arrData, "count" => $q->num_rows()]);
		}
		return json_encode($res);
	}
	
	public function findNorm($noRm) {
		$arrData = [];
		$this->bp4->trans_start();
		$this->bp4->select("'' AS norm, "
			. "pend_pasien.NIK AS noktp, "
			. "pend_pasien.NOMOR AS rmlama, "
			. "pend_pasien.LAHIR_TEMPAT AS tmptlahir, "
			. "pend_pasien.TANGGAL AS tgldaftar, "
			. "pend_pasien.NAMA AS nama, "
			. "pend_pasien.ALAMAT AS alamat, "
			. "pend_pasien.DESA AS kkelurahan, "
			. "pend_pasien.RKRT AS rtrw, "
			. "pend_pasien.KEC AS kkecamatan, "
			. "pend_pasien.KAB AS kkabupaten, "
			. "IFNULL(m_agama.kd_agama,1) AS kdAgama, "
			. "pend_pasien.JNSKEL AS jeniskel, "
			. "pend_pasien.GOLDARAH AS goldarah, "
			. "IFNULL(m_stat_nikah.kd_stat_nikah,'K') AS statKawin, "
			. "pend_pasien.PEKERJAAN AS pekerjaan, "
			. "pend_pasien.TGLAKHIR AS tglakhir, "
			. "pend_pasien.TGLLAHIR AS tgllahir, "
			. "IFNULL(m_kelompok.kkelompok,1) AS kkelompok, "
			. "pend_pasien.NOKTA AS noasuransi, "
			. "1 AS kdPendidikan, "
			. "'L' AS kunj, "
			. "'' AS orangtua ");
		if (strlen($noRm) > 6) {
			$this->bp4->where("pend_pasien.NOMOR", $noRm);
		} else if (strlen($noRm) <= 6) {
			$this->bp4->where("CAST(RIGHT(pend_pasien.NOMOR,5) AS SIGNED) = '$noRm'");
		}
		$this->bp4->join("m_agama", "pend_pasien.AGAMA = m_agama.agama", "LEFT");
		$this->bp4->join("m_stat_nikah", "pend_pasien.`STATUS` = m_stat_nikah.status_nikah", "LEFT");
		$this->bp4->join("m_kelompok", "pend_pasien.KTA = m_kelompok.kelompok", "LEFT");
		$this->bp4->group_by("pend_pasien.NOMOR");
		$q = $this->bp4->get("pend_pasien");//
		 // echo $this->bp4->last_query();
		$this->bp4->trans_complete();
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