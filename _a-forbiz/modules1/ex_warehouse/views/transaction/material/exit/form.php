<div class="row">
    <div class="col-xs-12"><?php echo $this->session->flashdata('msgTransMexit') ?></div>
</div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-clipboard mg-r-sm'></i> <?php echo $transaction_ct; ?> 
    </header>
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'formTransMexit')); ?>
        <?php if (!empty($mog)) { ?>
            <input type="hidden" name="mog_id" value="<?php echo $mog->mog_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">
            <div class="col-sm-7">
                <div class="col-xs-7">
                    <div class="form-group">
                        <label>Project</label>
                        <select id="project" onchange="getProData()" name="project" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Project">
                            <?php foreach ($project as $pro) : ?>
                                <option value="<?php echo $pro->project_id; ?>" <?php if (!empty($mog) && $pro->project_id == $mog->project_id) echo "selected"; ?> <?php if ($pro->project_id == set_value('project')) echo "selected"; ?>><?php echo ucwords($pro->project_name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="form-group">
                        <label>Project Code</label>
                        <div class="input-group mg-b-md">
                            <span class="input-group-addon"><i class="fa fa-gavel"></i></span>
                            <input type="text" name="mog_project_code" value="<?php echo isset($mog) ? $mog->project_code : NULL; ?>" class="proCode form-control" placeholder="Project Code" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>BPM Number</label>
                        <div class="input-group mg-b-md">
                            <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                            <input type="text" name="mog_number" value="<?php echo empty($mog) ? set_value('mog_number') : $mog->mog_number; ?>" class="form-control" placeholder="BPM Number">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 mg-b-sm">
                    <div class="form-group">
                        <label>Foreman/Subcon</label>
                        <select id="actor" name="actor" onchange="getActData()" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Foreman/Subcon">
                            <option value=""></option>
                            <?php foreach ($mandor['ct'] as $nom => $ct) : ?>
                                <optgroup label="<?php echo strtoupper($ct->actor_category_name); ?>">
                                    <?php foreach ($mandor['act'][$nom] as $num => $man) : ?>
                                        <option value="<?php echo $man->actor_id; ?>" <?php if (!empty($mog) && $man->actor_id == $mog->actor_id) echo "selected"; ?> <?php if ($man->actor_id == set_value('actor')) echo "selected"; ?>><?php echo strtoupper($man->actor_name); ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="">
                    <div class="col-xs-5 mg-b-md">
                        <div class="form-group">
                            <label>Code</label>
                            <div class="input-group mg-b-md">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <input type="text" class="codeAct form-control" value="<?php echo isset($mog) ? $mog->actor_code : NULL; ?>" placeholder="Code" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-7 mg-b-md">
                        <div class="form-group">
                            <label>Identity/NPWP</label>
                            <input type="text" class="npwpAct form-control" value="<?php echo isset($mog) ? $mog->actor_identity : NULL; ?>" placeholder="Identity/NPWP" readonly/>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xs-5">
                <div class="col-xs-12 mg-t-lg">
                    <div class="form-group">
                        <label class="col-xs-6 text-right">BPM Date</label>
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
                    <table class="table table-bordered table-striped" style="margin-bottom: 0px">
                        <thead class="bg-dark" style="color: white">
                            <tr>
                                <th class="text-center hidden-xs" style="min-width: 40px; padding: 15px">No.</th>
                                <th class="text-center" style="min-width: 200px; padding: 15px">Material</th>
                                <th class="text-center" style="width: 120px; padding: 15px">Unit </th>
                                <th class="text-center" style="width: 120px; padding: 15px">Volume</th>
                                <th class="text-center" style="width: 230px; padding: 15px">Note</th>
                                <th class="text-center" style="min-width: 30px; padding: 15px"><i class="fa fa-gear"></i></th>
                            </tr>
                        </thead>
                        <tbody id="show_row"></tbody>
                    </table>
                </div>
                <button class="adsRowM btn btn-md btn-dark col-xs-12 mg-t-lg" style="margin-bottom: -15px" onclick="adds_row()" type="button"><i class="fa fa-plus"></i></button>
            </div>
        </section>
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($mog)) { ?>
                    <div class="<?php echo!empty($mog) ? 'col-xs-6' : null ?>">
                        <a href="<?php echo base_url() ?>warehouse/bpm" style="cursor: pointer" class="cancelMt btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                    </div>
                <?php } ?>
                <div class="<?php echo!empty($mog) ? 'col-xs-6' : 'col-xs-6 col-xs-offset-6' ?> pull-right">
                    <button type="submit" id="save_btn" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $("select.form-select2").select2();
        <?php if(empty($mog)){?>
        $.ajax({
            url: "<?php echo base_url('warehouse/get-project'); ?>/" + $("select[name=project] option:selected").val() + '/2',
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $('.row_out').remove();
                    adds_row();
                    $(".proCode").attr('value', json.data.project_code);
                    //$("input[name=mog_number]").attr('value', json.number);
                }
            }
        });
        <?php }?>
        $(".cancelMt").click(function() {
            $(".load_main_data").load("<?php echo base_url(); ?>warehouse/bpm/form");
        });
<?php if ($permit->access_update == 1 && !empty($mog)) { ?>
            $('#show_row').load("<?php echo base_url() . $url_access . 'get_detail/' . md5($mog->mog_id) . '/' . md5($mog->project_id); ?>");
<?php } ?>
    });

    function adds_row() {
        var counter = $('.row_out').length + 1;

        var baris = '<tr class="row_out row_tam">'
            + '<td class="text-center hidden-xs"><p id="nom_' + counter + '">' + counter + '</p></td>'
            + '<input type="hidden" name="action[]" value="add" class="form-control">'
    + '<input type="hidden" name="mog_dt[]" value="">'
            + '<input type="hidden" id="mog_dt_status_' + counter + '" name="mog_dt_status[]" value="1" class="form-control">'
            + '<td id="material_select_' + counter + '"></td>'
            + '<td class="hidden-xs">'
            + '<input type="text" id="mog_dt_unit_' + counter + '" name="mog_dt_unit[]" value="" class="form-control" placeholder="Unit" readonly>'
            + '<input type="hidden" id="mog_dt_convertion_' + counter + '" name="mog_dt_convertion[]" value="">'
            + '</td>'
            + '<td><input id="mog_dt_volume_' + counter + '" class=" form-control " onkeyup="get_count(this,' + counter + ')" name="mog_dt_volume[]" value="" class="form-control" placeholder="Volume"></td>'
            + '<td>'
            + '<input id="mog_dt_note_' + counter + '" class=" form-control " name="mog_dt_note[]" value="" class="form-control" placeholder="Note">'
            + '</td>'
            + '<td class="text-center">'
            + '<input type="hidden" id="stock_final_rest_' + counter + '" class=" form-control " name="stock_final_rest[]" value="" class="form-control">'
            + '<button type="button" class="btn btn-danger" id="btn_' + counter + '" onclick="cut(this, ' + counter + ')"><i class="fa fa-times"></i></button>'
            + '</td>'
            + '</tr>';
        $('#show_row').append(baris);
        $('#material_select_' + counter).load("<?php echo base_url() ?>warehouse/bpm/material/" + $("select[name=project] option:selected").val() +"/"+ counter);
    }

    function get_unit(i) {
        $.ajax({
                       
            url: "<?php echo base_url() . $url_access . 'get_stock/'; ?>" + $('#material_' + i).val() + "/" + $("#project").val(),
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $("#mog_dt_unit_" + i).attr('value', json.data.material_unit_name);
                    $("#mog_dt_convertion_" + i).attr('value', json.data.material_sub_convertion);
                    $("#stock_final_rest_" + i).attr('value', json.data.stock_final_rest);
                }
                if (currencyToNumber($("#mog_dt_volume_" + i).val()) > parseInt($("#stock_final_rest_" + i).val())) {
                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Stock insufficient. The remaining stock of "+numberToCurrency($("#stock_final_rest_" + i).val()));
                }
            }
        });
        return false;
    }
    function getActData() {
        $.ajax({
            url: "<?php echo base_url('warehouse/get-supplier'); ?>/" + $('#actor').val(),
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $(".codeAct").attr('value', json.data.actor_code);
                    $(".npwpAct").attr('value', json.data.actor_identity);
                }
            }
        });
        return false;
    }
    function getProData() {
        $.ajax({
            url: "<?php echo base_url('warehouse/get-project'); ?>/" + $("select[name=project] option:selected").val() + '/2',
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $('.row_out').remove();
                    adds_row();
                    $(".proCode").attr('value', json.data.project_code);
                    //                                $("input[name=mog_number]").attr('value', json.data.project_code + json.number);
                    $("input[name=mog_number]").attr('value', json.number);
                }
            }
        });
        if($("select[name=project] option:selected").val() != ''){
            $(".adsRowM").removeAttr("disabled","disabled");
        }else{
            $(".adsRowM").attr("disabled","disabled");
            $('.row_out').remove();
        }
        return false;
    }

    function get_count(a, i, ct) {
        if(ct) {
            var new_val = currencyToNumber(a.value);
            var val = parseInt($("#" + ct + "_" + i).val());
            var st = $("#status_" + ct + "_" + i).val();
            
            if(new_val != val) {
                if(new_val > val) {
                    var diff = new_val - val;
                    $("#status_" + ct + "_" + i).attr('value', 2);
                }
                if(val > new_val) {
                    var diff = val - new_val;
                    $("#status_" + ct + "_" + i).attr('value', 3);
                }
                $("#diff_" + ct + "_" + i).attr('value', diff);
            } else {
                $("#diff_" + ct + "_" + i).attr('value', '0');
                $("#status_" + ct + "_" + i).attr('value', '0');
            }
            //            alert(st);
        }
        
        if(a && i) {
            a.value = numberToCurrency(a.value);
<?php if ($permit->access_special == 1) { ?>
                if (currencyToNumber(a.value) > parseInt($("#stock_final_rest_" + i).val())) {
                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Stock insufficient. The remaining stock of "+numberToCurrency($("#stock_final_rest_" + i).val()));
                    $("#mog_dt_volume_" + i).val("");
                }
<?php } else { ?>
                if($("#status_volume_" + i).val() == '3') {
                    if (currencyToNumber(a.value) > parseInt($("#volume_" + i).val())) {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Volume can not more than "+numberToCurrency($("#volume_" + i).val()));
                        $("#mog_dt_volume_" + i).val("");
                    }
                } else {
                    if (currencyToNumber(a.value) > parseInt($("#stock_final_rest_" + i).val())) {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Stock insufficient. The remaining stock of "+numberToCurrency($("#stock_final_rest_" + i).val()));
                        $("#mog_dt_volume_" + i).val("");
                    }
                }
<?php } ?>
            
            var volume = currencyToNumber($("#mog_dt_volume_" + i).val() != '' ? $("#mog_dt_volume_" + i).val() : 0);
        }
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
            $("#mog_dt_note_" + rz).attr('id', "mog_dt_note_" + a);
            $("#mog_dt_convertion_" + rz).attr('id', "mog_dt_convertion_" + a);
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

    $("#formTransMexit").submit(function() {
        var err = 0;
        if (err > 0) {
            return false;
        }
        if ($("select[name=project] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Project can not empty");
            $("select[name=project]").focus();
            return false;
        }
        if ($("input[name=mog_number]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>BPM Number can not empty");
            $("input[name=mog_number]").focus();
            return false;
        }
        if ($("select[name=actor] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Foreman/Subcon can not empty");
            $("select[name=actor]").focus();
            return false;
        }
        var jmlTransM = $('.row_out').length;
        if(jmlTransM == 0){
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>item/material input least 1");
            return false;
        }
        if($("#material_1 option:selected").val() ==''){
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>No item / material input");
            return false;
        }
        for (var e = 1; e <= jmlTransM; e++) {
            var material = $("#material_" + e + " option:selected").val();
            var qty = $("#mog_dt_volume_" + e).val();
            var stock = parseInt($("#stock_final_rest_" + e).val());
            if(qty !=''){
                if (material == '') {
                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Material ordered can not empty");
                    return false;
                }
            }
            if (material != '') {
                if(qty ==''){
                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Volume ordered can not empty");
                    return false;
                }
<?php if ($permit->access_update == 1) { ?>
                    if(qty > stock){
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Volume ordered should not more than stock");
                        return false;
                    }
<?php } else { ?>
                    if($("#status_volume_" + e).val() == '3') {
                        if (currencyToNumber(qty) > parseInt($("#volume_" + e).val())) {
                            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Volume should not more than "+numberToCurrency($("#volume_" + e).val()));
                            return false;
                        }
                    } else {
                        if (currencyToNumber(qty) > parseInt($("#stock_final_rest_" + e).val())) {
                            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Stock insufficient. The remaining stock of "+numberToCurrency($("#stock_final_rest_" + e).val()));
                            return false;
                        }
                    }
<?php } ?>
            }
        }
        $(".loadertabo1").show();
        $('input').attr('readonly', 'readonly');
        $('select').attr('readonly', 'disabled');
        $('textarea').attr('readonly', 'readonly');
//        $("#save_btn").attr("disabled", "disabled");
                        
        $.ajax({
            url: $("#formTransMexit").attr('action'),
            data: $("#formTransMexit").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function(json) {
                if (json.status == 0) {
                    $(".saving").html(json.msg);
                    $('input').removeAttr('readonly', 'readonly');
                    $('select').removeAttr('readonly', 'readonly');
                    $('textarea').removeAttr('readonly', 'readonly');
                    $(".loadertabo1").hide();
                    $("#save_btn").attr("disabled", false);
                    bootbox.alert(json.msg);
                } else if (json.status == 1) {
                    window.open("<?php echo base_url() ?>warehouse/bpm-print/" + json.id);
                    $(".load_main_data").load("<?php echo base_url() ?>warehouse/bpm/form");
                }
            }
        });
        return false;
    });
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>