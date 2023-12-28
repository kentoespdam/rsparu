<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PanggilController
 *
 * @author user
 */
class PanggilPoliController extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->ano = $this->load->database('ano', TRUE);
        $this->tgl = date("Y-m-d");
//        $this->load->model('API/PanggilModel');
    }
	
	public function tmpPanggil_get() {
        $response = [];
        $arrData = [];
        $this->ano->limit(1);
        $q = $this->ano->get_where("tmp_panggil_poli", ['panggil' => '0']);
		// echo $this->ano->last_query();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($arrData, $d);
            }
            $response = $this->ResponseModel->res200(['data' => $arrData]);
        } else {
            $response = $this->ResponseModel->res204(['data' => $arrData]);
        }

        echo json_encode($response);
    }
	
}
