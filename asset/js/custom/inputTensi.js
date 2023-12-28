/* global base_uri */

function input(notrans) {
    let uri_kunj = base_uri + 'Tensi/DaftarTunggu/detail/' + notrans;
    $.getJSON(uri_kunj, function (json) {
        if (json.metaData.code == 200) {
            $.each(json.response.data, (index, t) => {
                $('#nama').html(": " + t.nama);
                $('#jeniskel').html(": " + t.jeniskel);
                $('#ttl').html(": " + t.tmptlahir + ", " + t.tgllahir);
                $('#alamat').html(": " + t.kelurahan + " RT " + t.rtrw + ", " + t.kecamatan + ", " + t.kabupaten);
                $('#umur').html(": " + t.umurthn + " Th " + t.umurbln + " Bln " + t.umurhr + " Hari");
                $('#tgltrans').val(t.tgltrans);
                $('#norm').attr('readonly', 'readonly');
                $('#norm').val(t.norm);
                $('#notrans').val(t.notrans);
                $('html, body').animate({
                    scrollTop: $("#formTensi").offset().top
                }, 1000);

                edit(t.norm)
                show_riwayat(t.norm);
            });
        }

    });
}

function edit(norm) {
    let uri_tensi = base_uri + 'Tensi/ShowData/norm/' + norm;
    $.getJSON(uri_tensi, function (json) {
        if (json.metaData.code == 200) {
            $.each(json.response.data, (index, t) => {
                show_riwayat(t.norm);
                $('#nama').html(": " + t.nama);
                $('#jeniskel').html(": " + t.jeniskel);
                $('#ttl').html(": " + t.tmptlahir + ", " + t.tgllahir);
                $('#alamat').html(": " + t.kelurahan + " RT " + t.rtrw + ", " + t.kecamatan + ", " + t.kabupaten);
                $('#umur').html(": " + t.umurthn + " Th " + t.umurbln + " Bln " + t.umurhr + " Hari");
                $('#tgltrans').val(t.tgltrans);
                $('#norm').attr('readonly', 'readonly');
                $('#norm').val(t.norm);
                $('#notrans').val(t.notrans);
                $('html, body').animate({
                    scrollTop: $("#formTensi").offset().top
                }, 1000);

                $('#smbrData' + t.smbrData).iCheck('check')
                $('#statRujuk' + t.statRujuk).iCheck('check');
                $('#hilangBB3Bln' + t.hilangBB3Bln).iCheck('check');
                $('#turunAsupMkn' + t.turunAsupMkn).iCheck('check');
                $('#psiko' + t.psiko).iCheck('check');
                $('#batukDahak' + t.batukDahak).iCheck('check');
                $('#batukDarahKualitas' + t.batukDarahKualitas).iCheck('check');
                $('#nyeriDadaLok' + t.nyeriDadaLok).iCheck('check');
                var arrDemamWaktuPagi = t.demamWaktuPagi.split(",");
                for (var i = 0; i < arrDemamWaktuPagi.length; i++) {
                    $("#demamWaktuPagi" + arrDemamWaktuPagi[i]).iCheck('check');
                }

                $('#ketSmbrData').val(t.ketSmbrData);
                $('#hubSmbrData').val(t.hubSmbrData);
                $('#ketStatRujuk').val(t.ketStatRujuk);
                $('#td').val(t.td);
                $('#fnadi').val(t.fnadi);
                $('#suhu').val(t.suhu);
                $('#fnafas').val(t.fnafas);
                $('#bb').val(t.bb);
                $('#tb').val(t.tb);
                $('#otherPsiko').val(t.otherPsiko);
                $('#hasilPeriksaSebelumnya').html(t.hasilPeriksaSebelumnya);
                $('#batuk').val(t.batuk);
                $('#batukDarah').val(t.batukDarah);
                $('#sesak').val(t.sesak);
                $('#sesakSuara').val(t.sesakSuara);
                $('#nyeriDada').val(t.nyeriDada);
                $('#demam').val(t.demam);
                $('#keluhanLain').val(t.keluhanLain);
                $('#p_admin_tensi').val(t.p_admin_tensi).trigger('change');
                $('#p_perawat_tensi').val(t.p_perawat_tensi).trigger('change');
                $('#ktujuan').val(t.ktujuan).trigger('change');
            });
        }
//        else {
//            alert('Data tidak ditemukan!!!');
//            reset_form_tensi();
//        }
    });
}

function reset_form_tensi() {
    var p_admin_tensi = $('#p_admin_tensi').val();
    var p_perawat_tensi = $('#p_perawat_tensi').val();
    $('#updTensi').val(0);
    $('#ketSmbrData').attr('disabled', 'disabled');
    $('#hubSmbrData').attr('disabled', 'disabled');
    $('#ketStatRujuk').attr('disabled', 'disabled');
    $('#otherPsiko').attr('disabled', 'disabled');

    $('#frmTensi').trigger("reset");
    $('#norm').removeAttr('readonly');

    $('#nama').html(": NaN");
    $('#jeniskel').html(": NaN");
    $('#ttl').html(": NaN");
    $('#alamat').html(": NaN");
    $('#umur').html(": NaN");

    $("#ktujuan").val('').trigger('change');
//    $('#smbrData0').prop('check', true);
    $('#smbrData0').iCheck('check');
    $('#statRujuk0').iCheck('check');
    $('#hilangBB3Bln0').iCheck('check');
    $('#turunAsupMkn0').iCheck('check');
    $('#psiko0').iCheck('check');
    $('#batukDahak0').iCheck('check');
    $('#batukDarahKualitas3').iCheck('check');
    $('#sesakSuara').val('Vesikular (normal)').trigger('change');
    $('#nyeriDadaLok3').iCheck('check');
    $('[name=demamWaktuPagi]').iCheck('uncheck');
    $('input[type=radio], input[type=checkbox]').iCheck('update');
    $('#p_admin_tensi').val('').trigger('change');
    $('#p_perawat_tensi').val('').trigger('change');
    $('#f_riwayat').val('0');
    reset_form_riwayat();
    $('html, body').animate({
        scrollTop: $("#tungguTensi").offset().top
    }, 1000);
}

function makeIndx() {
    var arr = $('#frmTensi').serializeArray();
    $.each(arr, function (x, t) {
        $('[name=\'' + t.name + '\']').attr('TabIndex', x);
    });
}

function do_simpan() {
    var smpn = $.post(base_uri + 'Tensi/Simpan', $('#frmTensi').serializeArray(), (json) => {
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
        } else if (json.metaData.code == 302) {
            var y = confirm(json.response.message + ", Akan Mengupdate Data?");
            if (y == true) {
                $('#updTensi').val(1);
                do_simpan();
            } else {
                reset_form_tensi();
            }
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
    }, "json");
}

$(document).ready(function () {
    //    Setting Jam
    setInterval(function () {
        var jam = new Date();
        var j = jam.getHours();
        if (j < 10) {
            j = "0" + j;
        }
        var m = jam.getMinutes();
        if (m < 10) {
            m = "0" + m;
        }
        var d = jam.getSeconds();
        if (d < 10) {
            d = "0" + d;
        }
        $('#jamdaftar').val(j + ":" + m + ":" + d);
    }, 1000);

    makeIndx();

    showTujuan(base_uri + "API/Tujuan", '');
    showPetugas();
    reset_form_tensi();

    $('#smbrData1').on('ifChecked', (event) => {
        $('#ketSmbrData').removeAttr('disabled');
        $('#hubSmbrData').removeAttr('disabled');
    });
    $('#smbrData1').on('ifUnchecked', (event) => {
        $('#ketSmbrData').attr('disabled', 'disabled');
        $('#hubSmbrData').attr('disabled', 'disabled');
    });
    $('#statRujuk1').on('ifChecked', (event) => {
        $('#ketStatRujuk').removeAttr('disabled');
    });
    $('#statRujuk1').on('ifUnchecked', (event) => {
        $('#ketStatRujuk').attr('disabled', 'disabled');
    });
    $('#psiko3').on('ifChecked', (event) => {
        $('#otherPsiko').removeAttr('disabled');
    });
    $('#psiko3').on('ifUnchecked', (event) => {
        $('#otherPsiko').attr('disabled', 'disabled');
    });

    $(".select2").select2();

    $('#norm').bind("keydown", function (e) {
        if (e.keyCode == 13) {
            edit($(this).val());
            e.preventDefault();
            return false;
        }
    });

    $('#find_norm').on('click',() => {
        edit($('#norm').val());
    });

    $('#frmTensi').on('submit', function () {
        var bl = false;
        if ($('#f_riwayat').val() == 0) {
            var x = confirm('Riwayat belum ada!, akan lanjut menyimpan??');
            if (x == true) {
//		    do_simpan();
            }
        } else {
            do_simpan();
        }
        return false;
    });

    $('input[type=text]').on("keydown", function (e) {
        var keyCode = e.keyCode;
        if (keyCode === 13) {
            var ind = parseInt($(this).attr('tabindex')) + 1;
            $('#frmTensi').find('[tabindex=' + ind + ']').focus();
        }
    });
});

