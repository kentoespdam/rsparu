<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AntreanOldModel
 *
 * @author user
 */
class AntreanOldModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->ano = $this->load->database('ano', true);
    }

    public function showLoket() {
        $response = [];
        $arrData = [];

        $tgl = date('Y-m-d');
        $this->ano->select('NoAntri, LOKET, jenis, lewati, Panggil');
        $this->ano->order_by('Panggil DESC');
        $this->ano->order_by('LEWATI ASC');
        $this->ano->order_by('NoAntri ASC');
        $this->ano->where('DATE(Tanggal)', $tgl);
        $this->ano->where('Selesai', 0);
//        $this->ano->limit(1);
        // echo $this->ano->get_compiled_select('tbnoantri');
        $q = $this->ano->get('tbnoantri');
	  // echo $this->ano->last_query();

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($arrData, $d);
            }
            $response = $this->ResponseModel->res200(['data' => $arrData, 'count' => $q->num_rows()]);
        } else {
            $response = $this->ResponseModel->res204(['data' => 'Antrian Sudah Habis', 'count' => 0]);
        }

        return json_encode($response);
    }

    public function showPoli($poli) {
        $response = [];
        $arrData = [];

        $poli = str_replace("%20", " ", $poli);

        $tgl = date('Y-m-d');
        $this->ano->select('Klinik, Nama, Alamat, Masuk, Lewati');
        $this->ano->order_by('Tanggal ASC');
        $this->ano->where('DATE(Tanggal)', $tgl);
        $this->ano->where('Klinik', $poli);
        $this->ano->where('Masuk', 0);

        $q = $this->ano->get('tbantrianpoli');
//        echo $this->ano->last_query();

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($arrData, $d);
            }
            $response = $this->ResponseModel->res200(['data' => $arrData, 'count' => $q->num_rows()]);
        } else {
            $response = $this->ResponseModel->res204(['data' => 'Antrian Sudah Habis', 'count' => 0]);
        }

        return json_encode($response);
    }

}
