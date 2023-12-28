<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaftarTungguRontgen_M
 *
 * @author Tata Usaha
 */
class DaftarTungguRontgen_M extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->simrs = $this->load->database('simrs', TRUE);
    }

    public function showData($tgl) {
        $response = [];
        $arrData = [];

        $this->benchmark->mark('code_start');
        $this->simrs->select("t_kunjungan.notrans, "
                . "m_pasien.inorm, "
                . "t_kunjungan.norm, "
                . "t_kunjungan.tgltrans, "
                . "t_kunjungan.nourut, "
                . "m_pasien.noktp, "
                . "m_kelompok.kelompok, "
                . "m_pasien.noasuransi, "
                . "m_pasien.nama, "
                . "IF ( m_pasien.jeniskel = 'L', 'Laki-Laki', 'Perempuan' ) AS jeniskel, "
                . "m_kelurahan.kelurahan, "
                . "IF ( t_kunjungan.kunj = 'L', 'Lama', 'Baru' ) AS kunj, "
                . "IF(ISNULL(t_rontgen.notrans),0,1) AS selesai");
        $this->simrs->join('m_pasien', 't_kunjungan.norm = m_pasien.norm', 'INNER');
        $this->simrs->join('m_kelompok', 't_kunjungan.kkelompok = m_kelompok.kkelompok', 'INNER');
        $this->simrs->join('m_kelurahan', 'm_pasien.kkelurahan = m_kelurahan.kdKel', 'INNER');
//        $this->simrs->join('t_poli', 't_poli.notrans = t_kunjungan.notrans', 'LEFT');
        $this->simrs->join('t_rontgen', 't_kunjungan.notrans = t_rontgen.notrans', 'LEFT');
        $this->simrs->where('DATE(t_kunjungan.tgltrans)', $tgl);
//        $this->simrs->where('t_poli.rontgen', 1);
        $this->simrs->order_by("nourut ASC");
        $q = $this->simrs->get("t_kunjungan");
//        echo $this->simrs->last_query();

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($arrData, $d);
            }
            $this->benchmark->mark('code_end');
            $response = $this->ResponseModel->res200(["data" => $arrData, "count" => $q->num_rows(), "time" => $this->benchmark->elapsed_time('code_start', 'code_end')]);
        } else {
            $response = $this->ResponseModel->res204(["data" => $arrData, "count" => $q->num_rows()]);
        }

        return json_encode($response);
    }

    public function showOther($tgl) {
        $response = [];
        $arrData = [];

        $this->benchmark->mark('code_start');
        $this->simrs->select("t_kunjungan.notrans, "
                . "m_pasien.inorm, t_kunjungan.norm, "
                . "t_kunjungan.tgltrans, "
                . "t_kunjungan.nourut, "
                . "m_pasien.noktp, "
                . "m_kelompok.kelompok, "
                . "m_pasien.noasuransi, "
                . "m_pasien.nama, "
                . "IF ( m_pasien.jeniskel = 'L', 'Laki-Laki', 'Perempuan' ) AS jeniskel, "
                . "m_kelurahan.kelurahan, "
                . "IF ( t_kunjungan.kunj = 'L', 'Lama', 'Baru' ) AS kunj, "
                . "m_tujuan.tujuan ");
        $this->simrs->join('m_pasien', 't_kunjungan.norm = m_pasien.norm', 'INNER');
        $this->simrs->join('m_kelompok', 't_kunjungan.kkelompok = m_kelompok.kkelompok', 'INNER');
        $this->simrs->join('m_kelurahan', 'm_pasien.kkelurahan = m_kelurahan.kdKel', 'INNER');
        $this->simrs->join('t_tensi', 't_tensi.notrans = t_kunjungan.notrans', 'INNER');
        $this->simrs->join('m_tujuan', 't_kunjungan.ktujuan = m_tujuan.kd_tujuan', 'INNER');
        $this->simrs->join('t_rontgen', 't_kunjungan.notrans = t_rontgen.notrans', 'LEFT');
        $this->simrs->where('DATE(t_kunjungan.tgltrans)', $tgl);
//        $this->simrs->where('t_poli.rontgen !=', 1);
        $this->simrs->order_by("nourut ASC");
        $q = $this->simrs->get("t_kunjungan");
//        echo $this->simrs->last_query();

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($arrData, $d);
            }
            $this->benchmark->mark('code_end');
            $response = $this->ResponseModel->res200(["data" => $arrData, "count" => $q->num_rows(), "time" => $this->benchmark->elapsed_time('code_start', 'code_end')]);
        } else {
            $response = $this->ResponseModel->res204(["data" => $arrData, "count" => $q->num_rows()]);
        }

        return json_encode($response);
    }

    public function addRontgen() {
        $res = [];
        $notrans = $this->input->post('notrans');

        $q = $this->simrs->get_where('t_poli', ['notrans' => $notrans]);
        if ($q->num_rows() == 1) {
            $this->simrs->trans_start();
            if ($q->result()[0]->rontgen == 0) {
                $this->simrs->update('t_poli', ['rontgen' => 1], ['notrans' => $notrans]);
            } else {
                $this->simrs->update('t_poli', ['rontgen' => 0], ['notrans' => $notrans]);
            }
            $this->simrs->trans_complete();
        }

        $this->AntrianModel->simpan_antrianpoli(substr($notrans, 0, 5), date("Y-m-d"), "RONTGEN");
//        echo $this->simrs->last_query();

        if ($this->simrs->trans_status() === TRUE) {
            $res = $this->ResponseModel->res201(['message' => 'Data Berhasil Diupdate!']);
        }

        return json_encode($res);
    }

}
