<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('msgTransEq') ?></div>
</div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-truck mg-r-sm'></i> Equipment Receipt (BAPP) 
    </header>
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'formBAPP')); ?>
        <input type="hidden" name="transaction_ct" value="<?php echo $transaction_ct; ?>"/>
        <?php if (!empty($equipt_trans_dt)) { ?>
            <input type="hidden" name="equipt_transaction_id" value="<?php echo $equipt_trans_dt->equipt_transaction_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">
            <div class="col-sm-5">
                <div class="col-xs-7">
                    <div class="form-group">
                        <label>Project</label>
                        <?php //if ($sess['position_id'] == 1 || ($sess['position_id'] == 1 && isset($equipt_transaction))) { ?>
<!--                            <select id="project" onchange="getProData()" name="project" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Project">
                                <option value=""></option>
                                <?php foreach ($project as $et) : ?>
                                    <option value="<?php echo $et->project_id; ?>" <?php if (isset($equipt_trans_dt) && $et->project_id == $equipt_trans_dt->project_id) echo "selected"; ?> <?php if ($et->project_id == set_value('project')) echo "selected"; ?>><?php echo ucwords($et->project_name); ?></option>
                                <?php endforeach; ?>
                            </select>-->
                        <?php //} else if ($sess['position_id'] == 5) { ?>
                            <input type="text" name="project_name" value="<?php echo isset($equipt_trans_dt) ? $equipt_trans_dt->project_name : NULL; ?>" class="form-control" placeholder="Project" readonly>
                            <input type="hidden" name="project" value="<?php echo isset($equipt_trans_dt) ? $equipt_trans_dt->project_id : NULL; ?>" class="form-control" placeholder="Project" readonly>
                        <?php //} ?>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="form-group">
                        <label>Project Code</label>
                        <div class="input-group mg-b-md">
                            <span class="input-group-addon"><i class="fa fa-gavel"></i></span>
                            <input type="text" name="project_code" value="<?php echo isset($equipt_trans_dt) ? $equipt_trans_dt->project_code : NULL; ?>" class="proCode form-control" placeholder="Project Code" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-xs-7">
                    <div class="form-group">
                        <label>BAPP Number</label>
                        <?php if ($sess['position_id'] == 1 && isset($equipt_transaction)) { ?>
                            <div class="input-group mg-b-md">
                                <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                <input readonly type="text" name="equipt_transaction_number" value="<?php echo!isset($equipt_trans_dt) ? set_value('equipt_transaction_number') : $equipt_trans_dt->equipt_transaction_number; ?>" class="form-control" placeholder="BAPP Number">
                            </div>
                        <?php } else { ?>
                        <?php //} else if ($sess['position_id'] == 5) { ?>
                            <input type="hidden" name="equipt_transaction_number" value="<?php echo empty($equipt_trans_dt) ? set_value('equipment_transaction_number') : $equipt_trans_dt->equipment_transaction_number; ?>" class="form-control" placeholder="BPP Number">
                            <select id="equipt_transaction" onchange="get_detail(this)" name="equipt_transaction" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose BAPP">
                                <option value=""></option>
                                <?php foreach ($equipt_trans as $et) : ?>
                                    <option value="<?php echo md5($et->equipt_transaction_id); ?>" <?php if (!empty($equipt_trans_dt) && $et->equipt_transaction_id == $equipt_trans_dt->equipt_transation_id) echo "selected"; ?> <?php if ($et->equipt_transaction_id == set_value('equipt_transaction')) echo "selected"; ?>><?php echo ucwords($et->equipt_transaction_number); ?> | <?php echo $et->project_code; ?> | <?php echo $et->actor_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-xs-5 mg-b-md">
                    <div class="form-group">
                        <label>Travel Document</label>
                        <input readonly type="text" name="equipt_transaction_letter" class="form-control" value="<?php echo isset($equipt_trans_dt) ? $equipt_trans_dt->equipt_transaction_letter : NULL; ?>" placeholder="Travel Doc"/>
                    </div>
                </div>
                <div class="col-xs-6 mg-b-md">
                    <div class="form-group">
                        <label>V. License Plate</label>
                        <input readonly type="text" name="equipt_transaction_car" class="form-control" value="<?php echo isset($equipt_trans_dt) ? $equipt_trans_dt->equipt_transaction_car : NULL; ?>" placeholder="V. License Plate"/>
                    </div>
                </div>
                <div class="col-xs-6 mg-b-md">
                    <div class="form-group">
                        <label>Driver</label>
                        <input readonly type="text" name="equipt_transaction_driver" class="form-control" value="<?php echo isset($equipt_trans_dt) ? $equipt_trans_dt->equipt_transaction_driver : NULL; ?>" placeholder="Driver"/>
                    </div>
                </div>
                <div class="col-xs-6 mg-b-md">
                    <div class="form-group">
                        <label>KTP/SIM</label>
                        <input readonly type="text" onkeypress="return isNumber(event)" name="equipt_transaction_driver_identity" class="form-control" value="<?php echo isset($equipt_trans_dt) ? $equipt_trans_dt->equipt_transaction_driver_identity : NULL; ?>" placeholder="KTP/SIM"/>
                    </div>
                </div>
                <!--                <div class="col-xs-6 mg-b-md">
                                    <label>Waktu Keluar/Bongkar Muat</label>
                                    <div class="input-group input-append date datepicker" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                        <input <?php echo $sess['position_id'] == 5 ? 'readonly' : NULL; ?> type="text" class="form-control" name="equipt_transaction_date_verify" value="<?php echo date('d-m-Y') ?>">
                                        <span class="input-group-btn">
                                            <button class="btn btn-white add-on" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>-->
                <div class="col-xs-12 mg-b-sm">
                    <div class="form-group">
                        <label>Supplier/Subcon</label>
                        <?php //if ($sess['position_id'] == 1 || ($sess['position_id'] == 1 && isset($equipt_transaction))) { ?>
                        <?php if ($sess['position_id'] == 1 && isset($equipt_transaction)) { ?>
                            <select id="actor" name="actor" onchange="getActData()" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Supplier/Subcon">
                                <option value=""></option>
                                <?php foreach ($actor['ct'] as $nom => $ct) : ?>
                                <optgroup label="<?php echo strtoupper($ct->actor_category_name); ?>">
                                        <?php foreach ($actor['act'][$nom] as $num => $man) : ?>
                                    <option value="<?php echo $man->actor_id; ?>" <?php if (!empty($equipt_trans_dt) && $man->actor_id == $equipt_trans_dt->actor_id) echo "selected"; ?> <?php if ($man->actor_id == set_value('actor')) echo "selected"; ?>><?php echo strtoupper($man->actor_name); ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                        <?php //} else if ($sess['position_id'] == 5) { ?>
                        <?php } else { ?>
                            <input type="hidden" name="actor" class="form-control" value="" placeholder="Supplier/Subkon" readonly/>
                            <input type="text" name="actor_name" class="form-control" value="" placeholder="Supplier/Subkon" readonly/>
                        <?php } ?>
                    </div>
                </div>
                <div class="">
                    <div class="col-xs-5 mg-b-md">
                        <div class="form-group">
                            <label>Supplier/Subcon Code</label>
                            <div class="input-group mg-b-md">
                                <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                                <input type="text" class="codeAct form-control" value="<?php echo isset($equipt_trans_dt) ? $equipt_trans_dt->actor_code : NULL; ?>" placeholder="Code" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-7 mg-b-md">
                        <div class="form-group">
                            <label>NPWP</label>
                            <input type="text" class="npwpAct form-control" value="<?php echo isset($equipt_trans_dt) ? $equipt_trans_dt->actor_identity : NULL; ?>" placeholder="NPWP Supplier/Subcon" readonly/>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xs-7">
                <div class="col-xs-12 mg-t-lg">
                    <div class="form-group">
                        <label class="col-xs-6 text-right">BAPP Date</label>
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
                                <?php if($sess['position_id'] == 5 || ($sess['position_id'] == 1 && ((isset($equipt_transaction) && $equipt_trans_dt->equipt_transaction_status == 1) || !isset($equipt_transaction)))) { ?>
                                    <th class="text-center" style="width: 200px; padding: 15px">Code</th>
                                <?php } ?>
                                <th class="text-center" style="width: 200px; padding: 15px">Equipment</th>
                                <th class="text-center" style="width: 120px; padding: 15px">Unit</th>
                                <th class="text-center" style="width: 120px; padding: 15px">Status</th>
                                <th class="text-center" style="width: 250px; padding: 15px">Condition</th>
                                <th class="text-center" style="width: 90px; padding: 15px">Volume</th>
                                <?php if($sess['position_id'] == 5 || ($sess['position_id'] == 1 && ((isset($equipt_transaction) && $equipt_trans_dt->equipt_transaction_status == 1) || !isset($equipt_transaction)))) { ?>
                                    <th class="text-center" style="width: 120px; padding: 15px">Price</th>
                                    <th class="text-center hidden-xs" style="width: 150px; padding: 15px">Sub Total</th>
                                <?php } ?>
                                <th class="text-center" style="width: 30px; padding: 15px"><i class="fa fa-gear"></i></th>
                            </tr>
                        </thead>
                        <tbody id="show_row"></tbody>
                        <tr>
                            <td colspan="7">
                                <button disabled class="btn btn-md btn-dark col-xs-12" onclick="adds_row()" type="button"><i class="fa fa-plus"></i></button>
                            </td>
                            <?php if($sess['position_id'] == 5 || ($sess['position_id'] == 1 && ((isset($equipt_transaction) && $equipt_trans_dt->equipt_transaction_status == 1) || !isset($equipt_transaction)))) { ?>
                                <th class="text-right">Total (Rp)</th>
                                <td>
                                    <input type="text" name="equipt_transaction_total" class="form-control" id="equipment_transaction_total" readonly/>
                                </td>
                            <?php } ?>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-xs-6 col-xs-offset-6">
                <?php if (!empty($equipt_trans_dt)) { ?>
                    <div class="<?php echo!empty($equipt_trans_dt) ? 'col-xs-6' : null ?>">
                        <a href="<?php echo base_url()?>procurement/transaction/equipment/entry" role="button" style="cursor: pointer" class="<?php echo empty($equipt_trans) ? 'cancelEq' : null ?> btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                    </div>
                <?php } ?>

                <div class="<?php echo!empty($equipt_trans_dt) ? 'col-xs-6' : 'col-md-6 col-sm-12 col-xs-6' ?> pull-right">
                    <button type="submit" id="save_btn" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $(".datepicker").datepicker();
        $("select.form-select2").select2();
<?php if ($sess['position_id'] == 1) { ?>
            adds_row();
<?php } ?>
                
<?php if ($sess['position_id'] == 1 && isset($equipt_transaction)) { ?>
            $('#show_row').load("<?php echo base_url() . 'procurement/transaction/equipment/get_transaction_detail/' . $equipt_transaction; ?>");
<?php } ?>
        
        $(".cancelEq").click(function() {
            $(".load_main_data").load("<?php echo base_url()?> procurement/transaction/equipment/form/entry/");
        });
    });
    
<?php if ($sess['position_id'] == 1 || ($sess['position_id'] == 1 && isset($equipt_transaction))) { ?>
        function adds_row() {
            var counter = $('.row_out').length + 1;

            var baris = '<tr class="row_out row_tam">'
                + '<td class="text-center hidden-xs"><p id="nom_' + counter + '">' + counter + '</p></td>'
                + '<input type="hidden" name="action[]" value="add" class="form-control">'
    <?php if($sess['position_id'] == 5 || ($sess['position_id'] == 1 && ((isset($equipt_transaction) && $equipt_trans_dt->equipt_transaction_status == 1) || !isset($equipt_transaction)))) { ?>
                        + '<td id="td_code_' + counter + '">'
                        + '<div class="form-group">'
                        + '<select id="code_' + counter + '" name="code[]" class="form-control selectpicker" data-style="btn-white">'
                        + '<option value="">Code</option>'
                        + '<?php foreach ($code as $cd) : ?>'
                            + '<option value="<?php echo $cd->code_id; ?>" <?php if ($cd->code_id == set_value("code")) echo "selected"; ?>><?php echo $cd->code_name; ?></option>'
                            + '<?php endforeach; ?>'
                        + '</select>'
                        + '</div>'
                        + '</td>'    
    <?php } ?>
                    + '<td id="equipment_' + counter + '"></td>'
                    + '<td class="hidden-xs">'
                    + '<input type="text" id="unit_' + counter + '" name="unit[]" value="" class="form-control" placeholder="Unit" readonly>'
                    + '</td>'
                    + '<td id="td_status_' + counter + '">'
                    + '<div class="form-group">'
                    + '<select id="status_' + counter + '" name="status[]" class="form-control selectpicker" data-style="btn-white">'
                    + '<option value="">Status</option>'
                    + '<option value="1">Buy</option>'
                    + '<option value="2">Rental</option>'
                    + '</select>'
                    + '</div>'
                    + '</td>'
                    + '<td class="hidden-xs">'
                    + '<input type="text" id="condition_' + counter + '" name="condition[]" value="" class="form-control" placeholder="Condition">'
                    + '</td>'
                    + '<td>'
                    + '<input id="volume_' + counter + '" class=" form-control " onkeyup="get_count(this,' + counter + ')" name="volume[]" value="" class="form-control" placeholder="Volume">'
                    + '</td>'
    <?php if($sess['position_id'] == 5 || ($sess['position_id'] == 1 && ((isset($equipt_transaction) && $equipt_trans_dt->equipt_transaction_status == 1) || !isset($equipt_transaction)))) { ?>
                        + '<td>'
                        + '<input id="price_' + counter + '" class=" form-control " onkeyup="get_count(this,' + counter + ')" name="price[]" value="" class="form-control" placeholder="Price">'
                        + '</td>'
                        + '<td class="hidden-xs total_sub" style="padding-left: 18px" id="total_sub_' + counter + '">'
                        + '</td>'
    <?php } ?>
                    + '<td class="text-center"><button type="button" class="btn btn-danger" id="btn_' + counter + '" onclick="cut(this, ' + counter + ')"><i class="fa fa-times"></i></button></td>'
                    + '</tr>';

                $('#show_row').append(baris);
                $('#equipment_' + counter).load("<?php echo base_url() ?>procurement/transaction/equipment/get_equipment/all/"+ counter);
            }
<?php } ?>

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
    function getActData() {
        $.ajax({
            url: "<?php echo base_url('procurement/transaction/equipment/getdata_suplier'); ?>/" + $('#actor').val(),
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
            url: "<?php echo base_url('procurement/transaction/equipment/getdata_project'); ?>/" + $('#project').val() + '/1/equipt_transaction',
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $(".proCode").attr('value', json.data.project_code);
                    //                    $("input[name=equipt_transaction_number]").attr('value', json.data.project_code + json.number);
                    $("input[name=equipt_transaction_number]").attr('value', json.number);
                }
            }
        });
        return false;
    }
    
    function get_detail(el) {
        $.ajax({
            url: "<?php echo base_url() . 'procurement/transaction/equipment/get_transaction/'; ?>" + el.value,
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $("#formBAPP").attr('action', "<?php echo base_url() . $url_action ?>" + el.value);
                    $("input[name=actor_name]").attr('value', json.eq.actor_name);
                    $("input[name=actor]").attr('value', json.eq.actor_id);
                    $("input[name=project]").attr('value', json.eq.project_id);
                    $("input[name=project_name]").attr('value', json.eq.project_name);
                    $("input[name=project_code]").attr('value', json.eq.project_code);
                    $("input[name=equipt_transaction_number]").attr('value', json.eq.equipt_transaction_number);
                    $("input[name=equipt_transaction_letter]").attr('value', json.eq.equipt_transaction_letter);
                    $("input[name=equipt_transaction_car]").attr('value', json.eq.equipt_transaction_car);
                    $("input[name=equipt_transaction_driver]").attr('value', json.eq.equipt_transaction_driver);
                    $("input[name=equipt_transaction_driver_identity]").attr('value', json.eq.equipt_transaction_driver_identity);
                    $("input[name=equipt_transaction_date_verify]").attr('value', json.eq.equipt_transaction_date_verify);
                    $(".npwpAct").attr('value', json.eq.actor_id);
                    $('#show_row').load("<?php echo base_url() . 'procurement/transaction/equipment/get_transaction_detail/'; ?>" + el.value);
                }
            }
        });
        return false;
    }
    
    function format_number(a) {
        a.value = numberToCurrency(a.value);
    }

    function get_count(a, i, ct) {
        if (a && i) {
            a.value = numberToCurrency(a.value);
            var volume = currencyToNumber($("#volume_" + i).val() != '' ? $("#volume_" + i).val() : 0);
            if($("#price_" + i).val()) {
                var price = currencyToNumber($("#price_" + i).val() != '' ? $("#price_" + i).val() : 0);
                var count = numberToCurrency(volume * price);
                $("#total_sub_" + i).html(count);
            }
        }
        if(ct) {
            var new_val = currencyToNumber(a.value);
            var val = parseInt($("#e_" + ct + "_" + i).val());
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
        for (var length = $(".total_sub").length, total = parseInt(0), e = 1; e <= length; e++) {
            var sub_total = currencyToNumber($("#total_sub_" + e).html() ? $("#total_sub_" + e).html() : 0);
            total = total + sub_total;
        }
        $("input[name=equipt_transaction_total]").val(numberToCurrency(total));
    }

    function cut(el, i) {
        var rowx = $('.row_out').length;
        for (var a = i; a < rowx; a++) {
            var rz = a + 1;
            $("#nom_" + rz).html(a);
            $("#nom_" + rz).attr('class', "nom_" + a);
            $("#nom_" + rz).attr('id', "nom_" + a);
            $("#equipment_data" + rz).attr('onchange', "get_unit(" + a + ")");
            $("#equipment_data" + rz).attr('id', "equipment_data" + a);
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

    $("#formBAPP").submit(function() {
        var err = 0;
        if (err > 0) {
            return false;
        }
        if ($("select[name=project] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Project can not empty");
            $("select[name=project]").focus();
            return false;
        }
<?php if ($sess['position_id'] == 5) { ?>
//            if ($("select[name=code] option:selected").val() == "") {
//                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Code can not empty");
//                $("select[name=project]").focus();
//                return false;
//            }
<?php } ?>
        if ($("input[name=equipt_transaction_number]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>BAPP Number can not empty");
            $("input[name=equipt_transaction_number]").focus();
            return false;
        }
        if ($("input[name=equipt_transaction_letter]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Travel document can not empty");
            $("input[name=equipt_transaction_letter]").focus();
            return false;
        }
        if ($("input[name=equipt_transaction_car]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Vehicle Number can not empty");
            $("input[name=equipt_transaction_number]").focus();
            return false;
        }
        if ($("input[name=equipt_transaction_driver]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Driver can not empty");
            $("input[name=equipt_transaction_driver]").focus();
            return false;
        }
        if ($("input[name=equipt_transaction_driver_identity]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Driver identity can not empty");
            $("input[name=equipt_transaction_driver_identity]").focus();
            return false;
        }
        if ($("select[name=actor] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Supplier can not empty");
            $("select[name=actor]").focus();
            return false;
        }
        var rowJmW = $('.row_out').length;
                    if(rowJmW == 0){
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Equipment input least 1");
                        return false;
                    }
        if ($("#equipment_data1 option:selected").val() == '') {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>No equipment is entered");
            return false;
        }
        var rowJmW = $('.row_out').length;
        for (var e = 1; e <= rowJmW; e++) {
            if ($("#equipment_data" + e + " option:selected").val() != '') {

                    if ($("#code_" + e).val() == '') {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Equipment Code can not empty");
                        return false;
                    }
                    
                    if ($("#status_" + e).val() == '') {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Equipment Status can not empty");
                        return false;
                    }
                    if ($("#price_" + e).val() == '') {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Booked price can not empty");
                        return false;
                    }
                    if ($("#volume_" + e).val() == '') {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Volume ordered can not empty");
                        return false;
                    }

            } else {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Equipment can not empty");
                return false;
            }
        }
        $(".loadertabo1").show();
        $('input').attr('readonly', 'readonly');
        $('select').attr('readonly', 'disabled');
        $('textarea').attr('readonly', 'readonly');
        $("#save_btn").attr("disabled", "disabled");
        
        $.ajax({
            url: $("#formBAPP").attr('action'),
            data: $("#formBAPP").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function(json) {
                if (json.status == 0) {
                    $(".saving").html(json.msg);
                    $('input').removeAttr('readonly', 'readonly');
                    $('select').removeAttr('readonly', 'readonly');
                    $('textarea').removeAttr('readonly', 'readonly');
                    $(".loadertabo1").hide();
                    bootbox.alert(json.msg);
                    $("#save_btn").attr("disabled", false);
                } else{
                    window.open("<?php echo base_url() ?>procurement/transaction/equipment/equipment_entry/" + json.id);
                    $(".load_main_data").load("<?php echo base_url() ?>procurement/transaction/equipment/form/entry");
                }
            }
        });
        return false;
    });
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
<script src="<?php echo base_url() ?>assets/folarium/for.number.js"></script>