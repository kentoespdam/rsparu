<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KelurahanModel
 *
 * @author user
 */
class KelurahanModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->simrs = $this->load->database("simrs", TRUE);
    }

    public function showAll($kdKec) {
        $response = [];
        $arrData = [];

        $this->simrs->order_by("kelurahan", "ASC");
        $q = $this->simrs->get_where("m_kelurahan", ['kdKec' => $kdKec]);

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($arrData, $d);
            }

            $response = $this->ResponseModel->res200(["data" => $arrData, "count" => $q->num_rows()]);
        } else {
            $response = $this->ResponseModel->res204(["data" => $arrData, "count" => $q->num_rows()]);
        }

        return json_encode($response);
    }

}
