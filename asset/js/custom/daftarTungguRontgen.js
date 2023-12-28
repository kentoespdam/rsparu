/* global $aliases, base_uri, $name */

cariDaftarTungguRontgen = () => {
    let uri = base_uri + 'Rontgen/DaftarTunggu/showData';
    let tgl = $('#tgl').val();
    let skrng = new Date();
    let hr_skrng = skrng.getDate();
    if (skrng.getDate() < 10) {
        hr_skrng = '0' + skrng.getDate();
    }
    let bln_skrng = skrng.getMonth() + 1;
    if (bln_skrng < 10) {
        bln_skrng = "0" + bln_skrng;
    }
    let tgl_skrng = skrng.getFullYear() + "-" + bln_skrng + "-" + hr_skrng;
    if ($.fn.DataTable.isDataTable('#listDaftarTungguRontgen')) {
        $('#listDaftarTungguRontgen').DataTable().destroy();
    }
    $('#listDaftarTungguRontgen tbody').find('tr').remove().end();
    $('#src_daftarTunggu').removeClass('hidden');
    $.post(uri, {tgl: tgl}, (json) => {
    }, "json").always((json) => {
        if (json.metaData.code === 200) {
            let str = "";
            let str_pnggil = "";
            let selesai = "<label class='label label-primary'>Belum Selesai</label>";
            $.each(json.response.data, (index, t) => {
                if (t.selesai == 1) {
                    selesai = "<label class='label label-success'>Selesai</label>";
                } else {
                    selesai = "<label class='label label-primary'>Belum Selesai</label>";
                }

                if (tgl == tgl_skrng) {
//			  str_pnggil = "<span class='btn btn-success glyphicon glyphicon-volume-up btn-xs' onclick=\"panggil('" + t.norm + "')\" id='panggilPasien'></span>";
                    str_pnggil = "<label class=\"btn btn-xs radio-inline\"><input type=\"checkbox\" name=\"data_panggil[]\" value=\"" + t.norm + "\"></label>";
                } else {
                    str_pnggil = "";
                }

                str = str + "<tr id=\"tr_" + t.norm + "\">"
                        + "<td nowrap>"
                        + str_pnggil
                        + '<div class="btn-group btn-group-xs" role="group" aria-label="Basic example" id="rst">'
                        + "&nbsp; &nbsp;<span class='btn btn-success glyphicon glyphicon-pencil btn-xs' onclick=\"inputRontgen('" + t.notrans + "')\" id='inputPasien'></span>"
                        + "<span class='btn btn-danger glyphicon glyphicon-remove' onclick=\"hapus('" + t.notrans + "','" + t.nama + "');\" id='cetak'></span>"
                        + '</div>'
                        + "</td>"
                        + "<td>" + t.nourut + "</td>"
                        + "<td>" + t.norm + "</td>"
                        + "<td>" + t.noktp + "</td>"
                        + "<td>" + t.kelompok + "</td>"
                        + "<td>" + t.noasuransi + "</td>"
                        + "<td>" + t.nama + "</td>"
                        + "<td>" + t.jeniskel + "</td>"
                        + "<td>" + t.kelurahan + "</td>"
                        + "<td>" + t.kunj + "</td>"
                        + "<td>" + selesai + "</td>"
                        + "</tr>";
            });

            $('#listDaftarTungguRontgen tbody').html(str);
            getTmpPanggil();
        }
        if (!$.fn.DataTable.isDataTable('#listDaftarTungguRontgen')) {
            $('#listDaftarTungguRontgen').DataTable().destroy();
            setTimeout(function () {
                let tbl = $('#listDaftarTungguRontgen').DataTable();
                tbl.order([10, 'asc']).draw();
            }, 100);
        }

        $('#src_daftarTunggu').addClass('hidden');
    });
};

cariDaftarSelesaiRontgen = () => {
    let uri = base_uri + 'Rontgen/DaftarTunggu/showOther';
    let tgl = $('#tgl').val();
    let skrng = new Date();
    let hr_skrng = skrng.getDate();
    if (skrng.getDate() < 10) {
        hr_skrng = '0' + skrng.getDate();
    }
    let bln_skrng = skrng.getMonth() + 1;
    if (bln_skrng < 10) {
        bln_skrng = "0" + bln_skrng;
    }
    let tgl_skrng = skrng.getFullYear() + "-" + bln_skrng + "-" + hr_skrng;
    if ($.fn.DataTable.isDataTable('#listDaftarSelesai')) {
        $('#listDaftarSelesai').DataTable().destroy();
    }
    $('#listDaftarSelesai tbody').find('tr').remove().end();
    $.post(uri, {tgl: tgl}, (json) => {
    }, "json").always((json) => {
        if (json.metaData.code === 200) {
            let str = "";
            let str_pnggil = "";
            let selesai = "<label class='label label-primary'>Belum Selesai</label>";
            $.each(json.response.data, (index, t) => {
                str = str + "<tr id=\"tr_" + t.norm + "\">"
                        + "<td nowrap>"
                        + '&nbsp; &nbsp;<div class="btn-group btn-group-xs" role="group" aria-label="Basic example" id="rst">'
                        + "<span class='btn btn-success glyphicon glyphicon-circle-arrow-left' onclick=\"addRontgen('" + t.notrans + "','" + t.ktujuan + "');\" id='cetak'></span>"
                        + '</div>'
                        + "</td>"
                        + "<td>" + t.nourut + "</td>"
                        + "<td>" + t.norm + "</td>"
                        + "<td>" + t.noktp + "</td>"
                        + "<td>" + t.kelompok + "</td>"
                        + "<td>" + t.noasuransi + "</td>"
                        + "<td>" + t.nama + "</td>"
                        + "<td>" + t.jeniskel + "</td>"
                        + "<td>" + t.kelurahan + "</td>"
                        + "<td>" + t.kunj + "</td>"
                        + "<td>" + t.tujuan + "</td>"
                        + "</tr>";
            });

            $('#listDaftarSelesai tbody').html(str);
        }
        $('#listDaftarSelesai').DataTable();
    });
};

getTmpPanggil = () => {
    let uri = base_uri + "API/panggil/tmp/Poli/poli/" + $name;
    $.getJSON(uri, (json) => {
        if (json.metaData.code == 200) {
            $.each(json.response.data, (index, t) => {
                $('#tr_' + t.norm).removeClass('success');
                $('#tr_' + t.norm).addClass('success');
            });
        }
    });
};

panggil = (data) => {
    let tgl = $('#tgldaftar').val();
    let url = base_uri + "API/panggil/tmp/Poli/addTmp/poli/" + $name;
    $.post(url, data, function (json) {
//	  $tensiIO.emit('panggil',$uname, data);
        if (json.metaData.code === 201) {
            $tensiIO.emit('panggil', $uname, json.response);
            $('[name="data_panggil[]"]').prop('checked', false);
            getTmpPanggil();
        }
    }, "json");
};

play_audio = (data) => {
    let uri_suara;
    let teks = data.str;
    $('#nomer').html(teks);
    if (loc == 'dev-rsparu.kentoes.com') {
        if (window.location.protocol == 'http:') {
            uri_suara = 'http://bkpm.kentoes.com/auahgelap/getvoice.php?teks=' + teks.toLowerCase();
        } else {
            uri_suara = 'https://bkpm.kentoes.com/auahgelap/getvoice.php?teks=' + teks.toLowerCase();
        }
    } else {
        uri_suara = window.location.origin + '/auahgelap/getvoice.php?teks=' + teks.toLocaleLowerCase();
    }
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

    snd.onended = function () {

    };
};

addRontgen = (notrans, ktujuan) => {
    var tanya = confirm('Akan Menambah Data?');
    if (tanya == true) {
        let url = base_uri + "Rontgen/Add";
        $.post(url, {notrans: notrans, ktujuan: ktujuan}, function (json) {
//	  $tensiIO.emit('panggil',$uname, data);
            if (json.metaData.code === 201) {
                $.notify({
                    // options
                    message: json.response.message,
                }, {
                    delay: 5000,
                    timer: 1000,
                    type: 'success'
                });
                $('#ronTab a[href="#iTunggu"]').tab('show');

                cariDaftarRontgen();
            }
        }, "json");
    }
};

hapus = (notrans, nama) => {
    var tanya = confirm('Yakin Akan Menghapus Data ' + nama + '?');
    if (tanya == true) {
        let url = base_uri + "Rontgen/Delete";
        $.post(url, {notrans: notrans}, function (json) {
            var tipe = "success";
            console.log(json.response);
            if (json.metaData.code === 304) {
                tipe = "danger";
            }
            $.notify({
                // options
                message: json.response.message,
            }, {
                delay: 5000,
                timer: 1000,
                type: tipe
            });

            cariDaftarRontgen();
        }, "json");
    }
};

cariDaftarRontgen = () => {
    cariDaftarTungguRontgen();
    cariDaftarSelesaiRontgen();
};

$(document).ready(() => {
    window.onload = function () {
        var context = new AudioContext();
    };

    $('#aliasPoli').val($aliases);

    cariDaftarRontgen();

    $('#frm_panggil').on('submit', () => {
        panggil($('#frm_panggil').serializeArray());
    });
});