<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaftarController
 *
 * @author Tata Usaha
 */
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;

class DaftarController extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->an = $this->load->database('an', TRUE);
        $this->load->model("UrutModel");
    }

    public function daftar_get($kdKategori) {
        $response = [];
        $norut = $this->generateUrut();
//        echo $norut;
        $data = [
            "noUrut" => $norut,
            "kdKategori" => $kdKategori,
            "printed" => 0
        ];
        $this->an->trans_start();
        $q = $this->an->insert("tdaftar1", $data);
        $this->an->trans_complete();

//        print_r($this->an->trans_status());

        if ($this->an->trans_status() == 1) {
            $response = $this->ResponseModel->res201(["message" => "Data Berhasil Disimpan!", "noUrut" => $norut]);
        } else {
            $response = $this->ResponseModel->res304(["message" => "Gagal Menyimpan Data!"]);
        }

        echo $response;
    }

    private function generateUrut() {
        $this->an->select('noUrut');
        $this->an->where("DATE_FORMAT(tdaftar1.id,'%Y-%m-%d')", date('Y-m-d'), TRUE);
        $this->an->order_by('id', 'DESC');
        $q = $this->an->get('tdaftar1');
        $this->an->limit(1);

        if ($q->num_rows() > 0) {
            $urut = $q->result()[0]->noUrut + 1;
        } else {
            $urut = 1;
        }

        return $urut;
    }

    public function pendingPrint_get() {
        $response = [];
        $data = [];
//        $this->an->select('noUrut');
        $this->an->where("printed", "0");
        $this->an->order_by('id', 'ASC');
        $this->an->limit(1);
        $q = $this->an->get('tdaftar1');


        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($data, $d);
            }
            $response = $this->ResponseModel->res200(["data" => $data]);
        } else {
            $response = $this->ResponseModel->res204(["message" => "Sudah Dicetak Semua"]);
        }

        echo $response;
    }

    public function printKarcis_get($id, $noUrut) {
        $id = str_replace('%20', " ", $id);
        $data = ['printed' => 1];
        $where = ['id' => $id];
        $this->an->trans_start();
        $q = $this->an->update('tdaftar1', $data, $where);
        $this->an->trans_complete();
//        echo $q;

        if ($this->an->trans_status() === TRUE) {
//            $this->cetak($id, $noUrut);
        }
    }

    public function cetak_get($id, $noUrut) {

//        $connector = new FilePrintConnector("php://stdout");
//        $connector = new NetworkPrintConnector("192.168.10.200", 9100);
//        $printer = new Printer($connector);
//        $printer->text("Hello World!\n");
//        $printer->cut();
//        $printer->close();

//        $profile = CapabilityProfile::load("simple");
//        $connector = new WindowsPrintConnector("smb://192.168.10.200/pos-80c");
        $connector = new WindowsPrintConnector("pos-80c_1");
        $printer = new Printer($connector);
        try {
            $printer->text("Hello World!\n");
            $printer->cut();
            $printer->close();
        } catch (Exception $e) {
            log_message("error", "Error: Could not print. Message " . $e->getMessage());
            $this->receiptprint->close_after_exception();
            $printer->close();
        }
    }

}
