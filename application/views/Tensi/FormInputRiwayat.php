<form id="frmRiwayat" method="post" class="form-horizontal" onsubmit="return false;">
    <h4 class="col-sm-12 text-center"><b>Riwayat</b></h4>
    <hr class="garisBawah">

    <div class="form-group">
        <label for="rw_norm" class="col-sm-3">Norm.</label>
        <div class="col-sm-2">
            <input type="text" name="rw_norm" maxlength="6" class="form-control input-sm" id="rw_norm" placeholder="NO RM" readonly="" required="">
        </div>
    </div>
    <hr class="garisBawah">

    <div class="form-group">
        <label class="col-sm-3">A. Riwayat Cacat fisik</label>
        <label for="cacatFisik0" class="col-sm-1">
            <input type="radio" id="cacatFisik0" name="cacatFisik" value="0" checked=""> Tidak
        </label>
        <label for="cacatFisik1" class="col-sm-1">
            <input type="radio" id="cacatFisik1" name="cacatFisik" value="1"> Ya
        </label>
        <div class="col-sm-3">
            <input type="text" id="cacatFisikKet" name="cacatFisikKet" class="form-control" placeholder="Keterangan">
        </div>
    </div>
    <hr class="garisBawah">

    <div class="form-group">
        <label class="col-sm-3">B. Riwayat Mengggunakan alat bantu</label>
        <label for="alatBantu0" class="col-sm-1">
            <input type="radio" id="alatBantu0" name="alatBantu" value="0" checked=""> Tidak
        </label>
        <label for="alatBantu1" class="col-sm-1">
            <input type="radio" id="alatBantu1" name="alatBantu" value="1"> Ya
        </label>
        <div class="col-sm-3">
            <input type="text" id="alatBantuKet" name="alatBantuKet" class="form-control" placeholder="Keterangan">
        </div>
    </div>
    <hr class="garisBawah">

    <div class="form-group">
        <label class="col-sm-3">C. Riwayat Penyakit Dahulu</label>
        <label for="penyDahulu0" class="col-sm-2">
            <input type="checkbox" id="penyDahulu0" name="penyDahulu[]" value="0" checked=""> Tidak Ada
        </label>
        <label for="penyDahulu1" class="col-sm-1">
            <input type="checkbox" id="penyDahulu1" name="penyDahulu[]" value="1"> TBC
        </label>
        <label for="penyDahulu2" class="col-sm-1">
            <input type="checkbox" id="penyDahulu2" name="penyDahulu[]" value="2"> Asma
        </label>
        <label for="penyDahulu3" class="col-sm-2">
            <input type="checkbox" id="penyDahulu3" name="penyDahulu[]" value="3"> Hipertensi
        </label>
        <label for="penyDahulu4" class="col-sm-3">
            <input type="checkbox" id="penyDahulu4" name="penyDahulu[]" value="4"> Penyakit Ginjal
        </label>
    </div>

    <div class="form-group">
        <div class="col-sm-3">&nbsp;</div>
        <label for="penyDahulu5" class="col-sm-2">
            <input type="checkbox" id="penyDahulu5" name="penyDahulu[]" value="5"> Penyakit Jantung
        </label>
        <label for="penyDahulu6" class="col-sm-1">
            <input type="checkbox" id="penyDahulu6" name="penyDahulu[]" value="6"> DM
        </label>
        <label for="alatBantu17" class="col-sm-2">
            <input type="checkbox" id="penyDahulu7" name="penyDahulu[]" value="7"> HIV/AIDS
        </label>
    </div>

    <div class="form-group">
        <div class="col-sm-3">&nbsp;</div>
        <label for="penyLain" class="col-sm-2">Penyakit Lain</label>
        <div class="col-sm-4">
            <input type="text" id="penyLain" name="penyLain" class="form-control" placeholder="Penyakit Lain" required="">
        </div>
    </div>
    <hr class="garisBawah">

    <div class="form-group">
        <label class="col-sm-3">D. Riwayat Pengobatan</label>
        <span class="col-sm-2">
            <b>- TBC</b> &nbsp;&nbsp;&nbsp;
            <label for="pengoTB0">
                <input type="radio" id="pengoTB0" name="pengoTB" value="0" checked=""> Tidak
            </label>
            <label for="pengoTB1">
                <input type="radio" id="pengoTB1" name="pengoTB" value="1"> Ya
            </label>
        </span>

        <label for="pengoTBtahun" class="col-sm-1 text-right">Tahun</label>
        <div class="col-sm-1">
            <input type="text" id="pengoTBtahun" class="form-control" name="pengoTBtahun" placeholder="Tahun">
        </div>

        <label for="pengoTBlama" class="col-sm-2 text-right">Lama Berobat</label>
        <div class="col-sm-2">
            <input type="text" id="pengoTBlama" name="pengoTBlama" class="form-control" placeholder="Lama">
        </div>      
    </div>

    <div class="form-group">
        <label for="pengoTBtempat" class="col-sm-4 text-right">Tempat</label>
        <div class="col-sm-4">
            <input type="text" id="pengoTBtempat" name="pengoTBtempat" class="form-control" placeholder="Tempat Pengobatan">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-3">&nbsp;</div>
        <b for="pengoLain" class="col-sm-2">- Pengobatan Lain</b>
        <div class="col-sm-4">
            <input type="text" id="pengoLain" name="pengoLain" class="form-control" placeholder="Pengobatan Lain" required="">
        </div>
    </div>
    <hr class="garisBawah">

    <div class="form-group">
        <label class="col-sm-3">E. Riwayat Penyakit Keluarga</label>
        <label for="penyKeluarga0" class="col-sm-1">
            <input type="radio" id="penyKeluarga0" name="penyKeluarga" value="0" checked=""> Tidak
        </label>
        <label for="penyKeluarga1" class="col-sm-1">
            <input type="radio" id="penyKeluarga1" name="penyKeluarga" value="1"> Ya
        </label>
        <div class="col-sm-3">
            <input type="text" id="penyKeluargaKet" name="penyKeluargaKet" class="form-control" placeholder="Keterangan">
        </div>
    </div>
    <hr class="garisBawah">

    <div class="form-group">
        <label class="col-sm-3">F. Riwayat Alergi</label>
        <label for="alergi0" class="col-sm-1">
            <input type="radio" id="alergi0" name="alergi" value="0" checked=""> Tidak
        </label>
        <label for="alergi1" class="col-sm-1">
            <input type="radio" id="alergi1" name="alergi" value="1"> Ya
        </label>
        <div class="col-sm-3">
            <input type="text" id="alergiKet" name="alergiKet" class="form-control" placeholder="Keterangan">
        </div>
        <label for="alergiReaksi" class="col-sm-1 text-right">Reaksi</label>
        <div class="col-sm-3">
            <input type="text" id="alergiReaksi" name="alergiReaksi" class="form-control" placeholder="Keterangan">
        </div>
    </div>
    <hr class="garisBawah">

    <div class="form-group">
        <label class="col-sm-3">G. Riwayat Operasi</label>
        <label for="operasi0" class="col-sm-1">
            <input type="radio" id="operasi0" name="operasi" value="0" checked=""> Tidak
        </label>
        <label for="operasi1" class="col-sm-1">
            <input type="radio" id="operasi1" name="operasi" value="1"> Ya
        </label>
        <label for="operasiJenis" class="col-sm-2 text-right">Jenis</label>
        <div class="col-sm-3">
            <input type="text" id="operasiJenis" name="operasiJenis" class="form-control" placeholder="Keterangan">
        </div>
    </div>

    <div class="form-group">
        <label for="operasiTahun" class="col-sm-4 text-right">Tahun</label>
        <div class="col-sm-2">
            <input type="text" id="operasiTahun" name="operasiTahun" class="form-control" placeholder="Keterangan">
        </div>
        <label for="operasiTempat" class="col-sm-1 text-right">Tempat</label>
        <div class="col-sm-3">
            <input type="text" id="operasiTempat" name="operasiTempat" class="form-control" placeholder="Keterangan">
        </div>
    </div>
    <hr class="garisBawah">

    <div class="form-group">
        <label class="col-sm-3">I. Kebiasaan</label>
        <label class="col-sm-2">- Perokok</label>
        <label for="rokok0" class="col-sm-1">
            <input type="radio" id="rokok0" name="rokok" value="0" checked=""> Tidak
        </label>
        <label for="rokok1" class="col-sm-1">
            <input type="radio" id="rokok1" name="rokok" value="1"> Ya
        </label>
        <div class="col-sm-4">
            <input type="text" id="rokokKet" name="rokokKet" class="form-control" placeholder="Keterangan">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3">&nbsp;</label>
        <label class="col-sm-2">- Alkoholik</label>
        <label for="alkohol0" class="col-sm-1">
            <input type="radio" id="alkohol0" name="alkohol" value="0" checked=""> Tidak
        </label>
        <label for="alkohol1" class="col-sm-1">
            <input type="radio" id="alkohol1" name="alkohol" value="1"> Ya
        </label>
        <div class="col-sm-4">
            <input type="text" id="alkoholKet" name="alkoholKet" class="form-control" placeholder="Keterangan">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3">&nbsp;</label>
        <label class="col-sm-2">- Obat-obatan</label>
        <label for="obat0" class="col-sm-1">
            <input type="radio" id="obat0" name="obat" value="0" checked=""> Tidak
        </label>
        <label for="obat1" class="col-sm-1">
            <input type="radio" id="obat1" name="obat" value="1"> Ya
        </label>
        <div class="col-sm-4">
            <input type="text" id="obatKet" name="obatKet" class="form-control" placeholder="Keterangan">
        </div>
    </div>
    <hr class="garisBawah">
    
     <div class="form-group">
        <label class="col-sm-3">J. Riwayat Pekerjaan</label>
        <div class="col-sm-3">
            <input type="text" id="kerja" name="kerja" class="form-control" placeholder="Keterangan">
        </div>
    </div>
    <hr class="garisBawah">

    <div class="form-group">
        <div class="col-sm-3"></div>
        <div class="col-sm-3">
            <input type="hidden" name="ins_rw" id="ins_rw" value="0">
        </div>

        <div class="col-sm-6 text-right">
            <div class="btn-group" role="group" aria-label="Basic example" id="bt_grup">
                <!--<span class="btn btn-danger" id="batal" onclick="reset_form_riwayat();" >Batal</span>-->
                <button class="btn btn-success" id="simpanRiwayat" >SIMPAN</button>
            </div>
        </div>
    </div>
</form>