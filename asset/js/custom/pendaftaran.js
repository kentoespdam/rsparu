/* global base_uri */

function reset_form() {
    var loket = $('#loket').val();
    var petugas = $('#p_loket').val();
    $('#frm')[0].reset();

    $('#stat_tb').removeAttr('style');
    $('#stat_tb span').removeAttr('style');
    $('#stat_tb span').html('NTB');

    $('#kkecamatan').val('').trigger("change");
    $('#kkabupaten').val('').trigger("change");

    var sKelompok = showKelompok(base_uri + "API/kelompok", null);
    sKelompok.always(function () {
        $('#kdAgama').val("1").trigger("change");
        $('#kdPendidikan').val("1").trigger("change");
    });
    $('#nohp').attr('type', 'text');

    $('#statKawin').val('').trigger("change");
    $('#ktujuan').val('').trigger("change");
    $('#updKunj').val(0);
    $('#bt_grup').hide();
    $('#rst').show();
    $('#src_data_pas').hide();
    autoSelect('loket', loket);
    autoSelect('p_loket', petugas);
    $('#norm').focus();
}

function genNoRm() {
    var url = base_uri + "API/daftar/generateNoRm";
    $.getJSON(url, function (json) {
        if (json.metaData.code == 200) {
            $('#norm').val(json.response.norm);
            $('#normd').val(json.response.normd);
            $('#normb').val(json.response.normb);
        }
    });
}

function findKominfo(){
	console.log("cari kominfo");
};

function findData(val) {
    $('#' + val.replace('.', '')).css("background-color", "blue");
    $('#' + val.replace('.', '')).css("color", "white");
    var b = val.split("_");
    var uri = "";
    if (b[0] == "rmlama") {
        uri = base_uri + 'API/daftar/pasien/norm/old';
    } else {
        uri = base_uri + 'API/daftar/pasien/norm/new';
    }

    if (b[0] == "rmlama" || b[0] == "norm") {
        $.post(uri, {norm: b[1]}, function (json) {
            if (json.metaData.code == 200) {
                set_form(b[0], json.response.data[0], "");
            }
        }, "json");
    } else {
        $.post(uri, {norm: val}, function (json) {
            if (json.metaData.code == 200) {
                set_form("", json.response.data[0], "cetak");
            }
        }, "json");
    }
}

function findBy(field, data) {
    uri = base_uri + 'API/daftar/pasien/by';
    $.post(uri, {field: field, data: data}, function (json) {
        if (json.metaData.code == 200) {
            set_form(field, json.response.data[0], "");
        } else {
            alert('Data tidak ditemukan');
        }
    }, "json");
}

checkTB = (norm) => {
    // console.log('checkTB ' + norm);
    uri = base_uri + 'API/daftar/pasienTB';
    var xx = false;
    $.post(uri, {norm: norm}, function (json) {
        if (json.metaData.code == 200) {
            $('#stat_tb').css('background-color', 'red');
            $('#stat_tb span').css('color', 'white');
            if(json.response.data[0].jenisTb=='SO'){
                $('#stat_tb span').html('TB');
            }else if(json.response.data[0].jenisTb=='MDR'){
				alert('MDR');
                $('#stat_tb span').html('MDR');
            }
            $('#ktujuan').val('10').trigger('change');
        } else {
            $('#stat_tb').removeAttr('style');
            $('#stat_tb span').removeAttr('style');
            $('#stat_tb span').html('NTB');
            $('#ktujuan').val('1').trigger('change');
        }
    }, "json");
};

function set_form(tag, data, cetak) {
    var uri = base_uri;

    $('#norm').val(data.norm);
    $('#rmlama').val(data.rmlama);
    autoSelect('kkelompok', data.kkelompok);
    $('#kkelompok').trigger("change");
    autoSelect('kunj', data.kunj);
    $('#noasuransi').val(data.noasuransi);
    $('#noktp').val(data.noktp);
    $('#nama').val(data.nama);
    $('#alamat').val(data.alamat);
    if (tag == "rmlama") {
        autoSelectLike("kkabupaten", data.kkabupaten);
        var sKab = showKabupaten(base_uri, $('#kkabupaten').val());
        sKab.always(function () {
            setTimeout(function () {
                autoSelectLike('kkecamatan', data.kkecamatan);
                var sKec = showKecamatan(base_uri, $('#kkabupaten').val(), $('#kkecamatan').val());
                sKec.always(function () {
                    setTimeout(function () {
                        autoSelectLike('kkelurahan', data.kkelurahan);
                        $('#kkelurahan').select2().trigger('change');
                    }, 1000);
                });
            }, 1000);
        });
    } else {
        var sProv = showProvinsi(base_uri, data.kprovinsi);
        sProv.always(function () {
            setTimeout(function () {
                var sKab = showKabupaten(base_uri, data.kkabupaten);
                sKab.always(function () {
                    setTimeout(function () {
                        var sKec = showKecamatan(base_uri, data.kkabupaten, data.kkecamatan);
                        sKec.always(function () {
                            setTimeout(function () {
                                var sKel = showKelurahan(base_uri, data.kkecamatan, data.kkelurahan);
                            }, 100);
                        });
                    }, 100);
                });
            }, 100);
        });
    }
    $('#rtrw').val(data.rtrw);
    autoSelect('jeniskel', data.jeniskel);
    $('#kdAgama').select2().val(data.kdAgama).trigger("change");
    $('#kdPendidikan').val(data.kdPendidikan).trigger("change");
    if (data.nohp != "") {
        $('#nohp').attr('type', 'password');
    }
    $('#nohp').val(data.nohp);
    $('#tmptlahir').val(data.tmptlahir);
    $('#tgllahir').val(data.tgllahir);
    src_umur();
    $('#statKawin').val(data.statKawin).trigger('change');
    $('#pekerjaan').val(data.pekerjaan);
    $('#pjwb').val(data.pjwb);
    $('#ibuKandung').val(data.ibuKandung);
    autoSelect("goldarah", data.goldarah);
    $('#sts_pasien').val(1);
    $('#bt_grup').show();
    $('#rst').hide();

    checkTB(data.norm);
}

function cariData(param) {
    $('#src_data_pas').show();
    $('#listPasien tbody').find('tr').remove().end();
    var uriNew = base_uri + "API/daftar/pasien/new";
    var uriOld = base_uri + "API/daftar/pasien/old";
    if (param == "norm") {
        uriNew = base_uri + "API/daftar/pasien/norm/old/new";
        uriOld = base_uri + "API/daftar/pasien/norm/old";
    }
    var fnama = $('#fnama').val();
    var fdesa = $('#fdesa').val();
    var fkecamatan = $('#fkecamatan').val();
    var fkabupaten = $('#fkabupaten').val();
    var frmlama = $('#frmlama').val();
    var str = "";
    $.post(uriNew, {
        fnama: fnama,
        fdesa: fdesa,
        fkecamatan: fkecamatan,
        fkabupaten: fkabupaten,
        norm: frmlama,
    }, function (json) {
        if (json.metaData.code == 200) {
            var str1 = "";
            $.each(json.response.data, function (index, d) {
                str = str + "<tr style='color:blue;' id='norm_" + d.norm.replace('.', '') + "'>"
                        + "<td nowrap><span class='glyphicon glyphicon-eye-open' ondblclick=findData('norm_" + d.norm + "') id='trListPasien'></span></td>"
                        + "<td nowrap>" + d.norm + "</td>"
                        + "<td nowrap>" + d.rmlama + "</td>"
                        + "<td nowrap>" + d.nama + "</td>"
                        + "<td nowrap>" + d.jeniskel + "</td>"
                        + "<td nowrap>" + d.kkelurahan + "</td>"
                        + "<td nowrap>" + d.kkecamatan + "</td>"
                        + "<td nowrap>" + d.kkabupaten + "</td>"
                        + "<td nowrap>" + d.noktp + "</td>"
                        + "<td nowrap>" + d.noasuransi + "</td>"
                        + "</tr>";
            });
        }
    }, "json").always(function () {
        $.post(uriOld, {
            fnama: fnama,
            fdesa: fdesa,
            fkecamatan: fkecamatan,
            fkabupaten: fkabupaten,
            norm: frmlama,
        }, function (json) {
            if (json.metaData.code == 200) {
                $.each(json.response.data, function (index, d) {
                    str = str + "<tr id='rmlama_" + d.rmlama.replace('.', '') + "'>"
                            + "<td nowrap><span class='glyphicon glyphicon-eye-open' ondblclick=findData('rmlama_" + d.rmlama + "') id='trListPasien'></span></td>"
                            + "<td nowrap></td>"
                            + "<td nowrap>" + d.rmlama + "</td>"
                            + "<td nowrap>" + d.nama + "</td>"
                            + "<td nowrap>" + d.jeniskel + "</td>"
                            + "<td nowrap>" + d.kkelurahan + "</td>"
                            + "<td nowrap>" + d.kkecamatan + "</td>"
                            + "<td nowrap>" + d.kkabupaten + "</td>"
                            + "<td nowrap>" + d.noktp + "</td>"
                            + "<td nowrap>" + d.noasuransi + "</td>"
                            + "</tr>";
                });
            }
        }, "json").always(function () {
            set_table(str);
            $('#src_data_pas').hide();
        });
    });
}

function set_table(str) {
    $('#listPasien').DataTable().destroy();
    $('#listPasien tbody').html(str);
    $('#listPasien').DataTable({
        'paging': true,
        "scrollX": true,
        "order": [[0, "desc"]]
    });
}

function updateData() {
    var smpn = $.post(base_uri + "Pendaftaran/Update",
            $('#frm').serializeArray()
            , function (json) {
                if (json.metaData.code == 201) {
                    $.notify({
                        // options
                        message: json.response.message + ", <span findData(\'norm_" + json.response.norm + "'); >" + json.response.norm + "</span>",
                    }, {
                        delay: 5000,
                        timer: 1000,
                        type: 'success'
                    });

                    var x = confirm("Cetak Kartu?");
                    if (x == true) {
                        $('#norm').val(json.response.norm);
                        cetak();
                        $('#bt_grup').show();
                        $('#rst').hide();
                    }
                    reset_form();
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
            }
    , "json");
    smpn.always(function (data) {});
}

function cetak() {
    var norm = $('#norm').val();
    window.open(base_uri + "Cetak/RM/norm/" + norm);
    //window.open(base_uri + "Cetak/Kartu/norm/" + norm);
    window.open(base_uri + "Cetak/Label/norm/" + norm);
}

toglePass = () => {
    var x = document.getElementById("nohp");
    if (x.type === 'text') {
        x.type = 'password';
    } else {
        x.type = 'text';
    }
};

$(document).ready(function () {
    $('#listPasien').DataTable({
        'paging': true,
        "scrollX": true,
        "order": [[0, "desc"]]
    });

    $('.select2').select2();

    $('#bt_grup').hide();
    $('#rst').show();

    $('#src_data_pas').hide();
    $('#fnama').bind("keydown", function (e) {
        if (e.keyCode == 13) {
            cariData();
        }
    });
    $('#fdesa').bind("keydown", function (e) {
        if (e.keyCode == 13) {
            cariData();
        }
    });
    $('#fkecamatan').bind("keydown", function (e) {
        if (e.keyCode == 13) {
            cariData();
        }
    });
    $('#fkabupaten').bind("keydown", function (e) {
        if (e.keyCode == 13) {
            cariData();
        }
    });
    $('#frmlama').bind("keydown", function (e) {
        if (e.keyCode == 13) {
            cariData('norm');
        }
    });

    var sPetugas = showPetugas();
    var sAgama = showAgama(base_uri + "API/Agama", null);
    sAgama.always(function () {
        var sPendidikan = showPendidikan(base_uri + "API/Pendidikan", "");
        sPendidikan.always(function () {
            var sTujuan = showTujuan(base_uri + "API/Tujuan", "0");
            sTujuan.always(function () {
                setTimeout(function () {
                    var sProv = showProvinsi(base_uri, "");
                    sProv.always(function () {
                        $('#kprovinsi').val('33').trigger('change');
                    });
                }, 100);
            });
        });
    });

    reset_form();

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


//    Event
    $('#kkelompok').select2().on("change", function () {
        var cv = $('#kkelompok').val();
        sKelompok = showKelompok(base_uri + "API/kelompok", cv);
    });

    $('#kprovinsi').on("change", function () {
        setTimeout(function () {
            showKabupaten(base_uri, "");
            $('#kkecamatan').find('.optKec').remove().end();
            $('#kkelurahan').find('.optKel').remove().end();
        }, 100);
    });

    $('#kkabupaten').on("change", function () {
        setTimeout(function () {
            showKecamatan(base_uri, $('#kkabupaten').val(), "");
            $('#kkecamatan').val("").trigger("change");
        }, 100);
    });

    $('#kkecamatan').on("change", function () {
        setTimeout(function () {
            showKelurahan(base_uri, $('#kkecamatan').val(), "");
        }, 100);
    });

    $('#norm').bind("keydown", function (e) {
        if (e.keyCode == 13) {
            findData("norm_" + $(this).val());
            e.preventDefault();
            return false;
        }
    });

    $('#find_norm').on("click", function (e) {
        findData("norm_" + $('#norm').val());
    });

    $('#noktp').bind("keydown", function (e) {
        if (e.keyCode == 13) {
            findBy("noktp", $(this).val());
            e.preventDefault();
            return false;
        }
    });

    $('#find_noktp').on("click", function (e) {
        findBy("noktp", $('#noktp').val());
    });

    $('#noasuransi').bind("keydown", function (e) {
        if (e.keyCode == 13) {
            findBy("noasuransi", $(this).val());
            e.preventDefault();
            return false;
        }
    });

    $('#find_noasuransi').on("click", function (e) {
        findBy("noasuransi", $('#noasuransi').val());
    });

    $('#nourut').bind("keydown", function (e) {
        if (e.keyCode == 13) {
            $('#frm').submit();
        }
    });

    $('#frm').on("submit", function () {
        if ($('#nourut').val() == "") {
            alert('Nomor Urut Belum Di ISI!!!');
            return false;
        } else {
            if ($('#ktujuan').val() == "") {
                alert('Pilih Tujuan!!!');
                $('#ktujuan').focus();
                return false;
            } else {
                var smpn = $.post(base_uri + "Pendaftaran/Simpan", $('#frm').serializeArray(), function (json) {
                    if (json.metaData.code == 201) {
                        $.notify({
                            // options
                            message: json.response.message + ", <span findData(\'norm_" + json.response.norm + "'); >" + json.response.norm + "</span>",
                        }, {
                            delay: 5000,
                            timer: 1000,
                            type: 'success'
                        });
                        $('#ulangBtn').removeAttr("onClick");

                        var x = confirm("Cetak Kartu?");
                        if (x == true) {
                            $('#norm').val(json.response.norm);
                            cetak();
                            $('#bt_grup').show();
                            $('#rst').hide();
                        }
                        reset_form();
                    } else if (json.metaData.code == 302) {
                        var y = confirm(json.response.message + ", Akan Mengupdate Data?");
                        if (y == true) {
                            $('#updKunj').val(1);
                            $('#frm').submit();
                        } else {
                            reset_form();
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
                }
                , "json");
                smpn.always(function (data) {});
            }
        }
        return false;
    });
});
