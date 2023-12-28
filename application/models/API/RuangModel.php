<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuangModel
 *
 * @author Tata Usaha
 */
class RuangModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->an = $this->load->database('an', TRUE);
    }

    public function showAll() {
        $res = [];
        $arrData = [];
        $this->an->order_by("urut", "ASC");
        $q = $this->an->get("mruang");

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($arrData, $d);
            }

            $res = $this->ResponseModel->res200(["data" => $arrData]);
        } else {
            $res = $this->ResponseModel->res204(["data" => "Data tidak Ditemukan!"]);
        }

        return json_encode($res);
    }

}
