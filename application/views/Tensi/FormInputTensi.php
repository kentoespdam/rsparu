<form id="frmTensi" method="post" class="form-horizontal" onsubmit="return false;">
    <div class="form-group">
        <label for="tgltrans" class="col-sm-1">Tanggal</label>
        <div class="col-sm-2">
            <div class="input-group date" data-date-format="yyyy-mm-dd">
                <input type="text" name="tgltrans" id="tgltrans" class="form-control input-sm datepicker" required="required" placeholder="yyyy-mm-dd" value="2019-08-16" readonly="">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>
        <label for="jamdaftar" class="col-sm-1 col-form-label text-right">Jam Daftar</label>
        <div class="col-sm-1">
            <input type="text" name="jamdaftar" id="jamdaftar" class="form-control input-sm" required="required" placeholder="hh:mm::ss" value="<?php echo date("h:i:s"); ?>" readonly="" >
        </div>
    </div>

    <hr class="garisBawah">

    <div class="form-group">
        <label for="norm" class="col-sm-1">Norm.</label>
        <div class="col-sm-2">
            <div class="input-group input-group-sm">
                <input type="text" name="norm" maxlength="6" class="form-control input-sm" id="norm" placeholder="NO RM">
                <div class="input-group-addon btn" id="find_norm" >
                    <span class="glyphicon glyphicon-search"></span>
                </div>
            </div>
        </div>

        <label for="notrans" class="col-sm-1 text-right">No. Trans.</label>
        <div class="col-sm-2">
            <input type="text" id="notrans" name="notrans" class="form-control" placeholder="No. Transaksi" readonly="" required="">
        </div>


    </div>

    <hr class="garisBawah">

    <div class="form-group">
        <label class="col-sm-2">Sumber</label>
        <div class="col-sm-3" style="margin-left: -15px;">
            <label class="radio-inline">
                <input type="radio" name="smbrData" id="smbrData0" value="0" checked>
                Pasien Sendiri
            </label>
            <label for="smbrData1" class="radio-inline">
                <input type="radio" name="smbrData" id="smbrData1" value="1">
                Orang Lain
            </label>
        </div>

        <div class="col-sm-2">
            <input type="text" id="ketSmbrData" name="ketSmbrData" class="form-control" placeholder="Nama Sumber">
        </div>

        <label for="hubSmbrData" class="col-sm-1">Hubungan</label>
        <div class="col-sm-2">
            <input type="text" id="hubSmbrData" name="hubSmbrData" class="form-control" placeholder="Hubungan">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2" for="">Masuk Ke RS</label>
        <div class="col-sm-3" style="margin-left: -15px;">
            <label for="statRujuk0" class="radio-inline">
                <input type="radio" name="statRujuk" id="statRujuk0" value="0" checked=""> Datang Sendiri
            </label>
            <label for="statRujuk1" class="radio-inline">
                <input type="radio" name="statRujuk" id="statRujuk1" value="1"> Rujukan Dari
            </label>
        </div>
        <div class="col-sm-2">
            <input type="text" id="ketStatRujuk" name="ketStatRujuk" class="form-control" placeholder="Rujukan Dari">
        </div>
    </div>

    <hr class="garisBawah">
    <h5 class="col-sm-12 text-center"><b>Pengkajian (Assesmen)</b></h5>
    <hr class="garisBawah">

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">1. Pengukuran Tanda Vital</legend>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4" for="td">A. Tekanan Darah</label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text" id="td" name="td" class="form-control" placeholder="Tekanan Darah" required="">
                        <div class="input-group-addon">
                            <span class="">Mmhg</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4" for="fnadi">B. Frekuensi Nadi</label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text" id="fnadi" name="fnadi" class="form-control" placeholder="Frekuensi Nadi" required="">
                        <div class="input-group-addon">
                            <span class="">x/menit</span>
                        </div>
                    </div>
                </div>
            </div>            
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4" for="suhu">C. Suhu</label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text" id="suhu" name="suhu" class="form-control" placeholder="Suhu" required="">
                        <div class="input-group-addon">
                            <span class="">&deg;C</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4" for="fnafas">D. Frekuensi Nafas </label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text" id="fnafas" name="fnafas" class="form-control" placeholder="Frekuensu Nafas" required="">
                        <div class="input-group-addon">
                            <span class="">x/menit</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">2. Skrining Nutrisi</legend>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4" for="bb">A. Berat Badan</label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text" id="bb" name="bb" class="form-control" placeholder="Berat Badan" required="">
                        <div class="input-group-addon">
                            <span class="">KG</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4" for="tb">B. Tinggi Badan</label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text" id="tb" name="tb" class="form-control" placeholder="Tinggi Badan" required="">
                        <div class="input-group-addon">
                            <span class="">cm</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4" for="bb" style="margin-left: 15px;">C. BB turun 3 bulan terakhir</label>
                <div class="col-sm-5">
                    <label for="hilangBB3Bln0">
                        <input type="radio" name="hilangBB3Bln" id="hilangBB3Bln0" value="0" checked=""> Tidak
                    </label>

                    <label for="hilangBB3Bln1" class="radio-inline">
                        <input type="radio" name="hilangBB3Bln" id="hilangBB3Bln1" value="1"> Ya
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4" for="bb" style="margin-left: 15px;">D. napsu makan turun</label>
                <div class="col-sm-5">
                    <label for="turunAsupMkn0">
                        <input type="radio" name="turunAsupMkn" id="turunAsupMkn0" value="0" checked=""> Tidak
                    </label>

                    <label for="turunAsupMkn1" class="radio-inline">
                        <input type="radio" name="turunAsupMkn" id="turunAsupMkn1" value="1"> Ya
                    </label>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">3. Skrining Fungsional dan Psikologi</legend>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="col-sm-2">A. Kondisi psikologis </label>
                <div class="col-sm-2">
                    <label for="psiko0">
                        <input type="radio" name="psiko" id="psiko0" value="0" checked=""> Tenang
                    </label>
                </div>
                <div class="col-sm-2">
                    <label for="psiko1">
                        <input type="radio" name="psiko" id="psiko1" value="1"> Cemas
                    </label>
                </div>
                <div class="col-sm-2">
                    <label for="psiko2">
                        <input type="radio" name="psiko" id="psiko2" value="2"> Agitas
                    </label>
                </div>
                <div class="col-sm-3" style="margin-left: -5px;">
                    <div class="input-group input-group-sm" style="padding-left: 10px;">
                        <span for="psiko3" class="input-group-addon" style="border: 0px">
                            <input type="radio" name="psiko" id="psiko3" value="3" >
                        </span>
                        <input type="text" id="otherPsiko" name="otherPsiko" class="form-control" placeholder="Lain-Lain">
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">4. Hasil Pemeriksaan Sebelumnya</legend>
        <div class="col-sm-12">
            <textarea id="hasilPeriksaSebelumnya" name="hasilPeriksaSebelumnya" class="form-control" rows="5"></textarea>
        </div>
    </fieldset>
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">5. Anamnesa</legend>
        <div class="form-group">
            <label class="col-sm-12">A. Keluhan Utama/Riwayat Penyakit Sekarang</label>
        </div>

        <div class="form-group">
            <label class="col-sm-2" style="margin-left: 15px;">- Batuk </label>
            <div class="col-sm-2">
                <input type="text" id="batuk" name="batuk" class="form-control" placeholder="Batuk Hari/Bulan, Intensitas" required="">
            </div>

            <label class="col-sm-1">, Berdahak</label>
            <label for="batukDahak0" class="radio-inline">
                <input type="radio" name="batukDahak" id="batukDahak0" value="0" checked=""> Tidak Berdahak
            </label>
            <label for="batukDahak1" class="radio-inline">
                <input type="radio" name="batukDahak" id="batukDahak1" value="1"> Putih
            </label>
            <label for="batukDahak2" class="radio-inline">
                <input type="radio" name="batukDahak" id="batukDahak2" value="2"> Keruh
            </label>
            <label for="batukDahak3" class="radio-inline">
                <input type="radio" name="batukDahak" id="batukDahak3" value="3"> Hijau
            </label>
        </div>

        <div class="form-group">
            <label class="col-sm-2" style="margin-left: 15px;">- Batuk Darah</label>
            <div class="col-sm-2">
                <input type="text" id="batukDarah" name="batukDarah" class="form-control" placeholder="Hari/Bulan, Kuantitas" required="">
            </div>

            <label class="col-sm-1">, Kualitas</label>
            <label for="batukDarahKualitas0" class="radio-inline">
                <input type="radio" name="batukDarahKualitas" id="batukDarahKualitas0" value="0"> Bercak
            </label>
            <label for="batukDarahKualitas1" class="radio-inline">
                <input type="radio" name="batukDarahKualitas" id="batukDarahKualitas1" value="1"> Kental
            </label>
            <label for="batukDarahKualitas2" class="radio-inline">
                <input type="radio" name="batukDarahKualitas" id="batukDarahKualitas2" value="2"> Cair
            </label>
            <label for="batukDarahKualitas3" class="radio-inline">
                <input type="radio" name="batukDarahKualitas" id="batukDarahKualitas3" value="3" checked=""> Tidak Ada Darah
            </label>
        </div>

        <div class="form-group">
            <label for="sesak" class="col-sm-2" style="margin-left: 15px;">- Sesak nafas</label>
            <div class="col-sm-2">
                <input type="text" id="sesak" name="sesak" class="form-control" placeholder="Sesak Nafas Hari/Bulan, Intensitas" required="">
            </div>
            <label for="sesakSuara" class="col-sm-1">, Suara</label>
            <div class="col-sm-3">
                <select id="sesakSuara" name="sesakSuara" class="form-control select2">
                    <option value="Vesikular (normal)">Vesikular (normal)</option>
                    <option value="Wheezing (mengi)">Wheezing (mengi)</option>
                    <option value="Ronchi (ngorok)">Ronchi (ngorok)</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="nyeriDada" class="col-sm-2" style="margin-left: 15px;">- Nyeri Dada</label>
            <div class="col-sm-2">
                <input type="text" id="nyeriDada" name="nyeriDada" class="form-control" placeholder="Nyeri Dada Hari/Bulan, Intensitas" required="">
            </div>
            <label class="col-sm-1">, Lokasi</label>
            <label for="nyeriDadaLok0" class="radio-inline">
                <input type="radio" name="nyeriDadaLok" id="nyeriDadaLok0" value="0"> Kanan
            </label>
            <label for="nyeriDadaLok1" class="radio-inline">
                <input type="radio" name="nyeriDadaLok" id="nyeriDadaLok1" value="1"> Kiri
            </label>
            <label for="nyeriDadaLok2" class="radio-inline">
                <input type="radio" name="nyeriDadaLok" id="nyeriDadaLok2" value="2"> Uluhati
            </label>
            <label for="nyeriDadaLok3" class="radio-inline">
                <input type="radio" name="nyeriDadaLok" id="nyeriDadaLok3" value="3"> Semua Area
            </label>
            <label for="nyeriDadaLok4" class="radio-inline">
                <input type="radio" name="nyeriDadaLok" id="nyeriDadaLok4" value="4" checked=""> Tidak Bisa Ditentukan
            </label>
        </div>

        <div class="form-group">
            <label for="demam" class="col-sm-2" style="margin-left: 15px;">- Demam</label>
            <div class="col-sm-2">
                <input type="text" id="demam" name="demam" class="form-control" placeholder="Demam Hari/Bulan" required="">
            </div>
            <label class="col-sm-1">, Waktu</label>
            <label for="demamWaktuPagi0" class="radio-inline">
                <input type="checkbox" name="demamWaktuPagi[]" id="demamWaktuPagi0" value="0"> Pagi
            </label>
            <label for="demamWaktuPagi1" class="radio-inline">
                <input type="checkbox" name="demamWaktuPagi[]" id="demamWaktuPagi1" value="1"> Siang
            </label>
            <label for="demamWaktuPagi2" class="radio-inline">
                <input type="checkbox" name="demamWaktuPagi[]" id="demamWaktuPagi2" value="2"> Sore
            </label>
            <label for="demamWaktuPagi3" class="radio-inline">
                <input type="checkbox" name="demamWaktuPagi[]" id="demamWaktuPagi3" value="3"> Malam
            </label>
        </div>

        <div class="form-group">
            <label for="keluhanLain" class="col-sm-2" style="margin-left: 15px;">- Keluhan Lain</label>
            <div class="col-sm-8">
                <input type="text" id="keluhanLain" name="keluhanLain" class="form-control" placeholder="Keluhan Lain">
            </div>
        </div>
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">6. Petugas</legend>

        <div class="form-group">
            <label class="col-sm-12">A. Petugas</label>
        </div>

        <div class="form-group">
            <label for="perawat1" class="col-sm-2" style="margin-left: 15px;">Admin</label>
            <div class="col-sm-2">
                <select id="p_admin_tensi" name="p_admin_tensi" class="form-control select2 petugas">
                    <option value="">--Pilih--</option>
                </select>
            </div>

            <label for="perawat2" class="col-sm-1 text-right">Perawat</label>
            <div class="col-sm-2">
                <select id="p_perawat_tensi" name="p_perawat_tensi" class="form-control select2 petugas">
                    <option value="">--Pilih--</option>
                </select>
            </div>

            <label for="ktujuan" class="col-sm-1 text-right">Poli</label>
            <div class="col-sm-2">
                <select id="ktujuan" name="ktujuan" class="form-control select2" required="">
                    <option value="">--Pilih--</option>
                </select>
            </div>
        </div>

    </fieldset>

    <hr class="garisBawah">

    <div class="form-group">
        <div class="col-sm-3">
            <input type="hidden" name="updTensi" id="updTensi" value="0">
            <input type="hidden" name="f_riwayat" id="f_riwayat" value="0">
        </div>
        <div class="col-sm-3"></div>

        <div class="col-sm-6 text-right">
            <div class="btn-group" role="group" aria-label="Basic example" id="bt_grup">
                <span class="btn btn-danger" id="batal" onclick="reset_form_tensi();" >Batal</span>
                <button class="btn btn-success" id="simpanTensi">SIMPAN</button>
            </div>
        </div>
    </div>

</form>
