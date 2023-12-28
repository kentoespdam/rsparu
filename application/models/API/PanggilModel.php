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
class PanggilModel extends CI_Model {

    public function __construct() {
	  parent::__construct();
	  $this->ano = $this->load->database('ano', TRUE);
	  $this->tgl = date("Y-m-d");
    }

    public function tmpPanggil() {
	  $response = [];
	  $arrData = [];
	  $this->ano->limit(1);
	  $q = $this->ano->get_where("tmp_panggil", ['panggil' => '0']);
//	   echo $this->ano->last_query();
	  if ($q->num_rows() > 0) {
		foreach ($q->result() as $d) {
		    array_push($arrData, $d);
		}
		$response = $this->ResponseModel->res200(['data' => $arrData]);
	  } else {
		$response = $this->ResponseModel->res204(['data' => $arrData]);
	  }

	  return json_encode($response);
    }

    public function addTmp($noAntri, $loket) {
	  $response = [];
	  $arrData = [];

	  $q = $this->ano->get_where('tmp_panggil', ['noAntri' => $noAntri]);
	  $sql_u = "UPDATE `tbnoantri` "
		    . "SET tbnoantri.Panggil=1, "
		    . "tbnoantri.LOKET=" . $loket
		    . ", tbnoantri.lewati=0 "
		    . "WHERE CAST(tbnoantri.NoAntri AS UNSIGNED)=" . $noAntri . " "
		    . "AND DATE(tbnoantri.Tanggal)='" . $this->tgl . "'";
	  if ($q->num_rows() > 0) {
		$this->ano->query($sql_u);
		$response = $this->upd($noAntri, $loket, "0");
	  } else {
		$this->ano->query($sql_u);
		$response = $this->ins($noAntri, $loket);
	  }

	  return json_encode($response);
    }

    public function updTmp($noAntri, $loket, $panggil) {
	  return json_encode($this->upd($noAntri, $loket, $panggil));
    }

    private function ins($noAntri, $loket) {
	  $res = "";
	  $this->ano->trans_start();
	  $q = $this->ano->insert('tmp_panggil', ['noAntri' => $noAntri, 'loket' => $loket, 'panggil' => '0']);
	  $this->ano->trans_complete();

	  if ($this->ano->trans_status() === true) {
		$res = $this->ResponseModel->res201(['msg' => 'Data berhasil Disimpan!']);
	  }

	  return $res;
    }

    private function upd($noAntri, $loket, $panggil) {
	  $res = "";
	  $this->ano->trans_start();
	  $q = $this->ano->update('tmp_panggil', ['loket' => $loket, 'panggil' => $panggil], ['CAST(noAntri AS UNSIGNED)=' => $noAntri]);
	  $this->ano->trans_complete();
	  // echo $this->ano->last_query();

	  if ($this->ano->trans_status() === true) {
		// $this->ano->update("tbnoantri",["Panggil"=>0],['CAST(noAntri AS UNSIGNED)=' => $noAntri]);
		$res = $this->ResponseModel->res201(["msg" => "update data success"]);
	  }

	  return $res;
    }

    public function lewati($noAntri, $tanggal) {
	  $this->ano->trans_start();
	  $where = "DATE(tbnoantri.Tanggal)='$tanggal' AND CAST(tbnoantri.NoAntri AS UNSIGNED)='$noAntri'";
	  $this->ano->update("tbnoantri", ["LEWATI" => 1, "Panggil" => 0], $where);
	  // echo $this->ano->last_query();
	  $this->ano->trans_complete();

	  return $this->rmTmp($noAntri);
    }

    public function rmTmp($noAntri) {
	  $res = [];
	  $this->ano->trans_start();
	  $q = $this->ano->delete('tmp_panggil', ['noAntri' => $noAntri]);
	  $this->ano->trans_complete();

	  if ($this->ano->trans_status() === true) {
		$res = $this->ResponseModel->res200(["msg" => "delete data success"]);
	  }

	  return $res;
    }

    public function gantiHari() {
	  // $tgl = date("Y-m-d");
	  // $sql = "DELETE FROM tmp_panggil WHERE DATE(tmp_panggil.ts)<> '" . $tgl . "'";

	  // $this->ano->trans_start();
	  // $q = $this->ano->query($sql);
	  // $this->ano->trans_complete();

	  // if ($this->ano->trans_status() === true) {
		$res = $this->ResponseModel->res201(["msg" => "delete data success"]);
	  // }

	  return json_encode($res);
    }

}
