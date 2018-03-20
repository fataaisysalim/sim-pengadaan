<div style="margin-top: 20px;">
    <!--<div class="row">-->
        <?php if($resource == 4) { ?>
        <div class="row invoice_wo">
            <div class="col-xs-6">
                <div class="form-group">
                    <label>SPK</label>
                    <select id="work_order" onchange="get_work_order(this)" name="work_order" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih Perintah Kerja">
                        <option value="<?php echo isset($detail) ? $detail->work_order_id : NULL; ?>" <?php echo isset($detail) ? "selected" : NULL; ?>><?php echo isset($detail) ? $detail->work_order_number : NULL; ?></option>
                        <?php foreach ($work_order as $wo) : ?>
                            <option value="<?php echo $wo->work_order_id; ?>" <?php if (isset($invoice_id) && $wo->work_order_id == $invoice_id->work_order_id) echo "selected"; ?> <?php if ($wo->work_order_id == set_value('project')) echo "selected"; ?>><?php echo ucwords($wo->work_order_number); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Invoice Type</label>
                    <select id="invoice_wo_ct" onchange="get_invoice_wo_ct(this)" name="invoice_wo_ct" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih Kategori">
                        <option value="<?php echo isset($detail) ? $detail->invoice_wo_ct_id : NULL; ?>" <?php echo isset($detail) ? "selected" : NULL; ?>><?php echo isset($detail) ? $detail->invoice_wo_ct_name : NULL; ?></option>
                        <?php if(!isset($detail)) { ?>
                            <?php foreach ($wo_ct as $ct) : ?>
                                <option class="option_wo_ct" id="option_wo_ct_<?php echo $ct->invoice_wo_ct_id; ?>" value="<?php echo $ct->invoice_wo_ct_id; ?>" <?php if (isset($invoice_id) && $ct->invoice_wo_ct_id == $invoice_id->invoice_wo_ct_id) echo "selected"; ?> <?php if ($ct->invoice_wo_ct_id == set_value('project')) echo "selected"; ?>><?php echo ucwords($ct->invoice_wo_ct_name); ?></option>
                            <?php endforeach; ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <table class="table table-bordered" style="margin-top: -13px">
            <thead class="bg-dark" style="color: white">
                <tr>
                    <th class="text-center hidden-xs" style="width: 30px; padding: 15px">No.</th>
                    <th id="transaction_name" class="text-center" style="width: 250px; padding: 15px"><?php echo $resource == 2 ? 'Alat' : 'BAPB' ?></th>
                    <?php if($resource == 1) { ?>
                        <th class="text-center" style="width: 600px; padding: 15px"></th>
                    <?php } else if($resource == 2) { ?>
                        <th class="text-center" style="width: 200px; padding: 15px">Hutang</th>
                        <th class="text-center" style="width: 200px; padding: 15px">Tagihan</th>
                    <?php } ?>
                    <!--<th class="text-center" style="min-width: 10px; padding: 15px"><i class="fa fa-gear"></i></th>-->
                    <th class="text-center" style="padding: 15px" width='1%'><i class="fa fa-gear"></i></th>
                </tr>
            </thead>
            <tbody id="show_row">
                
                <?php if(isset($detail)) { ?>
                    <?php $counter = 0; foreach ($detail as $i => $r) { ?>
                    <?php $counter = $i + 1; ?>
                    <?php if($resource == 1) { ?>
                    <tr class="row_out row_tam">
                        <td class="text-center hidden-xs" rowspan="2"><p id="num_<?php echo $counter; ?>"><?php echo $counter; ?></p></td>
                        <input type="hidden" id="action_<?php echo $counter; ?>" name="action[]" value="edit" class="form-control">
                        <input type="hidden" name="transaction_dt_status[]" value="1" class="form-control">
                        <input type="hidden" name="transaction_dt[]" value="<?php echo $r->invoice_dt_id; ?>" class="form-control">
                        <input type="hidden" id="transaction_total_<?php echo $counter; ?>" name="mog_total[]" value="" class="form-control">
                        <input type="hidden" id="transaction_total2_<?php echo $counter; ?>" name="mog_total2[]" value="" class="form-control">
                        <td style="border: none;" colspan="1" id="transaction_select_<?php echo $counter; ?>">
                            <div class="form-group">
                                <select id="transaction_<?php echo $counter ?>" onchange="get_transaction_detail(this, '<?php echo $counter ?>', '<?php echo $resource; ?>')" name="transaction[]" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih BAPB">
                                    <?php if(isset($mog)) { ?>
                                        <option value="<?php echo $r->mog_id ?>"><?php echo $r->mog_number; ?></option>
                                        <?php foreach ($mog as $m) { ?>
                                        <option value="<?php echo $m->mog_id; ?>"><?php echo $m->mog_number; ?></option>
                                        <?php } ?>
                                    <?php } ?> 
                                </select>
                            </div>
                            <script>
                                $('select.form-select2').select2();
                            </script>
                        </td>
                        <td ></td>
                        <td rowspan="2" class="text-center"><button type="button" class="btn btn-danger" id="btn_<?php echo $counter; ?>" onclick="change(<?php echo $resource; ?>, <?php echo $counter; ?>, 2)"><i class="fa fa-times"></i></button></td>
                    </tr>
                    <tr class="note_row_<?php echo $counter; ?>">
                        <td style="border: none;" class="hidden-xs" colspan="2">
                            <table class='table'>
                            <tr>
                                <th class="text-center hidden-xs" style="width: 30px; padding: 15px">No.</th>
                                <th class="text-center hidden-xs" style="width: 170px; padding: 15px">Material</th>
                                <th class="text-center hidden-xs" style="width: 30px; padding: 15px">Code</th>
                                <th class="text-center hidden-xs" style="width: 30px; padding: 15px">Unit</th>
                                <th class="text-center hidden-xs" style="width: 30px; padding: 15px">Convertion</th>
                                <th class="text-center hidden-xs" style="width: 30px; padding: 15px">Volume</th>
                                <th class="text-center hidden-xs" style="width: 130px; padding: 15px">Price</th>
                                <th class="text-center hidden-xs" style="width: 130px; padding: 15px">Subtotal</th>
                            </tr>
                            <tbody id="show_dt_<?php echo $counter; ?>">
                            <script>
                                $("#show_dt_<?php echo $counter; ?>").load("<?php echo base_url() . $url_access . 'get_transaction_detail/'; echo $r->mog_id ?>/<?php echo $counter; ?>/<?php echo $resource; ?>");
                            </script>
                            </tbody>
                            </table>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if($resource == 2) { ?>
                    <tr class="row_out row_tam">
                        <td class="text-center hidden-xs"><p id="num_<?php echo $counter; ?>"><?php echo $counter; ?></p></td>
                        <input type="hidden" id="action_<?php echo $counter; ?>" name="action[]" value="edit" class="form-control">
                        <input type="hidden" name="transaction_dt_status[]" value="1" class="form-control">
                        <input type="hidden" name="transaction_dt[]" value="<?php echo $r->invoice_equipt_id; ?>" class="form-control">
                        <input type="hidden" name="debt_id[]" value="<?php echo $r->debt_id; ?>" class="form-control">
                        <input type="hidden" id="transaction_total_<?php echo $counter; ?>" name="mog_total[]" value="" class="form-control">
                        <input type="hidden" id="transaction_total2_<?php echo $counter; ?>" name="" value="<?php echo rupiah($r->invoice_equipt_dt_total); ?>" class="form-control">
                        <td colspan="1" id="select_equipment_<?php echo $counter; ?>">
<!--                            <div class="form-group">
                                <select id="equipment_<?php echo $counter ?>" onchange="get_equipment_debt(this, '<?php echo $counter ?>')" name="equipment[]" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih Alat">
                                    <?php if(isset($equipt)) { ?>
                                        <?php foreach ($equipt as $e) { ?>
                                        <option value="<?php echo $e->equipment_id; ?>" <?php echo $e->equipment_id == $r->equipment_id ? 'selected' : NULL; ?>><?php echo $e->equipment_name; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>-->
                            <script>
                                $('#select_equipment_<?php echo $counter ?>').load("<?php echo base_url() . $url_access . 'get_select_equipment/' ?><?php echo $counter ?>/" + $("#actor").val() + "/" + $("#project").val() + "/" + $("input[name=invoice_resource_code]:checked").val() + "<?php echo '/' . $r->equipment_id; ?>");
                            </script>
                        </td>
                        <td>
                            <input readonly type="text" id="debt_<?php echo $counter; ?>" name="debt[]" value="<?php echo rupiah($r->debt_total); ?>" class="form-control">
                        </td>
                        <td>
                            <input type="text" onkeyup="total_equipt(this)" name="invoice_dt_total[]" id="invoice_dt_total_<?php echo $counter; ?>" value="<?php echo rupiah($r->invoice_equipt_dt_total); ?>" class="form-control">
                        </td>
                        <td class="text-center"><button type="button" class="btn btn-danger" id="btn_<?php echo $counter; ?>" onclick="change(<?php echo $resource; ?>, <?php echo $counter; ?>, 2)"><i class="fa fa-times"></i></button></td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                <?php } ?>
                
            </tbody>     
            <tr>
                <td style="border: 1px solid transparent; margin: 0; padding: 0; padding: 10px 0;" colspan="<?php echo ($resource == 1) ? 4 : 5; ?>"><button <?php echo $sess['position_id'] == 5 ? 'disabled' : NULL; ?> id="add_btn" class="btn btn-md btn-dark col-xs-12" onclick="<?php if($resource == 1) { echo 'adds_row()'; } else if($resource == 2) { echo 'adds_equipt()'; } ?>" type="button"><i class="fa fa-plus"></i></button></td>
                <?php if ($sess['position_id'] == 6 || ($sess['position_id'] == 1 && isset($invoice_id) && $invoice_id->invoice_status == 1)) { ?>
                <!--
                <th class="text-right">Total (Rp.)</th>
                <th><input type="text" class="form-control" name="invoice_total" id="invoice_total" readonly/></th
                >-->
                <?php } ?>
            </tr>
        </table> 
        <?php } ?>
    <!--</div>-->
</div>

<script type="text/javascript">
    $('select.form-select2').select2();
    
    $(document).ready(function(){
        if($("#work_order").val() == '') {
            $("#invoice_wo_ct").attr("disabled", "disabled");
        }
    });
    
    function get_work_order(a) {
        var val = a ? a.value : $("#work_order").val();
        $.ajax({
            url: "<?php echo base_url() . $url_access . 'get_work_order/'; ?>" + val,
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    if(json.termin == 0) {
//                        $("#termin_history").html('');
//                        $("#invoice_wo_ct").val('');
//                        get_pre_netto();
                    }
                    if(json.data.work_order_extra) {
                        if(json.data.work_order_extra_mode == 1) {
                            $("#work_order_contract2").val(numberToCurrency(parseFloat(json.data.work_order_contract) + parseFloat(json.data.work_order_extra)));
                        } else {
                            $("#work_order_contract2").val(numberToCurrency(parseFloat(json.data.work_order_contract) - parseFloat(json.data.work_order_extra)));
                        }
                    } else {
                        $("#work_order_contract2").val(numberToCurrency(json.data.work_order_contract));
                    }
                    $("#work_order_contract").val(numberToCurrency(json.data.work_order_contract));
                    $("#angsuran_um2").val(json.data.work_order_dp);
                    $("#work_order_dp").val(json.data.work_order_dp);
                    $("#retensi2").val(json.data.work_order_retensi);
                    $("#work_order_retensi").val(json.data.work_order_retensi);
                    
                    if(json.data.work_order_status == 2) {
                        $("#percent_netto").attr('disabled', 'disabled');
                        $("#percent_netto").val(100);
                        $("#pre_netto").val($("#work_order_contract2").val());
                    }
                    
                    if($("#pre_netto").val() != '') {
                        var pre_netto = currencyToNumber($("#pre_netto").val());
                        var um = 0;
                        var retensi = (json.data.work_order_retensi / 100) * pre_netto;
                        
                        if(json.data.work_order_status == 1) {  
                            var um = (json.data.work_order_dp / 100) * pre_netto;

                            $("#angsuran_um").val(numberToCurrency(um));
                            $("#um_percent").html('<p style="padding: 5px 0;">' + json.data.work_order_dp + '%' + '</p>');
                            $("#retensi").val(numberToCurrency(retensi));
                            $("#retensi_percent").html('<p style="padding: 5px 0;">' + json.data.work_order_retensi + '%' + '</p>');
                        }
                        if($("#invoice_wo_ct").val() == 3) {
                            $("#invoice_netto").val(numberToCurrency(retensi));
                            $("#retensi").val(numberToCurrency(retensi));
                        } else if($("#invoice_wo_ct").val() == 1) {
                            var retensi = 0;
                            $("#invoice_netto").val(numberToCurrency(pre_netto - um - retensi));
                        } else {
                            $("#invoice_netto").val(numberToCurrency(pre_netto - um - retensi));
                        }
                        $("#invoice_bruto").val($("#invoice_netto").val());
                        $("#total").val($("#invoice_netto").val());
                    }
                    $("#invoice_wo_ct").attr('disabled', false);
                    
                    var jml_op = $(".option_wo_ct").length;
                    for(var e = 1; e <= jml_op; e++) {
//                        if(json.data.work_order_status == $("#option_wo_ct_" + e).attr('value') || json.data.work_order_status > $("#option_wo_ct_" + e).attr('value')) {
                        if(json.data.work_order_status == 0) {
                            $("#option_wo_ct_" + e).attr('disabled', 'disabled');
                            $("#option_wo_ct_1").attr('disabled', false);
                        } else if(json.data.work_order_status == $("#option_wo_ct_" + e).attr('value') || json.data.work_order_status > $("#option_wo_ct_" + e).attr('value')) {
                            $("#option_wo_ct_" + e).attr('disabled', 'disabled');
                        } else {
                            $("#option_wo_ct_" + e).attr('disabled', false);
                        }
                        
                        if($("#option_wo_ct_" + e).attr('value') == 3 && json.data.work_order_status == 2) {
                            $("#option_wo_ct_3").attr('disabled', false);
                        } else {
                            $("#option_wo_ct_3").attr('disabled', 'disabled');
                        }
                    }
                    
                }
            }
        });
        return false;
    }
    
    function get_pre_netto(a) {
        if(a) {
            if(a.value < 101) {
                format_number(a);
                var pre_netto = currencyToNumber(a.value);
            } 
        } 
        
        if($("#invoice_wo_ct").val() == 1) {
            if($("#pre_netto").val() != '') {
                var pre_netto = currencyToNumber($("#pre_netto").val());
            } 
        } 
        if($("#invoice_wo_ct").val() == 2) {
            if($("#percent_netto").val() != '') {
                if(percent_validate($("#percent_netto").val()) == true) {
                    var percent_netto = $("#percent_netto").val();
                    var percent = parseFloat(percent_netto.replace(',', '.'));
                    var percent_fixed = percent.toFixed(4);
                    var contract = currencyToNumber($("#work_order_contract2").val());
                    var pre_netto = (percent_fixed / 100) * contract;
//                    alert(pre_netto);
                    $("#pre_netto").val(numberToCurrency2(Math.round(pre_netto)));
                    
//                    if (!isNaN(percent) && percent.toString().indexOf('.') != -1) {
//                        $("#percent_netto").val(percent_fixed.replace('.', ','));
//                    } else {
//                        var percent = percent.replace('.', ',');
//                        $("#percent_netto").val(percent);
//                    }
                } else {
                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Nilai progres salah");
                    $("#percent_netto").val('');
                    $("#new_termin").val('');
                }
            }
        }
        if($("#invoice_wo_ct").val() == 3) {
            $("#pre_netto").val($("#work_order_contract2").val());
            var pre_netto = currencyToNumber($("#work_order_contract2").val());
        }
                
        var um = 0;
        var retensi = 0;
        
        var jml_t = $(".termin_history").length;
        var termin = 0;
        for(var e = 1; e <= jml_t; e++) {
            termin = termin + currencyToNumber($("#termin_" + e).val());
        }
        if($("#percent_netto").val() != '' && termin > 0) {
            $("#new_termin").val(numberToCurrency2(pre_netto - termin));
            var new_termin = pre_netto - termin;
        }
        
        if($("#invoice_wo_ct").val() == 2) {
            var pre_netto = new_termin ? new_termin : pre_netto;
            if($("#angsuran_um2").val() != '') {
                if($("#percent_netto").val() == 100) {
                    var total_kon = currencyToNumber($("#work_order_contract").val());
                    var um = (currencyToNumber($("#angsuran_um2").val()) / 100) * total_kon;
                } else {
                    var um = (currencyToNumber($("#angsuran_um2").val()) / 100) * pre_netto;
                }
                $("#angsuran_um").val(numberToCurrency2(um));
                $("#um_percent").html($("#angsuran_um2").val() + '%');
            }
            
            if($("#retensi2").val() != '') {
                if($("#percent_netto").val() == 100) {
                    var total_kon2 = currencyToNumber($("#work_order_contract2").val());
                    var retensi = (currencyToNumber($("#retensi2").val()) / 100) * total_kon2;
                } else {
                    var retensi = (currencyToNumber($("#retensi2").val()) / 100) * pre_netto;
                }
                $("#retensi").val(numberToCurrency2(retensi));
                $("#retensi_percent").html($("#retensi2").val() + '%');
            }
        }
        
        $("#invoice_netto").val(numberToCurrency2(pre_netto - um - retensi));
        $("#invoice_bruto").val($("#invoice_netto").val());
        $("#total").val($("#invoice_netto").val());
        tax_count();
    }
    
    function get_invoice_wo_ct(a) {
        var wo_ct = a.value;
        if(wo_ct == 1) {
            var table = '<table class="table" style="margin-bottom: 0;">'
                        + '<tr>'
                        + '<td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Nilai Uang Muka</b></td>'
                        + '<td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>'
                        + '<td style="padding: 0 0 10px 0; border: none; font-weight: bold">'
                        + '<div class="row">'
                        + '<div class="col-xs-9">'
                        + '<input readonly class="form-control" onkeyup="get_pre_netto(this)" type="text" style="font-weight: bold" name="pre_netto" id="pre_netto" value=""/>'
                        + '</div>'
                        + '<div class="col-xs-3">'
                        + '<input readonly class="form-control" onkeyup="" type="text" style="font-weight: bold" name="wo_dp" id="wo_dp" value=""/>'
                        + '</div>'
                        + '</div>'
                        + '</td>'
                        + '</tr>'
                        + '</table>';
                $("#kategori").html('');
                $("#kategori").append(table);
                $("#wo_dp").val($("#work_order_dp").val() + '%');
                $("#pre_netto").val(numberToCurrency(currencyToNumber($("#work_order_contract").val()) * ($("#work_order_dp").val() / 100)));
        } else if(wo_ct == 2) {
            var table = '<table class="table" style="margin-bottom: 0;">'
                        + '<tr>'
                        + '<td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Nilai Progress (%) </b></td>'
                        + '<td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>'
                        + '<td style="padding: 0 0 10px 0; border: none; font-weight: bold">'
                        + '<div class="row">'
                        + '<div class="col-xs-4">'
                        + '<input class="form-control" onkeyup="get_pre_netto(this)" type="text" style="font-weight: bold" name="percent_netto" id="percent_netto" value=""/>'
                        + '</div>'
                        + '<div class="col-xs-8">'
                        + '<input readonly class="form-control" onkeyup="get_pre_netto(this)" type="text" style="font-weight: bold" name="pre_netto" id="pre_netto" value=""/>'
                        + '</div>'
                        + '</div>'
                        + '<div id="nominal">'
                        + '</div>'
                        + '</td>'
                        + '</tr>'
                        + '</table>'
                        + '<div id="termin_history">'
                        + '</div>'
                        + '<table class="table" style="margin-bottom: 0;">'
                        + '<tr>'
                        + '<td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Angsuran Uang Muka</b></td>'
                        + '<td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>'
                        + '<td style="padding: 0 0 10px 0; border: none; font-weight: bold">'
                        + '<div class="row">'
                        + '<div class="col-xs-9">'
                        + '<input readonly class="form-control" type="text" style="font-weight: bold" name="angsuran_um" id="angsuran_um" value=""/>'
                        + '<input class="form-control" type="hidden" style="font-weight: bold" id="angsuran_um2" value=""/>'
                        + '</div>'
                        + '<div class="col-xs-3" id="um_percent">'
                        + '</div>'
                        + '</div>'
                        + '</td>'
                        + '</tr>'
                        + '<tr>'
                        + '<td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Retensi</b></td>'
                        + '<td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>'
                        + '<td style="padding: 0 0 10px 0; border: none; font-weight: bold">'
                        + '<div class="row">'
                        + '<div class="col-xs-9">'
                        + '<input readonly class="form-control" type="text" style="font-weight: bold" name="retensi" id="retensi" value=""/>'
                        + '<input class="form-control" type="hidden" style="font-weight: bold" id="retensi2" value=""/>'
                        + '</div>'
                        + '<div id="retensi_percent" class="col-xs-3">'
                        + '</div>'
                        + '</td>'
                        + '</tr>'
                        + '</table>';
                $("#kategori").html('');
                $("#kategori").append(table);
                $("#termin_history").load("<?php echo base_url() . $url_access . 'get_invoice_history/' ?>" + $("#work_order").val());
        } else if(wo_ct == 3) {
            var table = '<table class="table" style="margin-bottom: 0;">'
                        + '<tr>'
                        + '<td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Nilai Progress</b></td>'
                        + '<td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>'
                        + '<td style="padding: 0 0 10px 0; border: none; font-weight: bold">'
                        + '<div class="row">'
                        + '<div class="col-xs-4">'
                        + '<input class="form-control" onkeyup="get_pre_netto(this)" type="text" style="font-weight: bold" name="percent_netto" id="percent_netto" value=""/>'
                        + '</div>'
                        + '<div class="col-xs-8">'
                        + '<input readonly class="form-control" onkeyup="get_pre_netto(this)" type="text" style="font-weight: bold" name="pre_netto" id="pre_netto" value=""/>'
                        + '<input class="form-control" type="hidden" name="retensi" id="retensi" value=""/>'
                        + '</div>'
                        + '</div>'
                        + '<div id="nominal">'
                        + '</div>'
                        + '</td>'
                        + '</tr>'
                        + '</table>';
                $("#kategori").html('');
                $("#kategori").append(table);
        }
        
        if($("#pre_netto").val()) {
            get_pre_netto();
        }
        $("#invoice_netto").val('');
        $("#invoice_bruto").val('');
        $("#total").val('');
        get_work_order();
    }
    
    function percent_validate(x) {
//        var parts = x.split(".");
        
        var x = x.replace(",", ".");
        var parts = x.split(".");
        
        if (typeof parts[1] == "string" && parts[1].length > 4) {
            return false;
        }
//        var x = x.replace(",", ".");
        var n = parseFloat(x);
        if (isNaN(n)) {
            return false;
        }
        if (n < 0 || n > <?php echo isset($max) ? $max - 1 : 100; ?>) {
            return false;
        }
        return true;
    }
    
    function change(el, i, st) {
        if(st) {
            var sts = st == 2 ? 1 : 2;
            var btn = st == 2 ? 'success' : 'danger';
            var fa = st == 2 ? 'check' : 'times';
            var bg = st == 2 ? 'red' : 'none';
            var act = st == 2 ? 'delete' : 'edit';
            var tot = st == 2 ? '0' : $("#transaction_total2_" + i).val();
            
            $("#btn_" + i).attr('onclick', "change(" + el + ", " + i + ", " + sts + ")");
            $("#btn_" + i).attr('class', "btn btn-" + btn);
            $("#btn_" + i + " i").attr('class', "fa fa-" + fa);
            
            $("#num_" + i).attr('style', "background-color : " + bg);
            $("#action_" + i).val(act);
            if(el == 1) {
                $("#transaction_total_" + i).val(tot);
            } else {
                $("#invoice_dt_total_" + i).val(tot);
            }
        }
        if(el == 1) {
            total();
        } else {
            total_equipt();
        }
    }
</script>