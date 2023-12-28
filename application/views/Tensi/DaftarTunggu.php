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
                <button id="cariDaftarTunggu" class="btn btn-primary" onclick="cariDaftarTensi();" >CARI</button>
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
        <ul id="" class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#iTunggu" aria-controls="iTunggu" role="tab" data-toggle="tab">Tunggu</a></li>
            <li role="presentation"><a href="#iSelesai" aria-controls="iSelesai" role="tab" data-toggle="tab">Selesai</a></li>
        </ul>
        <div class="tab-content" style="padding:10px; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd;">
            <div role="tabpanel" class="tab-pane active" id="iTunggu">
                <form id='frm_panggil' onsubmit='return false;'>
                    <input type="hidden" id="aliasPoli" name="aliasPoli" value="">
                    <table id="listDaftarTunggu" class="table table-bordered table-hover" width="100%">
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


<div class="modal fade" id="pindahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<h5 class="modal-title" id="exampleModalLongTitle"></h5>-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frmKirim" method="post">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Kirim Pasien</legend>

                        <div class="form-group">
                            <label for="notrans1" class="col-sm-3">Notrans</label>
                            <div class="col-sm-9">
                                <input type="text" id="notrans1" class="form-control" value="notrans" readonly="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="norm1" class="col-sm-3">Norm</label>
                            <div class="col-sm-9">
                                <input type="text" id="norm1" class="form-control" value="norm" readonly="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="nama1" class="col-sm-3">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" id="nama1" class="form-control" value="nama" readonly="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="umur1" class="col-sm-3">Umur</label>
                            <div class="col-sm-9">
                                <input type="text" id="umur1" class="form-control" value="umur" readonly="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jeniskel1" class="col-sm-3">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <input type="text" id="jeniskel1" class="form-control" value="jeniskel" readonly="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat1" class="col-sm-3">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" id="alamat1" class="form-control" value="alamat" readonly="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3">Poli</label>
                            <div class="col-sm-9">
                                <select name="tuj" id="tuj" class="form-control ktujuan" required="">
                                    <option value="">--Pilih--</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button id="pindahBt" class="btn btn-block btn-primary">KIRIM</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>