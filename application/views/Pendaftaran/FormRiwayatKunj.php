<!--<style>
    .table{
        margin-bottom: 0px;
    }
</style>-->

<div class="box-body" style="border-bottom: solid 1px #0004;">
    <form method="post" action="#" class="row form-horizontal" id="frm_cari_riwayat" style="margin-right: -5px; margin-left: -5px;">
        <div class="col-md-3">
            <div class="form-group">
		    <div class="input-group input-group-sm">
			  <input type="text" id="frnama" placeholder="Nama Pasien" class="form-control">
			  <div class="input-group-addon btn">
				<span class="glyphicon glyphicon-search" onclick="cariDataRiwayatKunj();" ></span>
			  </div>
		    </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
		    <div class="input-group input-group-sm">
			  <input type="text" id="frdesa" placeholder="Desa" class="form-control">
			  <div class="input-group-addon btn">
				<span class="glyphicon glyphicon-search" onclick="cariDataRiwayatKunj();" ></span>
			  </div>
		    </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
		    <div class="input-group input-group-sm">
			  <input type="text" id="frkecamatan" placeholder="Kecamatan" class="form-control">
			  <div class="input-group-addon btn">
				<span class="glyphicon glyphicon-search" onclick="cariDataRiwayatKunj();" ></span>
			  </div>
		    </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
		    <div class="input-group input-group-sm">
			  <input type="text" id="frkabupaten" placeholder="Kabupaten" class="form-control">
			  <div class="input-group-addon btn">
				<span class="glyphicon glyphicon-search" onclick="cariDataRiwayatKunj();" ></span>
			  </div>
		    </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
		    <div class="input-group input-group-sm">
			  <input type="text" id="frrmlama" placeholder="No RM" class="form-control">
			  <div class="input-group-addon btn">
				<span class="glyphicon glyphicon-search" onclick="cariDataRiwayatKunj('norm');" ></span>
			  </div>
		    </div>
            </div>
        </div>
        <div class="col-md-4" id="src_data_riwayat">
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
    <table id="listRiwayatKunj" class="table table-bordered table-hover dataTable" style="width:100%">
        <thead>
            <tr>
                <!--<th>aksi</th>-->
                <th>Norm</th>
                <th>Tgl Kunj</th>
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

<script>
    cariDataRiwayatKunj = (param) => {
	  var strRiwayatKunj = "";
	  $('#src_data_riwayat').show();
	  $('#listRiwayatKunj tbody').find('tr').remove().end();
	  var uriNew = base_uri + "API/riwayat/kunjungan/pasien";
	  if (param == "norm") {
		uriNew = base_uri + "API/riwayat/kunjungan/pasien/norm";
	  }

	  var frnama = $('#frnama').val();
	  var frdesa = $('#frdesa').val();
	  var frkecamatan = $('#frkecamatan').val();
	  var frkabupaten = $('#frkabupaten').val();
	  var frrmlama = $('#frrmlama').val();
	  var str = "";

	  $.post(uriNew, {
		frnama: frnama,
		frdesa: frdesa,
		frkecamatan: frkecamatan,
		frkabupaten: frkabupaten,
		norm: frrmlama,
	  }, function (json) {
		if (json.metaData.code == 200) {
		    $.each(json.response.data, function (index, d) {
			  strRiwayatKunj += "<tr style='color:blue;' id='norm_" + d.norm.replace('.', '') + "'>"
//				    + "<td nowrap><span class='glyphicon glyphicon-eye-open' ondblclick=findData('norm_" + d.norm + "') id='trListPasien'></span></td>"
				    + "<td nowrap>" + d.norm + "</td>"
				    + "<td nowrap>" + d.tgltrans + "</td>"
				    + "<td nowrap>" + d.nama + "</td>"
				    + "<td nowrap>" + d.jeniskel + "</td>"
				    + "<td nowrap>" + d.kelurahan + "</td>"
				    + "<td nowrap>" + d.kecamatan + "</td>"
				    + "<td nowrap>" + d.kabupaten + "</td>"
				    + "<td nowrap>" + d.noktp + "</td>"
				    + "<td nowrap>" + d.noasuransi + "</td>"
				    + "</tr>";
		    });
		}
	  }, "json").always(function () {
		$('#src_data_riwayat').hide();
		$('#listRiwayatKunj').DataTable().destroy();
		$('#listRiwayatKunj tbody').html(strRiwayatKunj);
		$('#listRiwayatKunj').DataTable({
		    'paging': true,
		    "scrollX": true,
		    "order": [[0, "desc"]]
		});
	  });
    };

    $(document).ready(() => {
	  $('#src_data_riwayat').hide();
	  $('#frnama').bind("keydown", function (e) {
		if (e.keyCode == 13) {
		    cariDataRiwayatKunj();
		}
	  });
	  $('#frdesa').bind("keydown", function (e) {
		if (e.keyCode == 13) {
		    cariDataRiwayatKunj();
		}
	  });
	  $('#frkecamatan').bind("keydown", function (e) {
		if (e.keyCode == 13) {
		    cariDataRiwayatKunj();
		}
	  });
	  $('#frkabupaten').bind("keydown", function (e) {
		if (e.keyCode == 13) {
		    cariDataRiwayatKunj();
		}
	  });
	  $('#frrmlama').bind("keydown", function (e) {
		if (e.keyCode == 13) {
		    cariDataRiwayatKunj('norm');
		}
	  });
    });
</script>