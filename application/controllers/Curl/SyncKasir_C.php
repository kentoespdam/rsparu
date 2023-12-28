<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SyncKasir_C
 *
 * @author Kent-os
 */
class SyncKasir_C extends CI_Controller
{
    public function __construct()
	{
        parent::__construct();
        $this->load->model('Curl-kasir/SheetModel');
    }

    public function index(){
        $res = $this->SheetModel->syncSheet();

		echo $res;
    }
}