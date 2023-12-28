//const fs = require('fs');
//let httpsOptions = {
//    key: fs.readFileSync('./privkey.pem'),
//    cert: fs.readFileSync('./fullchain.pem')
//};
const app = require('express')(),
        server = require('http').createServer(app),
        io = require('socket.io')(server),
        session = require('express-session')(
        {
            secret: "Rahasia",
            resave: true,
            saveUninitialized: true
        }),
        sharedsession = require('express-socket.io-session');
let connections = [];

// Attach Session
app.use(session);

// Share session with io sockets
io.use(sharedsession(session));

server.listen(3001, () => {
    console.log('listening on *:3001');
});

app.get('/', function (req, res) {
    res.sendFile(__dirname + '/views/index.html');

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

require('./model/tensi')(io);

require('./model/syncRmTb')();