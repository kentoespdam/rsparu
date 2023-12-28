function reset_form_riwayat() {
    $('#ins_rw').val(0);
    $('#cacatFisikKet').attr('disabled', 'disabled');
    $('#alatBantuKet').attr('disabled', 'disabled');
    $('#pengoTBtahun').attr('disabled', 'disabled');
    $('#pengoTBlama').attr('disabled', 'disabled');
    $('#pengoTBtempat').attr('disabled', 'disabled');
    $('#penyKeluargaKet').attr('disabled', 'disabled');
    $('#alergiKet').attr('disabled', 'disabled');
    $('#alergiReaksi').attr('disabled', 'disabled');
    $('#operasiJenis').attr('disabled', 'disabled');
    $('#operasiTahun').attr('disabled', 'disabled');
    $('#operasiTempat').attr('disabled', 'disabled');
    $('#rokokKet').attr('disabled', 'disabled');
    $('#alkoholKet').attr('disabled', 'disabled');
    $('#obatKet').attr('disabled', 'disabled');

    $('#cacatFisikKet').val('');
    $('#alatBantuKet').val('');
    $('#pengoTBtahun').val('');
    $('#pengoTBlama').val('');
    $('#pengoTBtempat').val('');
    $('#penyKeluargaKet').val('');
    $('#alergiKet').val('');
    $('#alergiReaksi').val('');
    $('#operasiJenis').val('');
    $('#operasiTahun').val('');
    $('#operasiTempat').val('');
    $('#rokokKet').val('');
    $('#alkoholKet').val('');
    $('#obatKet').val('');
    $('#kerja').val('');

    $('#cacatFisik0').iCheck('check');
    $('#alatBantu0').iCheck('check');
    $('[name="penyDahulu[]"]').iCheck('uncheck');
    $('#penyDahulu0').iCheck('check');
    $('#pengoTB0').iCheck('check');
    $('#penyKeluarga0').iCheck('check');
    $('#alergi0').iCheck('check');
    $('#operasi0').iCheck('check');
    $('#rokok0').iCheck('check');
    $('#alkohol0').iCheck('check');
    $('#obat0').iCheck('check');

    $('#frmRiwayat').trigger('reset');
}

function show_riwayat(norm) {
    $.getJSON(base_uri + 'Riwayat/norm/' + norm, function (json) {
        if (json.metaData.code == 200) {
            $.each(json.response.data, function (index, t) {
                $('#f_riwayat').val(1);
                $('#ins_rw').val(1);
                $('#rw_norm').val(norm);
                if (t.cacatFisik == 1) {
                    $('#cacatFisik1').iCheck('check');
                }
                $("#cacatFisikKet").val(t.cacatFisikKet);
                if (t.alatBantu == 1) {
                    $("#alatBantu1").iCheck('check');
                }
                $("#alatBantuKet").val(t.alatBantuKet);
                var arrPenyDahulu = t.penyDahulu.split(",");
                for (var i = 0; i < arrPenyDahulu.length; i++) {
                    $("#penyDahulu" + arrPenyDahulu[i]).iCheck('check');
                }
                $("#penyLain").val(t.penyLain);
                if (t.pengoTB == 1) {
                    $("#pengoTB1").iCheck('check');
                }
                $("#pengoTBtahun").val(t.pengoTBtahun);
                $("#pengoTBlama").val(t.pengoTBlama);
                $("#pengoTBtempat").val(t.pengoTBtempat);
                $("#pengoLain").val(t.pengoLain);
                if (t.penyKeluarga == 1) {
                    $("#penyKeluarga1").iCheck('check');
                }
                $("#penyKeluargaKet").val(t.penyKeluargaKet);
                if (t.alergi == 1) {
                    $("#alergi1").iCheck('check');
                }
                $("#alergiKet").val(t.alergiKet);
                $("#alergiReaksi").val(t.alergiReaksi);
                if (t.operasi == 1) {
                    $("#operasi1").iCheck('check');
                }
                $("#operasiJenis").val(t.operasiJenis);
                $("#operasiTahun").val(t.operasiTahun);
                $("#operasiTempat").val(t.operasiTempat);
                if (t.rokok == 1) {
                    $("#rokok1").iCheck('check');
                }
                $("#rokokKet").val(t.rokokKet);
                if (t.alkohol == 1) {
                    $("#alkohol1").iCheck('check');
                }
                $("#alkoholKet").val(t.alkoholKet);
                if (t.obat == 1) {
                    $("#obat1").iCheck('check');
                }
                $("#obatKet").val(t.obatKet);
                $("#kerja").val(t.kerjaKet);
            });
        } else {
            $('#rw_norm').val(norm);
        }
    });
}

$(document).ready(function () {
    reset_form_riwayat();

    $('#cacatFisik1').on('ifChecked', (event) => {
        $('#cacatFisikKet').removeAttr('disabled');
    });
    $('#cacatFisik1').on('ifUnchecked', (event) => {
        $('#cacatFisikKet').attr('disabled', 'disabled');
    });

    $('#alatBantu1').on('ifChecked', (event) => {
        $('#alatBantuKet').removeAttr('disabled');
    });
    $('#alatBantu1').on('ifUnchecked', (event) => {
        $('#alatBantuKet').attr('disabled', 'disabled');
    });

    $('#pengoTB1').on('ifChecked', (event) => {
        $('#pengoTBtahun').removeAttr('disabled');
        $('#pengoTBlama').removeAttr('disabled');
        $('#pengoTBtempat').removeAttr('disabled');
    });
    $('#pengoTB1').on('ifUnchecked', (event) => {
        $('#pengoTBtahun').attr('disabled', 'disabled');
        $('#pengoTBlama').attr('disabled', 'disabled');
        $('#pengoTBtempat').attr('disabled', 'disabled');
    });

    $('#penyKeluarga1').on('ifChecked', (event) => {
        $('#penyKeluargaKet').removeAttr('disabled');
    });
    $('#penyKeluarga1').on('ifUnchecked', (event) => {
        $('#penyKeluargaKet').attr('disabled', 'disabled');
    });

    $('#alergi1').on('ifChecked', (event) => {
        $('#alergiKet').removeAttr('disabled');
        $('#alergiReaksi').removeAttr('disabled');
    });
    $('#alergi1').on('ifUnchecked', (event) => {
        $('#alergiKet').attr('disabled', 'disabled');
        $('#alergiReaksi').attr('disabled', 'disabled');
    });

    $('#operasi1').on('ifChecked', (event) => {
        $('#operasiJenis').removeAttr('disabled');
        $('#operasiTahun').removeAttr('disabled');
        $('#operasiTempat').removeAttr('disabled');
    });
    $('#operasi1').on('ifUnchecked', (event) => {
        $('#operasiJenis').attr('disabled', 'disabled');
        $('#operasiTahun').attr('disabled', 'disabled');
        $('#operasiTempat').attr('disabled', 'disabled');
    });

    $('#rokok1').on('ifChecked', (event) => {
        $('#rokokKet').removeAttr('disabled');
    });
    $('#rokok1').on('ifUnchecked', (event) => {
        $('#rokokKet').attr('disabled', 'disabled');
    });

    $('#alkohol1').on('ifChecked', (event) => {
        $('#alkoholKet').removeAttr('disabled');
    });
    $('#alkohol1').on('ifUnchecked', (event) => {
        $('#alkoholKet').attr('disabled', 'disabled');
    });

    $('#obat1').on('ifChecked', (event) => {
        $('#obatKet').removeAttr('disabled');
    });
    $('#obat1').on('ifUnchecked', (event) => {
        $('#obatKet').attr('disabled', 'disabled');
    });

    $('#frmRiwayat').on('submit', function () {
        if ($('#rw_norm').val() !== "") {
            var smpn = $.post(base_uri + 'Riwayat/Simpan', $('#frmRiwayat').serializeArray(), (json) => {
                var tp = "succes";
                if (json.metaData.code == 201) {
                    tp = "success";
                    $('#f_riwayat').val('1');
                    $('#myTabs a[href="#iTensi"]').tab('show');
                    $('html, body').animate({
                        scrollTop: $("#formTensi").offset().top
                    }, 1000);
                } else {
                    tp = 'danger';
                }
                $.notify({
                    // options
                    message: json.response.message,
                }, {
                    delay: 5000,
                    timer: 1000,
                    type: tp
                });
            }, "json");
        }

        return false;
    });
});