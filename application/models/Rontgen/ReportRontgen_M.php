<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReportRontgen_M
 *
 * @author loket-2
 */
class ReportRontgen_M extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->Model('API/PetugasModel');
        $this->load->Model('API/TujuanModel');
        $this->load->model("Bridging/AntrianModel");
        $this->simrs = $this->load->database('simrs', TRUE);
        $this->skrng = date('Y-m-d');
    }

    public function showData() {
        $response = [];
        $arrData = [];

        $this->form_validation->set_rules("tglMulai", "Tanggal Mulai", "trim|required");
        $this->form_validation->set_rules("tglSelesai", "Tanggal Selesai", "trim|required");

        $tglMulai = $this->input->post('tglMulai');
        $tglSelesai = $this->input->post('tglSelesai');
        $kkelompok = $this->input->post('kkelompok');
        $kdFilm = $this->input->post('kdFilm');
        $kdMesin = $this->input->post('kdMesin');
        $p_rontgen = $this->input->post('p_rontgen');

        if ($this->form_validation->run() === false) {
            $res = $this->ResponseModel->res400(["message" => validation_errors()]);
        } else {
//        Query
            $this->simrs->where("tgltrans BETWEEN '$tglMulai' AND '$tglSelesai'");

            if ($kkelompok != "") {
                $this->simrs->where('kkelompok', $kkelompok);
            }

            if ($kdFilm != "") {
                $this->simrs->where('kdFilm', $kdFilm);
            }

            if ($kdMesin != "") {
                $this->simrs->where('kdMesin', $kdMesin);
            }

            if ($p_rontgen != "") {
                $this->simrs->where('p_rontgen', $p_rontgen);
            }

            $this->simrs->order_by('noreg', 'ASC');
            $q = $this->simrs->get('v_rontgen');

//        echo $this->simrs->last_query();

            if ($q->num_rows() > 0) {
                foreach ($q->result() as $d) {
                    array_push($arrData, $d);
                }
                $this->benchmark->mark('code_end');
                $response = $this->ResponseModel->res200(["data" => $arrData, "count" => $q->num_rows()]);
            } else {
                $response = $this->ResponseModel->res204(["data" => $arrData, "count" => $q->num_rows()]);
            }
        }

        return json_encode($response);
    }

}
