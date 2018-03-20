<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('msgTransM') ?></div>
</div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-edit mg-r-sm'></i> <?php echo $transaction_ct; ?>
    </header>
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'formTransM')); ?>
        <?php if (!empty($mog_dt)) { ?>
            <input type="hidden" name="mog_id" value="<?php echo $mog_dt->mog_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">

            <div class="col-sm-5">
             
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Nama Proyek</label>
                            <div class="input-group mg-b-md">
                                <select class="">
								<option>- Nama Proyek -</option>
								</select>
                            </div>
                        </div>
                    </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Status</label>
                        <div class="input-group mg-b-md">
                         <select class="">
								<option>- Status -</option>
								</select>
						</div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Tanggal SPB</label>
                        <div class="input-group mg-b-md">
                            
                            <input readonly type="text" name="mog_number_letter" class="form-control" placeholder="Tanggal SPB"/>
                       <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					   </div>
                    </div>
                </div>
                <div class="col-xs-12 mg-b-sm">
                    <div class="form-group">
                        <label>Nama Supplier</label>
                        <div class="input-group mg-b-md">
                         <select class="">
								<option>- Nama Supplier -</option>
								</select>
								<button class="btn btn-info" style="margin-left:20px;margin-top:-10px">Cari</button>
						</div>
                    </div>
                </div>
				
            </div>
            <!--div class="col-xs-7">
                <div class="col-xs-12 mg-t-lg">
                    <div class="form-group">
                        <label class="col-xs-6 text-right">BAPB Date</label>
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
            </div-->
        </div>
        <section class="panel">
            <div class="panel-body row">
                <div class="row" style="padding:10px">
				<a href="<?php echo base_url();?>procurement/transaction/material/tambah" class="btn btn-primary pull-right" style="margin-bottom:10px">Buat SPB Baru</a>
                    <table class="table table-bordered table-striped" style="margin-top: -13px">
                        <thead class="bg-dark" style="color: white">
                            <tr>
                                <th class="text-center hidden-xs" style="width: 30px; padding: 15px">No.</th>
                                <th class="text-center" style="width: 250px; padding: 15px">Nomor SPB</th>
                                <th class="text-center" style="width: 250px; padding: 15px">Tanggal SPB</th>
                                <th class="text-center" style="width: 250px; padding: 15px">Nama Proyek</th>
                                <th class="text-center" style="width: 250px; padding: 15px">Nama Supplier</th>
                                <th class="text-center" style="width: 250px; padding: 15px">Status</th>
                                <th class="text-center" style="width: 250px; padding: 15px">#</th>
                            </tr>
                        </thead>
                        <tbody id="">
						<tr>
							<td>1</td>
							<td>SPB/111-123TSK</td>
							<td>28 Agustus 2017</td>
							<td>KBN</td>
							<td>Interworld</td>
							<td>SPB Terbit</td>
							<td>
							<button class="btn btn-xs btn-primary"><i class="fa fa-check"></i></button>
							<button class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button>
							<button class="btn btn-xs btn-danger"><i class="fa fa-remove"></i></button>
							<button class="btn btn-xs btn-success"><i class="fa fa-print"></i></button>
							</td>
						</tr>
						</tbody>
                       
                    </table> 
                </div>
            </div>
        </section>
   
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $("select.form-select2").select2();
                    <?php if ($sess['position_id'] == 1 && isset($mog_id)) { ?>
                        <?php if ($sess['position_id'] == 1) { ?>
                            $("#show_row").load("<?php echo base_url() . $url_access . 'get_mog_detail/' . $mog_id; ?>");
                        <?php } ?>
                    adds_row();
                    <?php } ?>
        
                $(".cancelMt").click(function() {
                    $(".load_main_data").load("<?php echo base_url() . $url_access . 'form'; ?>");
                });
            });

            function adds_row() {
                var counterss = $('.row_tam').length + 1;
                var counter = $('.row_out').length + 1;
                for (var a = counter; a >= counterss; a--) {
                    var rz = a + 1;
                    $(".nom_" + a).html(rz);
                    $(".nom_" + a).attr('class', "nom_" + rz);
                    $("#menu_select_" + a).attr('id', "menu_select_" + rz);
                    $("#btn_" + a).attr('onclick', "cut(this, " + rz + ")");
                    $("#menu_" + a).attr('onchange', "menusa(" + rz + ")");
                    $("#menu_" + a).attr('id', "menu_" + rz);
                    $("#btn_" + a).attr('id', "btn_" + rz);
                    $("#qty_" + a).attr('onkeyup', "calcPay(this, " + rz + ")");
                    $("#qty_" + a).attr('id', "qty_" + rz);

                }

                var baris = '<tr class="row_out row_tam">'
                    + '<td class="text-center hidden-xs" rowspan="2"><p id="nom_' + counter + '">' + counter + '</p></td>'
                    + '<input type="hidden" name="action[]" value="add" class="form-control">'
                    + '<input type="hidden" name="mog_dt_status[]" value="1" class="form-control">'
                        <?php if ($sess['position_id'] == 5 || ($sess['position_id'] == 1 && ((isset($mog_id) && $mog_dt->mog_status != 0) || !isset($mog_id)))) { ?>
                            + '<td>'
                            + '<select name="code[]" id="code_'+counter+'" class="form-control" data-style="btn-white" data-placeholder="Code">'
                            + '<option value="">Code</option>'
                            <?php foreach ($code as $cd) { ?>
                                + '<option value="<?php echo $cd->code_id; ?>"><?php echo $cd->code_name; ?></option>'
                            <?php } ?>
                            + '</select>'
                            + '</td>'
                        <?php } ?>
                        + '<td id="material_select_' + counter + '"></td>'
                        + '<td class="hidden-xs">'
                        + '<input type="text" id="mog_dt_unit_' + counter + '" name="mog_dt_unit[]" value="" class="form-control" placeholder="Unit" readonly>'
                        + '</td>'
                        + '<td class="hidden-xs">'
                        + '<input type="text" id="mog_dt_convertion_' + counter + '" name="mog_dt_convertion[]" value="" class="form-control" placeholder="Convertion" readonly>'
                        + '</td>'
                        + '<td>'
                    //            + '<input id="mog_dt_volume_' + counter + '" class=" form-control " onkeyup="get_count(this,' + counter + ')" name="mog_dt_volume[]" value="" class="form-control" placeholder="Volume">'
                        + '<input id="mog_dt_volume_' + counter + '" class=" form-control" onkeyup="get_count(this,' + counter + ')" name="mog_dt_volume[]" value="" class="form-control" placeholder="Volume">'
                        + '</td>'
                        <?php if ($sess['position_id'] == 5 || ($sess['position_id'] == 1 && ((isset($mog_id) && $mog_dt->mog_status != 0) || !isset($mog_id)))) { ?>
                            + '<td>'
                            + '<input id="mog_dt_price_' + counter + '" class=" form-control " onkeyup="get_count(this,' + counter + ')" name="mog_dt_price[]" value="" class="form-control" placeholder="Price">'
                            + '</td>'
                            + '<td rowspan="2" style="padding-left: 18px" class="hidden-xs total_sub" id="total_sub_' + counter + '">'
                            + '</td>'
                        <?php } ?>
                        + '<td rowspan="2" class="text-center"><button type="button" class="btn btn-danger" id="btn_' + counter + '" onclick="cut(this, ' + counter + ')"><i class="fa fa-times"></i></button></td>'
                        + '</tr><tr class="note_row_' + counter + '">'
                        + '<td class="hidden-xs" colspan="<?php echo $sess['position_id'] == 5 ? '5' : '4' ?>">'
                        + '<input type="text" maxlength="20" id="mog_dt_note_' + counter + '" name="mog_dt_note[]" value="" class="form-control" placeholder="Note (Panjang huruf 20 karakter)">'
                        + '</td></tr>';
                    $('#show_row').append(baris);
                    $('#material_select_' + counter).load("<?php echo base_url() . $url_access . 'get_material/all/'; ?>"+ counter);
                }

                function get_unit(i) {
                    $.ajax({
                        url: "<?php echo base_url() . $url_access . 'get_unit_material'; ?>/" + $('#material_' + i).val() + '/' + $('#project').val(),
                        dataType: "JSON",
                        success: function(json) {
                            if (json.status == 1) {
                                if(json.stock_fn != 0) {
                                    $("#mog_dt_unit_" + i).attr('value', json.data.material_unit_name);
                                    $("#mog_dt_convertion_" + i).attr('value', floatToCurrency(json.data.material_sub_convertion));
                                    var volume = currencyToNumber($("#mog_dt_volume_" + i).val() != '' ? $("#mog_dt_volume_" + i).val() : 0);
                                    var convertion = currencyToNumber($("#mog_dt_convertion_" + i).val() != '' ? $("#mog_dt_convertion_" + i).val() : 0);
                                    if($("#mog_dt_price_" + i).val()) {
                                        var price = currencyToNumber($("#mog_dt_price_" + i).val() != '' ? $("#mog_dt_price_" + i).val() : 0);
                                        if(convertion == 0) {
                                            var count = numberToCurrency2((volume * 1) * price);
                                        } else {
                                            var count = numberToCurrency2((volume * convertion) * price);
                                        }
                                        $("#total_sub_" + i).html(count);
                                    }
                                } else {
                                    //                        $("#material_" + i + " option:selected").prop('selected', false);
                                    $("#kosong").attr("selected", true);
                                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Material tidak bisa dipilih, harap input stok awal terlebih dahulu");
                                    return false;
                                }
                            }
                        }
                    });
                    return false;
                }
                function getActData() {
                    $.ajax({
                        url: "<?php echo base_url() . $url_access . 'getdata_suplier'; ?>/" + $('#actor').val(),
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
    
                function get_detail(el) {
                    $.ajax({
                        url: "<?php echo base_url() . $url_access . 'get_mog/'; ?>" + el.value,
                        dataType: "JSON",
                        success: function(json) {
                            if (json.status == 1) {
                                $("#formTransM").attr('action', "<?php echo base_url() . $url_action ?>" + el.value);
                                $("input[name=actor_name]").attr('value', json.mog.actor_name);
                                $("input[name=actor]").attr('value', json.mog.actor_id);
                                $("input[name=project]").attr('value', json.mog.project_id);
                                $("input[name=project_name]").attr('value', json.mog.project_name);
                                $("input[name=mog_project_code]").attr('value', json.mog.project_code);
                                $("input[name=mog_number]").attr('value', json.mog.mog_number);
                                $("input[name=mog_number_letter]").attr('value', json.mog.mog_number_letter);
                                $(".npwpAct").attr('value', json.mog.actor_id);
                                $('#show_row').load("<?php echo base_url() . $url_access .'get_mog_detail/'; ?>" + el.value);
                            }
                        }
                    });
                    return false;
                }
    
                function getProData() {
                    $.ajax({
                        url: "<?php echo base_url() . $url_access . 'getdata_project'; ?>/" + $('#project').val() + '/1',
                        dataType: "JSON",
                        success: function(json) {
                            if (json.status == 1) {
                                $(".proCode").attr('value', json.data.project_code);
                                //                    $("input[name=mog_number]").attr('value', json.data.project_code + json.number);
                                $("input[name=mog_number]").attr('value', json.number);
                            }
                        }
                    });
                    return false;
                }
    
                function format_number(a) {
                    a.value = numberToCurrency(a.value);
                }
    
                function get_count(a, i, ct) {
                    if(a && i) {
                        a.value = numberToCurrency(a.value);
                        var volume = currencyToNumber($("#mog_dt_volume_" + i).val() != '' ? $("#mog_dt_volume_" + i).val() : 0);
                        var convertion = currencyToNumber($("#mog_dt_convertion_" + i).val() != '' ? $("#mog_dt_convertion_" + i).val() : 0);
                        if($("#mog_dt_price_" + i).val()) {
                            var price = currencyToNumber($("#mog_dt_price_" + i).val() != '' ? $("#mog_dt_price_" + i).val() : 0);
                            if(convertion == 0) {
                                var count = numberToCurrency2((volume * 1) * price);
                            } else {
                                var count = numberToCurrency2((volume * convertion) * price);
                            }
                            $("#total_sub_" + i).html(count);
                        }
                    }
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
                    for (var length = $(".total_sub").length, total = parseInt(0), e = 1; e <= length; e++) {
                        var sub_total = currencyToNumber($("#total_sub_" + e).html() ? $("#total_sub_" + e).html() : 0);
                        total = total + sub_total;
                    }
                    $("#mog_total").val(numberToCurrency2(total));
                }

                function cut(el, i) {
                    var rowx = $('.row_out').length;
                    $(".note_row_"+i).remove();
                    for (var a = i; a < rowx; a++) {
                        var rz = a + 1;
                        $("#nom_" + rz).html(a);
                        $("#nom_" + rz).attr('class', "nom_" + a);
                        $("#nom_" + rz).attr('id', "nom_" + a);
                        $("#material_" + rz).attr('onchange', "get_unit(" + a + ")");
                        $("#material_" + rz).attr('id', "material_" + a);
                        $("#mog_dt_unit_" + rz).attr('id', "mog_dt_unit_" + a);
                        $("#mog_dt_note_" + rz).attr('id', "mog_dt_note_" + a);
                        $(".note_row_" + rz).attr('class', "note_row_" + a);
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

                $("#formTransM").submit(function() {
                    var err = 0;
                    if (err > 0) {
                        return false;
                    }
                    if ($("input[name=project]").val() == "") {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Project can not empty");
                        $("input[name=project]").focus();
                        return false;
                    }
                    
                    if ($("select[name=mog_number] option:selected").val() == "") {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>BAPB Number can not empty");
                        $("select[name=mog_number] option:selected").focus();
                        return false;
                    }
                    
                    if ($("input[name=mog_number_letter]").val() == "") {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Letter Number can not empty");
                        $("input[name=mog_number_letter]").focus();
                        return false;
                    }
                    
                    if ($("input[name=actor]").val() == "") {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Supplier can not empty");
                        $("input[name=actor]").focus();
                        return false;
                    }
                    
                    var jmlTransM = $('.row_out').length;
                    if(jmlTransM == 0){
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>item/material input least 1");
                        return false;
                    }
                    if($("#material_1 option:selected").val() ==''){
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>No item/material input");
                        return false;
                    }
        
                    for (var e = 1; e <= jmlTransM; e++) {
                        var code = $("#code_" + e + " option:selected").val();
                        var material = $("#material_" + e + " option:selected").val();
                        var qty = $("#mog_dt_volume_" + e).val();
                        var price = $("#mog_dt_price_" + e).val();
                        if (material != '') {
                                <?php //if ($sess['position_id'] == 5) { ?>
                                    if(code ==''){
                                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Code ordered can not empty");
                                        return false;
                                    }
                                <?php //} ?>
                                
                                if(qty ==''){
                                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Volume ordered can not empty");
                                    return false;
                                }
                                if(price == ''){
                                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Price ordered can not empty");
                                    return false;
                                }
                            }
                        }
                    
                        $(".loadertabo1").show();
                        $('input').attr('readonly', 'readonly');
                        $('select').attr('readonly', 'disabled');
                        $('textarea').attr('readonly', 'readonly');
                        $("#save_btn").attr("disabled", "disabled");
                        $.ajax({
                            url: $("#formTransM").attr('action'),
                            data: $("#formTransM").serialize(),
                            type: "POST",
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 0) {
                                    $(".msgTransM").html(json.msg);
                                    $('input').removeAttr('readonly', 'readonly');
                                    $('select').removeAttr('readonly', 'readonly');
                                    $('textarea').removeAttr('readonly', 'readonly');
                                    $(".loadertabo1").hide();
                                    $("#save_btn").attr("disabled", false);
                                    bootbox.alert(json.msg);
                                } else if (json.status == 1) {
                                    <?php if ($sess['position_id'] == 1) { ?>
                                        window.open("<?php echo base_url() ?>warehouse/formcontrollertemplate/bapb/" + json.id);
                                    <?php } elseif ($sess['position_id'] == 5) { ?>
                                        window.open("<?php echo base_url() ?>warehouse/formcontrollertemplate/bapb_procurement/" + json.id);    
                                    <?php } ?>
                                        $(".load_main_data").load("<?php echo base_url() . $url_access . 'form'; ?>");
                                    }
                                }
                            });
                            return false;
                        });
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
