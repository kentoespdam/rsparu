<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataGrafik_C
 *
 * @author user
 */
class DataGrafik_C extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function g_kunj() {
        $this->load->model('Grafik/GrafikKunj_M');
        $tahun = $this->input->post('thn');
        
        echo $this->GrafikKunj_M->showData($tahun);
        
    }

}
