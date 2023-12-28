<?php

/*
 * Here comes the text of your license
 * Each line should be prefixed with mmm  * 
  @author kent-os
 */

/**
 * Description of DaftarTunggu_C
 *
 * @author rsparu-1
 */
class RiwayatController extends REST_Controller {

    public function __construct($config = 'rest') {
	  parent::__construct($config);
	  $this->load->model('API/RiwayatModel');
    }

    public function index() {
	  echo "ok";
    }
    
    public function findDataKunj_post() {
	  $frnama = $this->post("frnama");
	  $frdesa = $this->post("frdesa");
	  $frkecamatan = $this->post("frkecamatan");
	  $frkabupaten = $this->post("frkabupaten");

	  if ($frnama == "" && $frdesa == "" && $frkecamatan == "" && $frkabupaten == "") {
		echo json_encode($this->ResponseModel->res400(["message" => "Parameter tidak sesuai!!!"]));
	  } else {
		echo $this->RiwayatModel->findDataKunj($frnama, $frdesa, $frkecamatan, $frkabupaten);
	  }
    }

    public function findNormKunj_post() {
	  $norm = $this->post('norm');
//	  echo $norm;
	  if ($norm == "") {
		echo json_encode($this->RiwayatModel->res400(["message" => "Parameter tidak sesuai!!!"]));
	  } else {
		echo $this->RiwayatModel->findNormKunj($norm);
	  }
    }

}
