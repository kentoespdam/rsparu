<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Poli_M
 *
 * @author Keuangan
 */
class Poli_M extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->Model('API/PetugasModel');
        $this->load->Model('API/TujuanModel');
        $this->load->model("Bridging/AntrianModel");
        $this->load->model("Rontgen/DaftarTungguRontgen_M");
        $this->simrs = $this->load->database('simrs', TRUE);
        $this->skrng = date('Y-m-d');
    }

    public function Simpan() {
        $res = [];

        $notrans = $this->input->post("notrans");
        $norm = $this->input->post("norm");
        $tgltrans = $this->input->post('tgltrans');
        $jamdaftar = $this->input->post('jamdaftar');
        $inspeksi = $this->input->post("inspeksi");
        $perkusi = $this->input->post("perkusi");
        $palpasi = $this->input->post("palpasi");
        $auskultasi = $this->input->post("auskultasi");
        $anemis = $this->input->post("anemis");
        $cyanosis = $this->input->post("cyanosis");
        $dyspneu = $this->input->post("dyspneu");
        $stomatitis = $this->input->post("stomatitis");
        $rontgen = $this->input->post("rontgen");
        $konsul = $this->input->post("konsul");
        $tcm = $this->input->post("tcm");
        $bta = $this->input->post("bta");
        $hematologi = $this->input->post("hematologi");
        $kimiaDarah = $this->input->post("kimiaDarah");
        $imunoSerologi = $this->input->post("imunoSerologi");
        $mantoux = $this->input->post("mantoux");
        $ekg = $this->input->post("ekg");
        $mikroCo = $this->input->post("mikroCo");
        $spirometri = $this->input->post("spirometri");
        $spo2 = $this->input->post("spo2");
        $diagnosa1 = $this->input->post("diagnosa1");
        $diagnosa2 = $this->input->post("diagnosa2");
        $diagnosa3 = $this->input->post("diagnosa3");
        $nebulizer = $this->input->post("nebulizer");
        $infus = $this->input->post("infus");
        $oksigenasi = $this->input->post("oksigenasi");
        $injeksi = $this->input->post("injeksi");
        $terapi = $this->input->post("terapi");
        $p_admin_poli = $this->input->post("p_admin_poli");
        $p_dokter_poli = $this->input->post("p_dokter_poli");
        $p_admin_poli_konsul = $this->input->post("p_admin_poli_konsul");
        $p_dokter_poli_konsul = $this->input->post("p_dokter_poli_konsul");
        $ktujuan = $this->input->post("ktujuan");
        $updPoli = $this->input->post("updPoli");

        $this->form_validation->set_rules("notrans", "No. Transaksi", "trim|required");
        $this->form_validation->set_rules("norm", "No. RM", "trim|required");
//        $this->form_validation->set_rules("inspeksi", "Inspeksi", "trim|required");
//        $this->form_validation->set_rules("perkusi", "Perkusi", "trim|required");
//        $this->form_validation->set_rules("palpasi", "Palpasi", "trim|required");
//        $this->form_validation->set_rules("auskultasi", "Auskultasi", "trim|required");
//        $this->form_validation->set_rules("anemis", "Anemis", "trim|required");
//        $this->form_validation->set_rules("cyanosis", "Cyanosis", "trim|required");
//        $this->form_validation->set_rules("dyspneu", "Dyspneu", "trim|required");
//        $this->form_validation->set_rules("stomatitis", "Stomatitis", "trim|required");
        /* Rule Rontgen */
        if ($ktujuan == 6) {
            $this->form_validation->set_rules("rontgen", "Rontgen", "trim|required");
        }
        /* Rule Laborat */
        if ($ktujuan == 5) {
            if (($tcm + $bta + $hematologi + $kimiaDarah + $imunoSerologi) == 0) {
                $this->form_validation->set_rules("tcm", "TCM", "trim|required");
                $this->form_validation->set_rules("bta", "BTA", "trim|required");
                $this->form_validation->set_rules("hematologi", "Hematologi", "trim|required");
                $this->form_validation->set_rules("kimiaDarah", "Kimia Darah", "trim|required");
                $this->form_validation->set_rules("imunoSerologi", "Imuno Serologi", "trim|required");
            }
        }
        /* Rule Tindakan */
        if ($ktujuan == 4) {
            if (($mantoux + $ekg + $mikroCo + $spirometri) == 0) {
                $this->form_validation->set_rules("mantoux", "Mantoux", "trim|required");
                $this->form_validation->set_rules("ekg", "EKG", "trim|required");
                $this->form_validation->set_rules("mikroCo", "Mikro Co", "trim|required");
                $this->form_validation->set_rules("spirometri", "Spirometri", "trim|required");
                $this->form_validation->set_rules("spo2", "SPO2", "trim|required");
                $this->form_validation->set_rules("terapi", "Terapi", "trim|required");
                $this->form_validation->set_rules("nebulizer", "Nebulizer", "trim|required");
                $this->form_validation->set_rules("infus", "Infus", "trim|required");
                $this->form_validation->set_rules("oksigenasi", "Oksigenasi", "trim|required");
                $this->form_validation->set_rules("injeksi", "Injeksi", "trim|required");
            }
        }
        /* Rule Apotek */
        if ($ktujuan == 8) {
            $this->form_validation->set_rules("diagnosa1", "Diagnosa 1", "trim|required");
        }
//        $this->form_validation->set_rules("diagnosa2", "Diagnosa 2", "trim|required");
//        $this->form_validation->set_rules("diagnosa3", "Diagnosa 3", "trim|required");

        $this->form_validation->set_rules("p_admin_poli", "Admin", "trim|required");
        $this->form_validation->set_rules("p_dokter_poli", "Dokter", "trim|required");
        $this->form_validation->set_rules("ktujuan", "Tujuan", "trim|required");

        $this->form_validation->set_error_delimiters('<p>', '</p>');



        if ($this->form_validation->run() === false) {
            $res = $this->ResponseModel->res400(["message" => validation_errors()]);
        } else {
            $sql_i = [
                "notrans" => $notrans,
                "norm" => $norm,
                "tgltrans" => $tgltrans . " " . $jamdaftar,
                "ktujuan" => $ktujuan,
                "inspeksi" => $inspeksi,
                "perkusi" => $perkusi,
                "palpasi" => $palpasi,
                "auskultasi" => $auskultasi,
                "anemis" => $anemis,
                "cyanosis" => $cyanosis,
                "dyspneu" => $dyspneu,
                "stomatitis" => $stomatitis,
                "rontgen" => $rontgen,
                "konsul" => $konsul,
                "tcm" => $tcm,
                "bta" => $bta,
                "hematologi" => $hematologi,
                "kimiaDarah" => $kimiaDarah,
                "imunoSerologi" => $imunoSerologi,
                "mantoux" => $mantoux,
                "ekg" => $ekg,
                "mikroCo" => $mikroCo,
                "spirometri" => $spirometri,
                "spo2" => $spo2,
                "diagnosa1" => $diagnosa1,
                "diagnosa2" => $diagnosa2,
                "diagnosa3" => $diagnosa3,
                "nebulizer" => $nebulizer,
                "infus" => $infus,
                "oksigenasi" => $oksigenasi,
                "injeksi" => $injeksi,
                "terapi" => $terapi,
            ];
            $sql_p = [
                "notrans" => $notrans,
                "p_admin_poli" => $p_admin_poli,
                "p_dokter_poli" => $p_dokter_poli,
                "p_admin_poli_konsul" => $p_admin_poli_konsul,
                "p_dokter_poli_konsul" => $p_dokter_poli_konsul
            ];

            //i as input t_poli
            //p as input petugas
            $res = $this->do_simpan($sql_i, $sql_p, $updPoli);
        }

        return json_encode($res);
    }

    private function cek_exist($notrans) {
        $q = $this->simrs->get_where('t_poli', ['notrans' => $notrans]);

        return $q->num_rows();
    }

    public function do_simpan($sql_i, $sql_p, $updPoli) {
        $res = [];
//        $q = $this->simrs->get_where('t_poli', ['notrans' => $sql_i['notrans']]);

        if ($this->cek_exist($sql_i['notrans']) == 0) {
            $this->simrs->trans_start();
            $this->simrs->insert('t_poli', $sql_i);
            $this->simrs->trans_complete();

            if ($this->simrs->trans_status() === TRUE) {
                $this->PetugasModel->simpanTransPetugas($sql_p);
                $aa = $this->update_tKunjungan($sql_i);
                $res = $this->ResponseModel->res201([
                    "message" => "Data Berhasil Diupdate! "
                ]);
            }
        } else {
            if ($updPoli == 0) {
                $res = $this->ResponseModel->res302(["message" => "Transaksi Sudah Pernah dilakukan pada tanggal "]);
            } else {
                $this->simrs->trans_start();
                $this->simrs->update('t_poli', $sql_i, ['notrans' => $sql_i['notrans']]);
                $this->simrs->trans_complete();

                if ($this->simrs->trans_status() === TRUE) {
                    $this->PetugasModel->simpanTransPetugas($sql_p);
                    $aa = $this->update_tKunjungan($sql_i);
                    $res = $this->ResponseModel->res201([
                        "message" => "Data Berhasil Diupdate! "
                    ]);
                }
            }
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
//            $this->simrs->last_query();
            if ($sql_i['rontgen'] == 1) {
                $r1 = $this->AntrianModel->simpan_antrianpoli($sql_i["norm"], date("Y-m-d"), "RONTGEN");
                $this->DaftarTungguRontgen_M->addRontgen($sql_i['notrans'], $sql_i['ktujuan']);
                if ($r1["metaData"]["code"] == 201) {
                    if ($sql_i['tcm'] == 1 || $sql_i['bta'] == 1 || $sql_i['hematologi'] == 1 || $sql_i['kimiaDarah'] == 1 || $sql_i['imunoSerologi'] == 1) {
                        $r2 = $this->AntrianModel->simpan_antrianpoli($sql_i["norm"], date("Y-m-d"), "LABORAT");
                        if ($r2["metaData"]["code"] == 201) {
                            $res = $this->AntrianModel->simpan_antrianpoli($sql_i["norm"], date("Y-m-d"), $tujuan);
                        }
                    } else {
                        $res = $this->AntrianModel->simpan_antrianpoli($sql_i["norm"], date("Y-m-d"), $tujuan);
//                        if ($sql_i['rontgen'] != 1 || $sql_i['tcm'] == 1 || $sql_i['bta'] == 1 || $sql_i['hematologi'] == 1 || $sql_i['kimiaDarah'] == 1 || $sql_i['imunoSerologi'] == 1) {                         
//                        }
                    }
                }
            } else {
                if ($sql_i['tcm'] == 1 || $sql_i['bta'] == 1 || $sql_i['hematologi'] == 1 || $sql_i['kimiaDarah'] == 1 || $sql_i['imunoSerologi'] == 1) {
                    $r1 = $this->AntrianModel->simpan_antrianpoli($sql_i["norm"], date("Y-m-d"), "LABORAT");
                    if ($r1["metaData"]["code"] == 201) {
                        $res = $this->AntrianModel->simpan_antrianpoli($sql_i["norm"], date("Y-m-d"), $tujuan);
                    }
                } else {
                    $res = $this->AntrianModel->simpan_antrianpoli($sql_i["norm"], date("Y-m-d"), $tujuan);
                }
            }
        }
        return $res;
    }

    public function showData($norm) {
        $res = [];
        $data = [];
        $q = $this->simrs->get_where('v_det_poli', ['norm' => intval($norm), 'tgltrans' => $this->skrng]);
//        echo $this->simrs->last_query();
        if ($q->num_rows() == 1) {
            foreach ($q->result() as $d) {
                array_push($data, $d);
            }
            $res = $this->ResponseModel->res200(['data' => $data]);
        } else {
            $res = $this->ResponseModel->res204(['data' => $data]);
        }

        return json_encode($res);
    }

}
