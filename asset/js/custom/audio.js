/* 
 * Developed By Kent-Os
 * 
 */

let gen_uri_suara = (teks) => {
    if (loc == 'dev-rsparu.kentoes.com') {
        if (window.location.protocol == 'http:') {
            uri_suara = 'http://bkpm.kentoes.com/auahgelap/getvoice.php?teks=' + teks.toLowerCase();
        } else {
            uri_suara = 'https://bkpm.kentoes.com/auahgelap/getvoice.php?teks=' + teks.toLowerCase();
        }
    } else {
        uri_suara = window.location.origin + '/auahgelap/getvoice.php?teks=' + teks.toLocaleLowerCase();
    }
    return uri_suara;
};

play_audio = (data) => {
    teks = data.str;
    $('#nomer').html(teks);
    uri_suara = gen_uri_suara(teks);
    $.get(uri_suara, function (res) {
    }).always(function (res) {
        play_suara(res, data);
    }, "json");
};

play_suara = (res, data) => {
    var audioBell = new Audio(base_uri + 'asset/sound/dingdong.wav');
    var snd = new Audio(res);
    // var snd = new Audio("data:audio/wav;base64," + str);
    audioBell.play();
    audioBell.onended = function () {
        snd.play();
    };
};