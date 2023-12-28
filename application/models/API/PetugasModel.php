<?php

/*
 * Here comes the text of your license
 * Each line should be prefixed with mmm  * 
  @author kent-os
 */

/**
 * Description of PetugasModel
 *
 * @author rsparu-1
 */
class PetugasModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->simrs = $this->load->database('simrs', TRUE);
    }

    public function showListPegawai($uname) {
        $response = [];
        $arrData = [];

        $this->simrs->select('v_pegawai.nip, v_pegawai.nama, v_pegawai.gelar_d, v_pegawai.gelar_b, v_pegawai.kd_jab');
        if ($uname == 'LOKET'|| $uname == 'LOKET1'|| $uname == 'LOKET2'|| $uname == 'LOKET3') {
            $this->simrs->or_where('v_pegawai.nip', 1);
			$this->simrs->or_where('v_pegawai.nip', 6);
			$this->simrs->or_where('v_pegawai.nip', '198301182014062004');
			// $this->simrs->where('v_pegawai.kd_jab', 17);
            // $this->simrs->or_where('v_pegawai.kd_jab', 10);
            // $this->simrs->or_where('v_pegawai.kd_jab', 18);
        } elseif ($uname == 'POLIUMUM' || $uname == 'POLITB' || $uname == 'TENSI' || $uname == 'TENSITB' || $uname == 'POLISP' || $uname == 'POLITB2' || $uname == 'POLI1' || $uname == 'POLI2' || $uname == 'POLI3'|| $uname == 'POLI4'|| $uname == 'POLI5') {
            $this->simrs->where('v_pegawai.kd_jab', 7);
            $this->simrs->or_where('v_pegawai.kd_jab', 1);
            $this->simrs->or_where('v_pegawai.kd_jab', 8);
            $this->simrs->or_where('v_pegawai.kd_jab', 10);
            $this->simrs->or_where('v_pegawai.kd_jab', 18);
        } elseif ($uname == 'RONTGEN') {
            $this->simrs->where('v_pegawai.kd_jab', 12);
        }
        $this->simrs->order_by('v_pegawai.nama', 'ASC');
        $q = $this->simrs->get('v_pegawai');
//	  echo $this->simrs->last_query();

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($arrData, $d);
            }

            $response = $this->ResponseModel->res200(["data" => $arrData, "count" => $q->num_rows()]);
        } else {
            $response = $this->ResponseModel->res204(["data" => $arrData, "count" => $q->num_rows()]);
        }

        return json_encode($response);
    }

    /* public function showListPegawai($uname) {
      $response = [];
      $arrData = [];

      $this->simrs->select('v_pegawai.nip, v_pegawai.nama');
      $this->simrs->where('user_access.uname', $uname);
      $this->simrs->or_where('user_access.uname', 'ADMIN');
      $this->simrs->join('v_pegawai', 'user_access.nip = v_pegawai.nip', 'INNER');
      $this->simrs->order_by('v_pegawai.nama ASC');
      $q = $this->simrs->get('user_access');

      if ($q->num_rows() > 0) {
      foreach ($q->result() as $d) {
      array_push($arrData, $d);
      }

      $response = $this->ResponseModel->res200(["data" => $arrData, "count" => $q->num_rows()]);
      } else {
      $response = $this->ResponseModel->res204(["data" => $arrData, "count" => $q->num_rows()]);
      }

      return json_encode($response);
      } */

    public function simpanTransPetugas($arrPetugas) {
//	  print_r($arrPetugas);
        if ($this->cekTransPetugas($arrPetugas) == 0) {
            $this->simrs->insert('t_petugas', $arrPetugas);
        } else {
            $this->simrs->update('t_petugas', $arrPetugas, ['notrans' => $arrPetugas['notrans']]);
        }
    }

    public function deleteTransPetugas($notrans) {
        $this->simrs->delete('t_petugas', ['notrans' => $notrans]);
    }

    private function cekTransPetugas($arrPetugas) {
        $q = $this->simrs->get_where('t_petugas', ['notrans' => $arrPetugas['notrans']]);
        return $q->num_rows();
    }

}
