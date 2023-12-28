<?php

/* * To change this license header, choose License Headers in Project Properties. 
 * To change this template file, choose Tools | Templates 
 * and open the template in the editor. */

/**
 * Description of Main_C * 
 * @author rsparu-1 */
class Main_C extends CI_Controller {

    public function index() {
        if (isset($this->session->logged)) {
            $logged = $this->session->logged;
//                print_r($logged['user_access']);
            $view = [
                "uname" => $logged['uname'],
                "kd_poli" => $logged['kd_poli'],
                "name" => $logged['name'],
                "aliases" => $logged['aliases'],
                "user_access" => $logged['user_access']
            ];
            $this->parser->parse("template/n_template", $view);
        } else {
            // echo $_SERVER['HTTPS'];
            redirect(base_url('Login'));
        }
    }

}
