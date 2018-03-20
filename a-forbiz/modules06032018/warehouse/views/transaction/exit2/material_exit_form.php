<div class="saving_m"></div>
<section class="panel panel-info row">
    <header class="panel-heading lead">
        <i class='fa fa-plus mg-r-sm'></i> <?php /*echo $act;*/ echo $transaction_ct; ?> Material 
    </header>
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'form')); ?>
        <?php if (!empty($mog_dt)) { ?>
            <input type="hidden" name="mog_id" value="<?php echo $mog_dt->mog_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label>Nomor</label>
                    <input type="text" name="mog_number" value="<?php echo empty($mog_dt) ? set_value('mog_number') : $mog_dt->mog_number; ?>" class="form-control" placeholder="Nomor">
                </div>
            </div>
            
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label>Mandor/Sub Kontraktor</label>
                    <select id="actor" name="actor" class="form-control selectpicker" data-style="btn-white" required>
                        <option value="">--- Pilih Supplier ---</option>
                        <?php foreach ($mandor as $man) : ?>
                            <option value="<?php echo $man->actor_id; ?>" <?php if (!empty($mog_dt) && $man->actor_id == $mog_dt->actor_id) echo "selected"; ?> <?php if ($man->actor_id == set_value('actor')) echo "selected"; ?>><?php echo $man->actor_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label>Project</label>
                    <select onchange="get_material(this)" id="project" name="project" class="form-control selectpicker" data-style="btn-white" required>
                        <option value="">--- Pilih Proyek ---</option>
                        <?php foreach ($project as $pro) : ?>
                            <option value="<?php echo $pro->project_id; ?>" <?php if (!empty($mog_dt) && $pro->project_id == $mog_dt->project_id) echo "selected"; ?> <?php if ($pro->project_id == set_value('project')) echo "selected"; ?>><?php echo $pro->project_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <section class="panel">
            <div class="panel-body row">
                <div class="row">
                    <table class="table table-bordered table-striped" style="margin-bottom: 0px">
                        <thead class="bg-dark" style="color: white">
                            <tr>
                                <th class="text-center hidden-xs" style="min-width: 40px; padding: 15px">No.</th>
                                <th class="text-center" style="min-width: 200px; padding: 15px">Material</th>
                                <th class="text-center" style="width: 120px; padding: 15px">Satuan</th>
                                <th class="text-center" style="width: 120px; padding: 15px">Volume</th>
                                <!--<th class="text-center" style="width: 120px; padding: 15px">Price</th>-->
                                <!--<th class="text-center hidden-xs" style="width: 150px; padding: 15px">Sub Total</th>-->
                                <th class="text-center" style="min-width: 30px; padding: 15px"><i class="fa fa-gear"></i></th>
                            </tr>
                        </thead>
                        <tbody id="show_row">
                            
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="<?php echo!empty($mog_dt) ? 'col-xs-6' : 'col-md-6 col-sm-12 col-xs-6' ?> pull-right">
                        <label>Total</label>
                        <input type="text" name="mog_total" id="mog_total"/>
                    </div>
                </div>
                <div class="row" id="add_btn">
                <!--<button class="btn btn-lg btn-dark col-xs-12 mg-t-lg" style="margin-bottom: -15px" onclick="adds_row()" type="button"><i class="fa fa-plus"></i></button>-->
                </div>
            </div>
        </section>
        <div class="row">
            <?php if (!empty($mog_dt)) { ?>
                <div class="<?php echo!empty($mog_dt) ? 'col-xs-6' : null ?> pull-right">
                    <a role="button" style="cursor: pointer" class="cancel_m btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
            <div class="<?php echo!empty($mog_dt) ? 'col-xs-6' : 'col-md-6 col-sm-12 col-xs-6' ?> pull-right">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
//        adds_row();
        
        $(".cancel_m").click(function() {
            $(".mtform").load("<?php echo base_url() ?>warehouse/mog/form/mog");
        });
        
        $("#form_m").submit(function() {
            if ($("input[name=mog_name]").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Material tidak boleh kosong");
                $("input[name=mog_name]").focus();
                return false;
            }
            if ($("input[name=mog_code]").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Material Kode tidak boleh kosong");
                $("input[name=mog_code]").focus();
                return false;
            }
            if ($("select[name=actor]").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Material Unit tidak boleh kosong");
                $("select[name=actor]").focus();
                return false;
            }
            if ($("select[name=project]").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Material Kategori tidak boleh kosong");
                $("select[name=project]").focus();
                return false;
            }
            $(".saving_m").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
            $.ajax({
                url: $("#form_m").attr('action'),
                data: $("#form_m").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 0) {
                        $(".saving_m").html(json.msg);
                    } else {
                        $("#modal-contents").load('<?php echo base_url() ?>warehouse/mog/table/mog');
                        $("#load_sub_form").load('<?php echo base_url() ?>warehouse/mog/form/mog_sub');
                    }
                }
            });
            return false;
        });
    });

function adds_row_() {
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

function get_unit(i) {
    $.ajax({
        url: "<?php echo base_url('warehouse/material/get_unit'); ?>/" + $('#material_' + i).val(),
        dataType: "JSON",
        success: function(json) {
            if (json.status == 1) {
                $("#mog_dt_unit_" + i).attr('value', json.data.material_unit_name);
            }
        }
    });
    return false;
}

function get_count(a, i) {
    if(a && i) {
        a.value = numberToCurrency(a.value);
        var volume = currencyToNumber($("#mog_dt_volume_" + i).val() != '' ? $("#mog_dt_volume_" + i).val() : 0);
        var price = currencyToNumber($("#mog_dt_price_" + i).val() != '' ? $("#mog_dt_price_" + i).val() : 0);
        var count = numberToCurrency(volume * price);
        $("#total_sub_" + i).html(count);
    }
    for (var length = $(".total_sub").length, total = parseInt(0), e = 1; e <= length; e++) {
        var sub_total = currencyToNumber($("#total_sub_" + e).html() ? $("#total_sub_" + e).html() : 0);
        total = total + sub_total;
//        alert(sub_total + ' ' + total);
    }
    $("#mog_total").val(numberToCurrency(total));
}

function cut(el, i) {
    var rowx = $('.row_out').length;
    for (var a = i; a < rowx; a++) {
        var rz = a + 1;
        $("#nom_" + rz).html(a);
        $("#nom_" + rz).attr('class', "nom_" + a);
        $("#nom_" + rz).attr('id', "nom_" + a);
        $("#material_" + rz).attr('onchange', "get_unit(" + a + ")");
        $("#material_" + rz).attr('id', "material_" + a);
        $("#mog_dt_unit_" + rz).attr('id', "mog_dt_unit_" + a);
        $("#mog_dt_volume_" + rz).attr('onkeyup', "get_count(this, " + a + ")");
        $("#mog_dt_volume_" + rz).attr('id', "mog_dt_volume_" + a);
        $("#mog_dt_price_" + rz).attr('onkeyup', "get_count(this, " + a + ")");
        $("#mog_dt_price_" + rz).attr('id', "mog_dt_price_" + a);
        $("#total_sub_" + rz).attr('id', "total_sub_" + a);
        $("#btn_" + rz).attr('onclick', "cut(this, " + a + ")");
        $("#btn_" + rz).attr('id', "btn_" + a);
    }
    var parent = el.parentNode.parentNode;
    parent.parentNode.removeChild(parent);
    get_count();
}

$("#form").submit(function() {
    var err = 0;
    if (err > 0) {
        return false;
    }
    
    if ($("input[name=mog_number]").val() == "") {
        bootbox.alert("Nomor tidak boleh kosong");
        $("input[name=mog_number]").focus();
        return false;
    }
    if ($("select[name=actor]").val() == "") {
        bootbox.alert("Supplier tidak boleh kosong");
        $("select[name=actor]").focus();
        return false;
    }
    if ($("select[name=project]").val() == "") {
        bootbox.alert("Project tidak boleh kosong");
        $("select[name=project]").focus();
        return false;
    }
    
//    var jml_menu_ = $('.row_out').length;
//    for (var e = 1; e <= jml_menu_; e++) {
//        var menu = $("#menu_" + e + " option:selected").val();
//        var qty = $("#qty_" + e).val();
//        var note = $("#note_" + e).val();
//        if (menu != '' && qty == '') {
//            bootbox.alert("Jumlah menu dipesan tidak boleh kosong", function(result) {
//            });
//            $("#qty_" + e).focus();
//            return false;
//        }
//
//        if (menu == '' && qty != '') {
//            bootbox.alert("Menu dipesan tidak boleh kosong", function(result) {
//            });
//            $("#menu_" + e).focus();
//            return false;
//        }
//
//        if ($(".menusa_1 option:selected").val() == '' && $("#qty_1").val() == '') {
//            bootbox.alert("Menu dan jumlah menu dipesan tidak boleh kosong", function(result) {
//            });
//            $("#menu_" + e).focus();
//            return false;
//        }
//    }
    $(".loadertabo1").show();
    $('input').attr('readonly', 'readonly');
    $('select').attr('readonly', 'disabled');
    $('textarea').attr('readonly', 'readonly');
    $.ajax({
        url: $("#form").attr('action'),
        data: $("#form").serialize(),
        type: "POST",
        dataType: "JSON",
        success: function(json) {
            if (json.status == 0) {
                $(".saving").html(json.msg_dt);
                $('input').removeAttr('readonly', 'readonly');
                $('select').removeAttr('readonly', 'readonly');
                $('textarea').removeAttr('readonly', 'readonly');
                $(".loadertabo1").hide();
            } else if (json.status == 1) {
//                $(".saving").html(' ');
//                $(".loadertabo1").hide();
//                id = json.menu_order_id;
//                bootbox.confirm("<i class='fa fa-info-circle mg-r-md'></i>Order berhasil dilakukan. Tekan 'YES' untuk mencetak order", function(result) {
//                    if (result == true) {
//                        setInterval(window.location.replace("<?php echo base_url() ?>order"), 3500);
//                        $.post("<?php echo base_url() ?>order/order/get_order/" + id, "json");
//                    } else {
//                        setInterval(window.location.replace("<?php echo base_url() ?>order"), 2000);
//                    }
//                });
//
//
//                $('#order_').attr('disabled', 'disabled');
//                $('#cancel').attr('disabled', 'disabled');
            }
        }
    });
    return false;
});
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>