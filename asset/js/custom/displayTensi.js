let base_uri;
let bi = window.location.host.split(".");
if (bi[(bi.length) - 1] == "com" || bi[(bi.length) - 1] == "net") {
    base_uri = window.location.origin + "/";
} else {
    base_uri = window.location.origin + "/rsparu/";
}

let socket, $tensiIO, $uname;

getDftTunggu = () => {
    let poli = $('#poli').html();
    $('#dftTunggu ul').find('li').remove().end();
    $.getJSON(base_uri + 'API/tunggu/poli/' + poli, function (json) {
        if (json.metaData.code == 200) {
            tmbhData(json.response.data, json.response.count);
        } else {
            $('#dftTunggu ul').html('<li class="list-group-item list-group-item-warning text-center"><h3>Tidak Ada Antrian</h3></li>');
            setTimeout(function () {
                getDftTunggu();
            }, "2000");
        }
    });
};

tmbhData = (data, count) => {
    var c = 0;
    var str = "";
    var lop = setInterval(function () {
        $('#dftTunggu ul').html("");
        str = '<li class="list-group-item" style="background-color:#E3F2FD;"><h3>'
                + data[c].Nama + " - "
                + data[c].Alamat
                + '</h3></li>' + str;
        if (c <= count - 2) {
            c++;
        } else {
            c = 0;
            clearInterval(lop);
            getDftTunggu();
        }
        $('#dftTunggu ul').html(str);


    }, "2000");
};

panggil = () => {
    var id_poli = $('#id_poli').val();
    $.getJSON(base_uri + 'API/tunggu/poli/panggil/{id_tujuan}', function (json) {
        if (json.metaData.code == 200) {
            var dt = json.response.data[0];
            if (id_poli != dt.id_poli) {
                $('#id_poli').val(dt.id_poli);
                $('#diPanggil').html(dt.nama + " " + dt.alamat);
            }
        } else {
            $('#diPanggil').html("Tidak Ada pasien");
        }
//        setTimeout(function () {
//            panggil();
//        }, "2000");
    });
};



$(document).ready(function () {

    getDftTunggu();

    $uname = $('#uname').val();

    if (window.location.protocol == 'http:') {
        socket = io.connect(window.location.host + ":3001");
        $tensiIO = io.connect(window.location.origin + ":3001/Poli");
    } else {
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
        $('#diPanggil').html(data.str);
    });
});