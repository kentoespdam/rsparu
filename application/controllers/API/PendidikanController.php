<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PendidikanController
 *
 * @author user
 */
class PendidikanController extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->simrs = $this->load->database("simrs", true);
    }

    public function showAll_get() {
        $arrData = [];
        $q = $this->simrs->get("m_pendidikan");

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($arrData, $d);
            }

            $response = $this->ResponseModel->res200(["data" => $arrData, "count" => $q->num_rows()]);
        } else {
            $response = $this->ResponseModel->res204(["data" => $arrData, "count" => $q->num_rows()]);
        }

        echo json_encode($response);
    }

}
