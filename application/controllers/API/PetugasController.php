<?php

/*
 * Here comes the text of your license
 * Each line should be prefixed with mmm  * 
  @author kent-os
 */

/**
 * Description of PetugasController
 *
 * @author rsparu-1
 */
class PetugasController extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('API/PetugasModel');
    }
    
    public function listPetugasBy($uname){
        echo $this->PetugasModel->showListPegawai($uname);
    }
}
