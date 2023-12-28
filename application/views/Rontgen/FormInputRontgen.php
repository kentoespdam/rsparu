<style>
    .checkbox-inline, .radio-inline {
        position: relative;
        display: inline-block;
        padding-left: 0px;
        margin-bottom: 0;
        font-weight: 400;
        vertical-align: middle;
        cursor: pointer;
    }
</style>
<form id="frmInputRontgen" method="post" class="form-horizontal">
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Transaksi</legend>

        <div class="form-group col-sm-6">
            <label for="tgltrans" class="col-sm-4">Tanggal</label>
            <div class="col-sm-4">
                <div class="input-group date" data-date-format="yyyy-mm-dd">
                    <input type="text" name="tgltrans" id="tgltrans" class="form-control input-sm datepicker" required="required" placeholder="yyyy-mm-dd" value="2019-08-16" readonly="">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group col-sm-6">
            <label for="jamdaftar" class="col-sm-2">Jam Daftar</label>
            <div class="col-sm-4">
                <input type="text" name="jamdaftar" id="jamdaftar" class="form-control input-sm" required="required" placeholder="hh:mm::ss" value="<?php echo date("h:i:s"); ?>" readonly="" >
            </div> 
        </div>

        <div class="form-group col-sm-6">
            <label for="notrans" class="col-sm-4">notransaksi</label>
            <div class="col-sm-4">
                <input type="text" id="notrans" name="notrans" class="form-control input-sm" readonly="" placeholder="NO Transaksi">
            </div>
        </div>

        <div class="form-group col-sm-6">
            <label for="norm" class="col-sm-2">norm</label>
            <div class="col-sm-4">
                <div class="input-group input-group-sm">
                    <input type="text" name="norm" maxlength="6" class="form-control input-sm" id="norm" placeholder="NO RM" required="">
                    <div id="bt_norm" class="input-group-addon btn">
                        <span class="glyphicon glyphicon-search" id="find_norm" ></span>
                    </div>
                </div>
            </div>
        </div>

    </fieldset>
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Hasil Pemotretan</legend>

        <div class="form-group col-sm-12">
            <label class="col-sm-2" for="pasienRawat">Pasien Rawat</label>
            <div class="col-sm-10">
                <label for="pasienRawat0">
                    <input type="radio" name="pasienRawat" id="pasienRawat0" value="0" checked=""> IRJA
                </label>

                <label for="pasienRawat1">
                    <input type="radio" name="pasienRawat" id="pasienRawat1" value="1"> IGD / IRNA
                </label>
            </div>
        </div>

        <div class="form-group col-sm-6">
            <label for="noreg" class="col-sm-4">No. Reg.</label>
            <div class="col-sm-4">
                <input type="text" name="noreg" maxlength="6" class="form-control input-sm" id="noreg" placeholder="NO. Reg." required="">
            </div>
        </div>

        <div class="form-group col-sm-6">
            <label for="kdKondisiRo" class="col-sm-4">Kondisi</label>
            <div class="col-sm-8">
                <select name="kdKondisiRo" id="kdKondisiRo" class="form-control select2">
                    <option value="">--Pilih--</option>
                </select>
            </div>
        </div>

        <div class="form-group col-sm-6">
            <label class="col-sm-4">Nama Foto</label>
            <div class="col-sm-8">
                <select name="kdFoto" id="kdFoto" class="form-control select2">
                    <option value="">--Pilih--</option>
                </select>
            </div>
        </div>

        <div class="form-group col-sm-6">
            <label for="kdFilm" class="col-sm-4">Ukuran Film</label>
            <div class="col-sm-8">
                <select name="kdFilm" id="kdFilm" class="form-control select2">
                    <option value="">--Pilih--</option>
                </select>
            </div>
        </div>

        <div class="form-group col-sm-6">
            <label for="jmlExpose" class="col-sm-4">Jml Expose</label>
            <div class="col-sm-2">
                <input type="text" name="jmlExpose" id="jmlExpose" class="form-control" placeholder="Jml Expose" value="1">
            </div>

            <label for="jmlFilmDipakai" class="col-sm-4 text-right">Jml Film Dipakai</label>
            <div class="col-sm-2">
                <input type="text" name="jmlFilmDipakai" id="jmlFilmDipakai" class="form-control" placeholder="Jml Film Dipakai" value="1">
            </div>
        </div>

        <div class="form-group col-sm-6">
            <label for="jmlFilmRusak" class="col-sm-4">Jml Film Rusak</label>
            <div class="col-sm-2">
                <input type="text" name="jmlFilmRusak" id="jmlFilmRusak" class="form-control" placeholder="Jml Film Rusak" value="0">
            </div>

            <label for="kdMesin" class="col-sm-2 text-right">Mesin</label>
            <div class="col-sm-4">
                <select name="kdMesin" id="kdMesin" class="form-control select2" required="">
                    <option value="">--Pilih--</option>
                </select>
            </div>
        </div>

        <div class="form-group col-sm-6">
            <label for="proyeksi" class="col-sm-4">Proyeksi</label>
            <div class="col-sm-8">
                <label for="pa" class="radio-inline">
                    <input type="checkbox" name="pa" id="pa" value="1"> PA 
                </label>

                <label for="pa" class="radio-inline">
                    <input type="checkbox" name="ap" id="ap" value="1"> AP 
                </label>

                <label for="lateral" class="radio-inline">
                    <input type="checkbox" name="lateral" id="lateral" value="1"> Lateral 
                </label>

                <label for="obliq" class="radio-inline">
                    <input type="checkbox" name="obliq" id="obliq" value="1"> Obliq 
                </label>
            </div>
        </div>

        <div class="form-group col-sm-12">
            <label for="catatan" class="col-sm-2">Catatan</label>
            <div class="col-sm-12">
                <textarea name="catatan" id="catatan" class="form-control textarea" rows="5"></textarea>
            </div>
        </div>
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border"></legend>
        <div class="form-group col-sm-6">
            <label class="col-sm-4" for="p_rontgen">Petugas</label>
            <div class="col-sm-8">
                <select id="p_rontgen" name="p_rontgen" class="form-control select2 petugas" required="">
                    <option value="">--Pilih--</option>
                </select>
            </div>
        </div>

        <div class="form-group col-sm-6">
            <label for="ktujuan" class="col-sm-4">Poli Tujuan</label>
            <div class="col-sm-8">
                <select id="ktujuan" name="ktujuan" class="form-control select2" required="">
                    <option value="">--Pilih--</option>
                </select>
            </div>
        </div>
    </fieldset>
    
    <hr class="garisBawah">

    <div class="form-group">
        <div class="col-sm-3">
            <input type="hidden" id="updRontgen" name="updRontgen" value="0">
        </div>
        <div class="col-sm-3"></div>

        <!-- ini edit -->
        <div class="col-sm-6 text-right">
            <a class="btn btn-info" onclick="openUploadPage()">UPLOAD</a>
            <div class="btn-group" role="group" aria-label="Basic example" id="rst">
                <span class="btn btn-danger" id="rst-bt" onclick="batal();" >Batal</span>
                <button class="btn btn-success" id="save-bt">SIMPAN</button>
            </div>
            <script>
        // Fungsi untuk membuka halaman upload dengan parameter norm
        function openUploadPage() {
            var normValue = document.getElementById("norm").value;
            // var uploadURL = "../../../../RO/form_upload.php?norm=" + encodeURIComponent(normValue);
           // var uploadURL = "../../../../RO/index.php#upload?norm=" + encodeURIComponent(normValue);
            var uploadURL = "http://172.16.10.88/RO/form_upload.php?norm=" + encodeURIComponent(normValue);

            window.open(uploadURL, "_blank");
        }
        </script>
        </div>

    </div>
</form>