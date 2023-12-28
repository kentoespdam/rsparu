<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Riwayat_M
 *
 * @author Tata Usaha
 */
class Riwayat_M extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->simrs = $this->load->database('simrs', TRUE);
    }

    public function showData($norm) {
        $response = [];
        $arrData = [];

        $q = $this->simrs->get_where('t_riwayat', ['norm' => $norm]);
       
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

    public function Simpan() {
        $res = [];

        $this->form_validation->set_rules("rw_norm", "No RM", "trim|required");
        $this->form_validation->set_rules("cacatFisik", "Cacat Fisik", "trim|required");
        $this->form_validation->set_rules("alatBantu", "Alat Bantu", "trim|required");
//        $this->form_validation->set_rules("penyDahulu[]", "Penyakit Terdahulu", "trim|required");
        $this->form_validation->set_rules("penyLain", "Penyakit Lain", "trim|required");
        $this->form_validation->set_rules("pengoTB", "Pengobatan TB", "trim|required");
        $this->form_validation->set_rules("pengoLain", "Pengobatan Lain", "trim|required");
        $this->form_validation->set_rules("penyKeluarga", "Penyakit Keluarga", "trim|required");
        $this->form_validation->set_rules("alergi", "Alergi", "trim|required");
        $this->form_validation->set_rules("operasi", "Operasi", "trim|required");

        $this->form_validation->set_error_delimiters('', '');

        $norm = $this->input->post("rw_norm");
        $cacatFisik = $this->input->post("cacatFisik");
        $cacatFisikKet = $this->input->post("cacatFisikKet");
        $alatBantu = $this->input->post("alatBantu");
        $alatBantuKet = $this->input->post("alatBantuKet");
        $arrPenyDahulu = $this->input->post("penyDahulu");
        $penyDahulu = json_encode($arrPenyDahulu);
        $penyDahulu = str_replace("\"", "", $penyDahulu);
        $penyDahulu = str_replace("[", "", $penyDahulu);
        $penyDahulu = str_replace("]", "", $penyDahulu);
        $penyLain = $this->input->post("penyLain");
        $pengoTB = $this->input->post("pengoTB");
        $pengoTBtahun = $this->input->post("pengoTBtahun");
        $pengoTBlama = $this->input->post("pengoTBlama");
        $pengoTBtempat = $this->input->post("pengoTBtempat");
        $pengoLain = $this->input->post("pengoLain");
        $penyKeluarga = $this->input->post("penyKeluarga");
        $penyKeluargaKet = $this->input->post("penyKeluargaKet");
        $alergi = $this->input->post("alergi");
        $alergiKet = $this->input->post("alergiKet");
        $alergiReaksi = $this->input->post("alergiReaksi");
        $operasi = $this->input->post("operasi");
        $operasiJenis = $this->input->post("operasiJenis");
        $operasiTahun = $this->input->post("operasiTahun");
        $operasiTempat = $this->input->post("operasiTempat");
        $rokok = $this->input->post("rokok");
        $rokokKet = $this->input->post("rokokKet");
        $alkohol = $this->input->post("alkohol");
        $alkoholKet = $this->input->post("alkoholKet");
        $obat = $this->input->post("obat");
        $obatKet = $this->input->post("obatKet");
        $kerja = $this->input->post("kerja");

        if ($this->form_validation->run() === false) {
            $res = $this->ResponseModel->res400(["message" => validation_errors()]);
        } else {
            $where = ['norm' => $norm];
            $sql_i = [
                "norm" => $norm,
                "cacatFisik" => $cacatFisik,
                "cacatFisikKet" => $cacatFisikKet,
                "alatBantu" => $alatBantu,
                "alatBantuKet" => $alatBantuKet,
                "penyDahulu" => $penyDahulu,
                "penyLain" => $penyLain,
                "pengoTB" => $pengoTB,
                "pengoTBtahun" => $pengoTBtahun,
                "pengoTBlama" => $pengoTBlama,
                "pengoTBtempat" => $pengoTBtempat,
                "pengoLain" => $pengoLain,
                "penyKeluarga" => $penyKeluarga,
                "penyKeluargaKet" => $penyKeluargaKet,
                "alergi" => $alergi,
                "alergiKet" => $alergiKet,
                "alergiReaksi" => $alergiReaksi,
                "operasi" => $operasi,
                "operasiJenis" => $operasiJenis,
                "operasiTahun" => $operasiTahun,
                "operasiTempat" => $operasiTempat,
                "rokok" => $rokok,
                "rokokKet" => $rokokKet,
                "alkohol" => $alkohol,
                "alkoholKet" => $alkoholKet,
                "obat" => $obat,
                "obatKet" => $obatKet,
                "kerja" => $kerja
            ];

            if ($this->cek_riwayat($norm) == 0) {
                $res = $this->doSimpan($sql_i);
            } else {
                $res = $this->doUpdate($sql_i, $where);
            }
        }
        return json_encode($res);
    }

    private function cek_riwayat($norm) {
        $this->simrs->select('norm');
        $q = $this->simrs->get_where('t_riwayat', ['norm' => $norm]);
        return $q->num_rows();
    }

    public function doSimpan($sql_i) {
        $this->simrs->trans_start();
        $this->simrs->insert('t_riwayat', $sql_i);
        $this->simrs->trans_complete();

        if ($this->simrs->trans_status() === true) {
            $res = $this->ResponseModel->res201([
                "message" => "Data Berhasil Disimpan! "
            ]);
        }

        return $res;
    }

    public function doUpdate($sql_i, $where) {
        $this->simrs->trans_start();
        $this->simrs->update('t_riwayat', $sql_i, $where);
//        echo $this->simrs->last_query();
        $this->simrs->trans_complete();

        if ($this->simrs->trans_status() === true) {
            $res = $this->ResponseModel->res201([
                "message" => "Data Berhasil Diupdate! "
            ]);
        }

        return $res;
    }

}
