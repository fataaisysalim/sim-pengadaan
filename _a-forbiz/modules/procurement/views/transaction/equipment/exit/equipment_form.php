<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('msgTransEq') ?></div>
</div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-clipboard mg-r-sm'></i> Equipment Return (BPP)
    </header>
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'form')); ?>
        <input type="hidden" name="transaction_ct" value="<?php echo $transaction_ct; ?>"/>
        <?php if (!empty($equipt_trans)) { ?>
            <input type="hidden" name="equipt_transaction_id" value="<?php echo $equipt_trans->equipt_transaction_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">
            <div class="col-sm-6">
                <div class="col-xs-7">
                    <div class="form-group">
                        <label>Project</label>
                        <select id="project" onchange="getProData()" name="project" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih Proyek">
                            <option value=""></option>
                            <?php foreach ($project as $pro) : ?>
                                <option value="<?php echo $pro->project_id; ?>" <?php if (isset($equipt_trans) && $pro->project_id == $equipt_trans->project_id) echo "selected"; ?> <?php if ($pro->project_id == set_value('project')) echo "selected"; ?>><?php echo ucwords($pro->project_name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="form-group">
                        <label>Project Code</label>
                        <div class="input-group mg-b-md">
                            <span class="input-group-addon"><i class="fa fa-gavel"></i></span>
                            <input type="text" name="mog_project_code" value="<?php echo isset($equipt_trans) ? $equipt_trans->project_code : NULL; ?>" class="proCode form-control" placeholder="Kode Project" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>BPP Number</label>
                        <div class="input-group mg-b-md">
                            <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                            <input readonly type="text" name="equipt_transaction_number" value="<?php echo empty($equipt_trans) ? set_value('equipment_transaction_number') : $equipt_trans->equipt_transaction_number; ?>" class="form-control" placeholder="BPP Number">
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 mg-b-md">
                    <div class="form-group">
                        <label>V. License Plate</label>
                        <input <?php echo $sess['position_id'] == 5 ? 'readonly' : NULL; ?> maxlength="11" type="text" name="equipt_transaction_car" class="form-control" value="<?php echo isset($equipt_trans) ? $equipt_trans->equipt_transaction_car : NULL; ?>" placeholder="V. License Plate"/>
                    </div>
                </div>
                <div class="col-xs-6 mg-b-md">
                    <div class="form-group">
                        <label>Driver</label>
                        <input <?php echo $sess['position_id'] == 5 ? 'readonly' : NULL; ?> type="text" name="equipt_transaction_driver" class="form-control" value="<?php echo isset($equipt_trans) ? $equipt_trans->equipt_transaction_driver : NULL; ?>" placeholder="Diver"/>
                    </div>
                </div>
                <div class="col-xs-6 mg-b-md">
                    <div class="form-group">
                        <label>KTP/SIM</label>
                        <input <?php echo $sess['position_id'] == 5 ? 'readonly' : NULL; ?> type="text" onkeypress="return isNumber(event)" name="equipt_transaction_driver_identity" class="form-control" value="<?php echo isset($equipt_trans) ? $equipt_trans->equipt_transaction_driver_identity : NULL; ?>" placeholder="KTP/SIM"/>
                    </div>
                </div>
                <div class="col-xs-12 mg-b-sm">
                    <div class="form-group">
                        <label>Supplier/Subcon</label>
                        <select id="actor" name="actor" onchange="getActData()" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Supplier/Subcon">
                            <option value=""></option>
                            <?php foreach ($actor['ct'] as $nom => $ct) : ?>
                            <optgroup label="<?php echo strtoupper($ct->actor_category_name); ?>">
                                    <?php foreach ($actor['act'][$nom] as $num => $man) : ?>
                                    <option value="<?php echo $man->actor_id; ?>" <?php if (!empty($equipt_trans) && $man->actor_id == $equipt_trans->actor_id) echo "selected"; ?> <?php if ($man->actor_id == set_value('actor')) echo "selected"; ?>><?php echo ucwords($man->actor_name); ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="">
                    <div class="col-xs-5 mg-b-md">
                        <div class="form-group">
                            <label>Supplier/Subcon Code</label>
                            <div class="input-group mg-b-md">
                                <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                                <input type="text" class="codeAct form-control" value="<?php echo isset($equipt_trans) ? $equipt_trans->actor_code : NULL; ?>" placeholder="Kode" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-7 mg-b-md">
                        <div class="form-group">
                            <label>NPWP</label>
                            <input type="text" class="npwpAct form-control" value="<?php echo isset($equipt_trans) ? $equipt_trans->actor_identity : NULL; ?>" placeholder="NPWP Supplier/Subkon" readonly/>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xs-6">
                <div class="col-xs-12 mg-t-lg">
                    <div class="form-group">
                        <label class="col-xs-6 text-right">BPP Date</label>
                        <div class="col-xs-6">
                            <?php echo indo_date(date('Y-m-d')) ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label class="col-xs-6 text-right">Operator</label>
                        <div class="col-xs-6">
                            <?php echo ucwords($sess['employee']->employee_name) ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label class="col-xs-6 text-right">Position</label>
                        <div class="col-xs-6">
                            <?php echo ucwords($sess['users']->users_position_name) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="panel">
            <div class="panel-body row">
                <div class="row">
                    <table class="table table-bordered table-striped" style="margin-top: -13px">
                        <thead class="bg-dark" style="color: white">
                            <tr>
                                <th class="text-center hidden-xs" style="width: 40px; padding: 15px">No.</th>
                                <th class="text-center" style="width: 250px; padding: 15px">Equipment</th>
                                <th class="text-center" style="width: 200px; padding: 15px">Condition</th>
                                <th class="text-center" style="width: 90px; padding: 15px">Volume</th>
                                <th class="text-center" style="width: 120px; padding: 15px">Unit</th>
                                <th class="text-center" style="width: 220px; padding: 15px">Note</th>
<!--                                <th class="text-center" style="width: 120px; padding: 15px">Harga</th>
                                <th class="text-center hidden-xs" style="width: 150px; padding: 15px">Sub Total</th>-->
                                <th class="text-center" style="width: 30px; padding: 15px"><i class="fa fa-gear"></i></th>
                            </tr>
                        </thead>
                        <tbody id="show_row"></tbody>
                        <tr>
                            <td colspan="5">
                                <button class="btn btn-md btn-dark col-xs-12" id="adds_btn" onclick="adds_row()" type="button"><i class="fa fa-plus"></i></button>
                            </td>
<!--                            <th class="text-right">Total (Rp)</th>
                            <td>
                                <input type="text" name="equipment_transaction_total" class="form-control" id="equipment_transaction_total" readonly/>
                            </td>-->
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <div class="row">
            <?php if (!empty($equipt_trans)) { ?>
                <div class="<?php echo!empty($equipt_trans) ? 'col-xs-6' : null ?> pull-right">
                    <a href="<?php echo base_url()?>warehouse/transaction/equipment/out" role="button" style="cursor: pointer" class="<?php echo empty($equipt_trans) ? 'cancelEq' : null ?> btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
            <div class="<?php echo!empty($equipt_trans) ? 'col-xs-6 col-xs-offset-6' : 'col-md-6 col-sm-12 col-xs-6' ?> pull-right">
                <button type="submit" id="save_btn" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $("select.form-select2").select2();
        if($("#project").val() == '' || $("#actor").val() == '') {
            $("#adds_btn").attr('disabled', 'disabled');
        }

        $(".cancelEq").click(function() {
            $(".load_main_data").load("<?php echo base_url()?>warehouse/transaction/equipment/form/exit");
        });
        
<?php if ($sess['position_id'] == 1 && !empty($equipt_trans)) { ?>
            $('#show_row').load("<?php echo base_url() . $url_access . 'get_detail/' . md5($equipt_trans->equipt_transaction_id) . '/' . md5($equipt_trans->project_id); ?>");
<?php } ?>
    });
    
    function adds_row() {
        var counter = $('.row_out').length + 1;

        var baris = '<tr class="row_out row_tam">'
            + '<td class="text-center hidden-xs"><p id="nom_' + counter + '">' + counter + '</p></td>'
            + '<input type="hidden" name="action[]" value="add" class="form-control">'
            + '<input type="hidden" name="status[]" value="3" class="form-control">'
            + '<td id="td_equipment_' + counter + '">'
                
            + '</td>'
            + '<td class="hidden-xs">'
            + '<input type="text" id="condition_' + counter + '" name="condition[]" value="" class="form-control" placeholder="Condition">'
            + '</td>'
            + '<td>'
            + '<input id="volume_' + counter + '" class=" form-control " onkeyup="get_count(this,' + counter + ')" name="volume[]" value="" class="form-control" placeholder="Volume">'
        //            + '<input id="volume_' + counter + '" class=" form-control " onkeyup="format_number(this)" name="volume[]" value="" class="form-control" placeholder="Volume">'
            + '</td>'
            + '<td class="hidden-xs">'
            + '<input type="text" id="unit_' + counter + '" name="unit[]" value="" class="form-control" placeholder="Unit" readonly>'
            + '<input type="hidden" id="stok_' + counter + '" name="stok[]" value="" class="form-control" placeholder="Unit" readonly>'
            + '</td>'
            + '<td>'
            + '<input id="note_' + counter + '" maxlength="20" class=" form-control " name="note[]" value="" class="form-control" placeholder="Note (panjang huruf 20 karakter)">'
        //            + '<input id="volume_' + counter + '" class=" form-control " onkeyup="format_number(this)" name="volume[]" value="" class="form-control" placeholder="Volume">'
            + '</td>'
            + '<td class="text-center"><button type="button" class="btn btn-danger" id="btn_' + counter + '" onclick="cut(this, ' + counter + ')"><i class="fa fa-times"></i></button></td>'
            + '</tr>';

        $('#show_row').append(baris);
        $('#td_equipment_' + counter).load("<?php echo base_url() . $url_access . 'equipment_by_project/'; ?>" + $("select[name=project] option:selected").val() + "/" + $("select[name=actor] option:selected").val() + "/" + counter);
    }
    
    function getProData() {
        $.ajax({
            url: "<?php echo base_url('warehouse/project/getdata'); ?>/" + $('#project').val() + '/2/equipt_transaction',
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $(".proCode").attr('value', json.data.project_code);
//                    $("input[name=equipt_transaction_number]").attr('value', json.data.project_code + json.number);
                    $("input[name=equipt_transaction_number]").attr('value', json.number);
                        
                    if($('#project').val() != '' && $('#actor').val() != '') {
                        $("#adds_btn").attr('disabled', false);
//                        adds_row();
                    }
   
                }
            }
        });
        return false;
    }
    
    function format_number(a) {
        a.value = numberToCurrency(a.value);
    }

    function get_unit(i, ii) {
        $.ajax({
            url: "<?php echo base_url($url_access . 'get_stok'); ?>/" + i.value + "/" + $("#project").val(),
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $("#unit_" + ii).attr('value', json.data.equipment_unit_name);
                    $("#stok_" + ii).attr('value', json.data.equipment_stock_final_rest);
                    var note = ', ' + $("#condition_" + ii).val();
                    var explode = note.split("Baik");
                    if(explode[1]) {
                        $("#condition_" + ii).val('Baik' + explode[1]);
                    } else {
                        $("#condition_" + ii).val('Baik' + explode[0]);
                    }    
                }
            }
        });
        return false;
    }
    
    function getActData() {
        $.ajax({
            url: "<?php echo base_url('warehouse/supplier/getdata'); ?>/" + $('#actor').val(),
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $(".codeAct").attr('value', json.data.actor_code);
                    $(".npwpAct").attr('value', json.data.actor_identity);
                    
                    if($('#project').val() != '' && $('#actor').val() != '') {
                        $("#adds_btn").attr('disabled', false);
//                        adds_row();
                    }
                }
            }
        });
        return false;
    }
    
    function get_count(a, i, ct) {
        if(ct) {
            var new_val = currencyToNumber(a.value);
            var val = parseInt($("#e_" + ct + "_" + i).val());
            var st = $("#status_" + ct + "_" + i).val();
            
            if(new_val != val) {
                if(new_val > val) {
                    var diff = new_val - val;
                    $("#status_" + ct + "_" + i).attr('value', 3);
                }
                if(val > new_val) {
                    var diff = val - new_val;
                    $("#status_" + ct + "_" + i).attr('value', 2);
                }
                $("#diff_" + ct + "_" + i).attr('value', diff);
            } else {
                $("#diff_" + ct + "_" + i).attr('value', '0');
                $("#status_" + ct + "_" + i).attr('value', '0');
            }
            //            alert(st);
        }
        
        if (a && i) {
            a.value = numberToCurrency(a.value);
            var volume = currencyToNumber($("#volume_" + i).val() != '' ? $("#volume_" + i).val() : 0);
            
            if($("#status_volume_" + i).val() == '3') {
                if($("#stok_" + i).val() == '0') {
                    if (currencyToNumber(a.value) > parseInt($("#e_volume_" + i).val())) {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Volume can not be more than "+numberToCurrency($("#e_volume_" + i).val()));
                        $("#volume_" + i).val(" ");
                        return false;
                    }
                } else {
                    if (currencyToNumber(a.value) > parseInt($("#stok_" + i).val())) {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Stock insufficient. Remaining stock "+numberToCurrency($("#stok_" + i).val()));
                        $("#volume_" + i).val(" ");
                        return false;
                    }
                }
            } else {
                if (currencyToNumber(a.value) > parseInt($("#stok_" + i).val())) {
                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Stock insufficient. Remaining stock "+numberToCurrency($("#stok_" + i).val()));
                    $("#volume_" + i).val(" ");
                    return false;
                }
            }
        }
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

        if ($("select[name=project] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Project can not empty");
            $("select[name=project]").focus();
            return false;
        }
        if ($("input[name=equipt_transaction_number]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>BPP Number can not empty");
            $("input[name=equipt_transaction_number]").focus();
            return false;
        }
        if ($("input[name=equipt_transaction_car]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Vehicle License Plate can not empty");
            $("input[name=equipt_transaction_car]").focus();
            return false;
        }
        if ($("input[name=equipt_transaction_driver]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Driver can not empty");
            $("input[name=equipt_transaction_driver]").focus();
            return false;
        }
        if ($("input[name=equipt_transaction_driver_identity]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>No KTP/SIM can not empty");
            $("input[name=equipt_transaction_driver_identity]").focus();
            return false;
        }
        if ($("select[name=actor] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Supplier/Subcon can not empty");
            $("select[name=actor]").focus();
            return false;
        }
        var jmlTransM = $('.row_out').length;
                    if(jmlTransM == 0){
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Equipment input least 1");
                        return false;
                    }
        if ($("#equipment_data1 option:selected").val() == '') {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>No equipment is entered");
            return false;
        }
        
        for (var e = 1; e <= jmlTransM; e++) {
            var equipment = $("#equipment_data" + e + " option:selected").val();
            var qty = $("#volume_" + e).val();
            var stok = $("#stok_" + e).val();
            var price = $("#price_" + e).val();
            var stsE = $("#status_" + e + " option:selected").val();
            if (equipment != '') {
                if (qty == '') {
                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Volume ordered can not be empty");
                    return false;
                }
                <?php if($sess['position_id'] == 1){?>
                                if (price == '') {
                                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Price ordered can not empty");
                                    return false;
            }
                                if (stsE == '') {
                                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Status ordered can not empty");
                                    return false;
                                }
                                <?php } ?>
            }
            
            //            if (qty != '' || price != '') {
            if (qty != '') {
                if (equipment == '') {
                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Equipment ordered can not empty");
                    return false;
                }
                if($("#status_volume_" + e).val() == '3') {
                    if($("#stok_" + e).val() == '0') {
                        if (currencyToNumber(qty) > parseInt($("#e_volume_" + e).val())) {
                            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Volume can not more than "+numberToCurrency($("#e_volume_" + e).val()));
                        }
                    } else {
                        if (currencyToNumber(qty) > parseInt($("#stok_" + e).val())) {
                            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Stock insufficient. Remaining stock "+numberToCurrency($("#stok_" + e).val()));
                        }
                    }
                } else {
                    if (currencyToNumber(qty) > parseInt($("#stok_" + e).val())) {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Stock insufficient. Remaining stock "+numberToCurrency($("#stok_" + e).val()));
                        return false;
                    }
                }
            }
            
        }

        $(".loadertabo1").show();
        $('input').attr('readonly', 'readonly');
        $('select').attr('readonly', 'disabled');
        $('textarea').attr('readonly', 'readonly');
        $("#save_btn").attr("disabled", "disabled");
        
        $.ajax({
            url: $("#form").attr('action'),
            data: $("#form").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function(json) {
                if (json.status == 0) {
                    $('input').removeAttr('readonly', 'readonly');
                    $('select').removeAttr('readonly', 'readonly');
                    $('textarea').removeAttr('readonly', 'readonly');
                    $(".loadertabo1").hide();
                    $("#save_btn").attr("disabled", false);
                    bootbox.alert(json.msg);
                } else if (json.status == 1) {
                    window.open("<?php echo base_url() ?>warehouse/transaction/equipment/equipment_exit/" + json.id);
                    $(".load_main_data").load("<?php echo base_url() ?>warehouse/transaction/equipment/form/exit");
                }
            }
        });
        return false;
    });
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
<script src="<?php echo base_url() ?>assets/folarium/for.number.js"></script>
