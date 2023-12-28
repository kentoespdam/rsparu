<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Entah_C
 *
 * @author Kent-os
 */
class Entah_C extends CI_Controller {
    public function __construct() {
		parent::__construct();
		$this->simrs= $this->load->database('simrs',TRUE);
		$this->bp4= $this->load->database('bp4',TRUE);
		$this->load->model('API/PasienModel');
		$this->load->library('ciqrcode');
		$this->load->library('titled');
    }
    
    public function jalan($norm){
		$p = json_decode($this->PasienModel->findBiodata($norm));
		$data = $p->response->data[0];
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => "A4",
			'size' => "A4",
			// 'format'=>[192,135],
			// 'size'=>[192,135],
			'margin_left' => 10,
			'margin_right' => 5,
			'margin_top' => 2,
			'margin_bottom' => 2,
			'orientation'=>'P'
		]);
		$html = $this->parser->parse('Cetak/label', $data, false);
		// $mpdf->WriteHTML($html);
		
		
		// $text = $mpdf->WriteHTML($html);    
		/* tulis dan buka koneksi ke printer */    
		// $printer = printer_open("L3150 Series(Network)");  
		/* write the text to the print job */  
		// printer_write($printer, $text);   
		/* close the connection */ 
		// printer_close($printer);
    }
}
