<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Loket_c
 *
 * @author rsparu-1
 */
class Loket_c extends REST_Controller {
    public function __construct($config = 'rest') {
        parent::__construct($config);
    }

    public function index_get() {
        $res = [];
        $data = [];

        $q = $this->db->get('m_Loket');
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($data, $d);
            }
            $res = $this->responseModel->res200(["data" => $data, "count" => $q->num_rows()]);
        }

        echo json_encode($res);
    }

}
