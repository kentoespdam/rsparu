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
class DaftarTungguModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->simrs = $this->load->database('simrs', TRUE);
    }

    public function showData($tgl) {
        $response = [];
        $arrData = [];

        $this->benchmark->mark('code_start');
        $this->simrs->order_by("nourut ASC");
        $q = $this->simrs->get_where("v_daftar_tunggu", ['tgltrans' => $tgl]);

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($arrData, $d);
            }
            $this->benchmark->mark('code_end');
            $response = $this->ResponseModel->res200(["data" => $arrData, "count" => $q->num_rows(), "time" => $this->benchmark->elapsed_time('code_start', 'code_end')]);
        } else {
            $response = $this->ResponseModel->res204(["data" => $arrData, "count" => $q->num_rows()]);
        }

        return json_encode($response);
    }

    public function showDataPoli($tgl, $poli) {
        $response = [];
        $arrData = [];

        $this->simrs->select(
                "v_daftar_tunggu.norm, "
                . "v_daftar_tunggu.notrans, "
                . "v_daftar_tunggu.nourut, "
                . "v_daftar_tunggu.norm, "
                . "v_daftar_tunggu.noktp, "
                . "v_daftar_tunggu.kelompok, "
                . "v_daftar_tunggu.noasuransi, "
                . "v_daftar_tunggu.nama, "
                . "v_daftar_tunggu.jeniskel, "
                . "v_daftar_tunggu.kelurahan, "
                . "v_daftar_tunggu.kunj, "
                . "v_daftar_tunggu.selesai");
        $this->simrs->order_by("nourut", "ASC");
        $this->simrs->order_by("selesai", "DESC");
        $q = $this->simrs->get_where("v_daftar_tunggu", ['tgltrans' => $tgl, 'ktujuan' => $poli]);
//	   echo $this->simrs->last_query();

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

    public function showSelesaiDataPoli($tgl, $poli) {
        $response = [];
        $arrData = [];

        $this->simrs->select(
                "v_daftar_tunggu.norm, "
                . "v_daftar_tunggu.notrans, "
                . "v_daftar_tunggu.nourut, "
                . "v_daftar_tunggu.norm, "
                . "v_daftar_tunggu.noktp, "
                . "v_daftar_tunggu.kelompok, "
                . "v_daftar_tunggu.noasuransi, "
                . "v_daftar_tunggu.nama, "
                . "v_daftar_tunggu.jeniskel, "
                . "v_daftar_tunggu.kelurahan, "
                . "v_daftar_tunggu.kunj, "
                . "v_daftar_tunggu.tujuan, "
                . "v_daftar_tunggu.selesai");
        $this->simrs->order_by("nourut", "ASC");
        $this->simrs->order_by("selesai", "DESC");
        $this->simrs->where("tgltrans", $tgl);
        $this->simrs->where("ktujuan !=", $poli);
        $q = $this->simrs->get("v_daftar_tunggu");
//	   echo $this->simrs->last_query();

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

    public function showDataDet($notrans) {
        $response = [];
        $arrData = [];

        $this->simrs->select(
                "v_daftar_tunggu.norm, "
                . "v_daftar_tunggu.notrans, "
                . "v_daftar_tunggu.tgltrans, "
                . "v_daftar_tunggu.nama, "
                . "v_daftar_tunggu.jeniskel, "
                . "v_daftar_tunggu.tmptlahir, "
                . "v_daftar_tunggu.tgllahir, "
                . "v_daftar_tunggu.umurthn, "
                . "v_daftar_tunggu.umurbln, "
                . "v_daftar_tunggu.umurhr, "
                . "v_daftar_tunggu.rtrw, "
                . "v_daftar_tunggu.kelurahan, "
                . "v_daftar_tunggu.kecamatan, "
                . "v_daftar_tunggu.kabupaten");
        $q = $this->simrs->get_where("v_daftar_tunggu", ['notrans' => $notrans]);

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

}
