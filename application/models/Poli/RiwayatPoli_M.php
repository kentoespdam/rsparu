<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RiwayatPoli_M
 *
 * @author Tata Usaha
 */
class RiwayatPoli_M extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->simrs = $this->load->database('simrs', TRUE);
    }

    public function AmbilRiwayat($norm) {
        $res = [];
        $data = [];
        $this->simrs->select('t_kunjungan.notrans, ' .
                't_kunjungan.norm, ' .
                't_kunjungan.tgltrans, ' .
                't_kunjungan.umurthn, ' .
                't_kunjungan.umurbln, ' .
                't_kunjungan.umurhr, ' .
                't_tensi.td, ' .
                't_tensi.fnadi, ' .
                't_tensi.suhu, ' .
                't_tensi.fnafas, ' .
                't_tensi.bb, ' .
                't_tensi.tb, ' .
                "IF(t_tensi.hilangBB3Bln = 1,'YA','TIDAK') AS  hilangBB3Bln, " .
                "IF(t_tensi.turunAsupMkn = 1, 'YA', 'TIDAK') AS turunAsupMkn, " .
                "IF(t_tensi.psiko = 0, 'TENANG', IF(t_tensi.psiko = 1, 'CEMAS', IF(t_tensi.psiko = 2, 'Agitas', 'Lain-Lain'))) AS psiko, " .
                't_tensi.otherPsiko, ' .
                't_tensi.hasilPeriksaSebelumnya, ' .
                "t_tensi.batuk, " .
                "IF(t_tensi.batukDahak = 0, 'Tidak Berdahak',IF(t_tensi.batukDahak = 1, 'Putih', IF(t_tensi.batukDahak = 2, 'Keruh', 'Hijau'))) AS batukDahak, " .
                't_tensi.batukDarah, ' .
                "IF(t_tensi.batukDarahKualitas = 0, 'Bercak', IF(t_tensi.batukDarahKualitas = 1, 'Banyak', IF(t_tensi.batukDarahKualitas = 2, 'Cair', 'Tidak Ada Darah'))) AS batukDarahKualitas, " .
                't_tensi.sesak, ' .
                't_tensi.sesakSuara, ' .
                't_tensi.nyeriDada, ' .
                "IF(t_tensi.nyeriDadaLok = 0, 'Kanan', IF(t_tensi.nyeriDadaLok = 1, 'Kiri', IF(t_tensi.nyeriDadaLok = 2, 'Uluhati', IF(t_tensi.nyeriDadaLok = 3, 'Semua Area', 'Tidak Bisa Ditentukan')))) AS nyeriDadaLok, " .
                't_tensi.demam, ' .
                "IF ( ISNULL(t_tensi.demamWaktuPagi), '-', t_tensi.demamWaktuPagi) AS demamWaktuPagi, " .
                't_tensi.keluhanLain, ' .
                'm_diag1.diagnosa AS diagnosa1, ' .
                'm_diag2.diagnosa AS diagnosa2, ' .
                'm_diag3.diagnosa AS diagnosa3, '
                . 't_poli.inspeksi, '
                . 't_poli.perkusi, '
                . 't_poli.palpasi, '
                . 't_poli.auskultasi, '
                . "IF ( ISNULL(t_poli.anemis), '-', IF ( t_poli.anemis = 0, 'TIDAK', 'YA' )) AS anemis, "
                . "IF ( ISNULL(t_poli.cyanosis), '-', IF ( t_poli.cyanosis = 0, 'TIDAK', 'YA' )) AS cyanosis, "
                . "IF ( ISNULL(t_poli.dyspneu), '-', IF ( t_poli.dyspneu = 0, 'TIDAK', 'YA' )) AS dyspneu, "
                . "IF ( ISNULL(t_poli.stomatitis), '-', IF ( t_poli.stomatitis = 0, 'TIDAK', 'YA' )) AS stomatitis, "
                . "admin_poli.gelar_d AS gelar_d_admin, "
                . "admin_poli.nama AS nama_d_admin, "
                . "admin_poli.gelar_b AS gelar_b_admin, "
                . "dokter_poli.gelar_d AS gelar_d_dokter, "
                . "dokter_poli.nama AS nama_dokter, "
                . "dokter_poli.gelar_b AS gelar_b_dokter "
        );
        $this->simrs->join('t_tensi', 't_tensi.notrans = t_kunjungan.notrans', 'LEFT');
        $this->simrs->join('t_poli', 't_kunjungan.notrans = t_poli.notrans', 'LEFT');
        $this->simrs->join(' m_diagnosa AS m_diag1', 't_poli.diagnosa1 = m_diag1.kdDiag', 'LEFT');
        $this->simrs->join(' m_diagnosa AS m_diag2', 't_poli.diagnosa2 = m_diag2.kdDiag', 'LEFT');
        $this->simrs->join(' m_diagnosa AS m_diag3', 't_poli.diagnosa3 = m_diag3.kdDiag', 'LEFT');
        $this->simrs->join(' t_petugas', 't_petugas.notrans = t_kunjungan.notrans', 'LEFT');
        $this->simrs->join(' v_pegawai AS admin_poli', 't_petugas.p_admin_poli = admin_poli.nip', 'LEFT');
        $this->simrs->join(' v_pegawai AS dokter_poli', 't_petugas.p_dokter_poli = dokter_poli.nip', 'LEFT');
        $this->simrs->where(['t_kunjungan.norm' => $norm]);
        $this->simrs->order_by('t_kunjungan.tgltrans DESC');
        $this->simrs->limit(3);
        $q = $this->simrs->get('t_kunjungan');
//        echo $this->simrs->last_query();
        if ($q->num_rows() > 0) {
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
