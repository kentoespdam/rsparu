<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pendaftaran_m
 *
 * @author Kent-os
 */
class Pendaftaran_m extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->tgl = date('Y-m-d');
        $this->load->model('API/NormModel');
        $this->load->model('API/RMModel');
        $this->load->model('API/PetugasModel');
        $this->load->model('API/TujuanModel');
        $this->load->model('Bridging/SimRsOldModel');
        $this->load->model("Bridging/AntrianModel");
        $this->load->model('Curl-kasir/SheetModel');
        $this->simrs = $this->load->database('simrs', TRUE);
    }

    public function simpan()
    {
        $res = [];
        $this->form_validation->set_rules('tgldaftar', 'Tanggal Daftar', 'trim|required');
        $this->form_validation->set_rules('kkelompok', 'Kelompok', 'trim|required');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('kprovinsi', 'Provinsi', 'trim|required');
        $this->form_validation->set_rules('kkabupaten', 'Kabupaten', 'trim|required');
        $this->form_validation->set_rules('kkecamatan', 'Kecamatan', 'trim|required');
        $this->form_validation->set_rules('kkelurahan', 'Kelurahan', 'trim|required');
        $this->form_validation->set_rules('rtrw', 'RT/RW', 'trim|required');
        $this->form_validation->set_rules('tmptlahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tgllahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('kdAgama', 'Agama', 'trim|required');
        $this->form_validation->set_rules('statKawin', 'Status', 'trim|required');
        $this->form_validation->set_error_delimiters('', '');
        $nourut = $this->input->post('nourut');
        $norm = $this->input->post('norm');
        $rmlama = $this->input->post('rmlama');
        $tgldaftar = $this->input->post('tgldaftar');
        $jamdaftar = $this->input->post('jamdaftar');
        $kkelompok = $this->input->post('kkelompok');
        $noasuransi = $this->input->post('noasuransi');
        $noktp = $this->input->post('noktp');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $kprovinsi = $this->input->post('kprovinsi');
        $kkabupaten = $this->input->post('kkabupaten');
        $kkecamatan = $this->input->post('kkecamatan');
        $kkelurahan = $this->input->post('kkelurahan');
        $rtrw = $this->input->post('rtrw');
        $jeniskel = $this->input->post('jeniskel');
        $tmptlahir = $this->input->post('tmptlahir');
        $tgllahir = $this->input->post('tgllahir');
        $umurthn = $this->input->post('umurthn');
        $umurbln = $this->input->post('umurbln');
        $umurhr = $this->input->post('umurhr');
        $kdAgama = $this->input->post('kdAgama');
        $kdPendidikan = $this->input->post('kdPendidikan');
        $nohp = $this->input->post('nohp');
        $statKawin = $this->input->post('statKawin');
        $pekerjaan = $this->input->post('pekerjaan');
        $pjwb = $this->input->post('pjwb');
        $ibuKandung = $this->input->post('ibuKandung');
        $jctkkartu = $this->input->post('jctkkartu');
        $goldarah = $this->input->post('goldarah');
        $kunj = $this->input->post('kunj');
        $biaya = $this->input->post('biaya');
        $ktujuan = $this->input->post('ktujuan');
        $loket = $this->input->post('loket');
        $p_loket = $this->input->post('p_loket');
        $updKunj = $this->input->post('updKunj');
        if ($this->form_validation->run() === false) {
            $res = $this->ResponseModel->res400(["message" => validation_errors()]);
        } else {
            if ($norm == "") {
                $norm = json_decode($this->NormModel->generateNoRm());
                if ($rmlama == "") {
                    //B.08120073
                    $rmlama = substr($nama, 0, 1) . ".000" . $norm->response->norm;
                }
                $sql_i = [
                    'norm' => $norm->response->norm,
                    'rmlama' => $rmlama,
                    'tgldaftar' => $tgldaftar,
                    'jamdaftar' => $jamdaftar,
                    'kkelompok' => $kkelompok,
                    'noasuransi' => $noasuransi,
                    'noktp' => $noktp,
                    'nama' => $nama,
                    'alamat' => $alamat,
                    'kprovinsi' => $kprovinsi,
                    'kkabupaten' => $kkabupaten,
                    'kkecamatan' => $kkecamatan,
                    'kkelurahan' => $kkelurahan,
                    'rtrw' => $rtrw,
                    'jeniskel' => $jeniskel,
                    'tmptlahir' => $tmptlahir,
                    'tgllahir' => $tgllahir,
                    'kdAgama' => $kdAgama,
                    'kdPendidikan' => $kdPendidikan,
                    'nohp' => $nohp,
                    'statKawin' => $statKawin,
                    'pekerjaan' => $pekerjaan,
                    'pjwb' => $pjwb,
                    'ibuKandung' => $ibuKandung,
                    'jctkkartu' => $jctkkartu,
                    'goldarah' => $goldarah,
                    'kunj' => $kunj,
                ];
                if ($noktp != "" || $noasuransi != "") {
                    $dplct = $this->find_duplicate($noktp, $noasuransi);
                    if ($dplct == NULL) {
                        $res = $this->save_simrs($sql_i, $nourut, $kunj, $umurthn, $umurbln, $umurhr, $biaya, $loket, $updKunj, $ktujuan, $p_loket);
                    } else {
                        $res = $dplct;
                    }
                } else {
                    $res = $this->save_simrs($sql_i, $nourut, $kunj, $umurthn, $umurbln, $umurhr, $biaya, $loket, $updKunj, $ktujuan, $p_loket);
                }
            } else {
                $notrans = $this->NormModel->gen_notrans($norm);
                ($kkelompok == 1) ? $noasuransi = "" : $noasuransi = $noasuransi;
                $sql_it = [
                    "notrans" => $notrans,
                    "norm" => $norm,
                    "rmlama" => $rmlama,
                    'tgltrans' => $tgldaftar . " " . $jamdaftar,
                    "nourut" => $nourut,
                    "kunj" => $kunj,
                    "jeniskel" => $jeniskel,
                    "kkelompok" => $kkelompok,
                    "noasuransi" => $noasuransi,
                    "kkabupaten" => $kkabupaten,
                    "umurthn" => $umurthn,
                    "umurbln" => $umurbln,
                    "umurhr" => $umurhr,
                    "biaya" => $biaya,
                    "ktujuan" => $ktujuan,
                    "loket" => $loket
                ];
                $so = $this->SimRsOldModel->saveToBp4($norm);
                $res = $this->save_kunj($sql_it, $updKunj, $p_loket);
            }
        }
        return json_encode($res);
    }

    public function find_duplicate($noktp, $noasuransi)
    {
        $sql = "SELECT "
            . "norm, nama FROM ( "
            . "SELECT A.norm, A.nama FROM m_pasien AS A WHERE A.noasuransi='$noasuransi' && A.noasuransi <>'' "
            . "UNION ALL SELECT B.norm, B.nama FROM m_pasien AS B WHERE B.noktp='$noktp' && B.noktp <>'' ) "
            . "AS res GROUP BY norm";
        $q = $this->simrs->query($sql);
        //        echo $this->simrs->last_query();
        if ($q->num_rows() > 0) {
            $d = $q->result();
            $res = $this->ResponseModel->res304(["message" => "Data Sudah pernah Diinput", "norm" => $d[0]->norm]);
        } else {
            $res = null;
        }
        return $res;
    }

    public function save_simrs($sql_i, $nourut, $kunj, $umurthn, $umurbln, $umurhr, $biaya, $loket, $updKunj, $ktujuan, $p_loket)
    {
        $this->simrs->trans_start();
        $this->simrs->insert("m_pasien", $sql_i);
        $this->simrs->trans_complete();
        if ($this->simrs->trans_status() === TRUE) {
            $this->SimRsOldModel->saveToBp4($sql_i["norm"]);
            $notrans = $this->NormModel->gen_notrans($sql_i["norm"]);
            if ($sql_i["kkelompok"] == 1) {
                $noasuransi = "";
            } else {
                $noasuransi = $sql_i["noasuransi"];
            }
            $sql_it = [
                "notrans" => $notrans,
                "norm" => $sql_i["norm"],
                "rmlama" => $sql_i["rmlama"],
                'tgltrans' => $sql_i["tgldaftar"] . " " . $sql_i['jamdaftar'],
                "nourut" => $nourut,
                "kunj" => $kunj,
                "jeniskel" => $sql_i["jeniskel"],
                "kkelompok" => $sql_i["kkelompok"],
                "noasuransi" => $noasuransi,
                "kkabupaten" => $sql_i["kkabupaten"],
                "umurthn" => $umurthn,
                "umurbln" => $umurbln,
                "umurhr" => $umurhr,
                "biaya" => $biaya,
                "ktujuan" => $ktujuan,
                "loket" => $loket
            ];
            //	  print_r($sql_it);
            $res = $this->save_kunj($sql_it, $updKunj, $p_loket);
        } else {
            $res = $this->ResponseModel->res304(["message" => "gagal menyimpan!"]);
        }
        return $res;
    }

    public function save_kunj($sql_it, $updKunj, $p_loket)
    {
        $res = [];
        $tujuan = json_decode($this->TujuanModel->showDet($sql_it['ktujuan']))->response->data[0]->tujuan;
        $q = $this->simrs->get_where('t_kunjungan', ['norm' => $sql_it['norm'], 'DATE_FORMAT(tgltrans,"%Y-%m-%d")' => date("Y-m-d", strtotime($sql_it['tgltrans']))]);
        //        echo $this->simrs->last_query();
        if ($q->num_rows() == 0) {
            $this->simrs->trans_start();
            $this->simrs->insert("t_kunjungan", $sql_it);
            $this->simrs->trans_complete();
            if ($this->simrs->trans_status() === TRUE) {
                $ss = json_decode($this->SimRsOldModel->saveKunjToBp4($sql_it['norm']));
                $r1 = json_encode($this->AntrianModel->simpan_antrianpoli($sql_it["norm"], date("Y-m-d"), $tujuan));
                $sp = $this->PetugasModel->simpanTransPetugas(['notrans' => $sql_it['notrans'], 'p_loket' => $p_loket]);
                //$ck = $this->SheetModel->sendToSheet($sql_it['notrans']);
                $res = $this->ResponseModel->res201([
                    "message" => "Data Berhasil Disimpan! ",
                    "norm" => $sql_it["norm"],
                    "kunjOld" => $ss
                ]);
            }
        } else {
            if ($updKunj == 0) {
                $res = $this->ResponseModel->res302(["message" => "Pasien Sudah Mendaftar pada Hari ini!"]);
            } else {
                $sql_u = [
                    "notrans" => $q->result()[0]->notrans,
                    "norm" => $q->result()[0]->norm,
                    "rmlama" => $q->result()[0]->rmlama,
                    "nourut" => $sql_it["nourut"],
                    "kunj" => $sql_it["kunj"],
                    "jeniskel" => $q->result()[0]->jeniskel,
                    "kkelompok" => $sql_it['kkelompok'],
                    "noasuransi" => $sql_it['noasuransi'],
                    "kkabupaten" => $q->result()[0]->kkabupaten,
                    "umurthn" => $sql_it["umurthn"],
                    "umurbln" => $sql_it["umurbln"],
                    "umurhr" => $sql_it["umurhr"],
                    "biaya" => $sql_it["biaya"],
                    "ktujuan" => $sql_it["ktujuan"],
                    "loket" => $sql_it["loket"]
                ];
                //                print_r($sql_u);
                $this->simrs->trans_start();
                $this->simrs->update("t_kunjungan", $sql_u, ["notrans" => $q->result()[0]->notrans]);
                $this->simrs->trans_complete();
                if ($this->simrs->trans_status() === TRUE) {
                    $ss = $this->SimRsOldModel->saveKunjToBp4($sql_it['norm']);
                    $r1 = json_encode($this->AntrianModel->simpan_antrianpoli($sql_it["norm"], date("Y-m-d"), $tujuan));
                    $sp = $this->PetugasModel->simpanTransPetugas(['notrans' => $q->result()[0]->notrans, 'p_loket' => $p_loket]);
                    //$ck = $this->SheetModel->sendToSheet($q->result()[0]->notrans);
                    $res = $this->ResponseModel->res201([
                        "message" => "Data Berhasil Disimpan! ",
                        "norm" => $sql_it["norm"],
                        "kunjOld" => $ss
                    ]);
                }
            }
        }
        return $res;
    }

    public function update()
    {
        $res = [];
        $this->form_validation->set_rules('norm', 'NOMOR RM', 'trim|required|numeric');
        $this->form_validation->set_rules('tgldaftar', 'Tanggal Daftar', 'trim|required');
        $this->form_validation->set_rules('kkelompok', 'Kelompok', 'trim|required');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('kprovinsi', 'Provinsi', 'trim|required');
        $this->form_validation->set_rules('kkabupaten', 'Kabupaten', 'trim|required');
        $this->form_validation->set_rules('kkecamatan', 'Kecamatan', 'trim|required');
        $this->form_validation->set_rules('kkelurahan', 'Kelurahan', 'trim|required');
        $this->form_validation->set_rules('rtrw', 'RT/RW', 'trim|required');
        $this->form_validation->set_rules('tmptlahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tgllahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('kdAgama', 'Agama', 'trim|required');
        $this->form_validation->set_rules('statKawin', 'Status', 'trim|required');
        $nourut = $this->input->post('nourut');
        $norm = $this->input->post('norm');
        $rmlama = $this->input->post('rmlama');
        $tgldaftar = $this->input->post('tgldaftar');
        $jamdaftar = $this->input->post('jamdaftar');
        $kkelompok = $this->input->post('kkelompok');
        $noasuransi = $this->input->post('noasuransi');
        $noktp = $this->input->post('noktp');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $kprovinsi = $this->input->post('kprovinsi');
        $kkabupaten = $this->input->post('kkabupaten');
        $kkecamatan = $this->input->post('kkecamatan');
        $kkelurahan = $this->input->post('kkelurahan');
        $rtrw = $this->input->post('rtrw');
        $jeniskel = $this->input->post('jeniskel');
        $tmptlahir = $this->input->post('tmptlahir');
        $tgllahir = $this->input->post('tgllahir');
        $umurthn = $this->input->post('umurthn');
        $umurbln = $this->input->post('umurbln');
        $umurhr = $this->input->post('umurhr');
        $kdAgama = $this->input->post('kdAgama');
        $kdPendidikan = $this->input->post('kdPendidikan');
        $nohp = $this->input->post('nohp');
        $statKawin = $this->input->post('statKawin');
        $pekerjaan = $this->input->post('pekerjaan');
        $pjwb = $this->input->post('pjwb');
        $ibuKandung = $this->input->post('ibuKandung');
        $jctkkartu = $this->input->post('jctkkartu');
        $goldarah = $this->input->post('goldarah');
        $kunj = $this->input->post('kunj');
        $biaya = $this->input->post('biaya');
        $ktujuan = $this->input->post('ktujuan');
        $loket = $this->input->post('loket');
        $updKunj = $this->input->post('updKunj');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() === false) {
            $res = $this->ResponseModel->res400(["message" => validation_errors()]);
        } else {
            $sql_u = [
                'rmlama' => $rmlama,
                'tgldaftar' => $tgldaftar,
                'jamdaftar' => $jamdaftar,
                'kkelompok' => $kkelompok,
                'noasuransi' => $noasuransi,
                'noktp' => $noktp,
                'nama' => $nama,
                'alamat' => $alamat,
                'kprovinsi' => $kprovinsi,
                'kkabupaten' => $kkabupaten,
                'kkecamatan' => $kkecamatan,
                'kkelurahan' => $kkelurahan,
                'rtrw' => $rtrw,
                'jeniskel' => $jeniskel,
                'tmptlahir' => $tmptlahir,
                'tgllahir' => $tgllahir,
                'kdAgama' => $kdAgama,
                'kdPendidikan' => $kdPendidikan,
                'nohp' => $nohp,
                'statKawin' => $statKawin,
                'pekerjaan' => $pekerjaan,
                'pjwb' => $pjwb,
                'ibuKandung' => $ibuKandung,
                'jctkkartu' => $jctkkartu,
                'goldarah' => $goldarah,
                'kunj' => $kunj,
            ];
            $res = $this->do_update($sql_u, $norm);
        }
        return json_encode($res);
    }

    public function do_update($sql_u, $norm)
    {
        $res = [];
        $this->simrs->trans_start();
        $this->simrs->update('m_pasien', $sql_u, ['inorm' => intval($norm)]);
        $this->simrs->trans_complete();
        // echo $this->simrs->last_query();
        if ($this->simrs->trans_status() === TRUE) {
            $this->SimRsOldModel->saveToBp4($norm);
            $res = $this->ResponseModel->res201(["message" => "Data Berhasil diupdate!", "norm" => $norm]);
        } else {
            $res = $this->ResponseModel->res304(["message" => "Gagal mengupdate data!", "norm" => $norm]);
        }
        return $res;
    }

    public function delete_kunj()
    {
        $res = [];
        $this->form_validation->set_rules('notrans', 'No Transaksi', 'trim|required');
        $notrans = $this->input->post("notrans");
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() === false) {
            $res = $this->ResponseModel->res400(["message" => validation_errors()]);
        } else {
            $arrData = json_decode($this->RMModel->showDetKunjungan($notrans));
            $data = $arrData->response->data;
            if ($arrData->metaData->code == 200) {
                $res2 = [];
                $antri = json_decode($this->AntrianModel->hapus_antrianpoli($data[0]->norm, $data[0]->nourut, $data[0]->tgltrans));
                $sp = $this->PetugasModel->deleteTransPetugas($notrans);
                if ($antri->metaData->code == 200) {
                    $bp4 = json_decode($this->SimRsOldModel->delete_pend_kunjungan($data[0]->rmlama, $data[0]->nourut, $data[0]->tgltrans));
                    if ($bp4->metaData->code == 200) {
                        $res = json_decode($this->do_delete_kunj($notrans));
                    }
                }
            }
        }
        return json_encode($res);
    }

    public function do_delete_kunj($notrans)
    {
        $this->simrs->db_debug = FALSE;
        $res = [];
        $this->simrs->trans_start();
        $this->simrs->delete("t_kunjungan", ["notrans" => $notrans]);
        $this->simrs->trans_complete();
        if ($this->simrs->trans_status() === TRUE) {
            $res = $this->ResponseModel->res200(["message" => "Data Berhasil dihapus!"]);
        } else {
            $res = $this->ResponseModel->res304(["message" => "Gagal menghapus DATA!"]);
        }
        return json_encode($res);
    }
}
