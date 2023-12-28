<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Riwayat_C
 *
 * @author Tata Usaha
 */
class Riwayat_C extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Tensi/Riwayat_M');
    }

    public function index($norm) {
        echo $this->Riwayat_M->showData($norm);
    }
    
    public function Simpan(){
         echo $this->Riwayat_M->Simpan();
//		echo "Simpan";
    }

}
