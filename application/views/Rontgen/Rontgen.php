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

    .modal-lg{
        width:90%;
    }
</style>

<section class="content-header">
    <h1>
        Pelayanan
        <small>Rontgen</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Rontgen </li> 
    </ol>
</section>

<div class="content">
    <div class="row" id="tungguRontgen">
        <div class="col-md-12 border pt-3 pb-3" style="padding-right: 5px; padding-left: 15px;">
            {tungguRontgen}          
        </div>
    </div>

    <div class="row" id="formRontgen">
        <div class="col-md-12 border pt-3 pb-3" style="padding-right: 5px; padding-left: 15px;">
            <div class="box box-primary box-solid">
                <div class="box-header">
                    <h2 class="box-title">Input Data Rontgen</h2>
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
                    <!--<button id="bRiwayat" class="btn btn-block btn-warning" onclick="getRiwayat();">RIWAYAT</button>-->
                    <hr class="garisBawah">

                    {inputRontgen}
                </div>
            </div>
        </div>
    </div>
</div>

<!--<div class="modal fade" id="displayRiwayatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
<script src="<?php echo base_url('asset/js/custom/daftarTungguRontgen.js'); ?>"></script>
<script src="<?php echo base_url('asset/js/custom/inputRontgen.js'); ?>"></script>
<!--<script src="<?php echo base_url('asset/js/custom/inputRiwayat.js'); ?>"></script>-->