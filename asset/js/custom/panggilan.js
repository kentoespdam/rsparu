//            MENU PANGGIL
$('#panggilBtn').on("click", function () {
    $('#displayModal').modal('toggle');
    var loket = $('#loket').val();
    $('#exampleModalLongTitle').html("Panggil Loket " + loket);
    var url = base_uri + "API/panggil/Loket";

    if ($.fn.DataTable.isDataTable('#lAntri')) {
        $('#lAntri').DataTable().destroy();
    }

    $('#listAntri').find('tr').remove().end();
    $.getJSON(url, function (json) {
        if (json.metaData.code == 200) {
            var str = "";
            $.each(json.response.data, function (index, t) {

                var warna = "";
                var statPanggil = "NORMAL";
                if (parseInt(t.lewati) === 1) {
                    if (parseInt(t.Panggil) === 1) {
                        warna = "success";
                        statPanggil = "di Panggil";
                    } else {
                        warna = "danger";
                        statPanggil = "Lewati";
                    }
                } else {
                    if (parseInt(t.Panggil) === 1) {
                        warna = "success";
                        statPanggil = "di Panggil";
                    }
                }

                str = str + '<tr class="' + warna + '">' +
                        '<td>' + t.NoAntri + '</td>' +
                        '<td>' + t.jenis + '</td>' +
                        '<td>' + t.LOKET + '</td>' +
                        '<td>' + t.Panggil + '</td>' +
                        '<td>' + statPanggil + '</td>' +
                        '<td> <span class="btn btn-primary btn-sm" onclick="panggil(\'' + parseInt(t.NoAntri) + '\',\'' + loket + '\',\'' + t.jenis + '\');" >Panggil</span></td>' +
                        '</tr>';

            });
            $('#listAntri').html(str);
            setTimeout(function () {
                $('#lAntri').DataTable({
                    "order": [[3, "ASC"]]
                });
            }, "1000");

        }
    });
});

function panggil(noAntri, loket, jenis) {
    let $iNoAntri = parseInt(noAntri);
    let tgl = $('#tgldaftar').val();
    let url = base_uri + "API/panggil/tmp/addTmp/noAntri/" + $iNoAntri + "/loket/" + loket;
    $.getJSON(url, function (json) {
        if (json.metaData.code === 201) {
            var str = "upd_data(" + $iNoAntri + ", " + loket + ", '" + jenis + "');";
            $('#displayModal').modal('toggle');
            $('#nourut').val($iNoAntri);
            $('#ulangBtn').removeAttr("onClick");
            $('#ulangBtn').attr("onClick", str);
            $('#norm').focus();
            socket.emit('panggil', {urut: $iNoAntri, loket: loket, jenis: jenis});
        }
    });
}

function upd_data(noAntri, loket, jenis) {
    socket.emit('panggil', {urut: noAntri, loket: loket, jenis: jenis});
}

function lewati() {
    var noAntri = $("#nourut").val();
    var tgl = $('#tgldaftar').val();
    var dob = new Date(tgl);
    nTgl = dob.getFullYear() + "-" + parseInt(dob.getMonth() + 1) + "-" + dob.getDate();
    if (noAntri !== "") {
        $.getJSON(base_uri + "API/panggil/tmp/lewati/" + noAntri + "/tanggal/" + nTgl, function (json) {
            $("#nourut").val("");
        });
    }
}