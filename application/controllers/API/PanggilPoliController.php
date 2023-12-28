<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PanggilController
 *
 * @author user
 */
class PanggilPoliController extends REST_Controller {

    public function __construct($config = 'rest') {
	  parent::__construct($config);
	  $this->ano = $this->load->database('ano', TRUE);
	  $this->tgl = date("Y-m-d");
	  $this->load->model('API/PanggilPoliModel');
    }

    public function getTmp_get($Klinik) {
	  $response= $this->PanggilPoliModel->getTmp($Klinik);
	  echo $response;
    }
    
    public function addTmp_post($Klinik) {
        $response = $this->PanggilPoliModel->addTmp($Klinik);
        echo $response;
    }

}
