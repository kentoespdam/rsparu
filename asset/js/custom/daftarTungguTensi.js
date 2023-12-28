/* global $aliases, $kd_poli, base_uri */
cariDaftarTungguTensi = () => {
    let uri = base_uri + 'Tensi/DaftarTunggu/poli/' + $kd_poli;
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
    if ($.fn.DataTable.isDataTable('#listDaftarTunggu')) {
        $('#listDaftarTunggu').DataTable().destroy();
    }
    $('#listDaftarTunggu tbody').find('tr').remove().end();
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
                        + '&nbsp; &nbsp;<div class="btn-group btn-group-xs" role="group" aria-label="Basic example" id="rst">'
                        + "<span class='btn btn-danger glyphicon glyphicon-pencil btn-xs' onclick=\"input('" + t.notrans + "');\" id='inputPasien'></span>"
                        + "<span class='btn btn-success glyphicon glyphicon-print' onclick=\"cetak('" + t.norm + "');\" id='cetak'></span>"
                        + "<span class='btn btn-warning glyphicon glyphicon-share-alt' onclick=\"pindah('" + t.notrans + "');\" id='pindah'></span>"
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

            $('#listDaftarTunggu tbody').html(str);
            getTmpPanggil();
        }
        if (!$.fn.DataTable.isDataTable('#listDaftarTunggu')) {
            $('#listDaftarTunggu').DataTable().destroy();
            setTimeout(function () {
                let tbl = $('#listDaftarTunggu').DataTable();
                tbl.order([10, 'asc']).draw();
            }, 100);
        }
        $('#src_daftarTunggu').addClass('hidden');
    });
};

cariDaftarSelesaiTensi = () => {
    let uri = base_uri + 'Tensi/DaftarSelesai/poli/' + $kd_poli;
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
                        + "<span class='btn btn-success glyphicon glyphicon-print' onclick=\"cetak('" + t.norm + "');\" id='cetak'></span>"
                        + "<span class='btn btn-warning glyphicon glyphicon-share-alt' onclick=\"pindah('" + t.notrans + "');\" id='pindah'></span>"
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
    let uri = base_uri + "API/panggil/tmp/Poli/poli/" + $aliases;
    $.getJSON(uri, (json) => {
        if (json.metaData.code == 200) {
            $.each(json.response.data, (index, t) => {
                $('#tr_' + t.norm).removeClass('success');
                $('#tr_' + t.norm).addClass('success');
            });
        }
    });
}

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
}

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

cetak = (norm) => {
    window.open(base_uri + "Cetak/RM/norm/" + norm);
    window.open(base_uri + "Cetak/Kartu/norm/" + norm);
    window.open(base_uri + "Cetak/Label/norm/" + norm);
};

pindah = (notrans) => {
    $.getJSON(base_uri + 'Tensi/DaftarTunggu/detail/' + notrans, (json) => {
        if (json.metaData.code == 200) {
            $.each(json.response.data, (i, t) => {
                $('#notrans1').val(t.notrans);
                $('#norm1').val(t.norm);
                $('#nama1').val(t.nama);
                $('#umur1').val(t.umurthn);
                $('#jeniskel1').val(t.jeniskel);
                $('#alamat1').val(t.kelurahan + " RT " + t.rtrw + ", " + t.kecamatan + ", " + t.kabupaten);
                $('#pindahModal').modal('show');
            });
        }
    });
};

cariDaftarTensi = () => {
    cariDaftarTungguTensi();
    cariDaftarSelesaiTensi();
};

do_pindah = () => {
    var notrans = $('#notrans1').val();
    var norm = $('#norm1').val();
    var tuj = $('#tuj').val();

    $.post(base_uri + 'Tensi/Pindah', {notrans: notrans, norm: norm, ktujuan: tuj}, (json) => {
        if (json.metaData.code == 201) {
            $.notify({
                // options
                message: json.response.message,
            }, {
                delay: 5000,
                timer: 1000,
                type: 'success'
            });

            reset_form_tensi();
            cariDaftarTensi();
        } else {
            $.notify({
                // options
                message: json.response.message,
            }, {
                delay: 5000,
                timer: 1000,
                type: 'danger'
            });
        }
        $('#pindahModal').modal('hide');
    }, "json");
};

$(document).ready(() => {
    window.onload = function () {
        var context = new AudioContext();
    };

    $("#ktujuan1").select2();

    $('#aliasPoli').val($aliases);

    cariDaftarTensi();

    $('#frm_panggil').on('submit', () => {
        panggil($('#frm_panggil').serializeArray());
    });

    $('#frmKirim').on('submit', () => {
        do_pindah();
        return false;
    });
});

