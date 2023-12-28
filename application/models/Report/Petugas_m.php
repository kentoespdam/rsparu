<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Petugas_m
 *
 * @author loket-2
 */
class Petugas_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->simrs = $this->load->database('simrs', true);
    }

    public function showData() {
        $response = [];
        $arrData = [];
        $kd_menu = $this->input->post('kd_menu');
        $mulaiTgl = $this->input->post('mulaiTgl');
        $selesaiTgl = $this->input->post('selesaiTgl');

        if ($kd_menu == 1) {
            $this->simrs->select("Count(t_kunjungan.notrans) AS jml, peg_m_biodata.nip, peg_m_biodata.nama, 'Admin Loket' AS sts");
            $this->simrs->join('t_petugas', 't_petugas.notrans = t_kunjungan.notrans', 'INNER');
            $this->simrs->join('peg_m_biodata', 't_petugas.p_loket = peg_m_biodata.nip', 'INNER');
            $this->simrs->where("DATE_FORMAT(t_kunjungan.tgltrans,'%Y-%m-%d') BETWEEN '$mulaiTgl' AND '$selesaiTgl'");
            $this->simrs->group_by("peg_m_biodata.nip");
            $this->simrs->group_by("peg_m_biodata.nama");
            $q = $this->simrs->get("t_kunjungan");
//            echo $this->simrs->last_query();
            if ($q->num_rows() > 0) {
                foreach ($q->result() as $d) {
                    array_push($arrData, $d);
                }

                $response = $this->ResponseModel->res200(["data" => $arrData]);
            } else {
                $response = $this->ResponseModel->res204(["data" => $arrData]);
            }
        } elseif ($kd_menu == 2) {
            $this->simrs->select("Count(t_kunjungan.notrans) AS jml, peg_m_biodata.nip, peg_m_biodata.nama, 'Admin Tensi' AS sts");
            $this->simrs->join('t_petugas', 't_petugas.notrans = t_kunjungan.notrans', 'INNER');
            $this->simrs->join('peg_m_biodata', 't_petugas.p_admin_tensi = peg_m_biodata.nip', 'INNER');
            $this->simrs->where("DATE_FORMAT(t_kunjungan.tgltrans,'%Y-%m-%d') BETWEEN '$mulaiTgl' AND '$selesaiTgl'");
            $this->simrs->group_by("peg_m_biodata.nip");
            $this->simrs->group_by("peg_m_biodata.nama");
            $q1 = $this->simrs->get_compiled_select("t_kunjungan");

            $this->simrs->select("Count(t_kunjungan.notrans) AS jml, peg_m_biodata.nip, peg_m_biodata.nama, 'Perawat Tensi' AS sts");
            $this->simrs->join('t_petugas', 't_petugas.notrans = t_kunjungan.notrans', 'INNER');
            $this->simrs->join('peg_m_biodata', 't_petugas.p_perawat_tensi = peg_m_biodata.nip', 'INNER');
            $this->simrs->where("DATE_FORMAT(t_kunjungan.tgltrans,'%Y-%m-%d') BETWEEN '$mulaiTgl' AND '$selesaiTgl'");
            $this->simrs->group_by("peg_m_biodata.nip");
            $this->simrs->group_by("peg_m_biodata.nama");
            $q2 = $this->simrs->get_compiled_select("t_kunjungan");
//            echo $q1." UNION ".$q2;
            $q = $this->simrs->query($q1 . " UNION " . $q2);
            if ($q->num_rows() > 0) {
                foreach ($q->result() as $d) {
                    array_push($arrData, $d);
                }

                $response = $this->ResponseModel->res200(["data" => $arrData]);
            } else {
                $response = $this->ResponseModel->res204(["data" => $arrData]);
            }
        }elseif ($kd_menu == 3) {
            $this->simrs->select("Count(t_kunjungan.notrans) AS jml, peg_m_biodata.nip, peg_m_biodata.nama, 'Admin Poli' AS sts");
            $this->simrs->join('t_petugas', 't_petugas.notrans = t_kunjungan.notrans', 'INNER');
            $this->simrs->join('peg_m_biodata', 't_petugas.p_admin_poli = peg_m_biodata.nip', 'INNER');
            $this->simrs->where("DATE_FORMAT(t_kunjungan.tgltrans,'%Y-%m-%d') BETWEEN '$mulaiTgl' AND '$selesaiTgl'");
            $this->simrs->group_by("peg_m_biodata.nip");
            $this->simrs->group_by("peg_m_biodata.nama");
            $q1 = $this->simrs->get_compiled_select("t_kunjungan");

            $this->simrs->select("Count(t_kunjungan.notrans) AS jml, peg_m_biodata.nip, peg_m_biodata.nama, 'Dokter Poli' AS sts");
            $this->simrs->join('t_petugas', 't_petugas.notrans = t_kunjungan.notrans', 'INNER');
            $this->simrs->join('peg_m_biodata', 't_petugas.p_dokter_poli = peg_m_biodata.nip', 'INNER');
            $this->simrs->where("DATE_FORMAT(t_kunjungan.tgltrans,'%Y-%m-%d') BETWEEN '$mulaiTgl' AND '$selesaiTgl'");
            $this->simrs->group_by("peg_m_biodata.nip");
            $this->simrs->group_by("peg_m_biodata.nama");
            $q2 = $this->simrs->get_compiled_select("t_kunjungan");
			
			 // Admin Konsul
            $this->simrs->select("Count(t_kunjungan.notrans) AS jml, peg_m_biodata.nip, peg_m_biodata.nama, 'Admin Poli Konsul' AS sts");
            $this->simrs->join('t_petugas', 't_petugas.notrans = t_kunjungan.notrans', 'INNER');
            $this->simrs->join('peg_m_biodata', 't_petugas.p_admin_poli_konsul = peg_m_biodata.nip', 'INNER');
            $this->simrs->where("DATE_FORMAT(t_kunjungan.tgltrans,'%Y-%m-%d') BETWEEN '$mulaiTgl' AND '$selesaiTgl'");
            $this->simrs->group_by("peg_m_biodata.nip");
            $this->simrs->group_by("peg_m_biodata.nama");
            $q3 = $this->simrs->get_compiled_select("t_kunjungan");

            // Dokter Konsul
            $this->simrs->select("Count(t_kunjungan.notrans) AS jml, peg_m_biodata.nip, peg_m_biodata.nama, 'Dokter Konsul' AS sts");
            $this->simrs->join('t_petugas', 't_petugas.notrans = t_kunjungan.notrans', 'INNER');
            $this->simrs->join('peg_m_biodata', 't_petugas.p_dokter_poli_konsul = peg_m_biodata.nip', 'INNER');
            $this->simrs->where("DATE_FORMAT(t_kunjungan.tgltrans,'%Y-%m-%d') BETWEEN '$mulaiTgl' AND '$selesaiTgl'");
            $this->simrs->group_by("peg_m_biodata.nip");
            $this->simrs->group_by("peg_m_biodata.nama");
            $q4 = $this->simrs->get_compiled_select("t_kunjungan");
			
			
			
//            echo $q1." UNION ".$q2;
            $q = $this->simrs->query($q1 . " UNION " . $q2. " UNION " . $q3 . " UNION " . $q4);
            if ($q->num_rows() > 0) {
                foreach ($q->result() as $d) {
                    array_push($arrData, $d);
                }

                $response = $this->ResponseModel->res200(["data" => $arrData]);
            } else {
                $response = $this->ResponseModel->res204(["data" => $arrData]);
            }
        }

        return json_encode($response);
    }

}
