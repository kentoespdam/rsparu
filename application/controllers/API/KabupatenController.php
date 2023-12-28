<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KabupatenController
 *
 * @author user
 */
class KabupatenController extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model("API/KabupatenModel");
    }

    public function showAll_get($kdProv) {
        $res = $this->KabupatenModel->showAll($kdProv);
        echo $res;
    }

}
