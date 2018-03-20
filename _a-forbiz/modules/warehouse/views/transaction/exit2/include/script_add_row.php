<button class="btn btn-lg btn-dark col-xs-12 mg-t-lg" id="adds_row" style="margin-bottom: -15px" onclick="adds_row()" type="button"><i class="fa fa-plus"></i></button>
<script type="text/javascript">
    alert();
function adds_row() {
//    var counterss = $('.row_tam').length + 1;
    var counter = $('.row_out').length + 1;
//    for (var a = counter; a >= counterss; a--) {
//        var rz = a + 1;
//        $("#nom_" + a).html(rz);
//        $("#nom_" + a).attr('class', "nom_" + rz);
//        $("#nom_" + a).attr('id', "nom_" + rz);
//        $("#material_" + a).attr('onchange', "get_unit(" + rz + ")");
//        $("#material_" + a).attr('id', "material_" + rz);
//        $("#mog_dt_unit_" + a).attr('id', "mog_dt_unit_" + rz);
//        $("#mog_dt_volume_" + a).attr('onkeyup', "get_count(this, " + rz + ")");
//        $("#mog_dt_volume_" + a).attr('id', "mog_dt_volume_" + rz);
//        $("#mog_dt_price_" + a).attr('onkeyup', "get_count(this, " + rz + ")");
//        $("#mog_dt_price_" + a).attr('id', "mog_dt_price_" + rz);
//        $("#total_sub_" + a).attr('id', "total_sub_" + rz);
//        $("#btn_" + a).attr('onclick', "cut(this, " + rz + ")");
//        $("#btn_" + a).attr('id', "btn_" + rz);
//
//    }

    var baris = '<tr class="row_out row_tam">'
            + '<td class="text-center hidden-xs"><p id="nom_' + counter + '">' + counter + '</p></td>'
            + '<input type="hidden" name="action[]" value="add" class="form-control">'
            + '<td id="menu_select_' + counter + '">'
            + '<div class="form-group">'
            + '<select id="material_' + counter + '" onchange="get_unit(' + counter + ')" name="material[]" class="form-control selectpicker" data-style="btn-white" required>'
            + '<option value="">--- Pilih Material ---</option>'
            + '<?php foreach ($material_sub as $ms) : ?>'
            + '<option value="<?php echo $ms->material_sub_id; ?>" <?php if (!empty($mog_dt) && $ms->materia_sub_id == $mog_dt->material_sub_id) echo "selected"; ?> <?php if ($ms->material_sub_id == set_value("material")) echo "selected"; ?>><?php echo $ms->material_sub_name; ?></option>'
            + '<?php endforeach; ?>'
            + '</select>'
            + '</div>'
            + '</td>'
            + '<td class="hidden-xs">'
            + '<input type="text" id="mog_dt_unit_' + counter + '" name="mog_dt_unit[]" value="" class="form-control" placeholder="Satuan" readonly>'
            + '</td>'
            + '<td>'
            + '<input id="mog_dt_volume_' + counter + '" class=" form-control " onkeyup="get_count(this,' + counter + ')" name="mog_dt_volume[]" value="" class="form-control" placeholder="Volume">'
            + '</td>'
//            + '<td>'
//            + '<input id="mog_dt_price_' + counter + '" class=" form-control " onkeyup="get_count(this,' + counter + ')" name="mog_dt_price[]" value="" class="form-control" placeholder="Price" required>'
//            + '</td>'
//            + '<td class="hidden-xs total_sub" id="total_sub_' + counter + '">'
//            + '</td>'
            + '<td class="text-center"><button type="button" class="btn btn-danger" id="btn_' + counter + '" onclick="cut(this, ' + counter + ')"><i class="fa fa-times"></i></button></td>'
            + '</tr>';

    $('#show_row').append(baris);
}
</script>