var base_url = window.location.origin + "/antrian/";
function play_audio(nomor, noLoket) {
    var audioBell = new Audio(base_url + 'asset/sound/Airport_Bell.wav');
    var audioUrut = new Audio(base_url + 'asset/sound/nomor_urut.wav');

    var audioLoket = new Audio(base_url + 'asset/sound/di_loket.wav');
//    var audioAlphaLoket = new Audio(base_url + 'asset/sound/' + alphaLoket + '.wav');
    var audioNomorLoket = new Audio(base_url + 'asset/sound/' + noLoket + '.wav');

//        console.log(audioUrut);

    if (nomor <= 11 || nomor == 100) {
        var audioNomor = new Audio(base_url + 'asset/sound/' + nomor + '.wav');
        audioBell.play();
        audioBell.onended = function () {
            audioUrut.play();
        }

//        audioUrut.onended = function () {
//            audioAlphaLoket.play();
//        }

        audioUrut.onended = function () {
            audioNomor.play();
        }


        audioNomor.onended = function () {
            audioLoket.play();
        }

        audioLoket.onended = function () {
            audioNomorLoket.play();
        }
    }

    if (nomor > 11 && nomor < 20) {
        nomor = nomor - 10;
        var audioNomor = new Audio(base_url + 'asset/sound/' + nomor + '.wav');
        var audioNomorBelas = new Audio(base_url + 'asset/sound/belas.wav');

        audioBell.play();
        audioBell.onended = function () {
            audioUrut.play();
        }

//        audioUrut.onended = function () {
//            audioAlphaLoket.play();
//        }

        audioUrut.onended = function () {
            audioNomor.play();
        }

        audioNomor.onended = function () {
            audioNomorBelas.play();
        }

        audioNomorBelas.onended = function () {
            audioLoket.play();
        }

        audioLoket.onended = function () {
            audioNomorLoket.play();
        }
    }

    if (nomor >= 20 && nomor < 100) {
        var str = nomor.toString();
        var xplode = str.split('');
        var str1 = parseInt(xplode[0]);
        var str2 = parseInt(xplode[1]);

//            console.log(str);

        var audioNomorDepan = new Audio(base_url + 'asset/sound/' + str1 + '.wav');
        var audioNomorPuluh = new Audio(base_url + 'asset/sound/puluh.wav');

        audioBell.play();
        audioBell.onended = function () {
            audioUrut.play();
        }

//        audioUrut.onended = function () {
//            audioAlphaLoket.play();
//        }

        audioUrut.onended = function () {
            audioNomorDepan.play();
        }

        audioNomorDepan.onended = function () {
            audioNomorPuluh.play();
        }

        if (str2 > 0) {
            var audioNomorBelakang = new Audio(base_url + 'asset/sound/' + str2 + '.wav');

            audioNomorPuluh.onended = function () {
                audioNomorBelakang.play();
            }

            audioNomorBelakang.onended = function () {
                audioLoket.play();
            }
        } else {
            audioNomorPuluh.onended = function () {
                audioLoket.play();
            }

        }

        audioLoket.onended = function () {
            audioNomorLoket.play();
        }
    }

    if (nomor > 100) {
        var str = nomor.toString();
        var xplode = str.split('');
        var str1 = parseInt(xplode[0]);
        var str23 = parseInt(xplode[1] + "" + xplode[2]);
        var str2 = parseInt(xplode[1]);
        var str3 = parseInt(xplode[2]);

        console.log(str23);

        var audioNomorRatus = new Audio(base_url + 'asset/sound/ratus.wav');
        //var audioNomorTengah = new Audio(base_url+'asset/sound/' + str2 + '.wav');

        if (str1 > 1) { //lebih dari seratus
            var audioNomorDepan = new Audio(base_url + 'asset/sound/' + str1 + '.wav');
        } else { //tepat seratus
            var audioNomorDepan = new Audio(base_url + 'asset/sound/100.wav');
        }

        if (str23 > 0 && str23 <= 11) { //kurang dari 111
            var audioNomorBelakang = new Audio(base_url + 'asset/sound/' + str23 + '.wav');
        } else if (str23 > 11 && str23 < 20) { //seratus belasan
            var audioNomorBelakang1 = new Audio(base_url + 'asset/sound/' + str3 + '.wav');
            var audioNomorBelakang = new Audio(base_url + 'asset/sound/belas.wav');
        } else {
            if (str3 > 0) {
                var audioNomorBelakang1 = new Audio(base_url + 'asset/sound/' + str2 + '.wav');
                var audioNomorBelakang2 = new Audio(base_url + 'asset/sound/puluh.wav');
                var audioNomorBelakang = new Audio(base_url + 'asset/sound/' + str3 + '.wav');
            } else {
                var audioNomorBelakang1 = new Audio(base_url + 'asset/sound/' + str2 + '.wav');
                var audioNomorBelakang = new Audio(base_url + 'asset/sound/puluh.wav');
            }
        }

        audioBell.play();
        audioBell.onended = function () {
            audioUrut.play();
        }

        /*        audioUrut.onended = function () {
         audioAlphaLoket.play();
         }*/

        audioUrut.onended = function () {
            audioNomorDepan.play();
        }
        if (str23 > 0 && str23 <= 11) { //kurang dari 111
            audioNomorDepan.onended = function () {
                audioNomorBelakang.play();
            }
        } else if (str23 > 11 && str23 < 20) { //seratus belasan
            audioNomorDepan.onended = function () {
                audioNomorBelakang1.play();
            }

            audioNomorBelakang1.onended = function () {
                audioNomorBelakang.play();
            }
        } else {
            if (str3 > 0) {
                audioNomorDepan.onended = function () {
                    audioNomorBelakang1.play();
                }

                audioNomorBelakang1.onended = function () {
                    audioNomorBelakang2.play();
                }

                audioNomorBelakang2.onended = function () {
                    audioNomorBelakang.play();
                }
            } else {
                audioNomorDepan.onended = function () {
                    audioNomorBelakang1.play();
                }

                audioNomorBelakang1.onended = function () {
                    audioNomorBelakang.play();
                }
            }
        }

        audioNomorBelakang.onended = function () {
            audioLoket.play();
        }

        audioLoket.onended = function () {
            audioNomorLoket.play();
        }
    }

    audioNomorLoket.onended = function () {
        upd_data(nomor, noLoket, '1');
        get_data();
    }
}

function upd_data(noAntri, loket, panggil) {
    $.getJSON(base_url + "API/panggil/tmp/updTmp/noAntri/" + noAntri + "/loket/" + loket + "/panggil/" + panggil), function (json) {
        console.log(json);
    }
}

function get_data() {
    $.getJSON(base_url + "API/panggil/tmp/loket", function (json) {
        if (json.metaData.code == 200) {
            $('#nomer').html("No : " + json.response.data[0].noAntri + " di Loket " + json.response.data[0].loket);
            play_audio(json.response.data[0].noAntri, json.response.data[0].loket);
        } else {
            setTimeout(function () {
                get_data();
            }, 1000);
        }
    });
}



//function panggil(noAntri, loket) {
//    var alpha = "";
//    var nomor = 0;
//    var url = base_url + "API/panggil/tmp/addTmp/noAntri/" + noAntri + "/loket/" + loket;
//    $.getJSON(url, function (json) {
//        if (json.metaData.code == 200) {
//
//        }
//    });
//}

function panggilUlang() {
    $('#panggil').removeAttr('disabled');
    //console.log("Panggil Ulang");
    var alpha = "";
    var nomor = 0;
    var sisa = 0;
    var url = base_url + "API/Antree/GET/Kategori/{kdKategori}/Action/recall/Loket/{noLoket}";
    $.getJSON(url, function (json) {
        //console.log(json);
        if (json.metaData.code == 200) {
            $.each(json.response.message, function (index, t) {
                alpha = t.alpha;
                nomor = t.noUrut;
            });
            sisa = json.response.sisa;
            console.log(json.response.sisa);
            $('#nomorAntrian').html(alpha + nomor);
            $('#sisaAntrian').html("Sisa : " + sisa);
            play_audio(nomor);
        }
    }, "json");
}