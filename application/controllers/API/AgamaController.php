<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AgamaController
 *
 * @author user
 */
class AgamaController extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->simrs = $this->load->database('simrs', TRUE);
    }

    public function showAll_get() {
        $arrData = [];
        $q = $this->simrs->get("m_agama");

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($arrData, $d);
            }

            $res = $this->ResponseModel->res200(["data" => $arrData, "count" => $q->num_rows()]);
        } else {
            $res = $this->ResponseModel->res204(["data" => $arrData, "count" => $q->num_rows()]);
        }
        echo json_encode($res);
    }

}
