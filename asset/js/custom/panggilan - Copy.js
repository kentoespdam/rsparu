var base_uri;
if (window.location.host == "rsparu.kentoes.com") {
    base_uri = window.location.origin + "/";
}
else {
    base_uri = window.location.origin + "/rsparu/";
}

//            MENU PANGGIL
$('#panggilBtn').on("click", function () {
    $('#displayModal').modal('toggle');
    var loket = $('#loket').val();
    $('#exampleModalLongTitle').html("Panggil Loket " + loket);
    var url = base_uri+"API/panggil/Loket";
	if ($.fn.DataTable.isDataTable('#lAntri')) {
        $('#lAntri').DataTable().destroy();
    }
    // console.log(url);
    $.getJSON(url, function (json) {
        if (json.metaData.code == 200) {
			var str="";
            $('#listAntri').find('tr').remove().end();
            $.each(json.response.data, function (index, t) {
                var noAntri = parseInt(t.NoAntri);
				var warna="";
				var statPanggil="1 NORMAL";
				// console.log(parseInt(t.LEWATI));
				if(parseInt(t.lewati)===1 ){ 
					if(parseInt(t.Panggil)===1){
						warna="success";
						statPanggil="di Panggil";
					}else{
						warna="danger";
						statPanggil="Lewati";
					}
				}else{
					if(parseInt(t.Panggil)===1){
						warna="success";
						statPanggil="di Panggil";
					}
				}
				
				
                str = str + '<tr class="'+warna+'">' +
                    '<td>' + t.NoAntri + '</td>' +
                    '<td>' + t.jenis + '</td>' +
                    '<td>' + t.LOKET + '</td>' +
                    '<td>' + t.Panggil + '</td>' +
                    '<td>' + statPanggil + '</td>' +
                    '<td> <span class="btn btn-primary btn-sm" onclick="panggil(' + noAntri + ',' + loket + ');" >Panggil</span></td>' +
                    '</tr>';
                
            });
			$('#listAntri').html(str);
			setTimeout(function(){
				$('#lAntri').DataTable({
					"order": [[ 3, "ASC" ]]
				});
			},"1000");
			
        }
    });
});

function panggil(noAntri, loket) {
    var tgl = $('#tgldaftar').val();
    var url = base_uri + "API/panggil/tmp/addTmp/noAntri/" + noAntri + "/loket/" + loket;
    $.getJSON(url, function (json) {
        if (json.metaData.code == 201) {
            var str = "upd_data(" + noAntri + ", " + loket + ", 0);";
            // var str1 = "lewati('" + tgl + "');";
            $('#displayModal').modal('toggle');
            $('#nourut').val(noAntri);
            $('#ulangBtn').removeAttr("onClick");
            $('#ulangBtn').attr("onClick", str);
            // $('#lewatiBtn').removeAttr("onClick");
            // $('#lewatiBtn').attr("onClick", str1);
        }
    });
}

function upd_data(noAntri, loket, panggil) {
    $.getJSON(base_uri + "API/panggil/tmp/updTmp/noAntri/" + noAntri + "/loket/" + loket + "/panggil/" + panggil, function (json) {
        // console.log(json.metaData.code);
    });
}

function lewati(){
	var noAntri=$("#nourut").val();
	// console.log("noAntri:"+noAntri);
	var tgl = $('#tgldaftar').val();
	var dob = new Date(tgl);
	nTgl=dob.getFullYear() + "-" + parseInt(dob.getMonth() + 1) + "-"+dob.getDate();
	if(noAntri!==""){
		$.getJSON(base_uri + "API/panggil/tmp/lewati/"+noAntri+"/tanggal/"+nTgl, function (json) {
			$("#nourut").val("");
			// console.log(json.metaData.code);
		});
	}
}