<?php

/*
 * Here comes the text of your license
 * Each line should be prefixed with mmm  * 
  @author kent-os
 */

/**
 * Description of TujuanController
 *
 * @author rsparu-1
 */
class TujuanController extends REST_Controller{
    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model("API/TujuanModel");
    }

    public function showAll_get() {
        $res = $this->TujuanModel->showAll();
        echo $res;
    }
    
    public function showDet_get($id){
        $res = $this->TujuanModel->showDet($id);
        echo $res;
    }
}
