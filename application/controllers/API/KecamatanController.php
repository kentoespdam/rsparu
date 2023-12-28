<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KecamatanController
 *
 * @author user
 */
class KecamatanController extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model("API/KecamatanModel");
    }

    public function showAll_get($kdKab) {
        $res = $this->KecamatanModel->showAll($kdKab);
        echo $res;
    }

}
