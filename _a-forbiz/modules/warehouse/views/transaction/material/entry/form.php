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
            <div class="col-sm-7">
               <!--  <div class="col-xs-7">
                    <div class="form-group">
                        <label>Nama Proyek</label>
                        <select id="project" onchange="getProData()" name="project" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih Project">
                            <?php foreach ($project as $pro) : ?>
                                <option value="<?php echo $pro->project_id; ?>" <?php if (isset($mog_dt) && $pro->project_id == $mog_dt->project_id) echo "selected"; ?> <?php if ($pro->project_id == set_value('project')) echo "selected"; ?>><?php echo ucwords($pro->project_name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div> -->
                <?php echo $this->load->view("global_project");?>
                <div class="col-xs-5">
                    <div class="form-group">
                        <label>Kode SPK</label>
                        <div class="input-group mg-b-md">
                            <span class="input-group-addon"><i class="fa fa-gavel"></i></span>
                            <input type="text" name="mog_project_code" value="<?php echo isset($mog_dt) ? $mog_dt->project_code : NULL; ?>" class="proCode form-control" placeholder="Kode SPK" readonly>
                        </div>
                    </div>
                </div>
                
				<!-- 
                <div class="col-xs-4">
                    <div class="form-group">
                        <label>Nomor SPB</label>
                        <div class="input-group mg-b-md">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" name="mog_number_letter" class="form-control" value="<?php echo isset($mog_dt) ? $mog_dt->mog_number_letter : NULL; ?>" placeholder="Nomor SPB"/>
                        </div>
                    </div>
                </div>
				-->
				
                <!-- 
					<div class="col-xs-7 mg-b-sm">
                    <div class="form-group">
                        <label>Supplier</label>
                        <select id="actor" name="actor" onchange="getActData()" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih Supplier/Subcon">
                            <option value=""></option>
                            <?php //foreach ($supplier['ct'] as $nom => $ct) : ?>
                                <optgroup label="<?php // echo strtoupper($ct->actor_category_name); ?>">
                                    <?php //foreach ($supplier['act'][$nom] as $num => $man) : ?>
                                        <option value="<?php // echo $man->actor_id; ?>" <?php //if (!empty($mog_dt) && $man->actor_id == $mog_dt->actor_id) echo "selected"; ?> <?php //if ($man->actor_id == set_value('actor')) echo "selected"; ?>><?php //echo $man->actor_name; ?></option>
                                    <?php //endforeach; ?>
                                </optgroup>
                            <?php //endforeach; ?>
                        </select>
						
                    </div>
                </div>
				-->
				<div class="col-xs-7 mg-b-sm">
					<div class="form-group">
                        <label>Supplier</label>
						<!-- <select id="supplier" name="supplier" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih Supplier/Subcon">
							<option value="">Pilih Supplier</option>
						</select> -->
                        <select id="actor" name="actor" onchange="getActData()" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Supplier/Nasabah">
                                <option value="">-Pilih Supplier-</option>
                                <?php foreach ($supplier['ct'] as $nom => $ct) : ?>
                                     <option <?php if (isset($row->actor_id) && $row->actor_id == $ct->actor_id) echo "selected"; ?> value="<?php echo $ct->actor_id; ?>"><?php echo $ct->actor_name; ?></option>
                                <?php endforeach; ?>   
                            </select>
                    </div>
                </div>
				
                <div class="col-xs-5 mg-b-sm">
                    <div class="form-group">
                        <label>Upload Surat Jalan</label>
                        <div class="input-group mg-b-md">
                            <input type="file" class="filestyle" data-buttonText="Browse">
                        </div>
                    </div>
                </div>
				
				<div class="col-xs-4 mg-b-sm">
					<div class="form-group">
                        <label>Nomor SPB</label>
						<select id="spb" name="spb" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih SPB">
							<option value="">Pilih SPB</option>
						</select>
                    </div>
                </div>
				
				

				<div class="col-xs-4">
                    <div class="form-group">
                        <label>Nomor BAPB</label>
                        <div class="input-group mg-b-md">
                            <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                            <input type="text" id="no_bapb" value="<?php echo empty($mog_dt) ? set_value('mog_number') : $mog_dt->mog_number; ?>" class="form-control" placeholder="Nomor BAPB">
                        </div>
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="form-group">
                        <label>Nomor Surat Jalan</label>
                        <div class="input-group mg-b-md">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" name="mog_number_letter" class="form-control" value="<?php echo isset($mog_dt) ? $mog_dt->mog_number_letter : NULL; ?>" placeholder="Nomor Surat Jalan"/>
                        </div>
                    </div>
                </div>
				
				

                <div class="">
                    <div class="col-xs-5 mg-b-md">
                        <div class="form-group">
                            <label>Kode Nasabah</label>
                            <div class="input-group mg-b-md">
                                <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                                <input type="text" id="kode_nasabah" class="form-control" value="<?php echo isset($mog_dt) ? $mog_dt->actor_code : NULL; ?>" placeholder="Kode Nasabah" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-7 mg-b-md">
                        <div class="form-group">
                            <label>NPWP</label>
                            <input type="text" id="npwp" class="form-control" value="<?php echo isset($mog_dt) ? $mog_dt->actor_identity : NULL; ?>" placeholder="NPWP" readonly/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-5">
                <div class="col-xs-12 mg-t-lg">
                    <div class="form-group">
                        <label class="col-xs-6 text-right mg-t-sm">Tanggal BAPB</label>
                        <div class="col-xs-6">
						<div class="row">
						<div class="input-group input-append date datepicker" data-date="<?php echo empty($mog_dt) ? date('d-m-Y') : date('d-m-Y',strtotime($mog_dt->mog_date)); ?>" data-date-format="dd-mm-yyyy">
                        <input type="text" readonly class="form-control" name="mog_date" value="<?php echo empty($mog_dt) ? date('d-m-Y') : date('d-m-Y',strtotime($mog_dt->mog_date)); ?>" placeholder="BAPB DATE">
                        <span class="input-group-btn"><button class="btn btn-white add-on" type="button"><i class="fa fa-calendar"></i></button></span>
                    </div>
						</div>
                            
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
                                <th class="text-center hidden-xs" style="width: 30px; padding: 15px">No.</th>
                                <?php if ($permit->access_special == 1) { ?>
                                    <th class="text-center" style="width: 150px; padding: 15px">Kode Sumber Daya</th>
                                <?php } ?>
                                <th class="text-center" style="width: 250px; padding: 15px">Nama Material</th>
                                <th class="text-center" style="width: 100px; padding: 15px">Satuan</th>
                                <th class="text-center" style="width: 150px; padding: 15px">Konversi</th>
                                <th class="text-center" style="width: 90px; padding: 15px">Volume</th>
                                <?php if ($permit->access_special == 1) { ?>
                                    <th class="text-center" style="width: 140px; padding: 15px">Harga</th>
                                    <th class="text-center hidden-xs" style="width: 150px; padding: 15px">Sub Total</th>
                                <?php } ?>
                                <th class="text-center" style="width: 50px; padding: 15px"><i class="fa fa-gear"></i></th>
                            </tr>
                        </thead>
                        <tbody id="show_rowxx"></tbody>
                        <tr>
                            <td colspan="6"><button class="btn btn-md btn-dark col-xs-12" onclick="adds_row()" type="button"><i class="fa fa-plus"></i></button></td>
                            <?php if ($permit->access_special == 1) { ?>
                                <th class="text-right">Total (Rp.)</th>
                                <th><input type="text" class="form-control" name="mog_total" id="mog_total" readonly/></th>
                            <?php } ?>
                        </tr>
                    </table> 
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-xs-12">
                <?php if (!empty($mog_dt)) { ?>
                    <div class="<?php echo!empty($mog_dt) ? 'col-xs-6' : null ?>">
                        <a href="<?php echo base_url() ?>warehouse/bapb"  class="cancelMt btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                    </div>
                <?php } ?>
                <div class="<?php echo!empty($mog_dt) ? 'col-xs-6' : 'col-xs-6 col-xs-offset-6' ?> pull-right">
                    <button type="submit" id="save_btn" class="btn btn-primary col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
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
		//getdata_supplier();
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
		
<?php if ($permit->access_update == 1 && isset($mog_id)) { ?>
           // $("#show_row").load("<?php echo base_url() . $url_access . 'get_mog_detail/' . $mog_id; ?>");
            //adds_row();
<?php } ?>
        
        $(".cancelMt").click(function() {
            $(".load_main_data").load("<?php echo base_url(); ?>warehouse/bapb/form");
        });
    });
	
	
	
	
	function getdata_supplier(){
		$.ajax({
			url: "<?php echo base_url('warehouse/bapb/get_supplier'); ?>",
			dataType:'JSON',
			success: function(data) {		
				var select = $("#supplier"), options = '';
				select.empty();
				for(var i=0;i<data.length; i++){
					options += "<option data-kode='"+data[i].kode+"' data-npwp='"+data[i].npwp+"' value='"+data[i].idne+"'>"+ data[i].nama +"</option>"; 
				}
				select.append(options);
				$("#supplier").change(function(){
					console.log("supplier");
					$('#kode_nasabah').val($("#supplier option:selected").attr('data-kode'));
					$('#npwp').val($("#supplier option:selected").attr('data-npwp'));
					getdata_spb($('#supplier').val());
				});
			}
		});
	}
	
	
	function getdata_spb(id_spb){
		$.ajax({
			url: "<?php echo base_url('warehouse/bapb/getdata_spbsuplier'); ?>/"+ id_spb,
			dataType:'JSON',
			success: function(json) {
                var data = json.data;
				console.log(data);
                var select = $("#spb"), options = '';
                select.empty();
                if(json.status == 1){
                    if(data.length === 0) {
                        select.empty();
                    } else {
                        for(var i=0;i<data.length; i++){
                            options += "<option data-bapb='"+data[i].no_bapb+"' value='"+data[i].id+"'>"+ data[i].no_spb +"</option>"; 
                        }
                        select.append(options);
                        $("#spb").change(function(){
							$('#no_bapb').val($("#spb option:selected").attr('data-bapb'));
						});
						
					}
				}
			}
		});
	}
	
	
	
	
	
	
	
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
<?php if ($permit->access_special == 1) { ?>
                + '<td>'
                + '<select name="code[]" id="code_'+counter+'" class="form-control" data-style="btn-white" data-placeholder="Kode Sumber Daya">'
                + '<option value="">Kode Sumber Daya</option>'
    <?php foreach ($code as $cd) { ?>
                        + '<option value="<?php echo $cd->code_id; ?>"><?php echo $cd->code_name; ?></option>'
    <?php } ?>
                    + '</select>'
                    + '</td>'
<?php } ?>
            + '<td id="material_select_' + counter + '"></td>'
            + '<td class="hidden-xs">'
            + '<input type="text" id="mog_dt_unit_' + counter + '" name="mog_dt_unit[]" value="" class="form-control" placeholder="Satuan" readonly>'
            + '</td>'
            + '<td class="hidden-xs">'
            + '<input type="text" id="mog_dt_convertion_' + counter + '" name="mog_dt_convertion[]" value="" class="form-control" placeholder="Konversi" readonly>'
            + '</td>'
            + '<td>'
        //            + '<input id="mog_dt_volume_' + counter + '" class=" form-control " onkeyup="get_count(this,' + counter + ')" name="mog_dt_volume[]" value="" class="form-control" placeholder="Volume">'
            + '<input id="mog_dt_volume_' + counter + '" class=" form-control" onkeyup="get_count(this,' + counter + ')" name="mog_dt_volume[]" value="" class="form-control" placeholder="Volume">'
            + '</td>'
<?php if ($permit->access_special == 1) { ?>
                + '<td>'
                + '<input id="mog_dt_price_' + counter + '" class=" form-control " onkeyup="get_count(this,' + counter + ')" name="mog_dt_price[]" value="" class="form-control" placeholder="Harga">'
                + '</td>'
                + '<td rowspan="2" style="padding-left: 18px" class="hidden-xs total_sub" id="total_sub_' + counter + '">'
                + '</td>'
<?php } ?>
            + '<td rowspan="2" class="text-center"><button type="button" class="btn btn-danger" id="btn_' + counter + '" onclick="cut(this, ' + counter + ')"><i class="fa fa-times"></i></button></td>'
            + '</tr><tr class="note_row_' + counter + '">'
            + '<td class="hidden-xs" colspan="4">'
            + '<input type="text" maxlength="20" id="mog_dt_note_' + counter + '" name="mog_dt_note[]" value="" class="form-control" placeholder="Note (Panjang huruf 20 karakter)">'
            + '</td></tr>';
        $('#show_row').append(baris);
        $('#material_select_' + counter).load("<?php echo base_url() ?>warehouse/bapb/get_material/all/"+ counter);
    }

    function get_unit(i) {
        $.ajax({
            url: "<?php echo base_url('warehouse/material/get_unit'); ?>/" + $('#material_' + i).val() + '/' + $('#project').val(),
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
            url: "<?php echo base_url('warehouse/get_supplier'); ?>/" + $('#actor').val(),
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $("#kode_nasabah").attr('value', json.data.kode);
                    $("#npwp").attr('value', json.data.npwp);
                    getdata_spb($('#actor').val());
                }
            }
        });
        return false;
    }
	
    function get_detail(el) {
        $.ajax({
            url: "<?php echo base_url() . 'warehouse/bapb/get_mog/'; ?>" + el.value,
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
                    //$('#show_row').load("<?php echo base_url() . 'warehouse/bapb/get_mog_detail/'; ?>" + el.value);
                }
            }
        });
        return false;
    }
    
    function getProData() {
        $.ajax({
            url: "<?php echo base_url('warehouse/get-project'); ?>/" + $('#project').val() + '/1',
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
        if ($("select[name=project] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Project can not empty");
            $("select[name=project]").focus();
            return false;
        }
        if ($("input[name=mog_number]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>BAPB Number can not empty");
            $("input[name=mog_number]").focus();
            return false;
        }
        if ($("input[name=mog_number_letter]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Letter Number can not empty");
            $("input[name=mog_number_letter]").focus();
            return false;
        }
        if ($("select[name=actor] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Supplier can not empty");
            $("select[name=actor]").focus();
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
                                
                if(qty ==''){
                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Volume ordered can not empty");
                    return false;
                }
                if(price == ''){
                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Price ordered can not empty");
                    return false;
                }
            } else {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Material ordered can not empty");
                return false;
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
                    window.open("<?php echo base_url() ?>warehouse/bapb-print/" + json.id);
                    $(".load_main_data").load("<?php echo base_url() ?>warehouse/bapb/form");
                }
            }
        });
        return false;
    });
	
	
    


</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap-filestyle.min.js"></script>