<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebSocket
 *
 * @author Kent-os
 */

$host=$_SERVER['HTTP_HOST'];
$port=1990;
set_time_limit(0);

$socket = socket_create(AF_INET, SOCK_STREAM, 0)or die("Could not create socket\n");
$result = socket_bind($socket, $host, $port)or die("Could not bind to socket.\n");

$result = socket_listen($socket, 3)or die("Could not set up socket listener.\n");
echo "Listening for connections";

class WebSocket {
    
}
