<style>
    .checkbox-inline, .radio-inline {
        position: relative;
        display: inline-block;
        padding-left: 0px;
        margin-bottom: 0;
        font-weight: 400;
        vertical-align: middle;
        cursor: pointer;
    }
</style>
<form id="frmInputPoli" method="post" class="form-horizontal">
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Transaksi</legend>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="tgltrans" class="col-sm-4">Tanggal</label>
                <div class="col-sm-4">
                    <div class="input-group date" data-date-format="yyyy-mm-dd">
                        <input type="text" name="tgltrans" id="tgltrans" class="form-control input-sm datepicker" required="required" placeholder="yyyy-mm-dd" value="2019-08-16" readonly="">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="jamdaftar" class="col-sm-2">Jam Daftar</label>
                <div class="col-sm-4">
                    <input type="text" name="jamdaftar" id="jamdaftar" class="form-control input-sm" required="required" placeholder="hh:mm::ss" value="<?php echo date("h:i:s"); ?>" readonly="" >
                </div> 
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="notrans" class="col-sm-4">notransaksi</label>
                <div class="col-sm-4">
                    <input type="text" id="notrans" name="notrans" class="form-control input-sm" readonly="" placeholder="NO Transaksi">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="norm" class="col-sm-2">norm</label>
                <div class="col-sm-4">
                    <div class="input-group input-group-sm">
                        <input type="text" name="norm" maxlength="6" class="form-control input-sm" id="norm" placeholder="NO RM" required="">
                        <div id="bt_norm" class="input-group-addon btn">
                            <span class="glyphicon glyphicon-search" id="find_norm" ></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">1. Pemeriksaan Fisik</legend>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="inspeksi" class="col-sm-4">Inspeksi</label>
                <div class="col-sm-4">
                    <input type="text" id="inspeksi" name="inspeksi" class="form-control input-sm" placeholder="Inspeksi">
                </div>
            </div>

            <div class="form-group">
                <label for="perkusi" class="col-sm-4">Perkusi</label>
                <div class="col-sm-4">
                    <input type="text" id="perkusi" name="perkusi" class="form-control input-sm" placeholder="Perkusi">
                </div>
            </div>

            <div class="form-group">
                <label for="palpasi" class="col-sm-4">Palpasi</label>
                <div class="col-sm-4">
                    <input type="text" id="palpasi" name="palpasi" class="form-control input-sm" placeholder="Palpasi">
                </div>
            </div>

            <div class="form-group">
                <label for="auskultasi" class="col-sm-4">Auskultasi</label>
                <div class="col-sm-4">
                    <input type="text" id="auskultasi" name="auskultasi" class="form-control input-sm" placeholder="Auskultasi">
                </div>
            </div>
        </div>

        <div class="col-sm-4" style="border-left: solid 1px #ddd;">
            <div class="form-group">
                <label class="col-sm-4" for="anemis">Anemis</label>
                <div class="col-sm-8">
                    <label for="anemis0">
                        <input type="radio" name="anemis" id="anemis0" value="0"> Tidak
                    </label>

                    <label for="anemis1" class="radio-inline">
                        <input type="radio" name="anemis" id="anemis1" value="1"> Ya
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4" for="cyanosis">Cyanosis</label>
                <div class="col-sm-8">
                    <label for="cyanosis0">
                        <input type="radio" name="cyanosis" id="cyanosis0" value="0"> Tidak
                    </label>

                    <label for="cyanosis1" class="radio-inline">
                        <input type="radio" name="cyanosis" id="cyanosis1" value="1"> Ya
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4" for="dyspneu">Dyspneu</label>
                <div class="col-sm-8">
                    <label for="dyspneu0">
                        <input type="radio" name="dyspneu" id="dyspneu0" value="0"> Tidak
                    </label>

                    <label for="dyspneu1" class="radio-inline">
                        <input type="radio" name="dyspneu" id="dyspneu1" value="1"> Ya
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4" for="stomatitis">Stomatitis</label>
                <div class="col-sm-8">
                    <label for="stomatitis0">
                        <input type="radio" name="stomatitis" id="stomatitis0" value="0"> Tidak
                    </label>

                    <label for="stomatitis1" class="radio-inline">
                        <input type="radio" name="stomatitis" id="stomatitis1" value="1"> Ya
                    </label>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">2. Pemeriksaan Penunjang</legend>
        <div class="col-sm-3">
            <div class="form-group">
                <label class="col-sm-12">A. Rontgen</label>
            </div>
            <div class="form-group">
                <label class="col-sm-6" for="rontgen">- Pesan Rontgen</label>
                <div class="col-sm-6">
                    <label for="rontgen" class="radio-inline">
                        <input type="checkbox" name="rontgen" id="rontgen" value="1">
                    </label>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-6" for="rontgen">- Konsul Rontgen</label>
                <div class="col-sm-6">
                    <label for="konsul" class="radio-inline">
                        <input type="checkbox" name="konsul" id="konsul" value="1">
                    </label>
                </div>
            </div>
            
        </div>

        <div class="col-sm-3" style="border-left: solid 1px #ddd;">
            <div class="form-group">
                <label class="col-sm-12">B. Laboratorium</label>
            </div>
            <div class="form-group">
                <label class="col-sm-6" for="tcm">- TCM</label>
                <div class="col-sm-6">
                    <label for="tcm" class="radio-inline">
                        <input type="checkbox" name="tcm" id="tcm" value="1">
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-6" for="bta">- BTA</label>
                <div class="col-sm-6">
                    <label for="bta" class="radio-inline">
                        <input type="checkbox" name="bta" id="bta" value="1">
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-6" for="hematologi">- Hematologi</label>
                <div class="col-sm-6">
                    <label for="hematologi" class="radio-inline">
                        <input type="checkbox" name="hematologi" id="hematologi" value="1">
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-6" for="kimiaDarah">- Kimia Klinik</label>
                <div class="col-sm-6">
                    <label for="kimiaDarah" class="radio-inline">
                        <input type="checkbox" name="kimiaDarah" id="kimiaDarah" value="1">
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-6" for="imunoSerologi">- Imuno serologi </label>
                <div class="col-sm-6">
                    <label for="imunoSerologi" class="radio-inline">
                        <input type="checkbox" name="imunoSerologi" id="imunoSerologi" value="1">
                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-3" style="border-left: solid 1px #ddd;">
            <div class="form-group">
                <label class="col-sm-4">C. Lain-Lain</label>
            </div>

            <div class="form-group">
                <label class="col-sm-6" for="mantoux">- Tes Mantoux  </label>
                <div class="col-sm-6">
                    <label for="mantoux" class="radio-inline">
                        <input type="checkbox" name="mantoux" id="mantoux" value="1">
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-6" for="ekg">- EKG </label>
                <div class="col-sm-6">
                    <label for="ekg" class="radio-inline">
                        <input type="checkbox" name="ekg" id="ekg" value="1">
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-6" for="mikroCo">- Mikro CO </label>
                <div class="col-sm-6">
                    <label for="mikroCo" class="radio-inline">
                        <input type="checkbox" name="mikroCo" id="mikroCo" value="1">
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-6" for="spirometri">- Spirometri</label>
                <div class="col-sm-6">
                    <label for="spirometri" class="radio-inline">
                        <input type="checkbox" name="spirometri" id="spirometri" value="1">
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-6" for="spo2">- SpO2 </label>
                <div class="col-sm-6">
                    <div class="input-group input-group-sm">
                        <input type="text" id="spo2" name="spo2" class="form-control input-sm" placeholder="SpO2">
                        <div class="input-group-addon btn">%</div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">3. Diagnosa</legend>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-sm-4">Diagnosa 1</label>
                <div class="col-sm-8">
                    <select name="diagnosa1" id="diagnosa1" class="form-control select2 diagnosa">
                        <option value="">--Pilih--</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-sm-4">Diagnosa 2</label>
                <div class="col-sm-8">
                    <select name="diagnosa2" id="diagnosa2" class="form-control select2 diagnosa">
                        <option value="">--Pilih--</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-sm-4">Diagnosa 3</label>
                <div class="col-sm-8">
                    <select name="diagnosa3" id="diagnosa3" class="form-control select2 diagnosa">
                        <option value="">--Pilih--</option>
                    </select>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">4. Tindakan Medis</legend>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-3" for="nebulizer">Nebulizer</label>
                <div class="col-sm-6">
                    <div class="input-group input-group-sm">
                        <input type="text" id="nebulizer" name="nebulizer" class="form-control input-sm" placeholder="Nebulizer">
                        <div class="input-group-addon btn">X</div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3" for="infus">Infus</label>
                <div class="col-sm-6">
                    <textarea id="infus" name="infus" class="form-control"></textarea>
                </div>
            </div>
        </div>

        <div class="col-sm-6" style="border-left: solid 1px #ddd;">
            <div class="form-group">
                <label class="col-sm-3" for="oksigenasi" >Oksigenasi</label>
                <div class="col-sm-6">
                    <div class="input-group input-group-sm">
                        <input type="text" id="oksigenasi" name="oksigenasi" class="form-control input-sm" placeholder="Oksigenasi">
                        <div class="input-group-addon btn">I/mnt</div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3" for="injeksi">Injeksi</label>
                <div class="col-sm-6">
                    <textarea id="injeksi" name="injeksi" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">5. Terapi & Edukasi</legend>
        <div class="col-sm-12">
            <textarea id="terapi" name="terapi" class="form-control" rows="5"></textarea>
        </div>
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">6. Petugas</legend>
        <div class="col-sm-4">
            <label class="col-sm-4" for="p_admin_poli">Admin</label>
            <div class="col-sm-8">
                <select id="p_admin_poli" name="p_admin_poli" class="form-control select2 perawat" required="">
                    <option value="">--Pilih--</option>
                </select>
            </div>
        </div>
        <div class="col-sm-4" style="border-left: solid 1px #ddd;">
            <label class="col-sm-4" for="p_dokter_poli">Dokter</label>
            <div class="col-sm-8">
                <select id="p_dokter_poli" name="p_dokter_poli" class="form-control select2 dokter" required="">
                    <option value="">--Pilih--</option>
                </select>
            </div>
        </div>

    </fieldset>
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">7. Konsul</legend>
        <div class="col-sm-4">
            <label class="col-sm-4" for="p_admin_poli_konsul">Admin</label>
            <div class="col-sm-8">
                <select id="p_admin_poli_konsul" name="p_admin_poli_konsul" class="form-control select2 perawat">
                    <option value="">--Pilih--</option>
                </select>
            </div>
        </div>
        <div class="col-sm-4" style="border-left: solid 1px #ddd;">
            <label class="col-sm-4" for="p_dokter_poli_konsul">Dokter</label>
            <div class="col-sm-8">
                <select id="p_dokter_poli_konsul" name="p_dokter_poli_konsul" class="form-control select2 dokter">
                    <option value="">--Pilih--</option>
                </select>
            </div>
        </div>

    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">8. Poli Tujuan</legend>
        <div class="col-sm-4">
            <label for="ktujuan" class="col-sm-4">Poli Tujuan</label>
            <div class="col-sm-8">
                <select id="ktujuan" name="ktujuan" class="form-control select2" required="">
                    <option value="">--Pilih--</option>
                </select>
            </div>
        </div>
    </fieldset>

    <hr class="garisBawah">

    <div class="form-group">
        <div class="col-sm-3">
            <input type="hidden" id="updPoli" name="updPoli" value="0">
        </div>
        <div class="col-sm-3"></div>

        <div class="col-sm-6 text-right">
            <div class="btn-group" role="group" aria-label="Basic example" id="rst">
                <span class="btn btn-danger" id="rst-bt" onclick="batal();" >Batal</span>
                <button class="btn btn-success" id="save-bt">SIMPAN</button>
            </div>
        </div>
    </div>
</form>


<script>
    $(document).ready(() => {
        $('.select2').select2();
    });
</script>