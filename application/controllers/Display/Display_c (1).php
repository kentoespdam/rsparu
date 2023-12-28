<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Display_c
 *
 * @author rsparu-1
 */
class Display_c extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('API/Loket_m');
        $this->load->model('API/Video_m');
        // $this->load->model('API/Tujuan_m');
    }

    public function index($id) {
        if ($id == 1) {
            $this->pendaftaran();
        } else {
            $this->poli($id);
        }
    }

    private function pendaftaran() {
        $m_loket = $this->Loket_m->showAll();
        $m_video = $this->Video_m->showAll();
        $data = [
            "dtPanel" => $m_loket,
            "dtVideo" => $m_video
        ];
        $this->parser->parse('Panggil/display', $data);
    }

    private function poli($id) {
        $poli = json_decode($this->Tujuan_m->showDet($id));
        $data = [
            "id_tujuan" => $poli->response[0]->id_tujuan,
            "poli" => $poli->response[0]->nama
        ];
        $this->parser->parse('template/display_poli', $data);
    }

}
