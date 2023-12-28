<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GrafikKunj_M
 *
 * @author user
 */
class GrafikKunj_M extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->simrs = $this->load->database('simrs', true);
    }

    public function showData($tahun) {
        $dataB = [];
        $dataL = [];
        $datas = [];
        $sqlB = "SELECT Count(t_kunjungan.notrans) AS jml,"
                . "MONTH (t_kunjungan.tgltrans) AS bln "
                . "FROM t_kunjungan "
                . "WHERE YEAR (t_kunjungan.tgltrans)='$tahun' "
                . "AND t_kunjungan.kunj='B' "
                . "GROUP BY bln";
        $sqlL = "SELECT Count(t_kunjungan.notrans) AS jml,"
                . "MONTH (t_kunjungan.tgltrans) AS bln "
                . "FROM t_kunjungan "
                . "WHERE YEAR (t_kunjungan.tgltrans)='$tahun' "
                . "AND t_kunjungan.kunj='L' "
                . "GROUP BY bln";
        $q1 = $this->simrs->query($sqlB);
        
        if ($q1->num_rows() > 0) {
            $data = [];
            foreach ($q1->result() as $d) {
                array_push($data, $d);
            }

            $dataB['label'] = "Baru";
            $dataB['data'] = $this->genByMonth($data);
            array_push($datas, $dataB);
        }
        
        $q2 = $this->simrs->query($sqlL);
        if ($q2->num_rows() > 0) {
            $data = [];
            foreach ($q2->result() as $d) {
                array_push($data, $d);
            }

            $dataL['label'] = "Lama";
            $dataL['data'] = $this->genByMonth($data);
            array_push($datas, $dataL);
        }

        echo(json_encode($datas));
    }

    private function genByMonth($data) {
        $nData = [];
        $bln = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ];
//        print_r($data);
        $jml = 0;
        for ($i = 0; $i < 12; $i++) {
            $d = [];
            array_push($d, $bln[$i]);
            foreach ($data as $t) {
                if ($t->bln == $i + 1) {
                    $jml = (int)$t->jml;
                }
            }
            array_push($d, $jml);
            array_push($nData, $d);
            $jml = 0;
        }

//        echo json_encode($nData);

        return $nData;
    }

}
