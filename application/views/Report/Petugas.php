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
        Report
        <small>Petugas</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Report Petugas </li> 
    </ol>
</section>

<div class="content">
    <div class="box box-warning">
        <div class="box-body" style="border-bottom: solid 1px #0004;">
            <form id="frm" onsubmit="return false;">
                <div class="form-group">
                    <div class="col-sm-2">
                        <select name="kd_menu" id="kd_menu" class="form-control select2"></select>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group date" data-date-format="yyyy-mm-dd">
                            <input type="text" name="mulaiTgl" id="mulaiTgl" class="form-control input-sm datepicker" required="required" placeholder="yyyy-mm-dd" value="<?php echo date("Y-m-d"); ?>" readonly="">
                            <div class="input-group-addon" >
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group date" data-date-format="yyyy-mm-dd">
                            <input type="text" name="selesaiTgl" id="selesaiTgl" class="form-control input-sm datepicker" required="required" placeholder="yyyy-mm-dd" value="<?php echo date("Y-m-d"); ?>" readonly="">
                            <div class="input-group-addon" >
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-warning col-sm-1" onclick="src_data();">CARI</button>
                </div>
            </form>
        </div>
    </div>

    <div class="box box-success">
        <div class="box-body" style="border-bottom: solid 1px #0004;">
            <table id="lst" class="table table-hovered table-bordered datatable" width="100%">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Nip</th>                        
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>asset/js/custom/reportPetugas.js"></script>