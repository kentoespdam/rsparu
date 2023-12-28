<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kominfo extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load library yang diperlukan
        $this->load->library('curl');
    }

    public function getDataPendaftaranKominfo()
    {
        // Ambil data dari URL dengan parameter username dan password
        $url = 'https://kkpm.banyumaskab.go.id/api/pendaftaran/data_pendaftaran';  // Ganti dengan URL sesuai kebutuhan
        $username = '3301010509940003';  // Ganti dengan username yang valid
        $password = 'banyumas';  // Ganti dengan password yang valid

        // Konfigurasi cURL
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => "$username:$password",
        );

        $this->curl->create($url);
        $this->curl->options($options);

        // Eksekusi cURL
        $result = $this->curl->execute();

        // Tampilkan hasil
        echo $result;
    }
	
	public function getDataPasienKominfo()
    {
        // Ambil data dari URL dengan parameter username dan password
        $url = 'http://kkpm.banyumaskab.go.id/api/pasien/data_pasien';  // Ganti dengan URL sesuai kebutuhan
        $username = '3301010509940003';  // Ganti dengan username yang valid
        $password = 'banyumas';  // Ganti dengan password yang valid

        // Konfigurasi cURL
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => "$username:$password",
        );

        $this->curl->create($url);
        $this->curl->options($options);

        // Eksekusi cURL
        $result = $this->curl->execute();

        // Tampilkan hasil
        echo $result;
    }
}
