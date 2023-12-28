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

        <?php
        $dtVideo = json_decode($dtVideo);
        $arrVid = [];

        if ($dtVideo->metaData->code == 200) {
            foreach ($dtVideo->response->data as $d) {
                $arrVid[] = base_url('asset/video/') . $d->file;
            }
            // print_r($arrVid);
        }
        ?>
    </head>

    <body style="background-color: #B9F6CA" >
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#" style="font-weight: bold;">
                <i class="fab fa-angular fa-2x"></i>
                Antrian BKPM Purwokerto
            </a>
        </nav>

        <div class="container-fluid" style="margin-top:20px;">
            <div class="row">
                <div class="col-7">
                    <div class="card" style="height: 350px;">
                        <video class="card-body" id="videoPlayer" style="height: 350px;" autoplay="autoplay" controls autoplay="">
                            <?php
                            if ($dtVideo->metaData->code == 200) {
                                echo'<source src="' . base_url('asset/video/') . $dtVideo->response->data[0]->file . '" type="video/mp4">';
                            }
                            ?>
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                <div class="col-5">
                    <div id="diPanggil" class="card" style="height: 350px;">
                        <h1 class="card-header text-center" style="font-weight: bold;">Antrian dipanggil</h1>
                        <div class="card-body text-danger">
                            <input type="hidden" id="diPanggilHide" value="0">
                            <h2 class="text-center" style="font-weight: bold;">Loading...</h2>
                            <h1 class="card-title text-center font-weight-bolder" style="font-size: 6rem; font-weight: bold;">0</h1>
                            <h4 class="text-center" style="font-weight: bold;">Loading...</h4>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <?php
                $dtPanel = json_decode($dtPanel);
                // print_r($dtPanel->response->data);
                $lbr = 12 / $dtPanel->response->count;

                foreach ($dtPanel->response->data as $dp) {
                    ?>
                    <div class="col-md-<?php echo $lbr; ?>">
                        <div class="card" id="crd-<?php echo $dp->id_loket; ?>">
                            <input type="hidden" id="hide-<?php echo $dp->id_loket; ?>" value="0">
                            <h2 class="card-header text-center" style="font-weight: bold;"><?php echo $dp->nama; ?></h2>
                            <div class="card-body">
                                <h1 class="card-title text-center" style="font-weight: bold;">0</h1>
                                <h5 class="text-center" style="font-weight: bold;">Loading...</h5>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="cnfrm">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Notifikasi</h5>
                    </div>
                    <div class="modal-body">
                        <p>Jalankan Aplikasi</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="f_close();">Close</button>
                        <button type="button" class="btn btn-primary" onclick="f_ok();">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== 
        -->
        <!-- Placed at the end of the document so the pages load faster -->

        <script src="<?php echo base_url(); ?>asset/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js"></script>
        <!--script src="<?php echo base_url(); ?>assets/js/vendor/popper.min.js"></script-->
        <script src="<?php echo base_url(); ?>asset/js/custom/display.js"></script>
        <!--script src="<?php echo base_url(); ?>assets/js/cus-antrian-nomor.js"></script-->
        <script>
                            $(document).ready(function () {
                                video(<?php echo json_encode($arrVid); ?>);
                                $('#videoPlayer').prop("volume", 0.01);
                                // $('#cnfrm').modal({"backdrop": false});
//				$('#cnfrm').modal('show');
                                ambilAntrian();
                                // panggilData();
//                                $('#videoPlayer').trigger('play');
                            });
        </script>
    </body>
</html>