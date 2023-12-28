<style>
    #dalem tr td{
        border-bottom: 1px solid #f1f1f1;;
    }
</style>
<table id="listRiwayat" class="table table-bordered table-hover" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Anamnesa</th>
            <th>Diagnosa</th>
            <th>Terapi & Pemeriksaan</th>
            <th>Obat</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $data = json_decode($data);
        $n=1;
//        print_r($data->response->data);
        if ($data->metaData->code == 200) {
            foreach ($data->response->data as $d) {
                ?>
                <tr>
                    <td width="3%" align="right">
                        <?php echo $n."."; ?>
                    </td>
                    <td width="10%">
                        <?php echo date("d-m-Y", strtotime($d->tgltrans)); ?>
                    </td>
                    <td width="25%">
                        <table id="dalem" style="font-size: 12px;" width="100%">
                            <tr>
                                <td>TD</td>
                                <td>:</td>
                                <td><?php echo $d->td; ?> Mmhg</td>
                            </tr>
                            <tr>
                                <td>Frek. Nadi</td>
                                <td>:</td>
                                <td><?php echo $d->fnadi; ?> x/menit</td>
                            </tr>
                            <tr>
                                <td>Suhu</td>
                                <td>:</td>
                                <td><?php echo $d->suhu; ?> °C</td>
                            </tr>
                            <tr>
                                <td>Frek. Nafas</td>
                                <td>:</td>
                                <td><?php echo $d->fnafas; ?> x/menit</td>
                            </tr>
                            <tr>
                                <td>BB</td>
                                <td>:</td>
                                <td><?php echo $d->bb; ?> Kg</td>
                            </tr>
                            <tr>
                                <td>Tinggi Badan</td>
                                <td>:</td>
                                <td><?php echo $d->tb; ?> cm</td>
                            </tr>
                            <tr>
                                <td>Hilang Berat Badan 3 Bulan Terakhir</td>
                                <td>:</td>
                                <td><?php echo $d->hilangBB3Bln; ?></td>
                            </tr>
                            <tr>
                                <td>Napsu Makan Turun</td>
                                <td>:</td>
                                <td><?php echo $d->turunAsupMkn; ?></td>
                            </tr>
                            <tr>
                                <td>Kondisi psikologis</td>
                                <td>:</td>
                                <td><?php echo $d->psiko; ?> &nbsp; <?php echo $d->otherPsiko; ?></td>
                            </tr>
                            <tr>
                                <td>Hasil Pemeriksaan Sebelumnya</td>
                                <td>:</td>
                                <td><?php echo $d->hasilPeriksaSebelumnya; ?></td>
                            </tr>
                            <tr>
                                <td>Batuk</td>
                                <td>:</td>
                                <td><?php echo $d->batuk; ?></td>
                            </tr>
                            <tr>
                                <td>Berdahak</td>
                                <td>:</td>
                                <td><?php echo $d->batukDahak; ?></td>
                            </tr>
                            <tr>
                                <td>Batuk Darah</td>
                                <td>:</td>
                                <td><?php echo $d->batukDarah; ?></td>
                            </tr>
                            <tr>
                                <td>Kualitas</td>
                                <td>:</td>
                                <td><?php echo $d->batukDarahKualitas; ?></td>
                            </tr>
                            <tr>
                                <td>Sesak nafas</td>
                                <td>:</td>
                                <td><?php echo $d->sesak; ?></td>
                            </tr>
                            <tr>
                                <td>Suara</td>
                                <td>:</td>
                                <td><?php echo $d->sesakSuara; ?></td>
                            </tr>
                            <tr>
                                <td>Nyeri Dada</td>
                                <td>:</td>
                                <td><?php echo $d->nyeriDada; ?></td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>:</td>
                                <td><?php echo $d->nyeriDadaLok; ?></td>
                            </tr>
                            <tr>
                                <td>Demam</td>
                                <td>:</td>
                                <td><?php echo $d->demam; ?></td>
                            </tr>
                            <tr>
                                <td valign="top">Waktu</td>
                                <td valign="top">:</td>
                                <td>
                                    <?php
                                    $demamWaktu = explode(",", $d->demamWaktuPagi);
                                    for ($i = 0; $i < count($demamWaktu); $i++) {
                                        if ($d->demamWaktuPagi == "-" || $d->demamWaktuPagi == "null") {
                                            echo "-";
                                        } elseif ($demamWaktu[$i] == 0) {
                                            echo "Pagi &nbsp;";
                                        } elseif ($demamWaktu[$i] == 1) {
                                            echo "Siang &nbsp;";
                                        } elseif ($demamWaktu[$i] == 2) {
                                            echo "Sore &nbsp;";
                                        } elseif ($demamWaktu[$i] == 3) {
                                            echo "Malam &nbsp;";
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Keluhan Lain</td>
                                <td>:</td>
                                <td><?php echo $d->keluhanLain; ?></td>
                            </tr>
                        </table>
                    </td>
                    <td width="25%">
                        <table id="dalem" style="font-size: 12px;" width="100%">
                            <tr>
                                <td width="15%" valign="top">Diag1</td>
                                <td width="5%" valign="top">: &nbsp;</td>
                                <td width="80%" valign="top"> <?php echo $d->diagnosa1; ?></td>
                            </tr>
                            <tr>
                                <td valign="top">Diag2</td>
                                <td valign="top">: &nbsp;</td>
                                <td valign="top"> <?php echo $d->diagnosa2; ?></td>
                            </tr>
                            <tr>
                                <td valign="top">Diag2</td>
                                <td valign="top">: &nbsp;</td>
                                <td valign="top"> <?php echo $d->diagnosa3; ?></td>
                            </tr>
                            <tr>
                                <td valign="top">&nbsp;</td>
                                <td valign="top">&nbsp;</td>
                                <td valign="top"> &nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="top">Admin</td>
                                <td valign="top">: &nbsp;</td>
                                <td valign="top">
                                    <?php echo $d->gelar_d_admin; ?>
                                    <?php echo $d->nama_d_admin; ?>,
                                    <?php echo $d->gelar_b_admin; ?>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">Dokter</td>
                                <td valign="top">: &nbsp;</td>
                                <td valign="top"> 
                                    <?php echo $d->gelar_d_dokter; ?>
                                    <?php echo $d->nama_dokter; ?>,
                                    <?php echo $d->gelar_b_dokter; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table id="dalem" style="font-size: 12px;" width="100%">
                            <tr>
                                <td>Inspeksi</td>
                                <td>:</td>
                                <td><?php echo $d->inspeksi; ?></td>
                            </tr>
                            <tr>
                                <td>Perkusi</td>
                                <td>:</td>
                                <td><?php echo $d->perkusi; ?></td>
                            </tr>
                            <tr>
                                <td>Palpasi</td>
                                <td>:</td>
                                <td><?php echo $d->palpasi; ?></td>
                            </tr>
                            <tr>
                                <td>Auskultasi</td>
                                <td>:</td>
                                <td><?php echo $d->auskultasi; ?></td>
                            </tr>
                            <tr>
                                <td>Anemis</td>
                                <td>:</td>
                                <td><?php echo $d->anemis; ?></td>
                            </tr>
                            <tr>
                                <td>Cyanosis</td>
                                <td>:</td>
                                <td><?php echo $d->cyanosis; ?></td>
                            </tr>
                            <tr>
                                <td>Dyspneu</td>
                                <td>:</td>
                                <td><?php echo $d->dyspneu; ?></td>
                            </tr>
                            <tr>
                                <td>Stomatitis</td>
                                <td>:</td>
                                <td><?php echo $d->stomatitis; ?></td>
                            </tr>
                        </table> 
                    </td>
                    <td>
                        Contrary to popular belief, Lorem Ipsum is not simply random text. 
                    </td>
                </tr>
                <?php
                $n++;
            };
        }
        ?>
    </tbody>
</table>
<script>
    $(function () {
        $('#listRiwayat').DataTable({
            "order": [[0, "asc"]]
        });
    });
</script>