<div class="box box-warning">
    <div class="box-body" style="border-bottom: solid 1px #0004;">
        <div class="form-group">
            <label for="tgldaftar" class="col-sm-1 col-form-label text-right">Tanggal</label>
            <div class="col-sm-2" style="min-width: 180px;">
                <div class="input-group date" data-date-format="yyyy-mm-dd">
                    <input type="text" name="tgl" id="tgl" class="form-control input-sm datepicker" required="required" placeholder="yyyy-mm-dd" value="<?php echo date("Y-m-d"); ?>" readonly="">
                    <div class="input-group-addon" >
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <button id="cariDaftarTunggu" class="btn btn-primary" onclick="cariDaftarRontgen();" >CARI</button>
            </div>
            <div class="col-md-3 hidden" id="src_daftarTunggu">
                <div class="input-group" >
                    <input type="text" value="Sedang Mencari..." readonly="" hidden="" class="form-control" style="background: red; color: white;">
                    <div class="input-group-addon" style="background: red; color: white;">
                        <span class="fa fa-spinner fa-pulse fa-1x"></span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="box-body">
        <ul id="ronTab" class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#iTunggu" aria-controls="iTunggu" role="tab" data-toggle="tab">Tunggu</a></li>
            <li role="presentation"><a href="#iSelesai" aria-controls="iSelesai" role="tab" data-toggle="tab">Tunggu Poli</a></li>
        </ul>
        <div class="tab-content" style="padding:10px; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd;">
            <div role="tabpanel" class="tab-pane active" id="iTunggu">
                <form id='frm_panggil' onsubmit='return false;'>
                    <input type="hidden" id="aliasPoli" name="aliasPoli" value="">
                    <table id="listDaftarTungguRontgen" class="table table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>Aksi</th>
                                <th>Urut</th>
                                <th>Norm</th>
                                <th>NIK</th> 
                                <th>Kelompok</th>
                                <th>No Asuransi</th> 
                                <th>Nama</th>
                                <th>JKel</th>
                                <th>Desa</th>
                                <th>Kunjungan</th> 
                                <th>Status</th> 
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <button id="bt_panggil" class="btn btn-sm btn-warning">Panggil</button>
                </form>
            </div>
            
            <div role="tabpanel" class="tab-pane" id="iSelesai">
                <table id="listDaftarSelesai" class="table table-bordered table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>Urut</th>
                            <th>Norm</th>
                            <th>NIK</th> 
                            <th>Kelompok</th>
                            <th>No Asuransi</th> 
                            <th>Nama</th>
                            <th>JKel</th>
                            <th>Desa</th>
                            <th>Kunjungan</th> 
                            <th>Tujuan</th> 
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>