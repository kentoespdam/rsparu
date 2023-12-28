function showDaftarKominfo() {
	$("#displayDaftarKominfo").modal("toggle");
	daftarKominfo();
}
function cariKominfo() {
	var normValue = $("#norm").val();

	// Add leading zeros if the value has less than 6 digits
	while (normValue.length < 6) {
		normValue = "0" + normValue;
	}

	$.ajax({
		url: "kominfo.php",
		method: "POST",
		data: {
			no_rm: normValue,
		},
		dataType: "json",
		success: function (response) {
			console.log(response);
			if (response.error) {
				console.error("Error: " + response.error);
			} else {
				var data = response.response.data;
				console.log(data);
				$("#norm").val("");
				$("#nama").val(data.pasien_nama);
				$("#noktp").val(data.pasien_nik);
				$("#kkelompok").val(data.penjamin_id);
				$("#kkelompok").trigger("change");
				$("#noasuransi").val(data.penjamin_nomor);
				$("#alamat").val(data.pasien_alamat);
				$("#kprovinsi").val(data.provinsi_id);
				$("#kprovinsi").trigger("change");
				setTimeout(function () {
					$("#kkabupaten").val(data.kabupaten_id);
					$("#kkabupaten").trigger("change");
				}, 4000);
				setTimeout(function () {
					$("#kkecamatan").val(data.kecamatan_id);
					$("#kkecamatan").trigger("change");
				}, 8000);
				setTimeout(function () {
					$("#kkelurahan").val(data.kelurahan_id);
					$("#kkelurahan").trigger("change");
				}, 20000);
				$("#rtrw").val(data.pasien_rt + "/" + data.pasien_rw);
				$("#kdAgama").val(data.rs_paru_agama_id);
				$("#kdAgama").trigger("change");
				$("#jeniskel").val(data.jenis_kelamin_nama);
				$("#jeniskel").trigger("change");
				$("#statKawin").val(data.rs_paru_status_kawin);
				$("#statKawin").trigger("change");
				$("#tmptlahir").val(data.pasien_tempat_lahir);
				$("#tgllahir").val(data.pasien_tgl_lahir);
				src_umur();
				$("#kdPendidikan").val(data.rs_paru_pendidikan_id).trigger("change");
				$("#nohp").val(data.pasien_no_hp);
				$("#pjwb").val(data.pasien_penanggung_jawab_nama);
				$("#ktujuan").val("1").trigger("change");
			}
		},
		error: function (error) {
			console.error("Error fetching data:", error);
		},
	});
}
function daftarKominfo2() {
	var kkpm = "<?php echo base_url('Kominfo.php'); ?>";
	var uname = "3301010509940003";
	var pass = "banyumas";
	var today = new Date();
	var formattedDate = today.toISOString().split("T")[0];
	if ($.fn.DataTable.isDataTable("#listDaftarTungguKOminfo")) {
		var table = $("#listDaftarTungguKOminfo").DataTable();
		table.destroy();
	}

	$.ajax({
		url: kkpm,
		method: "POST",
		//dataType: "jsonp",
		data: {
			username: uname,
			password: pass,
			tanggal: formattedDate,
		},

		success: function (json) {
			json.data = json.data.map(function (item) {
				item.aksi = `<a href="#Pendaftaran" class="aksi-button px-2 " data-norm="${item.norm}"><i class="btn btn-success glyphicon glyphicon-eye-open"></i></a>`;
				return item;
			});

			var table = $("#listDaftarTungguKOminfo").DataTable({
				data: json.data,
				columns: [
					{ data: "aksi", className: "col-1 text-center" },
					{ data: "ID Nation", className: "col-1 text-center" },
					{ data: "ID Year" },
					{ data: "Nation" },
					{ data: "Population" },
					{ data: "Slug Nation" },
					{ data: "Year" },
				],
				order: [2, "asc"],
				paging: true,
				lengthMenu: [
					[5, 10, 25, 50, -1],
					[5, 10, 25, 50, "All"],
				],
				pageLength: 5,
				responsive: true,
				lengthChange: true,
				autoWidth: false,
			});

			// Menangani klik pada tombol aksi
			$("#listDaftarTungguKOminfo .aksi-button").on("click", function () {
				var data = table.row($(this).parents("tr")).data();

				var nilaiAwalNama = $("#nama").val();
				$("#norm").val(data["Year"]);
				findData("norm_" + $("#norm").val());

				//cekPerubahanNama(nilaiAwalNama);
				var nilaiSaatIniNama = $("#nama").val();

				// Bandingkan nilai awal dengan nilai saat ini
				if (nilaiAwalNama !== nilaiSaatIniNama) {
					console.log(
						'Nilai "nama" telah berubah:',
						nilaiAwalNama,
						"->",
						nilaiSaatIniNama
					);
				} else {
					var data = table.row($(this).parents("tr")).data();
					console.log(data);
					$("#norm").val("");
					$("#nourut").val(data["Year"]);
					// $("#kkelompok").val(data[""]);
					// $("#kkelompok").trigger("change");
					// $("#kunj").val(data[""]);
					// $("#noasuransi").val(data[""]);
					$("#alamat").val(data["Nation"]);
					// $("#kprovinsi").val(data[""]);
					// $("#kprovinsi").trigger("change");
					// setTimeout(function () {
					//     $("#kkabupaten").val(data[""]);
					//     $("#kkabupaten").trigger("change");
					// }, 1000);
					// setTimeout(function () {
					//     $("#kkecamatan").val(data[""]);
					//     $("#kkecamatan").trigger("change");
					// }, 2000);
					// $("#rtrw").val(data[""]);
					// $("#kdAgama").val(data[""]);
					// $("#jeniskel").val(data[""]);
					// $("#statKawin").val(data[""]);
					// $("#tmptlahir").val(data[""]);
					// $("#tgllahir").val(data[""]);
					// $("#kdPendidikan").val(data[""]);
					// $("#pekerjaan").val(data[""]);
					// $("#norm").val(data[""]);
					// $("#pjwb").val(data["ID Nation"]);
					// $("#ibuKandung").val(data["ID Nation"]);
				}

				$("#displayDaftarKominfo").modal("toggle");
			});
		},
		error: function (xhr, status, error) {
			console.error("Error fetching data:", error);
		},
		complete: function () {
			$("#src_daftarTunggu").addClass("hidden");
		},
	});
}