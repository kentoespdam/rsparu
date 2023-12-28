<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rontgen_M
 *
 * @author Tata Usaha
 */
class Rontgen_M extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->Model('API/PetugasModel');
        $this->load->Model('API/TujuanModel');
        $this->load->model("Bridging/AntrianModel");
        $this->simrs = $this->load->database('simrs', TRUE);
        $this->skrng = date('Y-m-d');
    }

    public function Simpan() {
        $res = [];

        $notrans = $this->input->post("notrans");
        $norm = $this->input->post("norm");
        $tgltrans = $this->input->post("tgltrans");
        $ktujuan = $this->input->post("ktujuan");
        $pasienRawat = $this->input->post("pasienRawat");
        $noreg = $this->input->post("noreg");
        $kdFoto = $this->input->post("kdFoto");
        $kdKondisiRo = $this->input->post("kdKondisiRo");
        $kdFilm = $this->input->post("kdFilm");
        $jmlExpose = $this->input->post("jmlExpose");
        $jmlFilmDipakai = $this->input->post("jmlFilmDipakai");
        $jmlFilmRusak = $this->input->post("jmlFilmRusak");
        $kdMesin = $this->input->post("kdMesin");
        $pa = $this->input->post("pa");
        $ap = $this->input->post("ap");
        $lateral = $this->input->post("lateral");
        $obliq = $this->input->post("obliq");
        $catatan = $this->input->post("catatan");
        $p_rontgen = $this->input->post("p_rontgen");
        $updRontgen = $this->input->post("updRontgen");

        $this->form_validation->set_rules("notrans", "No Transaksi", "trim|required");
        $this->form_validation->set_rules("norm", "No RM", "trim|required");
        $this->form_validation->set_rules("tgltrans", "Tranggal Transaksi", "trim|required");
        $this->form_validation->set_rules("ktujuan", "Tujuan", "trim|required");
        $this->form_validation->set_rules("noreg", "No Registrasi", "trim|required");
        $this->form_validation->set_rules("kdFoto", "Nama Foto", "trim|required");
        $this->form_validation->set_rules("kdKondisiRo", "Kondisi Foto", "trim|required");
        $this->form_validation->set_rules("kdFilm", "Ukuran Film", "trim|required");
        $this->form_validation->set_rules("jmlExpose", "Jml Expose", "trim|required");
        $this->form_validation->set_rules("jmlFilmDipakai", "Jml Film Dipakai", "trim|required");
        $this->form_validation->set_rules("kdMesin", "Mesin", "trim|required");
        $this->form_validation->set_rules("p_rontgen", "Petugas", "trim|required");

        if ($this->form_validation->run() === false) {
            $res = $this->ResponseModel->res400(["message" => validation_errors()]);
        } else {
            $sql_i = [
                "notrans" => $notrans,
                "norm" => $norm,
                "tgltrans" => $tgltrans,
                "ktujuan" => $ktujuan,
                "pasienRawat" => $pasienRawat,
                "noreg" => $noreg,
                "kdFoto" => $kdFoto,
                "kdKondisiRo" => $kdKondisiRo,
                "kdFilm" => $kdFilm,
                "jmlExpose" => $jmlExpose,
                "jmlFilmDipakai" => $jmlFilmDipakai,
                "jmlFilmRusak" => $jmlFilmRusak,
                "kdMesin" => $kdMesin,
                "pa" => $pa,
                "ap" => $ap,
                "lateral" => $lateral,
                "obliq" => $obliq,
                "catatan" => $catatan,
                "selesai" => 1
            ];

            $sql_p = [
                "notrans" => $notrans,
                "p_rontgen" => $p_rontgen
            ];

            $res = $this->do_simpan($sql_i, $sql_p, $updRontgen);
        }

        return json_encode($res);
    }

    private function cek_exist($notrans) {
        $q = $this->simrs->get_where('t_rontgen', ['notrans' => $notrans]);

        return $q->num_rows();
    }

    public function do_simpan($sql_i, $sql_p, $updRontgen) {
        $res = [];

        if ($this->cek_exist($sql_i['notrans']) == 0) {
            $this->simrs->trans_start();
            $this->simrs->insert('t_rontgen', $sql_i);
            $this->simrs->trans_complete();

            if ($this->simrs->trans_status() === TRUE) {
                $this->PetugasModel->simpanTransPetugas($sql_p);
                $aa = $this->update_tKunjungan($sql_i);
                $res = $this->ResponseModel->res201([
                    "message" => "Data Berhasil Diupdate! "
                ]);
            }
        } else {
//            if ($updRontgen == 0) {
//                $res = $this->ResponseModel->res302(["message" => "Transaksi Sudah Pernah dilakukan pada tanggal "]);
//            } else {
            $this->simrs->trans_start();
            $this->simrs->update('t_rontgen', $sql_i, ['notrans' => $sql_i['notrans']]);
            $this->simrs->trans_complete();

            if ($this->simrs->trans_status() === TRUE) {
                $this->PetugasModel->simpanTransPetugas($sql_p);
                $aa = $this->update_tKunjungan($sql_i);
                $res = $this->ResponseModel->res201([
                    "message" => "Data Berhasil Diupdate! "
                ]);
            }
//            }
        }

        return $res;
    }

    private function update_tKunjungan($sql_i) {
        $res = [];
        $tujuan = json_decode($this->TujuanModel->showDet($sql_i['ktujuan']))->response->data[0]->tujuan;
        $this->simrs->trans_start();
        $this->simrs->update('t_kunjungan', ['ktujuan' => $sql_i['ktujuan']], ['notrans' => $sql_i['notrans']]);
        $this->simrs->trans_complete();

        if ($this->simrs->trans_status() === TRUE) {
            $res = $this->AntrianModel->simpan_antrianpoli($sql_i["norm"], date("Y-m-d"), $tujuan);
        }

        return $res;
    }

    public function Hapus() {
        $res = [];
        $notrans = $this->input->post('notrans');
        
        if ($notrans != "") {
            $this->simrs->trans_start();
            $this->simrs->delete("t_rontgen", ["notrans" => $notrans]);
            $this->simrs->trans_complete();

            if ($this->simrs->trans_status() === TRUE) {
                $res = $this->ResponseModel->res200(["message" => "Data Berhasil dihapus!"]);
            }
        } else {
            $res = $this->ResponseModel->res304(["message" => "Gagal menghapus DATA!"]);
        }

        return json_encode($res);
    }

}
