<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuangController
 *
 * @author Tata Usaha
 */
class RuangController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("API/RuangModel");
    }

    public function showAll() {
        $res = $this->RuangModel->showAll();
        echo $res;
    }

}
