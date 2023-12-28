<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Video_m
 *
 * @author rsparu-1
 */
class Video_m extends CI_Model {
	
	public function __construct() {
        parent::__construct();
        $this->simrs = $this->load->database("simrs", TRUE);
    }

    public function showAll() {
        $res = [];
        $data = [];

        $q = $this->simrs->get('m_video');
        if ($q->num_rows() > 1) {
            foreach ($q->result() as $d) {
                array_push($data, $d);
            }
            $res = $this->ResponseModel->res200(["data" => $data, "count" => $q->num_rows()]);
        } else {
            $res = $this->ResponseModel->res404(["data" => "", "count" => 0]);
        }

        return json_encode($res);
    }

}
