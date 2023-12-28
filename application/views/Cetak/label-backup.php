<!DOCTYPE HTML>
<html>
    <head>
        <title>Label</title>
        <style>
            @media print{
                @page{
                    size : 192mm 135mm;
                    size : landscape
                }
            }

            /*@page { sheet-size: 192mm 135mm; }*/

            * {
                box-sizing: border-box;
            } 

            body{
                font-size: 9pt; 
            }

            .box{
                float: left;
                /*		    border: solid 0.125mm black;
                                    background-color: #f5f5f5;*/
                width: 60mm;
                height: 28mm;
                margin-bottom: 2mm;
                padding-top:2mm;
                padding-bottom: 2mm;
                padding-left: 2mm;
                padding-right: 2mm;
            }		
            .ml{
                margin-left: 2mm;
            }
            .clearfix::after {
                content: "";
                clear: both;
                display: table;
            }
        </style>
    </head>
    <body>
        <?php
        for ($i = 0; $i < 4; $i++) {
            ?>
            <div class="box">
                <table border="0">
                    <tr>
                        <td>No RM</td>
                        <td>: {norm} / {rmlama}</td>
                    </tr>
                    <tr>
                        <td valign="top">Nama</td>
                        <td valign="top">: 
                            <?php
                            if (strlen($nama) > 13) {
                                echo substr($nama, 0, 12) . "-";
                            } else {
                                echo $nama;
                            }
                            ?>
                            , <?php echo $this->titled->gen_litle_title($umur, $jkel, $sKwn); ?></td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir</td>
                        <td>: <?php echo date('d-m-Y', strtotime($tgllahir)); ?> ({jkel})</td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo strtolower($kelurahan); ?> RT {rtrw}, <?php echo strtolower($kecamatan); ?>, <?php echo strtolower(str_replace("KABUPATEN ", "", $kabupaten)); ?></td>
                    </tr>
                </table>
            </div>
            <div class="box ml">
                <table border="0">
                    <tr>
                        <td>No RM</td>
                        <td>: {norm} / {rmlama}</td>
                    </tr>
                    <tr>
                        <td valign="top">Nama</td>
                        <td valign="top">: 
                            <?php
                            if (strlen($nama) > 13) {
                                echo substr($nama, 0, 12) . "-";
                            } else {
                                echo $nama;
                            }
                            ?>
                            , <?php echo $this->titled->gen_litle_title($umur, $jkel, $sKwn); ?></td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir</td>
                        <td>: <?php echo date('d-m-Y', strtotime($tgllahir)); ?> ({jkel})</td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo strtolower($kelurahan); ?> RT {rtrw}, <?php echo strtolower($kecamatan); ?>, <?php echo strtolower(str_replace("KABUPATEN ", "", $kabupaten)); ?></td>
                    </tr>
                </table>
            </div>
            <div class="box ml">
                <table border="0">
                    <tr>
                        <td>No RM</td>
                        <td>: {norm} / {rmlama}</td>
                    </tr>
                    <tr>
                        <td valign="top">Nama</td>
                        <td valign="top">: 
                            <?php
                            if (strlen($nama) > 13) {
                                echo substr($nama, 0, 12) . "-";
                            } else {
                                echo $nama;
                            }
                            ?>
                            , <?php echo $this->titled->gen_litle_title($umur, $jkel, $sKwn); ?></td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir</td>
                        <td>: <?php echo date('d-m-Y', strtotime($tgllahir)); ?> ({jkel})</td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo strtolower($kelurahan); ?> RT {rtrw}, <?php echo strtolower($kecamatan); ?>, <?php echo strtolower(str_replace("KABUPATEN ", "", $kabupaten)); ?></td>
                    </tr>
                </table>
            </div>
            <?php
        }
        ?>
    </body>
</html>