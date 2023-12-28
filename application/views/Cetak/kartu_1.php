<!DOCTYPE HTML>
<html>
    <head>
        <title>{title}</title>
        <style>
            body{
                font-size: 10pt;
            }

            table{
                width: 100%;
                border-collapse: collapse;
            }
            .jdul{
                font-size: 20px;
                font-size: x-large;
            }

            @page { sheet-size: 100mm 75mm; }

        </style>
    </head>
    <body>
        <div style="border: 1px solid black; height: 100%; padding: 2px;">
            <table>
                <tr>
                    <td colspan="6" align="center" style="padding-bottom:3px;"><b>BKPM PURWOKERTO</b></td>
                </tr>

                <tr>
                    <td colspan="6" align="center" class="jdul" style="padding-bottom:5px;">
                        <u><b style="font-size: 14px;">KARTU TANDA PENGENAL PASIEN</b></u>
                    </td>
                </tr>

<!--                <tr>
    <td>1</td>
    <td>2</td>
    <td>3</td>
    <td>4</td>
    <td>5</td>
    <td>6</td>
</tr>-->

                <tr>
                    <td>Tanggal</td>
                    <td width="2px">:</td>
                    <td colspan="3">{tgldaftar}</td>
                    <td colspan="2"></td>
                </tr>

                <tr>
                    <td>Norm</td>
                    <td>:</td>
                    <td colspan="4">{norm} / {rmlama}</td>
                </tr>

                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td colspan="4">{nama}</td>
                </tr>

                <tr>
                    <td>Tgl Lahir</td>
                    <td>:</td>
                    <td colspan="3">
                        <?php
                        echo date('d-m-Y', strtotime($tgllahir));

                        $umur = floor((time() - strtotime($tgllahir)) / 31556926);
                        echo " / " . $umur." Th";
                        ?>
                    </td>
                    <td>{jeniskel}</td>
                </tr>

                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td colspan="3">{pekerjaan}</td>
                    <td colspan="2"></td>
                </tr>

                <tr>
                    <td valign="top">Alamat</td>
                    <td valign="top">:</td>
                    <td valign="top">Kabupaten</td>
                    <td width="2px" valign="top">:</td>
                    <td colspan="2" valign="top">{kabupaten}</td>
                </tr>

                <tr>
                    <td colspan="2" rowspan="3"><img src="<?php echo base_url() . 'asset/temp/temp.png'; ?>" width="60px" /></td>
                    <td valign="top">Kecamatan</td>
                    <td valign="top">:</td>
                    <td colspan="2" valign="top">{kecamatan}</td>
                </tr>

                <tr>
                    <td valign="top">Kelurahan</td>
                    <td valign="top">:</td>
                    <td colspan="2" valign="top">{kelurahan}</td>
                </tr>
                <tr>
                    <td style="padding-bottom:10px;">RT / RW</td>
                    <td style="padding-bottom:10px;">:</td>
                    <td colspan="2" style="padding-bottom:10px;">{rtrw}</td>
                </tr>

                <tr>
                    <td colspan="6">Bila Kontrol kartu harap dibawa</td>
                </tr>

            </table>
        </div>

    </body>
</html>