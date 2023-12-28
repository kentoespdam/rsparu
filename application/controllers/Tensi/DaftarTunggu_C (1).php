<?php

/*
 * Here comes the text of your license
 * Each line should be prefixed with mmm  * 
  @author kent-os
 */

/**
 * Description of DaftarTunggu_C
 *
 * @author rsparu-1
 */
class DaftarTunggu_C extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $tgl = date("Y-m-d");
        $data = [
            'tgl' => $tgl,
        ];
        $this->parser->parse('Tensi/DaftarTunggu', $data);
    }

    public function showData() {
        $tgl = $this->input->post('tgl');
        $this->load->model('API/DaftarTungguModel');
        $res = $this->DaftarTungguModel->showData($tgl);
        echo $res;
    }

}
