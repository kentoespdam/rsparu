<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AntreanOldController
 *
 * @author user
 */
class AntreanOldController extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('API/AntreanOldModel');
    }

    public function vSound_get(){
         $this->parser->parse('Panggil/v_Suara', []);
		 session_write_close();
    }

    public function showLoket_get() {
        $res = $this->AntreanOldModel->showLoket();
        echo $res;
    }

    public function showPoli() { 
        
    }

}
