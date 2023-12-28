/* global $aliases, base_uri, uri_suara */

cariDaftarTungguPoli = () => {
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
    if ($.fn.DataTable.isDataTable('#listDaftarTungguPoli')) {
        $('#listDaftarTungguPoli').DataTable().destroy();
    }
    $('#listDaftarTungguPoli tbody').find('tr').remove().end();
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
                        + "&nbsp; &nbsp;<span class='btn btn-danger glyphicon glyphicon-pencil btn-xs' onclick=\"inputPoli('" + t.notrans + "')\" id='inputPasien'></span>"
                        + "<span class='btn btn-success glyphicon glyphicon-print' onclick=\"cetak('" + t.norm + "');\" id='cetak'></span>"
                        + "<span class='btn btn-warning glyphicon glyphicon-share-alt btn-xs' onclick=\"pindah('" + t.notrans + "');\" id='pindah'></span>"
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

            $('#listDaftarTungguPoli tbody').html(str);
            getTmpPanggil();
        }
        if (!$.fn.DataTable.isDataTable('#listDaftarTungguPoli')) {
            $('#listDaftarTungguPoli').DataTable().destroy();
            setTimeout(function () {
                let tbl = $('#listDaftarTungguPoli').DataTable();
                tbl.order([10, 'asc']).draw();
            }, 100);
        }

        $('#src_daftarTunggu').addClass('hidden');
    });
};

cariDaftarSelesaiPoli = () => {
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
                        + "<span class='btn btn-success glyphicon glyphicon-folder-open' onclick=\"getRiwayat('" + t.norm + "');\" id='cetak'></span>"
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

cetak = (norm) => {
    // window.open(base_uri + "Cetak/RM/norm/" + norm);
    // window.open(base_uri + "Cetak/Kartu/norm/" + norm);
    window.open(base_uri + "Cetak/Label/norm/" + norm);
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

cariDaftarPoli = () => {
    cariDaftarTungguPoli();
    cariDaftarSelesaiPoli();
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

            cariDaftarPoli();
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

    $('#aliasPoli').val($aliases);

    cariDaftarPoli();

    $('#frm_panggil').on('submit', () => {
        panggil($('#frm_panggil').serializeArray());
    });

    $('#frmKirim').on('submit', () => {
        do_pindah();
        return false;
    });
});