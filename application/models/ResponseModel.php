<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResponseModel
 *
 * @author KENT-OS
 */
class ResponseModel extends CI_Model {

    public function res200($data) {
        return [
            "response" => $data,
            "metaData" => [
                "code" => 200,
                "message" => "OK"
            ]
        ];
    }

    public function res201($data) {
        return [
            "response" => $data,
            "metaData" => [
                "code" => 201,
                "message" => "Data Created!"
            ]
        ];
    }

    public function res202($data) {
        return [
            "response" => $data,
            "metaData" => [
                "code" => 202,
                "message" => "Data Accepted!"
            ]
        ];
    }

    public function res204($data) {
        return [
            "response" => $data,
            "metaData" => [
                "code" => 204,
                "message" => "No Content"
            ]
        ];
    }

    public function res302($data) {
        return [
            "response" => $data,
            "metaData" => [
                "code" => 302,
                "message" => "Data Found"
            ]
        ];
    }

    public function res304($data) {
        return [
            "response" => $data,
            "metaData" => [
                "code" => 304,
                "message" => "Not Modifed"
            ]
        ];
    }

    public function res400($data) {
        return [
            "response" => $data,
            "metaData" => [
                "code" => 400,
                "message" => "Bad Request"
            ]
        ];
    }

    public function res401($data) {
        return [
            "response" => $data,
            "metaData" => [
                "code" => 401,
                "message" => "Unauthorized"
            ]
        ];
    }

    public function res404() {
        return [
            "response" => ["message" => "Page Not Found!"],
            "metaData" => [
                "code" => 404,
                "message" => "Not Found!!!"
            ]
        ];
    }

}
