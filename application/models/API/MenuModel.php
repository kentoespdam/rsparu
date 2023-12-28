<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuModel
 *
 * @author loket-2
 */
class MenuModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->simrs = $this->load->database('simrs', TRUE);
    }

    public function showListMenu() {
        $response = [];
        $arrData = [];

        $this->simrs->select('m_menu.kd_menu, m_menu.nm_menu');
        $this->simrs->join('user_access', 'user_access.uname = m_u_login.uname', 'INNER');
        $this->simrs->join('m_menu', 'user_access.kd_menu = m_menu.kd_menu', 'INNER');
        $this->simrs->group_by('m_menu.nm_menu');
        $this->simrs->order_by('m_menu.nm_menu', 'ASC');
        $q = $this->simrs->get('m_u_login');
//        echo $this->simrs->last_query();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $d) {
                array_push($arrData, $d);
            }

            $response = $this->ResponseModel->res200(["data" => $arrData, "count" => $q->num_rows()]);
        } else {
            $response = $this->ResponseModel->res204(["data" => $arrData, "count" => $q->num_rows()]);
        }

        return json_encode($response);
    }

}
