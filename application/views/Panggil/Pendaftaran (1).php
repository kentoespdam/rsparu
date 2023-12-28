<!--<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/custom.css"/>-->
<script src="<?php echo base_url(); ?>asset/dist/js/pendaftaranJs.js"></script>

<script>
    $(document).ready(function () {
        var base_uri = "<?php echo base_url(); ?>";
        $('#bt_grup').hide();
        $('#rst').show();
        autoSelect('loket', '{loket}');
        reset_form();

        setInterval(
                function () {
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
                }, 1000
                );

        $('#kkelompok').on("change", function () {
            showKelompok(base_uri + "API/kelompok", $(this).val());
        });

        $('#kprovinsi').on("change", function () {
            showKabupaten(base_uri, "");
        });

        $('#kkabupaten').on("change", function () {
            showKecamatan(base_uri, $('#kkabupaten').val(), "");
        });

        $('#kkecamatan').on("change", function () {
            showKelurahan(base_uri, $('#kkecamatan').val(), "");
        });

        $('#norm').bind("keypress", function (e) {
            if (e.keyCode == 13) {
                findData("norm_" + $(this).val());
            }
        });

        $('#frm').on("submit", function () {
            var smpn = $.post(base_uri + "panggil/pendaftaran/simpan",
                    $('#frm').serializeArray()
                    , function (json) {
                        console.log(json);
                        if (json.metaData.code == 201) {
                            $.notify({
                                // options
                                message: json.response.message.m_pasien,
                            }, {
                                delay: 5000,
                                timer: 1000,
                                type: 'success'
                            });

                            var x = confirm("Cetak Kartu?");
                            if (x == true) {
                                $('#norm').val(json.response.norm);
                                findData(json.response.norm);
                                window.open(base_uri + 'cetak/biodata/norm/' + json.response.norm, 'Karcis ' + json.response.norm, 'window settings')
                                $('#bt_grup').show();
                                $('#rst').hide();
                            } else {
                                reset_form();
                                // location.reload();	
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

            smpn.always(function (data) {
                console.log(data);
//                var x = confirm("Cetak RM?");
//                if (x == true) {
//                    
//                } else {
//
//                }
            });
            return false;
        });
    });
</script>

<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<div class="content">
    <div class="row">
        <div class="col-md-6 border pt-3 pb-3" style="padding-right: 5px; padding-left: 15px;">
            <div class="box box-warning">
                <form action="#" method="post" id="frm" class="form-horizontal box-body">
                    <!--                    <div class="form-group">
                                            <div class="col-sm-12">
                                                <span class="btn btn-primary btn-block" id="bt_pasien" onclick="stts_pasien();" >PASIEN BARU</span>
                                            </div>
                                        </div>-->
                    <div class="form-group">
                        <label for="nourut" class="col-sm-3 col-form-label">No. Urut</label>
                        <div class="col-sm-2">
                            <input type="text" name="nourut" class="form-control input-sm" id="nourut" placeholder="Urut">
                        </div>
                        <div class="col-sm-3">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <span 
                                    class="btn btn-success btn-sm glyphicon glyphicon-refresh" 
                                    id="ulangBtn" 
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    title="Panggil Ulang"></span>
                                <span 
                                    class="btn btn-info btn-sm glyphicon glyphicon-volume-up" 
                                    id="panggilBtn"  
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    title="Panggil"></span>
                                <span
                                    class="btn btn-danger btn-sm glyphicon glyphicon-fast-forward" 
                                    id="lewatiBtn"  
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    title="Lewati"></span>
                            </div>
                        </div>
                        <label for="loket" class="col-sm-1 col-form-label">Loket</label>
                        <div class="col-sm-3">
                            <select id="loket" class="form-control input-sm">
                                <option value="1">Loket 1</option>
                                <option value="2">Loket 2</option>
                                <option value="3">Loket 3</option>
                            </select>
                        </div>
                    </div>

                    <!--NoRM-->
                    <div class="form-group" style="margin-bottom: 3px;">
                        <label for="norm" class="col-sm-3 col-form-label">NO. RM</label>
                        <div class="col-sm-4">
                            <div class="input-group input-group-sm">
                                <input type="text" name="norm" maxlength="6" class="form-control input-sm" id="norm" placeholder="NO RM">
                                <!--<div class="input-group-btn">-->
                                <!--<button class="btn btn-info btn-flat" type="button" onclick="genNoRm();" >Generate</button>-->
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-search"></span>
                                </div>
                                <input type="hidden" name="normd" id="normd">
                                <input type="hidden" name="normb" id="normb">
                            </div>
                        </div>

                        <label for="rmlama" class="col-sm-2 col-form-label text-right">RM Lama</label>
                        <div class="col-sm-3">
                            <input type="text" name="rmlama" maxlength="11" class="form-control input-sm" id="rmlama" placeholder="NO RM Lama" onblur="toUpper('rmlama');" >
                        </div>
                    </div>

                    <!--Kelompok-->
                    <div class="form-group">
                        <label for="kkelompok" class="col-sm-3 col-form-label">Kelompok</label>
                        <div class="col-sm-4">
                            <select name="kkelompok" id="kkelompok" class="form-control">

                            </select>
                        </div>

                        <label for="kkunjungan" class="col-sm-2 col-form-label text-right">Kunjungan</label>
                        <div class="col-sm-3">
                            <select name="kkunjungan" id="kkunjungan" class="form-control">
                                <option value="B">Baru</option>
                                <option value="L">Lama</option>
                            </select>
                        </div>

                    </div>

                    <!--No Asuransi-->
                    <div class="form-group">
                        <label for="noasuransi" class="col-sm-3 col-form-label">No Asuransi</label>
                        <div class="col-sm-9">
                            <input type="text" name="noasuransi" class="form-control input-sm" id="noasuransi" placeholder="No Asuransi">
                        </div>
                    </div>

                    <!--No KTP-->
                    <div class="form-group">
                        <label for="noktp" class="col-sm-3 col-form-label">NIK</label>
                        <div class="col-sm-9">
                            <input type="text" name="noktp" class="form-control input-sm" id="noktp" placeholder="NIK">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tgldaftar" class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="col-sm-3">
                            <div class="input-group date" data-date-format="yyyy-mm-dd">
                                <input type="text" name="tgldaftar" id="tgldaftar" class="form-control input-sm datepicker" placeholder="yyyy-mm-dd" value="<?php echo date("Y-m-d"); ?>" readonly="">
                                <div class="input-group-addon" >
                                    <span class="glyphicon glyphicon-th"></span>

                                </div>
                            </div>
                        </div>
                        <label for="jamdaftar" class="col-sm-3 col-form-label text-right">Jam Daftar</label>
                        <div class="col-sm-3">
                            <input type="text" name="jamdaftar" id="jamdaftar" class="form-control input-sm" placeholder="hh:mm::ss" value="<?php echo date("h:i:s"); ?>" readonly="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input name="nama" type="text" class="form-control input-sm" id="nama" placeholder="Nama Pasien" onblur="toUpper('nama');" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" name="alamat" class="form-control input-sm" id="alamat" placeholder="alamat" onblur="toUpper('alamat');" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kprovinsi" class="col-sm-3 col-form-label">Provinsi</label>
                        <div class="col-sm-8">
                            <select name="kprovinsi" id="kprovinsi" class="form-control select2">
                                <option value="1">Satu</option>
                                <option value="2">Dua</option>
                                <option value="3">Tiga</option>
                            </select>
                        </div>
                        <div class="col-sm-1" id="fProv"></div>
                    </div>

                    <div class="form-group">
                        <label for="kkabupaten" class="col-sm-3 col-form-label">Kabupaten</label>
                        <div class="col-sm-8">
                            <select name="kkabupaten" id="kkabupaten" class="form-control select2">
                                <option value="">--Pilih--</option>
                            </select>
                        </div>
                        <div class="col-sm-1" id="fKab"></div>
                    </div> 

                    <div class="form-group">
                        <label for="kkecamatan" class="col-sm-3 col-form-label">Kecamatan</label>
                        <div class="col-sm-8">
                            <select name="kkecamatan" id="kkecamatan" class="form-control select2">
                                <option value="">--Pilih--</option>
                            </select>
                        </div>
                        <div class="col-sm-1" id="fKec"></div>
                    </div>

                    <div class="form-group">
                        <label for="kkelurahan" class="col-sm-3 col-form-label">Kelurahan</label>
                        <div class="col-sm-8">
                            <select name="kkelurahan" id="kkelurahan" class="form-control select2">
                                <option value="">--Pilih--</option>
                            </select>
                        </div>
                        <div class="col-sm-1" id="fKel"></div>
                    </div>

                    <div class="form-group">
                        <label for="rtrw" class="col-sm-3 col-form-label">RT/RW</label>
                        <div class="col-sm-3">
                            <input type="text" name="rtrw" class="form-control input-sm" id="rtrw" placeholder="RT/RW">
                        </div>

                        <label for="jeniskel" class="col-sm-3 col-form-label text-right">Jenis Kelamin</label>
                        <div class="col-sm-3">
                            <select name="jeniskel" id="jeniskel" class="form-control">
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kdAgama" class="col-sm-3 col-form-label">Agama</label>
                        <div class="col-sm-4">
                            <select name="kdAgama" id="kdAgama" class="form-control select2">
                                <option value="">--Pilih--</option>
                            </select>
                        </div>

                        <label for="kdPendidikan" class="col-sm-2 col-form-label text-right">Pendidikan</label>
                        <div class="col-sm-3">
                            <select name="kdPendidikan" id="kdPendidikan" class="form-control select2">
                                <option value="">--Pilih--</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tmptlahir" class="col-sm-3 col-form-label">Tampat Lahir</label>
                        <div class="col-sm-4">
                            <input type="text" name="tmptlahir" id="tmptlahir" class="form-control" placeholder="Tempat lahir" onblur="toUpper('tmptlahir');" >
                        </div>

                        <label for="nohp" class="col-sm-2 col-form-label text-right">Nomor Telp</label>
                        <div class="col-sm-3">
                            <input type="text" name="nohp" id="nohp" class="form-control" placeholder="Nomor Telp">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tgllahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-3">
                            <div class="input-group date" data-date-format="yyyy-mm-dd">
                                <input type="text" name="tgllahir" id="tgllahir" class="form-control datepicker" placeholder="yyyy-mm-dd" value="" readonly="" onchange="src_umur();">
                                <div class="input-group-addon" >
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                        <label for="status" class="col-sm-3 col-form-label text-right">Status</label>
                        <div class="col-sm-3">
                            <select name="status" id="status" class="form-control select2">
                                <option value="BK">Belum Kawin</option>
                                <option value="K">Kawin</option>
                                <option value="CH">Cerai Hidup</option>
                                <option value="CM">Cerai Mati</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 3px;">
                        <label for="umur" class="col-sm-3 col-form-label">Umur</label>
                        <div class="col-sm-3">
                            <div class=" input-group">
                                <input type="text" name="umurthn" class="form-control input-sm" id="umurthn" placeholder="0" aria-describedby="inputGroupPrepend2" readonly="">
                                <div class="input-group-addon">
                                    <span class="input-group-text" id="inputGroupPrepend2">TH</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" name="umurbln" class="form-control input-sm" id="umurbln" placeholder="0" aria-describedby="inputGroupPrepend2" readonly="">
                                <div class="input-group-addon">
                                    <span class="input-group-text" id="inputGroupPrepend2">Bl</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class=" input-group">
                                <input type="text" name="umurhr" class="form-control input-sm" id="umurhr" placeholder="0" aria-describedby="inputGroupPrepend2" readonly="">
                                <div class="input-group-addon">
                                    <span class="input-group-text" id="inputGroupPrepend2">Hr</span>
                                </div> 
                            </div> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
                        <div class="col-sm-9">
                            <input type="text" name="pekerjaan" class="form-control input-sm" id="pekerjaan" placeholder="Pekerjaan" onblur="toUpper('pekerjaan');" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pjwb" class="col-sm-3 col-form-label">Penanggungjawab</label>
                        <div class="col-sm-4">
                            <input type="text" name="pjwb" class="form-control input-sm" id="pjwb" placeholder="Penanggungjawab" onblur="toUpper('pjwb');" >
                        </div>
                        <label for="biaya" class="col-sm-2 col-form-label">Biaya</label>
                        <div class="col-sm-3">
                            <input type="text" name="biaya" class="form-control input-sm" id="biaya" placeholder="biaya">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3">


                        </div>
                        <div class="col-sm-6 text-right">
                            <div class="btn-group" role="group" aria-label="Basic example" id="bt_grup">
                                <span class="btn btn-warning" id="cetak" onclick="cetak();" >Cetak</span>
                                <span class="btn btn-primary" id="update">UPDATE</span>
                                <span class="btn btn-danger" id="batal" onclick="reset_form();" >Batal</span>
                                <button class="btn btn-success" id="simpan">SIMPAN</button>
                            </div>
                            <div class="btn-group" role="group" aria-label="Basic example" id="rst">
                                <span class="btn btn-danger" id="rst-bt" onclick="reset_form();" >Batal</span>
                                <button class="btn btn-success" id="simpan">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="sts_pasien" value="1">
                    <input type="hidden" id="frm_edited" value="0">
                </form>
            </div>
        </div>

        <div class="col-md-6 border pt-3" style="padding-right: 15px; padding-left: 5px;">
            {v_cari}
        </div>
    </div>

    <script>
        var base_url = "<?php echo base_url(); ?>";
        //            MENU PANGGIL
        $('#panggilBtn').on("click", function () {
            $('#displayModal').modal('toggle');
            var loket = $('#loket').val();
            $('#exampleModalLongTitle').html("Panggil Loket " + loket);
            var url = "<?php echo base_url(); ?>API/panggil/Loket";
            console.log(url);
            $.getJSON(url, function (json) {
                if (json.metaData.code == 200) {
                    $('#listAntri').find('tr').remove().end();
                    $.each(json.response.data, function (index, t) {
                        var noAntri = parseInt(t.NoAntri);
                        var str = '<tr>' +
                                '<td>' + t.NoAntri + '</td>' +
                                '<td>' + t.jenis + '</td>' +
                                '<td>' + t.LOKET + '</td>' +
                                '<td> <span class="btn btn-primary btn-sm" onclick="panggil(' + noAntri + ',' + loket + ');" >Panggil</span></td>' +
                                '</tr>';
                        $('#listAntri').append(str);
                    });
                }
            });
        });
        function panggil(noAntri, loket) {
            var tgl = $('#tgldaftar').val();
            var url = base_url + "API/panggil/tmp/addTmp/noAntri/" + noAntri + "/loket/" + loket;
            $.getJSON(url, function (json) {
                if (json.metaData.code == 201) {
                    var str = "upd_data('" + base_url + "'," + noAntri + ", " + loket + ", 0);";
                    var str1 = "lewati('" + base_url + "'," + noAntri + ", '" + tgl + "');";
                    $('#displayModal').modal('toggle');
                    $('#nourut').val(noAntri);
                    $('#ulangBtn').removeAttr("onClick");
                    $('#ulangBtn').attr("onClick", str);
                    $('#lewatiBtn').removeAttr("onClick");
                    $('#lewatiBtn').attr("onClick", str1);
                }
            });
        }

        function cetak() {
            var norm = $('#norm').val();
            window.open(base_url + 'cetak/form/norm/' + norm, 'Karcis ' + norm, 'window settings')
        }

    </script>

    <!--Modal-->
    <div class="modal fade" id="displayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table bordered striped" id="lAntri">
                        <thead>
                            <tr>
                                <th>No Antri</th>
                                <th>Kelompok</th>
                                <th>Loket</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="listAntri">
                            <tr>
                                <td colspan="4">Tidak Ada Data!</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 