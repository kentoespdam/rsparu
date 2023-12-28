<?php
if ($cetak == "true") {
// filename for download
    $filename = "Logbook_RO_" . date('Ymdhis') . ".xls";

    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Type: application/vnd.ms-excel");
}
?>
<html>
    <head>
        <title>Report Rontgen</title>
        <style>
            th{
                text-align: center;
            }
            <?php
            if ($cetak == "true") {
                ?>
                #isi table thead tr{
                    border:solid 2pt;   
                }
                #isi table tbody tr{
                    border:solid 2pt;   
                }
                #isi table tbody tr td{
                    border:solid 2pt;   
                }
                <?php
            }
            ?>
        </style>
    </head>
    <body>
        <table border="0" id="judul">
            <tr>
                <td align="center" colspan="23"><h2>Logbook harian Rontgen BKPM</h2></td>
            </tr>
            <tr>
                <td align="center" colspan="23"><h5>Tanggal {tglMulai}</h5></td>
            </tr>
        </table>

        <br><br>

        <div style="overflow-x:scroll;" id="isi">
            <table border="1pt" class="table table-bordered table-striped table-hover" width="100%">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th colspan="3">Nomor</th>
                        <th rowspan="2">Nama</th>
                        <th rowspan="2">Kelompok</th>
                        <th rowspan="2">Jenis Kel</th>
                        <th rowspan="2">Desa</th>
                        <th rowspan="2">Kecamatan</th>
                        <th rowspan="2">Kabupaten</th>
                        <th rowspan="2">Nama Foto</th>
                        <th rowspan="2">UK Film</th>
                        <th rowspan="2">Kondisi</th>
                        <th colspan="3">Jumlah</th>
                        <th rowspan="2">PA</th>
                        <th rowspan="2">AP</th>
                        <th rowspan="2">LTR</th>
                        <th rowspan="2">OBL</th>
                        <th rowspan="2">Mesin</th>
                        <th rowspan="2">Catatan</th>
                        <th rowspan="2">Petugas</th>
                    </tr>
                    <tr>
                        <th>Urut</th>
                        <th>Reg</th>
                        <th>RM</th>
                        <th>Film</th>
                        <th>Expose</th>
                        <th>Rusak</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $jjmlFilmDipakai = 0;
                    $jjmlExpose = 0;
                    $jjmlFilmRusak = 0;
                    $jpa = 0;
                    $jap = 0;
                    $jlateral = 0;
                    $jobliq = 0;

                    for ($i = 0; $i < $count; $i++) {
                        $jjmlFilmDipakai = $jjmlFilmDipakai + $data[$i]->jmlFilmDipakai;
                        $jjmlExpose = $jjmlExpose + $data[$i]->jmlExpose;
                        $jjmlFilmRusak = $jjmlFilmRusak + $data[$i]->jmlFilmRusak;
                        $jpa = $jpa + $data[$i]->pa;
                        $jap = $jap + $data[$i]->ap;
                        $jlateral = $jlateral + $data[$i]->lateral;
                        $jobliq = $jobliq + $data[$i]->obliq;
                        ?>
                        <tr>
                            <td nowrap><?php echo $i + 1; ?></td>
                            <td nowrap><?php echo $data[$i]->nourut; ?></td>
                            <td nowrap><?php echo $data[$i]->noreg; ?></td>
                            <td nowrap><?php echo $data[$i]->norm; ?></td>
                            <td nowrap><?php echo $data[$i]->nama; ?></td>
                            <td nowrap><?php echo $data[$i]->kelompok; ?></td>
                            <td nowrap><?php echo $data[$i]->jeniskel; ?></td>
                            <td nowrap><?php echo $data[$i]->kelurahan; ?></td>
                            <td nowrap><?php echo $data[$i]->kecamatan; ?></td>
                            <td nowrap><?php echo str_replace("KABUPATEN", "", $data[$i]->kabupaten); ?></td>
                            <td nowrap><?php echo $data[$i]->nmFoto; ?></td>
                            <td nowrap><?php echo $data[$i]->ukuranFilm; ?></td>
                            <td nowrap><?php echo $data[$i]->kondisiRo; ?></td>
                            <td nowrap><?php echo $data[$i]->jmlFilmDipakai; ?></td>
                            <td nowrap><?php echo $data[$i]->jmlExpose; ?></td>
                            <td nowrap><?php echo $data[$i]->jmlFilmRusak; ?></td>
                            <td nowrap><?php echo $data[$i]->pa; ?></td>
                            <td nowrap><?php echo $data[$i]->ap; ?></td>
                            <td nowrap><?php echo $data[$i]->lateral; ?></td>
                            <td nowrap><?php echo $data[$i]->obliq; ?></td>
                            <td nowrap><?php echo $data[$i]->nmMesin; ?></td>
                            <td nowrap><?php echo $data[$i]->catatan; ?></td>
                            <td nowrap><?php echo $data[$i]->gelar_d . "." . $data[$i]->petugas . ", " . $data[$i]->gelar_b; ?></td>
                        </tr>
                        <?php
                    };
                    ?>
                </tbody>
                <thead>
                    <tr>
                        <th colspan="13">Jumlah</th>
                        <td><?php echo $jjmlFilmDipakai; ?></td>
                        <td><?php echo $jjmlExpose; ?></td>
                        <td><?php echo $jjmlFilmRusak; ?></td>
                        <td><?php echo $jpa; ?></td>
                        <td><?php echo $jap; ?></td>
                        <td><?php echo $jlateral; ?></td>
                        <td><?php echo $jobliq; ?></td>
                        <td colspan="3" style="background-color: darkgray;"></td>
                    </tr>
                </thead>
            </table>
        </div>
    </body>
</html>