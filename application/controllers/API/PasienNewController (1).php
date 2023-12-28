<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PasienNewController
 *
 * @author user
 */
class PasienNewController extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->Model('API/PasienModel');
    }

    public function findData_post() {
        $fnama = $this->post("fnama");
        $fdesa = $this->post("fdesa");
        $fkecamatan = $this->post("fkecamatan");
        $fkabupaten = $this->post("fkabupaten");

        if ($fnama == "" && $fdesa == "" && $fkecamatan == "" && $fkabupaten == "") {
            echo json_encode($this->ResponseModel->res400(["message" => "Parameter tidak sesuai!!!"]));
        } else {
            echo $this->PasienModel->findData_new($fnama, $fdesa, $fkecamatan, $fkabupaten);
        }
    }

    public function findNorm_post() {
        $norm = $this->post('norm');
//	  echo $norm;
        if ($norm == "") {
            echo json_encode($this->ResponseModel->res400(["message" => "Parameter tidak sesuai!!!"]));
        } else {
            echo $this->PasienModel->findNorm($norm);
        }
    }

    public function findNormOld_post() {
        $norm = $this->post('norm');
//	  echo $norm;
        if ($norm == "") {
            echo json_encode($this->ResponseModel->res400(["message" => "Parameter tidak sesuai!!!"]));
        } else {
            echo $this->PasienModel->findNormOld($norm);
        }
    }

}
