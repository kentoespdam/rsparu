#!/usr/bin/env node
/** server.js  */

const app = require('express')(),
	  http = require('http').createServer(app),
	  io = require('socket.io')(http);
let connections = [];

http.listen(3001, function () {
    console.log('listening on *:3001');
});

app.get('/', function (req, res) {
//    res.sendFile(__dirname + '/index.html');
    console.log('OK!');
});

io.on('connection', function (socket) {
    connections.push(socket);
    console.log('a user connected. user count : ', connections.length);

    // Disconnect
    socket.on('disconnect', function (data) {
	  connections.splice(connections.indexOf(socket), 1);
	  console.log('some user Disconnect. user count : ', connections.length);
    });

    io.on('panggil', function (data) {
	  console.log(data);
	  io.emit('data panggil', data);
    });
});

require('./model/tensi')(io); 

