<div class="saving_m"></div>
<section class="panel panel-info row">
    <header class="panel-heading lead">
        <i class='fa fa-plus mg-r-sm'></i> <?php echo $transaction_ct == 1 ? "Entry" : "Exit"; echo ' ' . $title; ?> 
    </header>
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'form')); ?>
        <input type="hidden" name="transaction_ct" value="<?php echo $transaction_ct; ?>"/>
        <?php if (!empty($equip_trans_dt)) { ?>
            <input type="hidden" name="equipment_transaction_id" value="<?php echo $equip_trans_dt->equipment_transaction_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label>Nomor</label>
                    <input type="text" name="equipment_transaction_number" value="<?php echo empty($equip_trans_dt) ? set_value('equipment_transaction_number') : $equip_trans_dt->equipment_transaction_number; ?>" class="form-control" placeholder="Nomor">
                </div>
            </div>
            
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label>Supplier</label>
                    <select id="actor" name="actor" class="form-control selectpicker" data-style="btn-white" required>
                        <option value="">--- Pilih Supplier ---</option>
                        <?php foreach ($actor as $act) : ?>
                            <option value="<?php echo $act->actor_id; ?>" <?php if (!empty($equip_trans_dt) && $act->actor_id == $equip_trans_dt->actor_id) echo "selected"; ?> <?php if ($act->actor_id == set_value('actor')) echo "selected"; ?>><?php echo $act->actor_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label>Project</label>
                    <select id="project" name="project" class="form-control selectpicker" data-style="btn-white" required>
                        <option value="">--- Pilih Proyek ---</option>
                        <?php foreach ($project as $pro) : ?>
                            <option value="<?php echo $pro->project_id; ?>" <?php if (!empty($equip_trans_dt) && $pro->project_id == $equip_trans_dt->project_id) echo "selected"; ?> <?php if ($pro->project_id == set_value('project')) echo "selected"; ?>><?php echo $pro->project_name; ?></option>
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
                                <th class="text-center hidden-xs" style="width: 40px; padding: 15px">No.</th>
                                <th class="text-center" style="width: 200px; padding: 15px">Equipment</th>
                                <th class="text-center" style="width: 120px; padding: 15px">Unit</th>
                                <th class="text-center" style="width: 250px; padding: 15px">Condition</th>
                                <th class="text-center" style="width: 90px; padding: 15px">Volume</th>
                                <th class="text-center" style="width: 120px; padding: 15px">Price</th>
                                <th class="text-center hidden-xs" style="width: 150px; padding: 15px">Sub Total</th>
                                <th class="text-center" style="width: 30px; padding: 15px"><i class="fa fa-gear"></i></th>
                            </tr>
                        </thead>
                        <tbody id="show_row">
                            
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="<?php echo!empty($equip_trans_dt) ? 'col-xs-6' : 'col-md-6 col-sm-12 col-xs-6' ?> pull-right">
                        <label>Total</label>
                        <input type="text" name="equipment_transaction_total" id="equipment_transaction_total"/>
                    </div>
                </div>
                <button class="btn btn-lg btn-dark col-xs-12 mg-t-lg" style="margin-bottom: -15px" onclick="adds_row()" type="button"><i class="fa fa-plus"></i></button>
            </div>
        </section>
        <div class="row">
            <?php if (!empty($equip_trans_dt)) { ?>
                <div class="<?php echo!empty($equip_trans_dt) ? 'col-xs-6' : null ?> pull-right">
                    <a role="button" style="cursor: pointer" class="cancel_m btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
            <div class="<?php echo!empty($equip_trans_dt) ? 'col-xs-6' : 'col-md-6 col-sm-12 col-xs-6' ?> pull-right">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        adds_row();
        
        $(".cancel_m").click(function() {
            $(".mtform").load("<?php echo base_url() ?>warehouse/equipment_transaction/form/equipment_transaction");
        });
        $("#form_m").submit(function() {
            if ($("input[name=equipment_transaction_name]").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Material tidak boleh kosong");
                $("input[name=equipment_transaction_name]").focus();
                return false;
            }
            if ($("input[name=equipment_transaction_code]").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Material Kode tidak boleh kosong");
                $("input[name=equipment_transaction_code]").focus();
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
                        $("#modal-contents").load('<?php echo base_url() ?>warehouse/equipment_transaction/table/equipment_transaction');
                        $("#load_sub_form").load('<?php echo base_url() ?>warehouse/equipment_transaction/form/equipment_transaction_sub');
                    }
                }
            });
            return false;
        });
    });

function adds_row() {
    var counter = $('.row_out').length + 1;
    
    var baris = '<tr class="row_out row_tam">'
            + '<td class="text-center hidden-xs"><p id="nom_' + counter + '">' + counter + '</p></td>'
            + '<input type="hidden" name="action[]" value="add" class="form-control">'
            + '<td id="equipment_' + counter + '">'
            + '<div class="form-group">'
            + '<select id="equipment_' + counter + '" onchange="get_unit(this, ' + counter + ')" name="equipment[]" class="form-control selectpicker" data-style="btn-white" required>'
            + '<option value="">--- Pilih Equipment ---</option>'
            + '<?php foreach ($equipment as $eq) : ?>'
            + '<option value="<?php echo $eq->equipment_id; ?>" <?php if (!empty($equip_trans_dt) && $eq->materia_sub_id == $equip_trans_dt->equipment_id) echo "selected"; ?> <?php if ($eq->equipment_id == set_value("material")) echo "selected"; ?>><?php echo $eq->equipment_name; ?></option>'
            + '<?php endforeach; ?>'
            + '</select>'
            + '</div>'
            + '</td>'
            + '<td class="hidden-xs">'
            + '<input type="text" id="unit_' + counter + '" name="unit[]" value="" class="form-control" placeholder="Satuan" readonly>'
            + '</td>'
            + '<td class="hidden-xs">'
            + '<input type="text" id="condition_' + counter + '" name="condition[]" value="" class="form-control" placeholder="Kondisi">'
            + '</td>'
            + '<td>'
            + '<input id="volume_' + counter + '" class=" form-control " onkeyup="get_count(this,' + counter + ')" name="volume[]" value="" class="form-control" placeholder="Volume">'
            + '</td>'
            + '<td>'
            + '<input id="price_' + counter + '" class=" form-control " onkeyup="get_count(this,' + counter + ')" name="price[]" value="" class="form-control" placeholder="Price" required>'
            + '</td>'
            + '<td class="hidden-xs total_sub" id="total_sub_' + counter + '">'
            + '</td>'
            + '<td class="text-center"><button type="button" class="btn btn-danger" id="btn_' + counter + '" onclick="cut(this, ' + counter + ')"><i class="fa fa-times"></i></button></td>'
            + '</tr>';

    $('#show_row').append(baris);
//    $('#menu_select_' + counter).load("<?php echo base_url() ?>transaction/pay/menusa/" + counter);
}

function get_unit(i, ii) {
    $.ajax({
        url: "<?php echo base_url($url_access . 'get_unit'); ?>/" + i.value,
        dataType: "JSON",
        success: function(json) {
            if (json.status == 1) {
                $("#unit_" + ii).attr('value', json.data.equipment_unit_name);
            }
        }
    });
    return false;
}

function get_count(a, i) {
    if(a && i) {
        a.value = numberToCurrency(a.value);
        var volume = currencyToNumber($("#volume_" + i).val() != '' ? $("#volume_" + i).val() : 0);
        var price = currencyToNumber($("#price_" + i).val() != '' ? $("#price_" + i).val() : 0);
        var count = numberToCurrency(volume * price);
        $("#total_sub_" + i).html(count);
    }
    for (var length = $(".total_sub").length, total = parseInt(0), e = 1; e <= length; e++) {
        var sub_total = currencyToNumber($("#total_sub_" + e).html() ? $("#total_sub_" + e).html() : 0);
        total = total + sub_total;
//        alert(sub_total + ' ' + total);
    }
    $("#equipment_transaction_total").val(numberToCurrency(total));
}

function cut(el, i) {
    var rowx = $('.row_out').length;
    for (var a = i; a < rowx; a++) {
        var rz = a + 1;
        $("#nom_" + rz).html(a);
        $("#nom_" + rz).attr('class', "nom_" + a);
        $("#nom_" + rz).attr('id', "nom_" + a);
        $("#equipment_" + rz).attr('onchange', "get_unit(" + a + ")");
        $("#equipment_" + rz).attr('id', "equipment_" + a);
        $("#unit_" + rz).attr('id', "unit_" + a);
        $("#volume_" + rz).attr('onkeyup', "get_count(this, " + a + ")");
        $("#volume_" + rz).attr('id', "volume_" + a);
        $("#price_" + rz).attr('onkeyup', "get_count(this, " + a + ")");
        $("#price_" + rz).attr('id', "price_" + a);
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
    
    if ($("input[name=equipment_transaction_number]").val() == "") {
        bootbox.alert("Nomor tidak boleh kosong");
        $("input[name=equipment_transaction_number]").focus();
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
                $(".saving").html(json.msg);
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