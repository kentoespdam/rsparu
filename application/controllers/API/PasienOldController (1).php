<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PasienOldController
 *
 * @author user
 */
class PasienOldController extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->bp4 = $this->load->database("bp4", true);
        $this->load->model("PasienOld/PasienModel");
    }

    public function findData_post() {
        $fnama = $this->post("fnama");
        $fdesa = $this->post("fdesa");
        $fkecamatan = $this->post("fkecamatan");
        $fkabupaten = $this->post("fkabupaten");
        $rmlama = $this->post("rmlama");

        if ($fnama == "" && $fdesa == "" && $fkecamatan == "" && $fkabupaten == "") {
            echo json_encode($this->ResponseModel->res400(["message" => "Parameter tidak sesuai!!!"]));
        } else {
            echo $this->PasienModel->findData($fnama, $fdesa, $fkecamatan,$fkabupaten);
        }
    }

    public function findNorm_post() {
        $noRm= $this->post('norm');
        
        echo $this->PasienModel->findNorm($noRm);
    }

}
