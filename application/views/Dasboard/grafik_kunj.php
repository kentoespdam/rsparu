<div class="col-md-12">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Grafik Kunjungan</h3>
        </div>
        <div class="panel-body">
            <form method="post" class="form-horizontal" id="frm-g-kunj" onsubmit="return false;">
                <div class="form-group">
                    <label class="col-md-1">Tahun</label>
                    <div class="col-md-1">
                        <select type="text" id="tahun" class="form-control" >
                            <?php
                            $skrng = date('Y');
                            for ($i = $skrng; $i > $skrng - 5; $i--) {
                                echo $i;
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary" onclick="f_data_graf_kunj();">CARI</button>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-md-12">
                    <div id="g-kunj" style="min-height: 300px;">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function f_data_graf_kunj() {
        var uri_data = "<?php echo base_url(); ?>Grafik/Kunjungan";
        var thn = $('#tahun').val();
        $.post(uri_data, {thn: thn}, function (json) {
            if (json.length == 0) {
                alert('Data Tidak Ditemukan!');
                buka_uri();
            } else {
                append_plot(json);
            }
        }, "json");
    }

    function append_plot(data) {
        var options = {
            series: {
                lines: {
                    show: true
                },
                points: {
                    show: true
                }
            },
            grid: {
                hoverable: true,
                clickable: true
            },
            xaxis: {
                mode: "categories",
                tickLength: 0
            }
        };

        $.plot("#g-kunj", data, options);
    }
    $(document).ready(function () {
        $("<div id='tooltip'></div>").css({
            position: "absolute",
            display: "none",
            border: "1px solid #fdd",
            padding: "2px",
            "background-color": "#fee",
            opacity: 0.80
        }).appendTo("body");

        $("#g-kunj").bind("plothover", function (event, pos, item) {
            if (item) {
                var x = item.datapoint[0].toFixed(2), y = item.datapoint[1];
                $("#tooltip").html(item.series.label + " = " + y)
                        .css({top: item.pageY + 5, left: item.pageX + 5})
                        .fadeIn(200);
            } else {
                $("#tooltip").hide();
            }
        });

        f_data_graf_kunj();

    });

</script>