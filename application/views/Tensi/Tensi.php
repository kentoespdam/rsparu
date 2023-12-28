<style>
    .form-control:focus, .select2-container *:focus, .iradio_square_red *:focus{
        border-color: #FF0000;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
    }

    .garisBawah{
        padding: 0.05px;
        border-top: solid 1px #ddd;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .panel-body{
        padding:0px;
    }

    fieldset.scheduler-border {
        border: 1px solid #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }

    h5{
        margin-top: 0px;
    }

</style>

<section class="content-header"> 
    <h1>
        Pelayanan
        <small>Tensi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tensi </li> 
    </ol>
</section>

<div class="content">
    <div class="row" id="tungguTensi">
        <div class="col-md-12 border pt-3 pb-3" style="padding-right: 5px; padding-left: 15px;">
            {tungguTensi}          
        </div>
    </div>
    <div class="row" id="formTensi">
        <div class="col-md-12 border pt-3 pb-3" style="padding-right: 5px; padding-left: 15px;">
            <div class="box box-primary box-solid">
                <div class="box-header">
                    <h2 class="box-title">Input Data Tensi</h2>
                </div>
                <div class="box-body">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Biodata Pasien</legend>

                        <div class="row">
                            <label class="col-md-2">Nama</label>
                            <span id="nama" class="col-md-2">: NaN</span>

                            <label class="col-md-2">Tempat, Tanggal Lahir</label>
                            <span id="ttl" class="col-md-2">: NaN</span>

                            <label class="col-md-1">Umur</label>
                            <span id="umur" class="col-md-2">: NaN</span>
                        </div>

                        <div class="row">
                            <label class="col-md-2">Jenis Kelamin</label>
                            <span id="jeniskel" class="col-md-2">: NaN</span>

                            <label class="col-md-2">Alamat</label>
                            <span id="alamat" class="col-md-4">: NaN</span>
                        </div>

                    </fieldset>

                    <hr class="garisBawah">

                    <ul id="myTabs" class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#iTensi" aria-controls="iTensi" role="tab" data-toggle="tab">Tensi</a></li>
                        <li role="presentation"><a href="#iRiwayat" aria-controls="iRiwayat" role="tab" data-toggle="tab">Riwayat</a></li>
                    </ul>
                    <div class="tab-content" style="padding:10px; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd;">
                        <div role="tabpanel" class="tab-pane active" id="iTensi">
                            {inputTensi}  
                        </div>
                        <div role="tabpanel" class="tab-pane" id="iRiwayat">
                            {inputRiwayat}  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--
<div class="modal fade" id="displayDaftarTungguModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Tunggu Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="padding: 10px;"></div>
            </div>
        </div>
    </div>
</div>-->

<script>
    $(document).ready(function () {
        $('input[type=radio], input[type=checkbox]').iCheck({
            checkboxClass: 'icheckbox_square-red',
            radioClass: 'iradio_square-red',
            increaseArea: '20%' // optional
        });
    });
</script>
<script src="<?php echo base_url('asset/js/custom/daftarTungguTensi.js'); ?>"></script>
<script src="<?php echo base_url('asset/js/custom/inputTensi.js'); ?>"></script>
<script src="<?php echo base_url('asset/js/custom/inputRiwayat.js'); ?>"></script>