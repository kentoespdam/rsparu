inputRontgen = (notrans) => {
    let uri_kunj = base_uri + 'Rontgen/ShowDet/detail/' + notrans;
    $.getJSON(uri_kunj, function (json) {
        if (json.metaData.code == 200) {
            $.each(json.response.dataPasien, (index, t) => {
                reset_form_rontgen();
                $('#nama').html(": " + t.nama);
                $('#jeniskel').html(": " + t.jeniskel);
                $('#ttl').html(": " + t.tmptlahir + ", " + t.tgllahir);
                $('#alamat').html(": " + t.kelurahan + " RT " + t.rtrw + ", " + t.kecamatan + ", " + t.kabupaten);
                $('#umur').html(": " + t.umurthn + " Th " + t.umurbln + " Bln " + t.umurhr + " Hari");
                $('#tgltrans').val(t.tgltrans);
                $('#norm').attr('readonly', 'readonly');
                $('#norm').val(t.norm);
                $('#notrans').val(t.notrans);
                $('#updPoli').val(0);
                $('html, body').animate({
                    scrollTop: $("#frmInputRontgen").offset().top
                }, 1000);
            });

            $.each(json.response.dataRo, (index, t) => {
                if (t.pasienRawat == 1) {
                    $('#pasienRawat1').iCheck('check');
                }

                $('#noreg').val(t.noreg);

                $('#kdKondisiRo').val(t.kdKondisiRo).trigger('change');
                $('#kdFoto').val(t.kdFoto).trigger('change');
                $('#kdFilm').val(t.kdFilm).trigger('change');
                $('#jmlExpose').val(t.jmlExpose);
                $('#jmlFilmDipakai').val(t.jmlFilmDipakai);
                $('#jmlFilmRusak').val(t.jmlFilmRusak);
                $('#kdMesin').val(t.kdMesin).trigger('change');

                if (t.pa == 1) {
                    $('#pa').iCheck('check');
                }
                if (t.ap == 1) {
                    $('#ap').iCheck('check');
                }
                if (t.lateral == 1) {
                    $('#lateral').iCheck('check');
                }
                if (t.obliq == 1) {
                    $('#obliq').iCheck('check');
                }
                $('#catatan').val(t.catatan);
                $('#p_rontgen').val(t.p_rontgen).trigger('change');
                if (t.ktujuan != "") {
                    showTujuan(base_uri + "API/Tujuan/Det/" + t.ktujuan, t.ktujuan);
                } else {
                    showTujuan(base_uri + "API/Tujuan", '');
                }
            });
        }

    });
};

reset_form_rontgen = () => {
    var p_rontgen = $('#p_rontgen').val();

    $('#pasienRawat0').iCheck('check');
    $('#kdKondisiRo').val("").trigger('change');
    $('#kdFoto').val("").trigger('change');
    $('#kdFilm').val("").trigger('change');
    $('#jmlExpose').val(1);
    $('#jmlFilmDipakai').val(1);
    $('#jmlFilmRusak').val(0);
    $('#kdMesin').val("").trigger('change');
    $('#pa').iCheck('uncheck');
    $('#ap').iCheck('uncheck');
    $('#lateral').iCheck('uncheck');
    $('#obliq').iCheck('uncheck');
    $('#ktujuan').find(".optTujuan").remove().end();
    $('#updRontgen').val(0);

    $('#frmInputRontgen').trigger('reset');
    $('#norm').removeAttr('readonly');

    $('#nama').html(": NaN");
    $('#jeniskel').html(": NaN");
    $('#ttl').html(": NaN");
    $('#alamat').html(": NaN");
    $('#umur').html(": NaN");
};

batal = () => {
    reset_form_rontgen();
    $('html, body').animate({
        scrollTop: $("#tungguRontgen").offset().top
    }, 1000);
};

do_simpan = () => {
    $.post(base_uri + 'Rontgen/Simpan', $('#frmInputRontgen').serializeArray(), (json) => {
        if (json.metaData.code == 201) {
            $.notify({
                // options
                message: json.response.message,
            }, {
                delay: 5000,
                timer: 1000,
                type: 'success'
            });

            batal();
            cariDaftarTungguRontgen();
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
};

$(document).ready(() => {
    $('.select2').select2();

    showFotoRontgen();
    showKondisiRontgen();
    showFilmRontgen();
    showMesinRontgen();

    showPetugas();

    $('#frmInputRontgen').on("submit", () => {
        if ($('#jmlFilmRusak').val() > 0 && $('#catatan').val() == "") {
            alert("catatan harus diisi!!!");
        } else {
            do_simpan();
        }
        return false;
    });
});