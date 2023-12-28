<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/custom.css"/>

<script>
    $(document).ready(function () {
        var base_uri = "<?php echo base_url(); ?>";
        showProvinsi(base_uri + "API/provinsi", "");

        showKelompok(base_uri + "API/kelompok", "");

        $('#kprovinsi').on("change", function () {
            showKabupaten(base_uri + "API/kabupaten/kdProv/" + $('#kprovinsi').val(), "");
        });

        $('#kkabupaten').on("change", function () {
            showKecamatan(base_uri + "API/kecamatan/kdKab/" + $('#kkabupaten').val(), "");
        });

        $('#kkecamatan').on("change", function () {
            showKelurahan(base_uri + "API/kelurahan/kdKec/" + $('#kkecamatan').val(), "");
        });
    });
</script>

<form action="#" method="post" class="row flex-xl-nowrap">
    <div class="col-md-6 border pt-3 pb-3">

        <div class="row">
            <label for="nourut" class="col-sm-3 col-form-label">No. Urut</label>
            <div class="col-sm-2">
                <input type="text" name="nourut" class="form-control" id="nourut" placeholder="Urut">
            </div>
            <div class="col-sm-5">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <span class="btn btn-success">Ulang</span>
                    <span class="btn btn-info" id="panggilBtn">Panggil</span>
                    <span class="btn btn-danger">Lewati</span>
                </div>
            </div>
        </div>

        <!--NoRM-->
        <div class="form-group row">
            <label for="norm" class="col-sm-3 col-form-label">NO. RM</label>
            <div class="col-sm-3">
                <input type="text" name="norm" class="form-control" id="norm" placeholder="NO RM">
            </div>

            <label for="rmlama" class="col-sm-3 col-form-label">NO. RM Lama</label>
            <div class="col-sm-3">
                <input type="text" name="rmlama" class="form-control" id="rmlama" placeholder="NO RM Lama">
            </div>
        </div>

        <!--Kelompok-->
        <div class="form-group row">
            <label for="kkelompok" class="col-sm-3 col-form-label">Kelompok</label>
            <div class="col-sm-9">
                <select name="kkelompok" id="kkelompok" class="form-control select2">

                </select>
            </div>
        </div>

        <!--No Asuransi-->
        <div class="form-group row">
            <label for="noasuransi" class="col-sm-3 col-form-label">No Asuransi</label>
            <div class="col-sm-9">
                <input type="text" name="noasuransi" class="form-control" id="noasuransi" placeholder="No Asuransi">
            </div>
        </div>

        <!--No KTP-->
        <div class="form-group row">
            <label for="noktp" class="col-sm-3 col-form-label">NIK</label>
            <div class="col-sm-9">
                <input type="text" name="noktp" class="form-control" id="noktp" placeholder="NIK">
            </div>
        </div>

        <div class="form-group row">
            <label for="tgldaftar" class="col-sm-3 col-form-label">Tanggal Daftar</label>
            <div class="col-sm-3">
                <div class="input-group date" data-date-format="yyyy-mm-dd">
                    <input type="text" name="tgldaftar" class="form-control" placeholder="yyyy-mm-dd" value="<?php echo date("Y-m-d"); ?>" readonly="">
                    <div class="input-group-addon" >
                        <span class="glyphicon glyphicon-th"></span>

                    </div>
                </div>
            </div>
            <label for="jamdaftar" class="col-sm-3 col-form-label">Jam Daftar</label>
            <div class="col-sm-3">
                <input type="text" name="jamdaftar" id="jamdaftar" class="form-control" placeholder="hh:mm::ss" value="<?php echo date("h:i:s"); ?>" readonly="">
            </div>
        </div>

        <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
                <input name="nama" type="text" class="form-control" id="nama" placeholder="Nama Pasien">
            </div>
        </div>

        <div class="form-group row">
            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
                <input type="text" name="alamat" class="form-control" id="alamat" placeholder="alamat" >
            </div>
        </div>

        <div class="form-group row">
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

        <div class="form-group row">
            <label for="kkabupaten" class="col-sm-3 col-form-label">Kabupaten</label>
            <div class="col-sm-8">
                <select name="kkabupaten" id="kkabupaten" class="form-control select2">
                    <option value="">--Pilih--</option>
                </select>
            </div>
            <div class="col-sm-1" id="fKab"></div>
        </div> 

        <div class="form-group row">
            <label for="kkecamatan" class="col-sm-3 col-form-label">Kecamatan</label>
            <div class="col-sm-8">
                <select name="kkecamatan" id="kkecamatan" class="form-control select2">
                    <option value="">--Pilih--</option>
                </select>
            </div>
            <div class="col-sm-1" id="fKec"></div>
        </div>

        <div class="form-group row">
            <label for="kkelurahan" class="col-sm-3 col-form-label">Kelurahan</label>
            <div class="col-sm-8">
                <select name="kkelurahan" id="kkelurahan" class="form-control select2">
                    <option value="">--Pilih--</option>
                </select>
            </div>
            <div class="col-sm-1" id="fKel"></div>
        </div>

        <div class="form-group row">
            <label for="rtrw" class="col-sm-3 col-form-label">RT/RW</label>
            <div class="col-sm-3">
                <input type="text" name="rtrw" class="form-control" id="rtrw" placeholder="RT/RW">
            </div>
            <label for="jeniskel" class="col-sm-2 col-form-label">Jenis Kel</label>
            <div class="col-sm-4">
                <select name="jeniskel" id="jeniskel" class="form-control select2">
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="tmptlahir" class="col-sm-3 col-form-label">Tampat Lahir</label>
            <div class="col-sm-9">
                <input type="text" name="tmptlahir" id="tmptlahir" class="form-control" placeholder="Tempat lahir">
            </div>
        </div>

        <div class="form-group row">
            <label for="tgllahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-3">
                <div class="input-group date" data-date-format="yyyy-mm-dd">
                    <input type="text" name="tgllahir" id="tgllahir" class="form-control" placeholder="yyyy-mm-dd" value="" readonly="" onchange="src_umur();">
                    <div class="input-group-addon" >
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <label for="status" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-4">
                <select name="status" id="status" class="form-control select2">
                    <option value="BK">Belum Kawin</option>
                    <option value="K">Kawin</option>
                    <option value="CH">Cerai Hidup</option>
                    <option value="CM">Cerai Mati</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="umur" class="col-sm-3 col-form-label">Umur</label>
            <div class="col-sm-3 input-group">
                <input type="text" name="umurthn" class="form-control" id="umurthn" placeholder="0" aria-describedby="inputGroupPrepend2" readonly="">
                <div class="input-group-append">
                    <span class="input-group-text" id="inputGroupPrepend2">TH</span>
                </div>
            </div>
            <div class="col-sm-3 input-group">
                <input type="text" name="umurbln" class="form-control" id="umurbln" placeholder="0" aria-describedby="inputGroupPrepend2" readonly="">
                <div class="input-group-append">
                    <span class="input-group-text" id="inputGroupPrepend2">Bl</span>
                </div>
            </div>
            <div class="col-sm-3 input-group">
                <input type="text" name="umurhr" class="form-control" id="umurhr" placeholder="0" aria-describedby="inputGroupPrepend2" readonly="">
                <div class="input-group-append">
                    <span class="input-group-text" id="inputGroupPrepend2">Hr</span>
                </div> 
            </div>
        </div>

        <div class="form-group row">
            <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
            <div class="col-sm-9">
                <input type="text" name="pekerjaan" class="form-control" id="pekerjaan" placeholder="Pekerjaan">
            </div>
        </div>

        <div class="form-group row">
            <label for="pjwb" class="col-sm-3 col-form-label">Orangtua</label>
            <div class="col-sm-9">
                <input type="text" name="pjwb" class="form-control" id="pjwb" placeholder="Orangtua">
            </div>
        </div>

        <hr>

        <div class="form-group row">
            <div class="col-sm">
                <span class="btn btn-warning" id="cetak">Cetak</span>
            </div>
            <div class="col-sm text-center">
                <span class="btn btn-danger" id="batal">Batal</span>
            </div>
            <div class="col-sm text-right">
                <button class="btn btn-success" id="simpan">Simpan</button>
            </div>
        </div>

    </div>
    <div class="col-md-6 border pt-3">

    </div>
</form>

<script>
    //            MENU PANGGIL
    $('#panggilBtn').on("click", function () {
        $('#displayModal').modal('toggle');
        var url = "<?php echo base_url(); ?>API/panggil/Loket";
        console.log(url);
        $.getJSON(url, function (json) {
            if (json.metaData.code == 200) {
                $('#exampleModalLongTitle').html("Pilih No Antri");
                $('#listAntri').find('tr').remove().end();
                $.each(json.response.data, function (index, t) {
                    var str = '<tr>' +
                            '<td>' + t.NoAntri + '</td>' +
                            '<td>' + t.jenis + '</td>' +
                            '<td>' + t.LOKET + '</td>' +
                            '<td> <span class="btn btn-primary btn-sm" onclick="panggil(' + t.NoAntri + ')" >Panggil</span></td>' +
                            '</tr>';
                    $('#listAntri').append(str);
                });
            }
        });
    });
</script>

<!--Modal-->
<div class="modal fade" id="displayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Judul</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table bordered striped">
                    <thead>
                        <tr>
                            <th>No Antri</th>
                            <th>Kelompok</th>
                            <th>Loket</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="listAntri">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 