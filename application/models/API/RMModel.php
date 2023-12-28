<?php

/*
 * Here comes the text of your license
 * Each line should be prefixed with mmm  * 
  @author kent-os
 */

/**
 * Description of RMModel
 *
 * @author rsparu-1
 */
class RMModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->simrs = $this->load->database("simrs", TRUE);
    }

    public function showDetKunjungan($notrans) {
        $res = [];
        $data = [];
        $q = $this->simrs->get_where("t_kunjungan", ["notrans" => $notrans]);
        if ($q->num_rows() === 0) {
            $res = $this->ResponseModel->res204(["message" => "Data Tidak Ditemukan!"]);
        } else {
            foreach ($q->result() as $d) {
                array_push($data, $d);
            }
            $res = $this->ResponseModel->res200(["message" => "OK", "data" => $data]);
        }
        return json_encode($res);
    }

}
