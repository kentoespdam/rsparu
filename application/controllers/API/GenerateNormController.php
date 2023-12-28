<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GenerateNormController
 *
 * @author rsparu-1
 */
class GenerateNormController extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('API/NormModel');
    }

    public function index_get() {
        $res = $this->NormModel->generateNoRm();
        echo $res;
    }

}
