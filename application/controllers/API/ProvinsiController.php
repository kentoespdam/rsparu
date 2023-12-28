<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProvinsiController
 *
 * @author user
 */
class ProvinsiController extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model("API/ProvinsiModel");
    }

    public function showAll_get() {
        $res = $this->ProvinsiModel->showAll();
        echo $res;
    }

}
