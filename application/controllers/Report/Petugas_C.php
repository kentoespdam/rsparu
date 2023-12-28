<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Petugas_C
 *
 * @author loket-2
 */
class Petugas_C extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Report/Petugas_m');
    }

    public function index() {
        if (isset($this->session->logged)) {
            $logged = $this->session->logged;
            $arrData = [
//                'FormInput' => $this->parser->parse('Pendaftaran/FormInput', ["uname" => $logged['uname']], TRUE),
//                'FormCari' => $this->parser->parse('Pendaftaran/FormCari', [], TRUE),
//                'FormRiwayatKunj' => $this->parser->parse('Pendaftaran/FormRiwayatKunj', [], TRUE),
            ];

            $this->parser->parse('Report/Petugas', $arrData);
        } else {
            redirect(base_url('Login'));
        }
    }

    public function showData() {
        echo $this->Petugas_m->showData();
    }

}
