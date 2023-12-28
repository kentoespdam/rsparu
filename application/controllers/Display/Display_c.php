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
        $this->load->model('API/TujuanModel');

        $this->simrs = $this->load->database('simrs', true);
    }

    public function index($id) {
        if ($id == "0") {
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

//    private function poli($id) {
//        $poli = json_decode($this->TujuanModel->showDet($id));
//
//        $data = [
//            "id_tujuan" => $poli->response->data[0]->kd_tujuan,
//            "poli" => $poli->response->data[0]->tujuan
//        ];
//	  
//        $this->parser->parse('Panggil/display_poli', $data);
//    }

    private function poli($id) {
        $this->simrs->select("m_u_login.uname, m_u_login.kd_tujuan, m_u_login.`name`, m_u_login.aliases");
        $d = $this->simrs->get_where('m_u_login', ['uname' => $id])->result();
        
//        print_r($d);

        $data = [
            "uname" => $d[0]->uname,
            "id_tujuan" => $d[0]->kd_tujuan,
            "poli" => $d[0]->name,
            "aliases" => $d[0]->aliases,
        ];

        $this->parser->parse('Panggil/display_poli', $data);
    }

}
