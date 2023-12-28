/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var base_uri;
var bi = window.location.host.split(".");
if (bi[(bi.length) - 1] == "com" || bi[(bi.length) - 1] == "net") {
    base_uri = window.location.origin + "/";
}
else {
    base_uri = window.location.origin + "/rsparu/";
}


var socket;
$(function () {
    socket = io.connect(window.location.origin + ":3001");

    socket.on('data panggil', function (data) {
	  ambilAntrian(data.urut, data.loket, data.jenis);
    });
});

function video(playList) {
    var nextVideo = playList;
    var curVideo = 0;
    var videoPlayer = document.getElementById('videoPlayer');

    videoPlayer.onended = function () {
	  ++curVideo;
	  if (curVideo < nextVideo.length) {
		videoPlayer.src = nextVideo[curVideo];
	  }
	  else {
		videoPlayer.src = nextVideo[0];
	  }
    }
}

function ambilAntrian(urut, loket, jenis) {
    var noAntri = urut;
    if (urut < 10) {
	  noAntri = '00' + urut;
    }
    else if (urut < 100) {
	  noAntri = '0' + urut;
    }
    var diPanggilHide = $('#diPanggilHide').val();
    var diPanggilLoket = $('#diPanggil h2');
    var diPanggilTitle = $('#diPanggil .card-title');
    var diPanggilH4 = $('#diPanggil h4');
    var metaCode = 204;

    // if (diPanggilHide != noAntri) {
    diPanggilLoket.html("Loket " + loket);
    $('#diPanggilHide').val(noAntri);
    diPanggilTitle.html(noAntri);
    diPanggilH4.html(jenis);

    if ($('#hide-' + loket).val() != noAntri) {
	  $('#hide-' + loket).val(noAntri);
	  $('#crd-' + loket + ' .card-title').html(noAntri);
	  $('#crd-' + loket + ' h5').html(jenis);
    }
    // }
}

function f_ok() {
    ambilAntrian();
    // panggilData();
    $('#videoPlayer').trigger('play');
    $('#cnfrm').modal('hide');
}

function f_close() {
    window.close();
}

