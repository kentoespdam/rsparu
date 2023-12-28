<?php

date_default_timezone_set("Asia/Jakarta");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AntrianModel
 *
 * @author user
 */
class AntrianModel extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->simrs = $this->load->database('simrs', true);
        $this->ano = $this->load->database('ano', true);
    }

    public function simpan_antrianpoli($norm, $tgl, $Klinik) {
//        $Klinik = "";
        $No_Pasien = "";
        $Nama = "";
        $kelurahan = "";
        $kecamatan = "";
        $kabupaten = "";
        $NOANTRI = "";
        $umur = "";
        $jkel = "";
        $status = "";
        $sql = "SELECT "
                . "m_pasien.norm AS No_Pasien, "
                . "m_pasien.nama AS Nama, "
                . "m_kelurahan.kelurahan, "
                . "m_kecamatan.kecamatan, "
                . "m_kabupaten.kabupaten, "
                . "t_kunjungan.nourut AS NOANTRI "
                . ",t_kunjungan.umurthn, "
                . "t_kunjungan.jeniskel, "
                . "m_pasien.statKawin "
                . "FROM m_pasien "
                . "INNER JOIN t_kunjungan ON m_pasien.norm=t_kunjungan.norm "
                . "INNER JOIN m_kelurahan ON m_pasien.kkelurahan=m_kelurahan.kdKel "
                . "INNER JOIN m_kecamatan ON m_pasien.kkecamatan=m_kecamatan.kdKec "
                . "INNER JOIN m_kabupaten ON m_pasien.kkabupaten=m_kabupaten.kdKab "
                . "WHERE m_pasien.norm='$norm' "
                . "AND DATE(t_kunjungan.tgltrans)='$tgl'";

        $q = $this->simrs->query($sql);
//        echo $this->simrs->last_query();

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
//                $Klinik = $Klinik;
                $No_Pasien = $d->No_Pasien;
                $Nama = $d->Nama;
                $kelurahan = $d->kelurahan;
                $kecamatan = $d->kecamatan;
                $kabupaten = str_replace("KABUPATEN", "", $d->kabupaten);
                $NOANTRI = $d->NOANTRI;
                $umur = $d->umurthn;
                $jkel = $d->jeniskel;
                $status = $d->statKawin;
            }

            $NOANTRI = $this->format_noantri($NOANTRI);
        }

        return $this->do_simpan_antrianpoli($Klinik, $No_Pasien, $Nama, $kelurahan, $kecamatan, $kabupaten, $NOANTRI, $umur, $jkel, $status);
    }

    public function do_simpan_antrianpoli($Klinik, $No_Pasien, $Nama, $kelurahan, $kecamatan, $kabupaten, $NOANTRI, $umur, $jkel, $status) {
        $res = [];
        $title = $this->gen_title($umur, $jkel, $status);
        $Alamat = $kelurahan . ", " . $kabupaten;
        $Tanggal = date('Y-m-d h:i:s');
        $NO = $this->gen_no($No_Pasien, $Tanggal);
        $sql_i = [
            "NO" => $NO,
            "Klinik" => $Klinik,
            "DOKTER" => "",
            "No_Pasien" => $No_Pasien,
            "Nama" => $title . $Nama,
            "Alamat" => $Alamat,
            "Tanggal" => $Tanggal,
            "Masuk" => 0,
            "Lewati" => 0,
            "RMOK" => 0,
            "CETAK" => 0,
            "NOANTRI" => $NOANTRI,
        ];

        $cek_exist = $this->cek_exist($No_Pasien, $Tanggal, $Klinik);
//        echo $this->ano->last_query();
//        print_r($cek_exist->num_rows());
        if ($cek_exist->num_rows() == 0) {
            $this->ano->trans_start();
            $this->ano->insert("tbantrianpoli", $sql_i);
            $this->ano->trans_complete();
            $lq = $this->ano->last_query();

            if ($this->ano->trans_status() === true) {
                $this->ano->update('tbnoantri', ['Selesai' => 1, 'Panggil' => 2], ['NoAntri' => $NOANTRI]);
                $res = $this->ResponseModel->res201(['message' => 'Antrian Berhasil disimpan! ' . $Tanggal, 'lq' => $lq]);
            }
        } else {
            $sql_u = [
                "NO" => $cek_exist->result()[0]->NO,
                "Klinik" => $cek_exist->result()[0]->Klinik,
                "DOKTER" => $cek_exist->result()[0]->DOKTER,
                "No_Pasien" => $cek_exist->result()[0]->No_Pasien,
                "Nama" => $title . $Nama,
                "Alamat" => $cek_exist->result()[0]->Alamat,
                "Tanggal" => $cek_exist->result()[0]->Tanggal,
                "Masuk" => $cek_exist->result()[0]->Masuk,
                "Lewati" => $cek_exist->result()[0]->Lewati,
                "RMOK" => $cek_exist->result()[0]->RMOK,
                "CETAK" => $cek_exist->result()[0]->CETAK,
                "NOANTRI" => $NOANTRI,
            ];

//            print_r($sql_u);
            $this->ano->trans_start();
            $this->ano->update("tbantrianpoli", $sql_u, ["No_Pasien" => $No_Pasien, "tbantrianpoli.Tanggal" => $cek_exist->result()[0]->Tanggal, "Klinik" => $cek_exist->result()[0]->Klinik]);
            $this->ano->trans_complete();
//            echo $this->ano->last_query();
            //
            if ($this->ano->trans_status() === true) {
                $this->ano->update('tbnoantri', ['Selesai' => 1, 'Panggil' => 2], ['NoAntri' => $NOANTRI]);
                $res = $this->ResponseModel->res201(['message' => 'Antrian Berhasil disimpan! ' . $Tanggal]);
            }
        }

        return $res;
    }

    private function cek_exist($No_Pasien, $Tanggal, $Klinik) {
        $Tanggal = date('Y-m-d', strtotime($Tanggal));

        $sql = "SELECT * FROM `tbantrianpoli` "
                . "WHERE tbantrianpoli.No_Pasien = '$No_Pasien' "
                . "AND DATE_FORMAT( tbantrianpoli.Tanggal, '%Y-%m-%d' ) = '$Tanggal' "
                . "AND Klinik='$Klinik'";

        $q = $this->ano->query($sql);
//        echo $this->ano->last_query();
//        print_r($q->result_array());

        return $q;
    }

    public function format_noantri($NOANTRI) {
        if ($NOANTRI < 10) {
            $NOANTRI = " 00" . $NOANTRI;
        } elseif ($NOANTRI < 100) {
            $NOANTRI = " 0" . $NOANTRI;
        } else {
            $NOANTRI = " " . $NOANTRI;
        }

        return $NOANTRI;
    }

    public function gen_no($No_Pasien, $Tanggal) {
        $tgl = date('Y-m-d');
        $no = "001";

        $this->ano->select('NO + 1 AS NO', false);
        $this->ano->where('DATE(Tanggal)', $tgl);
        $this->ano->where('No_Pasien', $No_Pasien);
        $this->ano->order_by('NO', 'DESC');
        $this->ano->limit(1);
        $q = $this->ano->get("tbantrianpoli");
//        echo $this->ano->last_query();

        if ($q->num_rows() > 0) {
            $no = $q->result()[0]->NO;

            if ($no < 10) {
                $no = "00" . $no;
            } elseif ($no < 100) {
                $no = "0" . $no;
            }
        } else {
            $no = "001";
        }

        return $no;
    }

    private function gen_title($umur, $jkel, $status) {
        $title = "";
        if ($umur < 10) {
            $title = "ANAK ";
        } else if ($umur > 10) {
            if ($jkel == "L") {
                if ($status == "BK" && $umur < 30) {
                    $title = "SAUDARA ";
                } else {
                    $title = "BAPAK ";
                }
            } else {
                if ($status == "BK" && $umur < 30) {
                    $title = "NONA ";
                } else {
                    $title = "IBU ";
                }
            }
        }

        return $title;
    }

    public function hapus_antrianpoli($No_Pasien, $NOANTRI, $Tanggal) {
        $res = [];
        $NOANTRI = $this->format_noantri($NOANTRI);
        $Tanggal = date("Y-m-d", strtotime($Tanggal));

        $this->ano->trans_start();
        $this->ano->delete("tbantrianpoli", ["No_Pasien" => $No_Pasien, "NOANTRI" => $NOANTRI, "date_format(Tanggal,'%Y-%m-%d') =" => $Tanggal]);
        $this->ano->trans_complete();

        if ($this->ano->trans_status() === TRUE) {
            $this->ano->update('tbnoantri', ['Selesai' => 0, 'Panggil' => 0], ['NoAntri' => $NOANTRI]);
            $res = $this->ResponseModel->res200(["message" => "Data Antrian Berhasil dihapus!"]);
        } else {
            $res = $this->ResponseModel->res304(["message" => "Gagal Menghapus Data Antrian"]);
        }

        return json_encode($res);
    }

}
