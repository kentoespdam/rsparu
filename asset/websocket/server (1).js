var app = require('express')();
var http = require('http').createServer(app);
var io = require('socket.io')(http);
var connections = [];

http.listen(3000, function () {
    console.log('listening on *:3000');
});

app.get('/', function (req, res) {
    res.sendFile(__dirname + '/index.html');
});

io.on('connection', function (socket) {
    connections.push(socket);
    console.log('a user connected. user count : ', connections.length);

    // Disconnect
    socket.on('disconnect', function (data) {
        connections.splice(connections.indexOf(socket), 1);
        console.log('some user Disconnect. user count : ', connections.length);
    });

    socket.on('panggil', function (data) {
		console.log(data);
        io.emit('data panggil', data);
    });
});

