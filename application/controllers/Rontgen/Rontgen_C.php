<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rontgen_C
 *
 * @author Tata Usaha
 */
class Rontgen_C extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Rontgen/Rontgen_M');
        $this->load->model('Rontgen/DaftarTungguRontgen_M');
        $this->load->model('Rontgen/ReportRontgen_M');
    }

    public function index() {
        $arrData = [
            'tungguRontgen' => $this->parser->parse('Rontgen/DaftarTunggu', [], TRUE),
            'inputRontgen' => $this->parser->parse('Rontgen/FormInputRontgen', [], TRUE),
                // 'inputRiwayat' => $this->parser->parse('Rontgen/FormInputRiwayat', [], TRUE),
        ];

        $this->parser->parse('Rontgen/Rontgen', $arrData);
    }

    public function ShowTunggu() {
        $tgl = $this->input->post('tgl');
        $res = $this->DaftarTungguRontgen_M->showData($tgl);
        echo $res;
    }

    public function Simpan() {
        echo $this->Rontgen_M->Simpan();
    }

    public function Hapus() {
        $res = $this->Rontgen_M->Hapus();
        echo $res;
    }

    public function ShowData($norm) {
        echo $this->Rontgen_M->showData($norm);
    }

    public function ShowOther() {
        $tgl = $this->input->post('tgl');
        $res = $this->DaftarTungguRontgen_M->showOther($tgl);
        echo $res;
    }

    public function ShowDet($notrans) {
        $res = $this->DaftarTungguRontgen_M->showDet($notrans);
        echo $res;
    }

    public function addRontgen() {
        $notrans = $this->input->post('notrans');
        $ktujuan = $this->input->post('ktujuan');
        $res = $this->DaftarTungguRontgen_M->addRontgen($notrans, $ktujuan);
        echo $res;
    }

    public function ReportKunjungan() {
        $arrData = [];
        $this->parser->parse('Rontgen/ReportRontgen', $arrData);
    }

    public function showReportKunjungan($cetak) {
        $res = json_decode($this->ReportRontgen_M->showData());

        $arrData = [
            'tglMulai' => $this->input->post('tglMulai'),
            'tglSelesai' => $this->input->post('tglSelesai'),
            'count' => $res->response->count,
            'data' => $res->response->data,
            'cetak' => $cetak
        ];

        $this->parser->parse('Rontgen/rptRontgen', $arrData);
    }

}
