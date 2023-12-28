<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RontgenController
 *
 * @author Tata Usaha
 */
class RontgenController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('API/RontgenModel');
    }

    public function listFotoRontgen() {
        echo $this->RontgenModel->listFotoRontgen();
    }
    
    public function listKondisiRontgen() {
        echo $this->RontgenModel->listKondisiRontgen();
    }
    
    public function listFilmRontgen() {
        echo $this->RontgenModel->listFilmRontgen();
    }
    
    public function listMesinRontgen() {
        echo $this->RontgenModel->listMesinRontgen();
    }

}
