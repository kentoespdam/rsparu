<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RontgenModel
 *
 * @author Tata Usaha
 */
class RontgenModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->simrs = $this->load->database('simrs', TRUE);
    }

    public function listFotoRontgen() {
        $response = [];
        $arrData = [];

        $q = $this->simrs->get("m_rontgen_foto");

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

    public function listKondisiRontgen() {
        $response = [];
        $arrData = [];

        $this->simrs->order_by('mas', ' ASC');
        $this->simrs->order_by('kv', ' ASC');
        $q = $this->simrs->get("m_rontgen_kondisi");

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

    public function listFilmRontgen() {
        $response = [];
        $arrData = [];

        $q = $this->simrs->get("m_rontgen_film");

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

    public function listMesinRontgen() {
        $response = [];
        $arrData = [];

        $q = $this->simrs->get("m_rontgen_mesin");

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
