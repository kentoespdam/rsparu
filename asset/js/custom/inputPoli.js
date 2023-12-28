/* global base_uri */

getRiwayat = (vnorm) => {
    var norm = $('#norm').val();
    if (vnorm != "") {
        norm = vnorm;
    }
    if (!isEmpty(norm)) {
        $.get(base_uri + 'Poli/Riwayat/norm/' + norm, (data) => {
            $('#displayRiwayatModal .modal-dialog .modal-content .modal-body').html(data);
            $('#displayRiwayatModal').modal('show');
        });
    } else {
        alert('No RM tidak ditemukan!!');
    }
};



editPoli = (norm) => {
    let uri_tensi = base_uri + 'Poli/ShowData/norm/' + norm;
    $.getJSON(uri_tensi, function (json) {
        if (json.metaData.code == 200) {
            $.each(json.response.data, (index, t) => {
                reset_form_poli();
                $('#updPoli').val(1);
                $('#nama').html(": " + t.nama);
                $('#jeniskel').html(": " + t.jeniskel);
                $('#ttl').html(": " + t.tmptlahir + ", " + t.tgllahir);
                $('#alamat').html(": " + t.kelurahan + " RT " + t.rtrw + ", " + t.kecamatan + ", " + t.kabupaten);
                $('#umur').html(": " + t.umurthn + " Th " + t.umurbln + " Bln " + t.umurhr + " Hari");
                $('#tgltrans').val(t.tgltrans);
                $('#norm').attr('readonly', 'readonly');
                $('#norm').val(t.norm);
                $('#notrans').val(t.notrans);

                $('#inspeksi').val(t.inspeksi);
                $('#perkusi').val(t.perkusi);
                $('#palpasi').val(t.palpasi);
                $('#auskultasi').val(t.auskultasi);
                $('#spo2').val(t.spo2);
                $('#nebulizer').val(t.nebulizer);
                $('#infus').html(t.infus);
                $('#oksigenasi').val(t.oksigenasi);
                $('#injeksi').html(t.injeksi);
                $('#terapi').html(t.terapi);

                $('#anemis' + t.anemis).iCheck('check');
                $('#cyanosis' + t.cyanosis).iCheck('check');
                $('#dyspneu' + t.dyspneu).iCheck('check');
                $('#stomatitis' + t.stomatitis).iCheck('check');

                if (t.rontgen == 1) {
                    $('#rontgen').iCheck('check');
                }
                if (t.konsul == 1) {
                    $('#konsul').iCheck('check');
                }
                if (t.tcm == 1) {
                    $('#tcm').iCheck('check');
                }
                if (t.bta == 1) {
                    $('#bta').iCheck('check');
                }
                if (t.hematologi == 1) {
                    $('#hematologi').iCheck('check');
                }
                if (t.kimiaDarah == 1) {
                    $('#kimiaDarah').iCheck('check');
                }
                if (t.imunoSerologi == 1) {
                    $('#imunoSerologi').iCheck('check');
                }
                if (t.mantoux == 1) {
                    $('#mantoux').iCheck('check');
                }
                if (t.ekg == 1) {
                    $('#ekg').iCheck('check');
                }
                if (t.mikroCo == 1) {
                    $('#mikroCo').iCheck('check');
                }
                if (t.spirometri == 1) {
                    $('#spirometri').iCheck('check');
                }

                $('#diagnosa1').val(t.diagnosa1).trigger('change');
                $('#diagnosa2').val(t.diagnosa2).trigger('change');
                $('#diagnosa3').val(t.diagnosa3).trigger('change');

                $('#p_admin_poli').val(t.p_admin_poli).trigger('change');
                $('#p_dokter_poli').val(t.p_dokter_poli).trigger('change');
                $('#p_admin_poli_konsul').val(t.p_admin_poli_konsul).trigger('change');
                $('#p_dokter_poli_konsul').val(t.p_dokter_poli_konsul).trigger('change');
                $('#ktujuan').val(t.ktujuan).trigger('change');

                $('html, body').animate({
                    scrollTop: $("#formPoli").offset().top
                }, 1000);

            });
        }
    });
};

reset_form_poli = () => {
    var p_admin_poli = $('#p_admin_poli').val();
    var p_dokter_poli = $('#p_dokter_poli').val();
    $('#updPoli').val(0);

    $('#frmInputPoli').trigger("reset");
    $('#norm').removeAttr('readonly');

    $('#nama').html(": NaN");
    $('#jeniskel').html(": NaN");
    $('#ttl').html(": NaN");
    $('#alamat').html(": NaN");
    $('#umur').html(": NaN");

    $("#ktujuan").val('').trigger('change');
    $("#anemis0").iCheck('check');
    $("#cyanosis0").iCheck('check');
    $("#dyspneu0").iCheck('check');
    $("#stomatitis0").iCheck('check');
    $("#rontgen").iCheck('uncheck');
    $("#tcm").iCheck('uncheck');
    $("#bta").iCheck('uncheck');
    $("#hematologi").iCheck('uncheck');
    $("#kimiaDarah").iCheck('uncheck');
    $("#imunoSerologi").iCheck('uncheck');
    $("#mantoux").iCheck('uncheck');
    $("#ekg").iCheck('uncheck');
    $("#mikroCo").iCheck('uncheck');
    $("#spirometri").iCheck('uncheck');
    $('input[type=radio], input[type=checkbox]').iCheck('update');
    $("#diagnosa1").val('').trigger('change');
    $("#diagnosa2").val('').trigger('change');
    $("#diagnosa3").val('').trigger('change');
    $("#sp02").val('');
    $('#p_admin_poli').val(p_admin_poli).trigger('change');
    $('#p_dokter_poli').val(p_dokter_poli).trigger('change');
    $('#p_admin_poli_konsul').val('').trigger('change');
    $('#p_dokter_poli_konsul').val('').trigger('change');

};

batal = () => {
    reset_form_poli();
    $('html, body').animate({
        scrollTop: $("#box1").offset().top
    }, 1000);
};

inputPoli = (notrans) => {
    let uri_kunj = base_uri + 'Tensi/DaftarTunggu/detail/' + notrans;
    $.getJSON(uri_kunj, function (json) {
        if (json.metaData.code == 200) {
            $.each(json.response.data, (index, t) => {
                reset_form_poli();
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
                    scrollTop: $("#frmInputPoli").offset().top
                }, 1000);

                editPoli(t.norm);
//                show_riwayat(t.norm);
            });
        }

    });
};

makeIndx = () => {
    var arr = $('#frmInputPoli').serializeArray();
    $.each(arr, function (x, t) {
        $('[name=\'' + t.name + '\']').attr('TabIndex', x);
    });
};

do_simpan = () => {
    $.post(base_uri + 'Poli/Simpan', $('#frmInputPoli').serializeArray(), (json) => {
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
            cariDaftarPoli();
        } else if (json.metaData.code == 302) {
            var y = confirm(json.response.message + ", Akan Mengupdate Data?");
            if (y == true) {
                $('#updPoli').val(1);
                do_simpan();
            } else {
                batal();
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
};

$(document).ready(() => {
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
    showDiagnosa();
    reset_form_poli();

    $('#norm').bind("keydown", function (e) {
        if (e.keyCode == 13) {
            editPoli($(this).val());
            e.preventDefault();
            return false;
        }
    });

    $('#bt_norm').on("click", function () {
        editPoli($("#norm").val());
        return false;
    });

    $('#frmInputPoli').on('submit', () => {
        do_simpan();
        return false;
    })
});
