<?php

/*
 * Here comes the text of your license
 * Each line should be prefixed with mmm  * 
  @author kent-os
 */

/**
 * Description of TujuanModel
 *
 * @author rsparu-1
 */
class TujuanModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->simrs = $this->load->database("simrs", TRUE);
    }

    public function showAll() {
        $response = [];
        $arrData = [];

        $q = $this->simrs->get_where("m_tujuan", ['kd_tujuan !=' => '99', 'stat' => 1]);
		//$q = $this->simrs->order_by('tujuan', 'ASC')->get_where("m_tujuan", ['kd_tujuan !=' => '99', 'stat' => 1]);
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

    public function showDet($id) {
        $response = [];
        $arrData = [];

        $q = $this->simrs->get_where("m_tujuan", ['kd_tujuan' => $id]);

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
