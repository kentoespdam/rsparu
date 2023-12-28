<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KelurahanController
 *
 * @author user
 */
class KelurahanController extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model("API/KelurahanModel");
    }

    public function showAll_get($kdKel) {
        $res = $this->KelurahanModel->showAll($kdKel);
        echo $res;
    }

}
