<?php

/*
 * Here comes the text of your license
 * Each line should be prefixed with mmm  * 
  @author kent-os
 */

/**
 * Description of Poli_C
 *
 * @author rsparu-1
 */
class Poli_C extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Poli/Poli_M');
        $this->load->model('Poli/RiwayatPoli_M');
    }

    public function index() {
        $arrData = [
            'tungguPoli' => $this->parser->parse('Poli/DaftarTunggu', [], TRUE),
            'inputPoli' => $this->parser->parse('Poli/FormInputPoli', [], TRUE),
                // 'inputRiwayat' => $this->parser->parse('Poli/FormInputRiwayat', [], TRUE),
        ];

        $this->parser->parse('Poli/Poli', $arrData);
    }

    public function AmbilRiwayat($norm) {
        $data = $this->RiwayatPoli_M->AmbilRiwayat($norm);
//        print_r($data);
        $arrData = [
            'data'=>$data
        ];

        $this->parser->parse('Poli/FormRiwayat', $arrData);
    }

    public function Simpan() {
        echo $this->Poli_M->Simpan();
    }

    public function ShowData($norm) {
        echo $this->Poli_M->showData($norm);
    }

}
