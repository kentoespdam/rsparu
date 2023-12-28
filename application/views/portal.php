<!DOCTYPE HTML>
<html>
    <head>
        <title>{title}</title>
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/Ionicons/css/ionicons.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/skins/_all-skins.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/AdminLTE.min.css">

        <!-- jQuery 3 -->
        <script src="<?php echo base_url(); ?>asset/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo base_url(); ?>asset/bower_components/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url(); ?>asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <script>
            $('#myModal').modal({
                keyboard: false
            })
        </script>
    </head>
    <body class="hold-transition skin-blue layout-boxed sidebar-collapse sidebar-mini" >
        <div style="margin-top: 10px;"></div>
        <div class="row">
            <div class="col-md-4"></div>
            <a class="col-md-4" href="#"> <!--href="<?php echo base_url('dispenser'); ?>"-->
                <div class="box box-success box-solid" >
                    <div class="box-header with-border">
                        <h3 class="box-title">Dispenser</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        Menu Dispenser untuk menambahkan Antrian
                    </div>
                    <!-- /.box-body -->
                </div>
            </a>
            <div class="col-md-4"></div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <a class="col-md-4" href="#" id="panggilBtn" data-target="#displayModal">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Panggil</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        Menu untuk menampilkan panggilan terakhir
                    </div>
                    <!-- /.box-body -->
                </div>
            </a>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <a class="col-md-4" href="#" id="displayBtn" data-target="#displayModal">
                <div class="box box-danger box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Display</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        Menu untuk memanggil antrian
                    </div>
                    <!-- /.box-body -->
                </div>
            </a>
        </div>

    </body>
    <!--        <div class="row justify-content-md-center" style="margin-top: 10%">
                <div class="col-md-auto">
                    <a href="<?php echo base_url('dispenser'); ?>" class="card badge badge-dark" style="width: 312px;">
                        <div class="card-body">
                            <h5 class="card-title display-4 text-center">Dispenser</h5>
                            <p class="card-text">Menu Dispenser untuk menambahkan Antrian</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-auto">
                    <a href="#" id="displayBtn" class="card badge badge-success" style="width: 312px;" data-target="#displayModal">
                        <div class="card-body">
                            <h5 class="card-title display-4 text-center">Display</h5>
                            <p class="card-text">Menu untuk menampilkan panggilan terakhir</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-auto">
                    <a  href="#" id="panggilBtn" class="card badge badge-warning" style="width: 312px;" data-target="#displayModal">
                        <div class="card-body">
                            <h5 class="card-title display-4 text-center">Panggil</h5>
                            <p class="card-text">Menu untuk memanggil antrian</p>
                        </div>
                    </a>
                </div>
            </div>-->

    <script>
//            MENU DISPLAY
        $('#displayBtn').on("click", function () {
            $('#displayModal').modal('toggle');
            var url = "<?php echo base_url(); ?>API/ruang";
            console.log(url);
            $.getJSON(url, function (json) {
                if (json.metaData.code == 200) {
                    $('#exampleModalLongTitle').html("Pilih Display");
                    $('#listRuang').find('li').remove().end();
                    $.each(json.response.data, function (index, t) {
                        var str = '<li class="nav-item border">'
                                + '<a class="nav-link" href="<?php echo base_url(); ?>display/' + t.uri + '" target="_blank" onclick="$(\'#displayModal\').modal(\'toggle\');">' + t.ruang + '</a>'
                                + '</li>';
                        $('#listRuang').append(str);
                    });

                }
            });
        });
//            MENU PANGGIL
        $('#panggilBtn').on("click", function () {
            $('#displayModal').modal('toggle');
            var url = "<?php echo base_url(); ?>API/ruang";
            $('#listRuang').find('li').remove().end();
            for (var i = 1; i <= 3; i++) {
                var str = '<li class="nav-item border">'
                        + '<a class="nav-link" href="<?php echo base_url(); ?>panggil/pendaftaran/loket/' + i + '" target="_blank" onclick="$(\'#displayModal\').modal(\'toggle\');">Loket Pendaftaran ' + i + '</a>'
                        + "</li>";
                $('#listRuang').append(str);
            }
/*            console.log(url);
            $.getJSON(url, function (json) {
                if (json.metaData.code == 200) {
                    $('#exampleModalLongTitle').html("Pilih Display");
                    $('#listRuang').find('li').remove().end();
                    $.each(json.response.data, function (index, t) {
                        var str = '<li class="nav-item border">'
                                + '<a class="nav-link" href="<?php echo base_url(); ?>panggil/' + t.uri + '" target="_blank" onclick="$(\'#displayModal\').modal(\'toggle\');">' + t.ruang + '</a>'
                                + '</li>';
                        $('#listRuang').append(str);
                    });

                }
            });*/
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
                    <ul class="nav flex-column " id="listRuang">
                        <li class="nav-item">
                            <a class="nav-link" href="#">aaaa</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</html>