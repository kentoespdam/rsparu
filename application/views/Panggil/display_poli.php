<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="email" content="k3ntoes.android@gmail.com">
        <meta name="author" content="Kent-Os">

        <title>Antrian BKPM Purwokerto</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>asset/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>asset/bower_components/font-awesome/css/font-awesome.css" rel="stylesheet" />
    </head>

    <body style="background-color: #B9F6CA" >
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#" style="font-weight: bold;">
                <i class="fab fa-angular fa-2x"></i>
                Antrian <span id="poli">{poli}</span> BKPM Purwokerto
            </a>
        </nav>

        <div class="container-fluid" style="margin-top:20px;">
            <input type="hidden" id="uname" value="{uname}">
            <input type="hidden" id="id_poli" value="{id_tujuan}">
            <h1 id="diPanggil" class="alert alert-warning text-center text-dark">Loading Data....</h1>
            <div class="card">
                <h2 class="card-header bg-primary text-light">Menunggu</h2>
                <div class="card-body bg-light" id="dftTunggu" style="overflow: scroll; height: 425px;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-warning text-center"><h3>Loading Data....</h3></li>
                    </ul>
                </div>
            </div>

        </div>

        <script src="<?php echo base_url(); ?>asset/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js"></script>
        <!-- socket.io -->
        <script src="<?php echo base_url(); ?>asset/websocket/node_modules/socket.io-client/dist/socket.io.js"></script>

        <!--Custom-->
        <script src="<?php echo base_url(); ?>asset/js/custom/displayTensi.js"></script>
    </body>
</html>