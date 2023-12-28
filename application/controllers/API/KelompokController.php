<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KelompokController
 *
 * @author user
 */
class KelompokController extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model("API/KelompokModel");
    }

    public function showAll_get() {
        $res = $this->KelompokModel->showAll();
        echo $res;
    }

}
