<?php

/* * To change this license header, choose License Headers in Project Properties. 
* To change this template file, choose Tools | Templates 
* and open the template in the editor. */
/** 
* Description of Main_C * 
* @author rsparu-1 */

class Main_C extends CI_Controller {
	public function index() {
		if (isset($this->session->logged)) {
			$logged = $this->session->logged;
			$view = [
				"nip" => $logged['nip'],
				"gelar_d" => $logged['gelar_d'],
				"nama" => $logged['nama'],
				"gelar_b" => $logged['gelar_b'],
			];
			$this->parser->parse("template/n_template", $view);
		} else {
			// echo $_SERVER['HTTPS'];
			redirect(base_url('Login'));
		}
	}
}