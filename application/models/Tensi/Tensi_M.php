<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tensi_M
 *
 * @author Kent-os
 */
class Tensi_M extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->Model('API/PetugasModel');
        $this->load->Model('API/TujuanModel');
        $this->load->model("Bridging/AntrianModel");
        $this->simrs = $this->load->database('simrs', TRUE);
    }

    public function Simpan() {
        $res = [];

        $this->form_validation->set_rules("notrans", "Nomor Transaksi", "trim|required");
        $this->form_validation->set_rules("norm", "Nomor RM", "trim|required");
        $this->form_validation->set_rules("tgltrans", "Tanggal Transaksi", "trim|required");
        $this->form_validation->set_rules("ktujuan", "Poli", "trim|required");
        $this->form_validation->set_rules("smbrData", "Sumber Data", "trim|required");
        $this->form_validation->set_rules("statRujuk", "Status Rujuk", "trim|required");
        $this->form_validation->set_rules("td", "Tekanan Data", "trim|required");
        $this->form_validation->set_rules("fnadi", "Frekuensi Nadi", "trim|required");
        $this->form_validation->set_rules("suhu", "Suhu", "trim|required");
        $this->form_validation->set_rules("fnafas", "Frekuensi Nafas", "trim|required");
        $this->form_validation->set_rules("bb", "Berat Badan", "trim|required");
        $this->form_validation->set_rules("tb", "Tinggi Badan", "trim|required");
        $this->form_validation->set_rules("hilangBB3Bln", "Hilang Berat Badan Dalam 3 Bulan", "trim|required");
        $this->form_validation->set_rules("turunAsupMkn", "Turun Asupan Makan", "trim|required");

        $this->form_validation->set_error_delimiters('', '');

        $notrans = $this->input->post('notrans');
        $norm = $this->input->post('norm');
        $tgltrans = $this->input->post('tgltrans');
        $jamdaftar = $this->input->post('jamdaftar');
        $ktujuan = $this->input->post('ktujuan');
        $smbrData = $this->input->post('smbrData');
        $ketSmbrData = $this->input->post('ketSmbrData');
        $hubSmbrData = $this->input->post('hubSmbrData');
        $statRujuk = $this->input->post('statRujuk');
        $ketStatRujuk = $this->input->post('ketStatRujuk');
        $td = $this->input->post('td');
        $fnadi = $this->input->post('fnadi');
        $suhu = $this->input->post('suhu');
        $fnafas = $this->input->post('fnafas');
        $bb = $this->input->post('bb');
        $tb = $this->input->post('tb');
        $hilangBB3Bln = $this->input->post('hilangBB3Bln');
        $turunAsupMkn = $this->input->post('turunAsupMkn');
        $psiko = $this->input->post('psiko');
        $otherPsiko = $this->input->post('otherPsiko');
        $hasilPeriksaSebelumnya = $this->input->post('hasilPeriksaSebelumnya');
        $batuk = $this->input->post('batuk');
        $batukDahak = $this->input->post('batukDahak');
        $batukDarah = $this->input->post('batukDarah');
        $batukDarahKualitas = $this->input->post('batukDarahKualitas');
        $sesak = $this->input->post('sesak');
        $sesakSuara = $this->input->post('sesakSuara');
        $nyeriDada = $this->input->post('nyeriDada');
        $nyeriDadaLok = $this->input->post('nyeriDadaLok');
        $demam = $this->input->post('demam');
        $arrDemamWaktuPagi = $this->input->post('demamWaktuPagi');
        $demamWaktuPagi = json_encode($arrDemamWaktuPagi);
        $demamWaktuPagi = str_replace("\"", "", $demamWaktuPagi);
        $demamWaktuPagi = str_replace("[", "", $demamWaktuPagi);
        $demamWaktuPagi = str_replace("]", "", $demamWaktuPagi);
        $keluhanLain = $this->input->post('keluhanLain');
        $p_admin_tensi = $this->input->post('p_admin_tensi');
        $p_perawat_tensi = $this->input->post('p_perawat_tensi');
        $updTensi = $this->input->post('updTensi');

        if ($this->form_validation->run() === false) {
            $res = $this->ResponseModel->res400(["message" => validation_errors()]);
        } else {
            $sql_i = [
                'notrans' => $notrans,
                'norm' => $norm,
                'tgltrans' => $tgltrans . " " . $jamdaftar,
                'ktujuan' => $ktujuan,
                'smbrData' => $smbrData,
                'ketSmbrData' => $ketSmbrData,
                'hubSmbrData' => $hubSmbrData,
                'statRujuk' => $statRujuk,
                'ketStatRujuk' => $ketStatRujuk,
                'td' => $td,
                'fnadi' => $fnadi,
                'suhu' => $suhu,
                'fnafas' => $fnafas,
                'bb' => $bb,
                'tb' => $tb,
                'hilangBB3Bln' => $hilangBB3Bln,
                'turunAsupMkn' => $turunAsupMkn,
                'psiko' => $psiko,
                'otherPsiko' => $otherPsiko,
                'hasilPeriksaSebelumnya' => $hasilPeriksaSebelumnya,
                'batuk' => $batuk,
                'batukDahak' => $batukDahak,
                'batukDarah' => $batukDarah,
                'batukDarahKualitas' => $batukDarahKualitas,
                'sesak' => $sesak,
                'sesakSuara' => $sesakSuara,
                'nyeriDada' => $nyeriDada,
                'nyeriDadaLok' => $nyeriDadaLok,
                'demam' => $demam,
                'demamWaktuPagi' => $demamWaktuPagi,
                'keluhanLain' => $keluhanLain
            ];

            $res = $this->save_simrs($sql_i, $updTensi, $p_admin_tensi, $p_perawat_tensi);
        }

        return json_encode($res);
    }

    private function save_simrs($sql_i, $updTensi, $p_admin_tensi, $p_perawat_tensi) {
        $res = [];
        $q = $this->simrs->get_where('t_tensi', ['notrans' => $sql_i['notrans']]);
        if ($q->num_rows() == 0) {
            $this->simrs->trans_start();
            $this->simrs->insert('t_tensi', $sql_i);
            $this->simrs->trans_complete();

            if ($this->simrs->trans_status() === TRUE) {
                $this->PetugasModel->simpanTransPetugas(['notrans' => $sql_i['notrans'], 'p_admin_tensi' => $p_admin_tensi, 'p_perawat_tensi' => $p_perawat_tensi]);
                $aa = $this->update_tKunjungan($sql_i);
                $res = $this->ResponseModel->res201([
                    "message" => "Data Berhasil Disimpan! "
                ]);
            }
        } else {
            if ($updTensi == 0) {
                $res = $this->ResponseModel->res302(["message" => "Transaksi Sudah Pernah dilakukan pada tanggal "]);
            } else {
                $this->simrs->trans_start();
                $this->simrs->update('t_tensi', $sql_i, ['notrans' => $sql_i['notrans']]);
                $this->simrs->trans_complete();

                if ($this->simrs->trans_status() === TRUE) {
                    $this->PetugasModel->simpanTransPetugas(['notrans' => $sql_i['notrans'], 'p_admin_tensi' => $p_admin_tensi, 'p_perawat_tensi' => $p_perawat_tensi]);
                    $aa = $this->update_tKunjungan($sql_i);
                    $res = $this->ResponseModel->res201([
                        "message" => "Data Berhasil Diupdate! "
                    ]);
                }
            }
        }

//        echo $this->update_tKunjungan($sql_i);

        return $res;
    }

    private function update_tKunjungan($sql_i) {
        $res;
        $tujuan = json_decode($this->TujuanModel->showDet($sql_i['ktujuan']))->response->data[0]->tujuan;
        $this->simrs->trans_start();
        $q = $this->simrs->update('t_kunjungan', ['ktujuan' => $sql_i['ktujuan']], ['notrans' => $sql_i['notrans']]);
        $this->simrs->trans_complete();

        if ($this->simrs->trans_status() === TRUE) {
//            $this->simrs->last_query();
            $res = $this->AntrianModel->simpan_antrianpoli($sql_i["norm"], date("Y-m-d"), $tujuan);
        }
        return $res;
    }

    public function show_data($norm) {
        $res = [];
        $arrData = [];
        $skrng = date('Y-m-d');

        $this->simrs->select(
                't_tensi.notrans, '
                . 't_tensi.norm, '
                . 'DATE(t_tensi.tgltrans) as tgltrans, '
                . 't_tensi.ktujuan, '
                . 't_tensi.smbrData, '
                . 't_tensi.ketSmbrData, '
                . 't_tensi.hubSmbrData, '
                . 't_tensi.statRujuk, '
                . 't_tensi.ketStatRujuk, '
                . 't_tensi.td, '
                . 't_tensi.fnadi, '
                . 't_tensi.suhu, '
                . 't_tensi.fnafas, '
                . 't_tensi.bb, '
                . 't_tensi.tb, '
                . 't_tensi.hilangBB3Bln, '
                . 't_tensi.turunAsupMkn, '
                . 't_tensi.psiko, '
                . 't_tensi.otherPsiko, '
                . 't_tensi.hasilPeriksaSebelumnya, '
                . 't_tensi.batuk, '
                . 't_tensi.batukDahak, '
                . 't_tensi.batukDarah, '
                . 't_tensi.batukDarahKualitas, '
                . 't_tensi.sesak, '
                . 't_tensi.sesakSuara, '
                . 't_tensi.nyeriDada, '
                . 't_tensi.nyeriDadaLok, '
                . 't_tensi.demam, '
                . 't_tensi.demamWaktuPagi, '
                . 't_tensi.keluhanLain, '
                . 'v_daftar_tunggu.nama, '
                . 'v_daftar_tunggu.jeniskel, '
                . 'v_daftar_tunggu.tmptlahir, '
                . 'v_daftar_tunggu.tgllahir, '
                . 'v_daftar_tunggu.umurthn, '
                . 'v_daftar_tunggu.umurbln, '
                . 'v_daftar_tunggu.umurhr, '
                . 'v_daftar_tunggu.kabupaten, '
                . 'v_daftar_tunggu.kecamatan, '
                . 'v_daftar_tunggu.kelurahan, '
                . 'v_daftar_tunggu.rtrw, '
                . 't_petugas.p_admin_tensi, '
                . 't_petugas.p_perawat_tensi '
        );
        $this->simrs->join('v_daftar_tunggu', 'ON t_tensi.notrans = v_daftar_tunggu.notrans', 'INNER');
        $this->simrs->join('t_petugas', 'ON t_tensi.notrans = t_petugas.notrans', 'LEFT');        
        $this->simrs->where(['t_tensi.norm' => intval($norm), 'DATE(t_tensi.tgltrans)' => $skrng]);
        $q = $this->simrs->get('t_tensi');

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($arrData, $d);
            }

            $response = $this->ResponseModel->res200(["data" => $arrData, "count" => $q->num_rows()]);
        } else {
            $response = $this->ResponseModel->res204(["data" => $arrData, "count" => $q->num_rows()]);
        }

        return json_encode($response);
    }

    public function Pindah() {
        $this->form_validation->set_rules('notrans', 'No Transaksi', 'trim|required');
        $this->form_validation->set_rules('norm', 'No RM', 'trim|required');
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'trim|required');

        $this->form_validation->set_error_delimiters('', '');

        $notrans = $this->input->post('notrans');
        $norm = $this->input->post('norm');
        $ktujuan = $this->input->post('ktujuan');

        $sql_i = [
            'notrans' => $notrans,
            'norm' => $norm,
            'ktujuan' => $ktujuan
        ];

        $res = $this->update_tKunjungan($sql_i);
        return json_encode($res);
    }

}
