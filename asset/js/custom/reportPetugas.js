src_data = () => {
    if ($.fn.DataTable.isDataTable('#lst')) {
        $('#lst').DataTable().destroy();
    }
    $.post(base_uri + "Report/Petugas/showData", $('#frm').serialize(), (json) => {
        $('#lst tbody').html("");
        if (json.metaData.code == 200) {
            var str = "";
            $.each(json.response.data, (index, t) => {
                str += "<tr>"
                        + "<td>" + t.sts + "</td>"
                        + "<td>" + t.nama + "</td>"
                        + "<td>" + t.jml + "</td>"
                        + "<td>" + t.nip + "</td>"
                        + "</tr>";
            });
            $('#lst tbody').html(str);
            setTimeout(function () {
                var tbl=$('#lst').DataTable();
                tbl.order([2, 'asc']).draw();
            }, 100);
        } else {
            alert('Data tidak ditemukan!');
        }
    }, "json");
}

$(document).ready(() => {
    showMenu();
//    $('#lst').dataTable();

    $('.select2').select2();
});