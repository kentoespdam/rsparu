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
class PanggilController extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->ano = $this->load->database('ano', TRUE);
        $this->tgl = date("Y-m-d");
		$this->load->model('API/PanggilModel');
    }

    public function tmpPanggil_get() {
        $response = $this->PanggilModel->tmpPanggil();

        echo $response;
    }

    public function addTmp_get($noAntri, $loket) {
        $response = $this->PanggilModel->addTmp($noAntri, $loket);
        echo $response;
    }

    public function updTmp_get($noAntri, $loket, $panggil) {
		$response = $this->PanggilModel->updTmp($noAntri, $loket, $panggil);
        echo $response;
    }

    private function ins($noAntri, $loket) {
        $res = "";
        $this->ano->trans_start();
        $q = $this->ano->insert('tmp_panggil', ['noAntri' => $noAntri, 'loket' => $loket, 'panggil' => '0']);
        $this->ano->trans_complete();

        if ($this->ano->trans_status() === true) {
            $res = $this->ResponseModel->res201(['msg' => 'Data berhasil Disimpan!']);
        }

        return json_encode($res);
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

        return json_encode($res);
    }

    public function lewati_get($noAntri, $tanggal) {
        $response = $this->PanggilModel->lewati($noAntri, $tanggal);
        echo json_encode($response);
    }

    public function rmTmp_get($noAntri) {
        $response = $this->PanggilModel->rmTmp($noAntri);
        echo jon_encode($response);
    }

    public function gantiHari_get() {
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
