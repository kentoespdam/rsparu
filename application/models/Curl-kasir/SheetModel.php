<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SheetModel
 *
 * @author loket-2
 */
class SheetModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->url = "https://script.google.com/macros/s/AKfycbxgpLYWnJsnsYhS4QTjQACnYUlW7WF8rW9KZlO5BdUv_FMs1VdHhsH_/exec";
        $this->simrs = $this->load->database('simrs', true);
    }

    public function syncSheet()
    {
        $tgl = date("Y-m-d");
        $stat = [];
        $data = [];

        $this->simrs->select('t_kunjungan.notrans, t_kunjungan.norm, date(t_kunjungan.tgltrans) AS tgltrans, m_pasien.nama');
        $this->simrs->join('m_pasien', 't_kunjungan.norm = m_pasien.norm', 'INNER');
        $q = $this->simrs->get_where('t_kunjungan', ['DATE(tgltrans)' => $tgl]);
        // echo $this->simrs->last_query();

        if ($q->num_rows() > 1) {
            foreach ($q->result() as $d) {
                array_push($data, $d);
            }
            $stat = $this->sendToSheet(json_encode(['list' => $data]));
            // $stat = 1;
            // $stat=['list'=>$data];
        } else {
            $stat = "Error";
        }

        return $stat['content'];
    }

    public function sendToSheet($data)
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            //CURLOPT_ENCODING => "", // handle all encodings
            //CURLOPT_USERAGENT => "spider", // who am i
            CURLOPT_AUTOREFERER => true, // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 1200, // timeout on connect
            CURLOPT_TIMEOUT => 120, // timeout on response
            CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false, // Disabled SSL Cert checks
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => ['datatrans' => $data]
        );

        $ch = curl_init($this->url . "?s=sync");
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);
        //        echo json_encode($header);
        $rc = [
            "content" => $content,
            "err" => $err,
            "errmsg" => $errmsg,
            "header" => $header
        ];
        return $rc;
    }
}
