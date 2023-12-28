<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth_M
 *
 * @author Kent-os
 */
class Auth_M extends CI_Model {

    public function __construct() {
	  parent::__construct();
    }

    public function menu_cek($u, $m) {
//	  print_r($u);
	  if (!in_array($u, $m)) {
		
		echo"<script>"
		. "var x=alert('Anda Tidak Memiliki Akses!');"
		. "if(x){"
		. "window.location.href='" . base_url() . "';"
		. "}"
		. "</script>";
//		redirect()->to('#');
//		redirect('', 'refresh');
		
	  }
    }

}
