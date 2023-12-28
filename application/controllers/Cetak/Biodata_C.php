<?php

/* * Here comes the text of your license 
 * Each line should be prefixed with mmm  
 *   @author kent-os */

/** * Description of Biodata_C * 
 * @author rsparu-1 */
class Biodata_C extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('API/PasienModel');
        $this->load->library('ciqrcode');
        $this->load->library('titled');
    }

    public function index($norm) {
        $p = json_decode($this->PasienModel->findBiodata($norm));
        $data = $p->response->data[0];
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'Legal',
//            'size' => 'Legal',
            'margin_left' => 18,
            'margin_right' => 5,
            'margin_top' => 5,
            'margin_bottom' => 40,
        ]);
        $html = $this->parser->parse('Cetak/biodata', $data, TRUE);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function kartu($norm) {
        $p = json_decode($this->PasienModel->findBiodata($norm));
        $data = $p->response->data[0];
        $data->title = "Kartu_" . $data->norm;
        $params['data'] = $data->norm;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH . 'asset/temp/temp.png';
        $data->qr = $this->ciqrcode->generate($params);

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            // 'format' => [100, 75],
            // 'size' => [100, 75],
            'format' => "A4",
            'size' => "A4",
            'margin_left' => 1,
            'margin_right' => 1,
            'margin_top' => 1,
            'margin_bottom' => 1,
            'orientation' => 'P',
        ]);
        //$mpdf->SetWatermarkImage(APPPATH . '../asset/img/Logo_BP4.jpg',0.2,[45,50]);
        $mpdf->SetWatermarkImage(base_url('asset/img/Logo_BP4.jpg'), 0.2, [45, 50], [20, 3]);
        $mpdf->showWatermarkImage = true;
//        $mpdf->writeBarcode('978-1234-567-890', 0.2, [45, 50], [20, 3]);
        $html = $this->parser->parse('Cetak/kartu', $data, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function label($norm) {
        $p = json_decode($this->PasienModel->findBiodata($norm));
        $data = $p->response->data[0];
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => "A4",
            'size' => "A4",
            // 'format'=>[192,135],
            // 'size'=>[192,135],
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 2,
            'margin_bottom' => 2,
            'orientation' => 'P'
        ]);
        $html = $this->parser->parse('Cetak/label', $data, TRUE);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

}
