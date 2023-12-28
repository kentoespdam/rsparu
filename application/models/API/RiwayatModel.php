<?php

/*
 * Here comes the text of your license
 * Each line should be prefixed with mmm  * 
  @author kent-os
 */

/**
 * Description of DaftarTungguModel
 *
 * @author rsparu-1
 */
class RiwayatModel extends CI_Model {

    public function __construct() {
	  parent::__construct();
	  $this->simrs = $this->load->database('simrs', TRUE);
    }

    public function findDataKunj($frnama, $frdesa, $frkecamatan, $frkabupaten) {
	  $arrData = [];

	  ($frdesa != "") ? $wDs = " AND kelurahan LIKE '%" . $frdesa . "%'" : $wDs = "";
	  ($frkecamatan != "") ? $wKc = " AND kecamatan LIKE '%" . $frkecamatan . "%'" : $wKc = "";
	  ($frkabupaten != "") ? $wKb = " AND kabupaten LIKE '%" . $frkabupaten . "%'" : $wKb = "";
	  $where = "WHERE nama LIKE '%" . $frnama . "%'" . $wDs . $wKc . $wKb;
	  $sql = "SELECT "
		    . "t_kunjungan.notrans, "
		    . "DATE(t_kunjungan.tgltrans) AS tgltrans, "
		    . "m_pasien.inorm, "
		    . "m_pasien.norm, "
		    . "m_pasien.nama, "
		    . "m_pasien.jeniskel, "
		    . "m_kelurahan.kelurahan, "
		    . "m_kecamatan.kecamatan, "
		    . "m_kabupaten.kabupaten, "
		    . "m_pasien.noktp, "
		    . "m_pasien.noasuransi "
		    . "FROM t_kunjungan "
		    . "INNER JOIN m_pasien ON t_kunjungan.norm = m_pasien.norm "
		    . "INNER JOIN m_kelurahan ON m_pasien.kkelurahan = m_kelurahan.kdKel "
		    . "INNER JOIN m_kecamatan ON m_pasien.kkecamatan = m_kecamatan.kdKec "
		    . "INNER JOIN m_kabupaten ON m_pasien.kkabupaten = m_kabupaten.kdKab "
		    . $where
		    . " ORDER BY m_pasien.norm ASC, t_kunjungan.tgltrans DESC";

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

    public function findNormKunj($norm) {
	  $arrData = [];

	  $where = "WHERE m_pasien.inorm = " . intval($norm);
	  $sql = "SELECT "
		    . "t_kunjungan.notrans, "
		    . "DATE(t_kunjungan.tgltrans) AS tgltrans, "
		    . "m_pasien.inorm, "
		    . "m_pasien.norm, "
		    . "m_pasien.nama, "
		    . "m_pasien.jeniskel, "
		    . "m_kelurahan.kelurahan, "
		    . "m_kecamatan.kecamatan, "
		    . "m_kabupaten.kabupaten, "
		    . "m_pasien.noktp, "
		    . "m_pasien.noasuransi "
		    . "FROM t_kunjungan "
		    . "INNER JOIN m_pasien ON t_kunjungan.norm = m_pasien.norm "
		    . "INNER JOIN m_kelurahan ON m_pasien.kkelurahan = m_kelurahan.kdKel "
		    . "INNER JOIN m_kecamatan ON m_pasien.kkecamatan = m_kecamatan.kdKec "
		    . "INNER JOIN m_kabupaten ON m_pasien.kkabupaten = m_kabupaten.kdKab "
		    . $where
		    . " ORDER BY m_pasien.norm ASC, t_kunjungan.tgltrans DESC";

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

}
