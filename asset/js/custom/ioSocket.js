/* global io */

$(document).ready(() => {
    if (window.location.protocol == 'http:') {
	  socket = io.connect(window.location.host + ":3001");
	  $tensiIO = io.connect(window.location.origin + ":3001/Poli");
    }
    else {
	  socket = io.connect(window.location.host + ":3002");
	  $tensiIO = io.connect(window.location.origin + ":3002/Poli");
    }

    $tensiIO.emit('disconnect', $uname);
    $tensiIO.emit('joinRoom', $uname);

    $tensiIO.on('success', (res) => {
	  console.log(res);
    });

    $tensiIO.on('err', (res) => {
	  console.log(res);
    });

    $tensiIO.on('data panggil', (data) => {
	  play_audio(data);
    });
});