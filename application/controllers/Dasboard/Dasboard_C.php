<?php

/*
 * Here comes the text of your license
 * Each line should be prefixed with mmm  * 
  @author kent-os
 */

/**
 * Description of Dasboard_C
 *
 * @author rsparu-1
 */
class Dasboard_C extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

	public function index() {
        $arrData = [
            'grafik_kunj' => $this->parser->parse('Dasboard/grafik_kunj', [], TRUE),
            // 'FormCari' => $this->parser->parse('Pendaftaran/FormCari', [], TRUE),
        ];

        $this->parser->parse('Dasboard/dasboard', $arrData);
    }
}