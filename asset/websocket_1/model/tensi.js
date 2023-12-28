const db = require('./db');
let arr_room = [];
db.connect((err) => {
    if (err)
	  console.log(err);
    let sql = "SELECT uname FROM m_u_login";
    db.query(sql, (err, result) => {
	  if (err) throw err;
	  result.forEach(d => {
		arr_room.push(d.uname);
	  });

    });
});

module.exports = (io) => {
    io.of('/Poli').on('connection', (socket) => {
	  socket.emit('welcome', {msg: "joinning /Tensi"});
	  socket.on('joinRoom', (room) => {
		if (arr_room.includes(room)) {
		    socket.join(room);
		    return socket.emit('success', "Selamat datang di Room " + room);
		}
		else {
		    return socket.emit('err', "Room " + room + " Tidak ditemukan!");
		}
	  });

	  socket.on('panggil', (room, data) => {
		io.of('/Poli').in(room).emit('data panggil', data);
	  });
	  
	  
    });
};