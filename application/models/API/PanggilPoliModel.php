<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PanggilPoliModel
 *
 * @author Kent-os
 */
class PanggilPoliModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->ano = $this->load->database('ano', TRUE);
        $this->tgl = date("Y-m-d");
    }

    public function getTmp($Klinik) {
        $response = [];
        $data = [];
        $Kliniks = str_replace('%20', ' ', $Klinik);
        $this->ano->select("tmp_panggil_poli.noAntri, tmp_panggil_poli.norm, tmp_panggil_poli.poli");
        $q = $this->ano->get_where('tmp_panggil_poli', ['poli' => $Kliniks, 'DATE(ts)' => $this->tgl]);

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($data, $d);
            }
            $response = $this->ResponseModel->res200(['msg' => "Data Ditemukan!", 'data' => $data]);
        } else {
            $response = $this->ResponseModel->res204(['msg' => "Data tidak Ditemukan!", 'data' => $data]);
        }

        return json_encode($response);
    }

    public function addTmp($Klinik) {
        $response = [];
        $str_panggil = "";

        $aliasPoli = $this->input->post('aliasPoli');
        $data_panggil = $this->input->post('data_panggil');
        $n = count($data_panggil);

        $Kliniks = str_replace('%20', ' ', $Klinik);
//	  echo $Kliniks;

        for ($i = 0; $i < $n; $i++) {
//		$res;
            $No_Pasien = $data_panggil[$i];
            $q = $this->ano->get_where('tmp_panggil_poli', ['norm' => $No_Pasien, 'DATE(ts)' => $this->tgl, 'poli' => $Klinik]);
            // echo $this->ano->last_query();
            $where = ['No_Pasien' => $No_Pasien, 'DATE(Tanggal)' => $this->tgl, 'Klinik' => $Kliniks];
            $this->ano->select('NOANTRI, Klinik, No_Pasien, Nama, Alamat');
            $q1 = $this->ano->get_where('tbantrianpoli', $where);
//            echo $this->ano->last_query();
            $q1_res = $q1->result_object()[0];

            if ($q->num_rows() > 0) {
//		    $response = $this->ResponseModel->res201(['msg' => 'Data sudah Disimpan!', 'nama' => $q1_res->Nama, "alamat" => $q1_res->Alamat, "poli" => $Kliniks]);
                $str_panggil = $str_panggil . $q1_res->Nama . ", dari " . $q1_res->Alamat . ", \n ";
            } else {
                $this->ano->update('tbantrianpoli', ['Masuk' => 1], $where);
                $res = json_decode($this->ins($q1_res->NOANTRI, $q1_res->Nama, $q1_res->Alamat, $q1_res->Klinik, $No_Pasien));
                $str_panggil = $str_panggil . $res->nama . ", dari " . $res->alamat . ", ";
            }
        }
        $str_panggil = $str_panggil . " Silahkan Masuk Ke- Ruang " . $aliasPoli;
        $response = $this->ResponseModel->res201(['msg' => 'Data Disimpan!', 'str' => $str_panggil]);

        return json_encode($response);
    }

    private function ins($noAntri, $nama, $alamat, $poli, $norm) {
        $res = "";
        if ($this->checkAntri($noAntri, $norm) == 0) {
            $this->ano->trans_start();
            $this->ano->insert('tmp_panggil_poli', ['uuid' => $this->uuid->v4(), 'noAntri' => $noAntri, 'nama' => $nama, 'alamat' => $alamat, 'poli' => $poli, 'norm' => $norm, 'panggil' => 1]);
            $this->ano->trans_complete();
        } else {
            $this->ano->trans_start();
            $this->ano->update('tmp_panggil_poli', ['panggil' => 1, 'poli' => $poli], ["noAntri" => $noAntri, "norm" => $norm, "DATE(ts)" => $this->tgl]);
            $this->ano->trans_complete();
        }
//        echo $this->ano->last_query();

        if ($this->ano->trans_status() === true) {
            $res = ['nama' => $nama, "alamat" => $alamat];
        }

        return json_encode($res);
    }

    private function checkAntri($noAntri, $norm) {
        $q = $this->ano->get_where("tmp_panggil_poli", ["noAntri" => $noAntri, "norm" => $norm, "DATE(ts)" => $this->tgl]);

        return $q->num_rows();
    }

}
