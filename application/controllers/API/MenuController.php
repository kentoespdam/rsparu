<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuController
 *
 * @author loket-2
 */
class MenuController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('API/MenuModel');
    }

    public function listMenu() {
        echo $this->MenuModel->showListMenu();
    }

}
