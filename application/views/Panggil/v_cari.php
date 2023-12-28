<style>
    .table{
        margin-bottom: 0px;
    }
</style>
<div class="box box-info">
    <div class="box-header with-border">
        <form method="post" action="#" class="row" id="frm_cari" style="margin-right: -5px; margin-left: -5px;">
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" id="fnama" placeholder="Nama Pasien" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" id="fdesa" placeholder="Desa" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" id="fkecamatan" placeholder="Kecamatan" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" id="fkabupaten" placeholder="Kabupaten" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" id="frmlama" placeholder="No RM Lama" class="form-control">
                </div>
            </div>
            <div class="col-md-4" id="src_data_pas">
                <div class="input-group" >
                    <input type="text" value="Sedang Mencari..." readonly="" class="form-control" style="background: red; color: white;">
                    <div class="input-group-addon" style="background: red; color: white;">
                        <span class="fa fa-spinner fa-pulse fa-1x"></span>
                    </div>
                </div>

            </div>

        </form>
    </div>


    <div class="box-body">
        <table id="listPasien" class="table table-bordered table-hover dataTable" style="width:100%">
            <thead>
                <tr>
                    <th>aksi</th>
                    <th>Norm</th>
                    <th>Norm Lama</th>
                    <th>Nama</th>
                    <th>JKel</th>
                    <th>Desa</th>
                    <th>Kecamatan</th>
                    <th>Kabupaten</th>
                    <th>NIK</th>
                    <th>No Asuransi</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<script>
    function cariData() {
        $('#src_data_pas').show();
        $('#listPasien tbody').find('tr').remove().end();
        var uriNew = "<?php echo base_url(); ?>API/daftar/pasien/new"
        var uriOld = "<?php echo base_url(); ?>API/daftar/pasien/old"
        var fnama = $('#fnama').val();
        var fdesa = $('#fdesa').val();
        var fkecamatan = $('#fkecamatan').val();
        var fkabupaten = $('#fkabupaten').val();
        var rmlama = $('#rmlama').val();
        var str = "";
        $.post(uriNew, {
            fnama: fnama,
            fdesa: fdesa,
            fkecamatan: fkecamatan,
            fkabupaten: fkabupaten,
        }, function (json) {
            if (json.metaData.code == 200) {
                var str1 = "";
                $.each(json.response.data, function (index, d) {
//                    var data = $('#listPasien tbody').html();
                    str = str + "<tr style='color:blue;' id='norm_" + d.norm.replace('.', '') + "'>"
                            + "<td nowrap><span class='glyphicon glyphicon-eye-open' ondblclick=findData('norm_" + d.norm + "') id='trListPasien'></span></td>"
                            + "<td nowrap>" + d.norm + "</td>"
                            + "<td nowrap>" + d.rmlama + "</td>"
                            + "<td nowrap>" + d.nama + "</td>"
                            + "<td nowrap>" + d.jeniskel + "</td>"
                            + "<td nowrap>" + d.kelurahan + "</td>"
                            + "<td nowrap>" + d.kecamatan + "</td>"
                            + "<td nowrap>" + d.kabupaten + "</td>"
                            + "<td nowrap>" + d.noktp + "</td>"
                            + "<td nowrap>" + d.noasuransi + "</td>"
                            + "</tr>";
//                    set_table(data + str);
                });

            }
        }, "json").always(function () {
            $.post(uriOld, {
                fnama: fnama,
                fdesa: fdesa,
                fkecamatan: fkecamatan,
                fkabupaten: fkabupaten,
            }, function (json) {
                if (json.metaData.code == 200) {
                    $.each(json.response.data, function (index, d) {
//                        var data = $('#listPasien tbody').html();
                        str = str + "<tr id='rmlama_" + d.rmlama.replace('.', '') + "'>"
                                + "<td nowrap><span class='glyphicon glyphicon-eye-open' ondblclick=findData('rmlama_" + d.rmlama + "') id='trListPasien'></span></td>"
                                + "<td nowrap></td>"
                                + "<td nowrap>" + d.rmlama + "</td>"
                                + "<td nowrap>" + d.nama + "</td>"
                                + "<td nowrap>" + d.jeniskel + "</td>"
                                + "<td nowrap>" + d.kelurahan + "</td>"
                                + "<td nowrap>" + d.kecamatan + "</td>"
                                + "<td nowrap>" + d.kabupaten + "</td>"
                                + "<td nowrap>" + d.noktp + "</td>"
                                + "<td nowrap>" + d.noasuransi + "</td>"
                                + "</tr>";
//                        set_table(data + str);
                    });
                }
            }, "json").always(function () {
                set_table(str);
                $('#src_data_pas').hide();
            });
        });


    }

    function cariRmLama() {
        $('#listPasien tbody').find('tr').remove().end();
        var frmlama = $('#frmlama').val();
        var uriOld = '<?php echo base_url(); ?>API/daftar/pasien/old/norm';
        var uriNew = '<?php echo base_url(); ?>API/daftar/pasien/new/old/norm';
        var str = "";
        $.post(uriNew, {norm: frmlama}, function (json) {
            if (json.metaData.code == 200) {
                var str1 = "";
                $.each(json.response.data, function (index, d) {
                    str = str + "<tr style='color:blue;' id='rmlama_" + d.rmlama.replace('.', '') + "'>"
                            + "<td nowrap><span class='glyphicon glyphicon-eye-open' ondblclick=findData('norm_" + d.norm + "') id='trListPasien'></span></td>"
                            + "<td nowrap>"+d.norm+"</td>"
                            + "<td nowrap>" + d.rmlama + "</td>"
                            + "<td nowrap>" + d.nama + "</td>"
                            + "<td nowrap>" + d.jeniskel + "</td>"
                            + "<td nowrap>" + d.kkelurahan + "</td>"
                            + "<td nowrap>" + d.kkecamatan + "</td>"
                            + "<td nowrap>" + d.kkabupaten + "</td>"
                            + "<td nowrap>" + d.noktp + "</td>"
                            + "<td nowrap>" + d.noasuransi + "</td>"
                            + "</tr>";
//                    set_table(str);
                });
            } 
        }, "json").always(function () {
            $.post(uriOld, {norm: frmlama}, function (json) {
                if (json.metaData.code == 200) {
                    var str1 = "";
                    $.each(json.response.data, function (index, d) {
                        str = str + "<tr id='rmlama_" + d.rmlama.replace('.', '') + "'>"
                                + "<td nowrap><span class='glyphicon glyphicon-eye-open' ondblclick=findData('rmlama_" + d.rmlama + "') id='trListPasien'></span></td>"
                                + "<td nowrap></td>"
                                + "<td nowrap>" + d.rmlama + "</td>"
                                + "<td nowrap>" + d.nama + "</td>"
                                + "<td nowrap>" + d.jeniskel + "</td>"
                                + "<td nowrap>" + d.kkelurahan + "</td>"
                                + "<td nowrap>" + d.kkecamatan + "</td>"
                                + "<td nowrap>" + d.kkabupaten + "</td>"
                                + "<td nowrap>" + d.noktp + "</td>"
                                + "<td nowrap>" + d.noasuransi + "</td>"
                                + "</tr>";
//                    set_table(str);
                    });
                } 
            }, "json").always(function () {
                set_table(str);
            });
        });
    }

    function set_table(str) {
        $('#listPasien').DataTable().destroy();
//        console.log(str);
        $('#listPasien tbody').html(str);

        $('#listPasien').DataTable({
            'paging': true,
            "scrollX": true,
            "order": [[0, "desc"]]
        });
    }



    $(document).ready(function () {
        $('#src_data_pas').hide();
        $('#listPasien').DataTable({
            'paging': true,
//            'searching': false,
            "scrollX": true

        });
        $('#fnama').bind("keypress", function (e) {
            if (e.keyCode == 13) {
                cariData();
            }
        });
        $('#fdesa').bind("keypress", function (e) {
            if (e.keyCode == 13) {
                cariData();
            }
        });
        $('#fkecamatan').bind("keypress", function (e) {
            if (e.keyCode == 13) {
                cariData();
            }
        });
        $('#fkabupaten').bind("keypress", function (e) {
            if (e.keyCode == 13) {
                cariData();
            }
        });
        $('#frmlama').bind("keypress", function (e) {
            if (e.keyCode == 13) {
                cariRmLama();
//                cariData();
            }
        });


    });
    $(function () {
//        $('#trListPasien').dblclick(function () {
//        alert("double Click");
//            var b=$(this);
//            console.log(b.attr("val"));
//        });
    });
</script>