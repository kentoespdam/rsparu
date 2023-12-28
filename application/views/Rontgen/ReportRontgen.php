<section class="content-header"> 
    <h1>
        Dashboard
        <small>Report</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Report</a></li>
        <li class="active">Loket</li>
        <li class="active">Harian</li>
    </ol>
</section>
<div class="content">
    <div class="box box-warning">
        <div class="box-body">
            <form method="post" id="frm_cari" action="#" onsubmit="return true;">
                <div class="form-group row">
                    <label for="tglMulai" class="col-sm-1 col-form-label">Mulai</label>
                    <div class="col-sm-2">
                        <div class="input-group date" data-date-format="yyyy-mm-dd">
                            <input type="text" name="tglMulai" id="tglMulai" class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>" readonly="">
                            <div class="input-group-addon" >
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>

                    <label for="tglSelesai" class="col-sm-1">Sampai</label>
                    <div class="col-sm-2">
                        <div class="input-group date" data-date-format="yyyy-mm-dd">
                            <input type="text" name="tglSelesai" id="tglSelesai" class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>" readonly="">
                            <div class="input-group-addon" >
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>

                    <label for="kkelompok" class="col-sm-1">Jenis Pasien</label>
                    <div class="col-sm-2">
                        <select name="kkelompok" id="kkelompok" class="form-control select2">
                            <option value="">--Pilih--</option>
                        </select>
                    </div>

                    <label for="kdFilm" class="col-sm-1">Ukuran Film</label>
                    <div class="col-sm-2">
                        <select name="kdFilm" id="kdFilm" class="form-control select2">
                            <option value="">--Pilih--</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kdMesin" class="col-sm-1">Mesin</label>
                    <div class="col-sm-2">
                        <select name="kdMesin" id="kdMesin" class="form-control select2">
                            <option value="">--Pilih--</option>
                        </select>
                    </div>

                    <label for="kdMesin" class="col-sm-1">Petugas</label>
                    <div class="col-sm-2">
                        <select id="p_rontgen" name="p_rontgen" class="select2 petugas form-control">
                            <option value="">--Pilih--</option>
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <span id="btCari" class="btn btn-warning" onclick="cari('Report/Rontgen/showKunjungan/cetak/false');">CARI</span>
                        <span id="btCetak" class="btn btn-warning" onclick="cetak('Report/Rontgen/showKunjungan/cetak/true');">CETAK</span>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="tblResult" class="box box-success">
        <div class="box-body">
<!--            <table class="table table-bordered table-striped table-hover" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Urut</th>
                        <th>Noreg</th>
                        <th>NoRM</th>
                        <th>Nama</th>
                        <th>Kelompok</th>
                        <th>JenisKel</th>
                        <th>Desa</th>
                        <th>Kecamatan</th>
                        <th>Kabupaten</th>
                        <th>Nama Foto</th>
                        <th>UK Film</th>
                        <th>Kondisi</th>
                        <th>J. Film</th>
                        <th>Expose</th>
                        <th>Rusak</th>
                        <th>PA</th>
                        <th>LTR</th>
                        <th>OBL</th>
                        <th>Mesin</th>
                        <th>Catatan</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
            </table>-->
        </div>
    </div>
</div>


<script>
    cari = (uris) => {
        $.post(base_uri + uris, $('#frm_cari').serializeArray(), (data) => {
            $('#tblResult .box-body').html(data);
            var dawa = $('#isi').width();
            $('#judul').css('width', dawa);
        });
    };

    cetak = (uris) => {
        $('#frm_cari').attr('action', uris);
        $('#frm_cari').submit();
    };

    $(document).ready(() => {
        showKelompok(base_uri + "API/kelompok", "");
        showFilmRontgen();
        showMesinRontgen();
        showPetugas();

        $('.select2').select2();

//        $('#frm_cari').on("submit", () => {
//            return false;
//        });
    });
</script>