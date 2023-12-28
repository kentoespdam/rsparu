<?php

/*
 * Here comes the text of your license
 * Each line should be prefixed with mmm  * 
  @author kent-os
 */

/**
 * Description of Tensi_C
 *
 * @author rsparu-1
 */
class Tensi_C extends CI_Controller {

    public function __construct() {
	  parent::__construct();
	  $this->load->model('Tensi/Tensi_M');
    }

    public function index() {
	  $arrData = [
		'tungguTensi' => $this->parser->parse('Tensi/DaftarTunggu', [], TRUE),
		'inputTensi' => $this->parser->parse('Tensi/FormInputTensi', [], TRUE),
		'inputRiwayat' => $this->parser->parse('Tensi/FormInputRiwayat', [], TRUE),
	  ];

	  $this->parser->parse('Tensi/Tensi', $arrData);
    }

    public function Simpan() {
	  echo $this->Tensi_M->Simpan(); 
    }

    public function Show_data($norm) {
	  echo $this->Tensi_M->show_data($norm);
    }
    
    public function Pindah(){
        echo $this->Tensi_M->Pindah();
    }

}
