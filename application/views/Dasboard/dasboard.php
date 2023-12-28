<!--Flot Grafik-->
<script src="<?php echo base_url('asset'); ?>/bower_components/Flot/jquery.flot.js"></script>
<script src="<?php echo base_url('asset'); ?>/bower_components/Flot/jquery.flot.canvas.js"></script>
<script src="<?php echo base_url('asset'); ?>/bower_components/Flot/jquery.flot.categories.js"></script>
<!--<script src="<?php echo base_url('asset'); ?>/bower_components/Flot/jquery.flot.legend.js"></script>-->
<script src="<?php echo base_url('asset'); ?>/bower_components/Flot/jquery.flot.crosshair.js"></script>

<style>
    .legend {
        display: block;
        -webkit-padding-start: 2px;
        -webkit-padding-end: 2px;
        border-width: initial;
        border-style: none;
        border-color: initial;
        border-image: initial;
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .legendLayer .background {
        fill: rgba(255, 255, 255, 0.85);
        stroke: rgba(0, 0, 0, 0.85);
        stroke-width: 1;
    }
    .legend table tr td{
        padding: 3px;
    }
</style>

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

<section class="content">
    <div class="row">
        {grafik_kunj}
    </div>
</section>

