<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TungguPendaftaran_c
 *
 * @author rsparu-1
 */
class TungguPendaftaran_c extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->simrs = $this->load->database('simrs', true);
        $this->ano = $this->load->database('ano', true);
    }

    public function index_get() {
        $res = $this->tampil();

        echo json_encode($res);
    }

    private function tampil() {
        $res = [];
        $data = [];

        $this->ano->select("tmp_panggil.noAntri,tmp_panggil.loket,tmp_panggil.panggil,tmp_panggil.ts,tbnoantri.jenis");
        $this->ano->where(['tmp_panggil.panggil' => 0, 'DATE(tbnoantri.Tanggal)=' => date('Y-m-d')]);
        $this->ano->join('tbnoantri', "tmp_panggil.noAntri = tbnoantri.NoAntri", "inner");
        $this->ano->order_by('tmp_panggil.ts DESC');
        $q = $this->ano->get("tmp_panggil");
//        echo $this->ano->last_query();

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($data, $d);
            }
            $res = $this->ResponseModel->res200(["data" => $data, "count" => $q->num_rows()]);
        } else {
            $res = $this->ResponseModel->res204(["data" => $data, "count" => 0]);
        }

        return $res;
    }

}
