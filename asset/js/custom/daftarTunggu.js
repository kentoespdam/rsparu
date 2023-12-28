function showDaftarTunggu() {
    $('#displayDaftarTungguModal').modal('toggle');
    cariDaftarTunggu();
}

function showDaftarKominfo() {
    $('#displayDaftarKominfo').modal('toggle');
    
}

function f_data(norm) {
    $('#displayDaftarTungguModal').modal('toggle');
    findData(norm);
}

function removeTunggu(notrans, norm, nama) {
    var c = confirm("Yakin Akan Menghapus Data Kunjungan " + norm + " , a.n. " + nama + "? ");
    if (c == true) {
	  $('#displayDaftarTungguModal').modal('toggle');
	  $.post(base_uri + "Pendaftaran/Delete/Kunjungan", {"notrans": notrans}, function (json) {
              var tipe="success";
              if(json.metaData.code==304){
                  tipe="danger";
              }
		$.notify({
		    // options
		    message: json.response.message,
		}, {
		    delay: 5000,
		    timer: 1000,
		    type: tipe
		});

	  }, "json");
    }
}

function cariDaftarTunggu() {
    var uri = base_uri + 'Tensi/DaftarTunggu/showData';
    var tgl = $('#tgl').val();
    if ($.fn.DataTable.isDataTable('#listDaftarTunggu')) {
	  $('#listDaftarTunggu').DataTable().destroy();
    }
    $('#listDaftarTunggu tbody').find('tr').remove().end();
    $('#src_daftarTunggu').removeClass('hidden');
    $.post(uri, {tgl: tgl}, function (json) {

    }, "json").always(function (json) {
	  if (json.metaData.code == 200) {
		let str = "";
		let selesai = "<label class='label label-primary'>Belum Selesai</label>";
		$.each(json.response.data, function (index, t) {
		    if (t.selesai == 1) {
			  selesai = "<label class='label label-success'>Selesai</label>";
		    }
		    else {
			  selesai = "<label class='label label-primary'>Belum Selesai</label>";
		    }
		    str = str + "<tr>"
				+ "<td nowrap style=\"width: 75px;\" >"
				+ '<div class="btn-group btn-group-xs" role="group" aria-label="Basic example" id="rst">'
				+ "<span class='btn btn-success glyphicon glyphicon-eye-open' onclick=\"f_data('norm_" + t.norm + "')\" id='viewTungguPasien'></span>"
				+ "<span class='btn btn-danger glyphicon glyphicon-remove' onclick=\"removeTunggu('" + t.notrans + "','" + t.norm + "','" + t.nama + "')\" id='removeTungguPasien'></span>"
				+ '</div>'
				+ "</td>"
				+ "<td>" + t.nourut + "</td>"
				+ "<td>" + t.norm + "</td>"
				+ "<td>" + t.noktp + "</td>"
				+ "<td>" + t.kelompok + "</td>"
				+ "<td>" + t.noasuransi + "</td>"
				+ "<td>" + t.nama + "</td>"
				+ "<td>" + t.jeniskel + "</td>"
				+ "<td>" + t.kelurahan + "</td>"
				+ "<td>" + t.kunj + "</td>"
				+ "<td>" + t.tujuan + "</td>"
				+ "<td>" + selesai + "</td>"
				+ "</tr>";
		});
		// console.log(str);

		$('#listDaftarTunggu tbody').html(str);
		if (!$.fn.DataTable.isDataTable('#listDaftarTunggu')) {
		    $('#listDaftarTunggu').DataTable().destroy();
		    setTimeout(function () {
			  $('#listDaftarTunggu').DataTable({
				'paging': true,
				"scrollX": true,
				"order": [[0, "desc"]]
			  });
		    }, 100);
		}
		// $('#src_daftarTunggu').addClass('hidden');
	  }

	  $('#src_daftarTunggu').addClass('hidden');
    });
}

