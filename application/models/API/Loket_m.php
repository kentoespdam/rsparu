<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Loket_m
 *
 * @author rsparu-1
 */
class Loket_m extends CI_Model {
	
	public function __construct() {
		parent::__construct();
		$this->simrs=$this->load->database("simrs", true);
	}

    public function showAll() {
        $res = [];
        $data = [];

        $q = $this->simrs->get('m_loket');
        if ($q->num_rows() > 1) {
            foreach ($q->result() as $d) {
                array_push($data, $d);
            }
            $res = $this->ResponseModel->res200(["data" => $data, "count" => $q->num_rows()]);
        }

        return json_encode($res);
    }
	
	public function showDet($id){
		$res = [];
        $data = [];

        $q = $this->simrs->get_where('m_loket',['id_loket',$id]);
        if ($q->num_rows() > 1) {
            foreach ($q->result() as $d) {
                array_push($data, $d);
            }
            $res = $this->ResponseModel->res200(["data" => $data, "count" => $q->num_rows()]);
        }

        return json_encode($res);
	}

}
