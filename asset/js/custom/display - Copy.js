/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var uri = "//" + window.location.host + "/rsparu/";

function video(playList) {
    var nextVideo = playList;
    var curVideo = 0;
    var videoPlayer = document.getElementById('videoPlayer');

    videoPlayer.onended = function () {
        ++curVideo;
        if (curVideo < nextVideo.length) {
            videoPlayer.src = nextVideo[curVideo];
        } else {
            videoPlayer.src = nextVideo[0];
        }
    }
}

function ambilAntrian() {
    var diPanggilHide = $('#diPanggilHide').val();
    var diPanggilLoket = $('#diPanggil h2');
    var diPanggilTitle = $('#diPanggil .card-title');
    var diPanggilH4 = $('#diPanggil h4');
    var metaCode = 204;

    $.getJSON(uri + 'API/tunggu/pendaftaran', function (json) {

    }).always(function (json) {
        var t = json.response.data[0];
        if (json.metaData.code == 200) {
            if (diPanggilHide != t.noAntri) {
                diPanggilLoket.html("Loket " + t.loket);
                $('#diPanggilHide').val(t.noAntri);
                diPanggilTitle.html(t.noAntri);
                diPanggilH4.html(t.jenis);

                if ($('#hide-' + t.loket).val() != t.noAntri) {
                    $('#hide-' + t.loket).val(t.noAntri);
                    $('#crd-' + t.loket + ' .card-title').html(t.noAntri);
                    $('#crd-' + t.loket + ' h5').html(t.jenis);
                }
            }

            setTimeout(function () {
                ambilAntrian();
            }, "2000");
        } else {
            setTimeout(function () {
                diPanggilLoket.html(diPanggilLoket.html());
//                $('#diPanggilHide').val(json.tloket);
                diPanggilTitle.html(diPanggilTitle.html());
                diPanggilH4.html(diPanggilH4.html());

                ambilAntrian();
            }, "2000");
        }
    });
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