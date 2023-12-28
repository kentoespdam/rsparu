<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DiagnosaModel
 *
 * @author user
 */
class DiagnosaModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->simrs = $this->load->database('simrs', true);
    }

    public function showAll() {
        $res = [];
        $data = [];

        $this->simrs->order_by('kdDiag', 'ASC');
        $q = $this->simrs->get('m_diagnosa');

        foreach ($q->result() as $d) {
            array_push($data, $d);
        }

        $res = $this->ResponseModel->res200(["data" => $data]);

        return json_encode($res);
    }

}
