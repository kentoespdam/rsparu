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
        $this->load->model('Rontgen/Rontgen_M');
        $this->load->model('API/DaftarTungguModel');
    }

    public function showData($tgl) {
        $response = [];
        $arrData = [];

        $this->benchmark->mark('code_start');
        $this->simrs->select("t_kunjungan.notrans, "
                . "m_pasien.inorm, m_pasien.norm, "
                . "t_kunjungan.tgltrans, "
                . "t_kunjungan.nourut, "
                . "m_pasien.noktp, "
                . "m_kelompok.kelompok, "
                . "m_pasien.noasuransi, "
                . "m_pasien.nama, "
                . "IF ( m_pasien.jeniskel = 'L', 'Laki-Laki', 'Perempuan' ) AS jeniskel, "
                . "m_kelurahan.kelurahan, IF ( t_kunjungan.kunj = 'L', 'Lama', 'Baru' ) AS kunj, "
                . "t_rontgen.selesai");
        $this->simrs->join("m_pasien", "t_kunjungan.norm = m_pasien.norm", "INNER");
        $this->simrs->join("m_kelompok", "t_kunjungan.kkelompok = m_kelompok.kkelompok", "INNER");
        $this->simrs->join("m_kelurahan", "m_pasien.kkelurahan = m_kelurahan.kdKel", "INNER");
        $this->simrs->join("t_rontgen", "t_rontgen.notrans = t_kunjungan.notrans", "INNER");
        $this->simrs->where("DATE_FORMAT(t_kunjungan.tgltrans,'%Y-%m-%d')", $tgl);
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
                . "IF ( t_kunjungan.kunj = 'L', 'Lama', 'Baru' ) AS kunj,"
                . "t_kunjungan.ktujuan, "
                . "m_tujuan.tujuan ");
        $this->simrs->join('m_pasien', 't_kunjungan.norm = m_pasien.norm', 'INNER');
        $this->simrs->join('m_kelompok', 't_kunjungan.kkelompok = m_kelompok.kkelompok', 'INNER');
        $this->simrs->join('m_kelurahan', 'm_pasien.kkelurahan = m_kelurahan.kdKel', 'INNER');
        $this->simrs->join('t_tensi', 't_tensi.notrans = t_kunjungan.notrans', 'INNER');
        $this->simrs->join('m_tujuan', 't_kunjungan.ktujuan = m_tujuan.kd_tujuan', 'INNER');
        $this->simrs->join('t_rontgen', 't_kunjungan.notrans = t_rontgen.notrans', 'LEFT');
        $this->simrs->where("DATE_FORMAT(t_kunjungan.tgltrans,'%Y-%m-%d')", $tgl);
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

    public function showDet($notrans) {
        $arrData = [];

        $p = json_decode($this->DaftarTungguModel->showDataDet($notrans));

        $this->simrs->select("t_rontgen.notrans, "
                . "t_rontgen.norm, "
                . "t_rontgen.tgltrans, "
                . "t_rontgen.ktujuan, "
                . "t_rontgen.pasienRawat, "
                . "t_rontgen.noreg, "
                . "t_rontgen.kdFoto, "
                . "t_rontgen.kdKondisiRo, "
                . "t_rontgen.kdFilm, "
                . "t_rontgen.jmlExpose, "
                . "t_rontgen.jmlFilmDipakai, "
                . "t_rontgen.jmlFilmRusak, "
                . "t_rontgen.kdMesin, "
                . "t_rontgen.pa, "
                . "t_rontgen.ap, "
                . "t_rontgen.lateral, "
                . "t_rontgen.obliq, "
                . "t_rontgen.catatan, "
                . "t_rontgen.selesai, "
                . "t_petugas.p_rontgen");
        $this->simrs->join("t_petugas", "t_rontgen.notrans = t_petugas.notrans", "INNER");
        $q = $this->simrs->get_where('t_rontgen', ['t_rontgen.notrans' => $notrans]);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($arrData, $d);
            }
        }

        $response = $this->ResponseModel->res200(["dataPasien" => $p->response->data, "dataRo" => $arrData]);
        return json_encode($response);
    }

    public function addRontgen($notrans, $ktujuan) {
        $res = [];
        
        $norm = substr($notrans, 0, 6);
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

        $sql_i = [
            "notrans" => $notrans,
            "norm" => $norm,
            "ktujuan" => $ktujuan,
            "tgltrans" => date('Y-m-d')
        ];
        $sql_p = [
            "notrans" => $notrans
        ];
        $r = $this->Rontgen_M->do_simpan($sql_i, $sql_p, 0);
        $this->AntrianModel->simpan_antrianpoli($norm, date("Y-m-d"), "RONTGEN");
//        echo $this->simrs->last_query();

        if ($this->simrs->trans_status() === TRUE) {
            $res = $this->ResponseModel->res201(['message' => 'Data Berhasil Diupdate!', "info" => $r]);
        }

        return json_encode($res);
    }

}
