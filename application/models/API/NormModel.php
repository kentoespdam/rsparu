<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NormModel
 *
 * @author rsparu-1
 */
class NormModel extends CI_Model {

    public function __construct() {
	  parent::__construct();
	  date_default_timezone_set("Asia/Jakarta");
	  $this->tgl = date('Y-m-d h:i:s');
	  $this->simrs = $this->load->database("simrs", TRUE);
    }

    public function generateNoRm() {
	  $norm = "";
	  $response = [];

	  $q = $this->simrs->query("SELECT gen_norm() as norm;");
	  if ($q->num_rows() > 0) {
		foreach ($q->result() as $d) {
		    $norm = $d->norm;
		}

		$response = $this->ResponseModel->res200(["norm" => $norm]);
	  }

	  return json_encode($response);
    }

    public function gen_notrans($norm) {

	  $q = $this->simrs->query("SELECT gen_notrans('$norm','$this->tgl') AS notrans;");

	  if ($q->num_rows() > 0) {
		$d = $q->result();
		$notrans = $d[0]->notrans;
	  }

	  return $notrans;
    }

}
