<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('msgTransM') ?></div>
</div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-edit mg-r-sm'></i> <?php echo $transaction_ct; ?>
    </header>
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'form')); ?>
        <?php if (!empty($payment_id)) { ?>
            <input type="hidden" name="payment_id" value="<?php echo $payment_id->payment_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">
            <div class="col-sm-6">
                <div class="col-xs-7">
                    <div class="form-group">
                        <label>Invoice</label>
                        <select id="invoice" onchange="get_transaction_detail(this)" name="invoice" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih Invoice">
                            <option value=""></option>
                            <?php foreach ($invoice as $in) : ?>
                                <option value="<?php echo $in->invoice_id; ?>" <?php if (isset($payment_id) && $in->invoice_id == $payment_id->invoice_id) echo "selected"; ?>><?php echo ucwords($in->invoice_number); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-7">
                    <div class="form-group">
                        <label>Total Tagihan</label>
                        <div class="input-group mg-b-md">
                            <input readonly type="text" name="invoice_total" value="" class="form-control" placeholder="Total Tagihan">
                        </div>
                    </div>
                </div>
                <div class="col-xs-7">
                    <div class="form-group">
                        <label>Sisa Tagihan</label>
                        <div class="input-group mg-b-md">
                            <input readonly type="text" name="payment_sequence" value="" class="form-control" placeholder="Sisa Tagihan">
                        </div>
                    </div>
                </div>

                <div class="col-xs-7">
                    <div class="form-group">
                        <label>Total Bayar</label>
                        <div class="input-group mg-b-md">
                            <input type="text" onkeyup="format_number(this)" name="payment_total" value="" class="form-control" placeholder="Total Pembayaran">
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xs-6">
                <div class="col-xs-12 mg-t-lg">
                    <div class="form-group">
                        <label class="col-xs-6 text-right">Payment Date</label>
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
        <section class="panel" id="show_transaction">
            <div class="panel-body row">
                <div class="row">
                    <table class="table table-bordered table-striped" style="margin-top: -13px">
                        <thead class="bg-dark" style="color: white">
                            <tr>
                                <th class="text-center hidden-xs" style="width: 30px; padding: 15px">No.</th>
                                <th class="text-center" style="width: 250px; padding: 15px">Resource</th>
                                <th class="text-center" style="width: 100px; padding: 15px">Volume</th>
                                <th class="text-center" style="width: 100px; padding: 15px">Price</th>
                                <th class="text-center" style="width: 100px; padding: 15px">Subtotal</th>
                                <th class="text-center" style="min-width: 30px; padding: 15px"><i class="fa fa-gear"></i></th>
                            </tr>
                        </thead>
                        <tbody id="show_row"></tbody>
                        <tr>
                            <?php if ($permit->access_special == 1 && isset($payment_id) && $payment_id->payment_status == 1) { ?>
                                <th class="text-right">Total (Rp.)</th>
                                <th><input type="text" class="form-control" name="payment_total" id="payment_total" readonly/></th>
                            <?php } ?>
                        </tr>
                    </table> 
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-lg-6">

            </div>
            <div class="col-xs-6">
                <?php if (!empty($payment_id)) { ?>
                    <div class="<?php echo!empty($payment_id) ? 'col-xs-6' : null ?>">
                        <a role="button" style="cursor: pointer" class="cancel_m btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                    </div>
                <?php } ?>
                <div class="<?php echo!empty($payment_id) ? 'col-xs-6' : 'col-md-6 col-sm-12 col-xs-6' ?> pull-right">
                    <button type="submit" class="btn btn-primary col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
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
        
        $(".cancel_m").click(function() {
            $(".load_main_data").load("<?php echo base_url() ?>finance/payment");
        });
        
        $(".resource").change(function(){
            $('#show_row').html('');
            $("#add_btn").attr('disabled', 'disabled');
            $("#select_actor").load("<?php echo base_url() . $url_access . 'get_select_actor/' ?>" + $("input[name=payment_resource_code]:checked").val());
        });
        
    });
    
    function get_btn() {
        if($("#actor").val() != '' && $("#project").val()) {
            $("#add_btn").attr('disabled', false);
            $('#show_row').html('');
            adds_row();
        }
    }

    function get_transaction_detail(a) {
        $("#show_transaction").load("<?php echo base_url() . $url_access . 'get_transaction_detail/'; ?>" + a.value);
    }
    
    function get_detail(el) {
        $.ajax({
            url: "<?php echo base_url() . $url_access . 'get_invoice/'; ?>" + el.value,
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $("input[name=invoice_total]").attr('value', numberToCurrency(json.data.invoice_total));
                    $("input[name=payment_sequence]").attr('value', numberToCurrency(json.sisa));
                    if(json.payment_id) {
                        var action = $("#form").attr('action');
                        $("#form").attr('action', action + '' + json.payment_id);
                    } else {
                        $("#form").attr('action', "<?php echo base_url() . $url_action; ?>")
                    }
                }
            }
        });
        return false;
    }
    
    function getProData() {
        $.ajax({
            url: "<?php echo base_url('warehouse/project/getdata'); ?>/" + $('#project').val() + '/1/payment',
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $(".proCode").attr('value', json.data.project_code);
                    //                    $("input[name=payment_number]").attr('value', json.data.project_code + json.number);
                    $("input[name=payment_number]").attr('value', json.number);
                    get_btn();
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
            var volume = currencyToNumber($("#payment_dt_volume_" + i).val() != '' ? $("#payment_dt_volume_" + i).val() : 0);
            var convertion = currencyToNumber($("#payment_dt_convertion_" + i).val() != '' ? $("#payment_dt_convertion_" + i).val() : 0);
            if($("#payment_dt_price_" + i).val()) {
                var price = currencyToNumber($("#payment_dt_price_" + i).val() != '' ? $("#payment_dt_price_" + i).val() : 0);
                if(convertion == 0) {
                    var count = numberToCurrency((volume * 1) * price);
                } else {
                    var count = numberToCurrency((volume * convertion) * price);
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
        $("#payment_total").val(numberToCurrency(total));
    }
    
    function total() {
        for (var length = $(".row_out").length, total = parseInt(0), e = 1; e <= length; e++) {
            var sub_total = currencyToNumber($("#transaction_total_" + e).val() ? $("#transaction_total_" + e).val() : 0);
            total = total + sub_total;
        }
        
        var bruto = total * (10/100);
        var netto = total - bruto;
        
        $("#payment_total").val(numberToCurrency(total));
        $("#payment_bruto").val(numberToCurrency(bruto));
        $("#payment_netto").val(numberToCurrency(netto));
    }

    function cut(el, i) {
        var rowx = $('.row_out').length;
        $(".note_row_"+i).remove();
        for (var a = i; a < rowx; a++) {
            var rz = a + 1;
            $("#nom_" + rz).html(a);
            $("#nom_" + rz).attr('class', "nom_" + a);
            $("#nom_" + rz).attr('id', "nom_" + a);
            $("#payment_" + rz).attr('onchange', "get_unit(" + a + ")");
            $("#payment_" + rz).attr('id', "material_" + a);
            //            $("#payment_dt_unit_" + rz).attr('id', "payment_dt_unit_" + a);
            //            $("#payment_dt_note_" + rz).attr('id', "payment_dt_note_" + a);
            $(".note_row_" + rz).attr('class', "note_row_" + a);
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
        
        //        get_count();
        total();
    }

    $("#form").submit(function() {
        var err = 0;
        if (err > 0) {
            return false;
        }
        if ($("select[name=project] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Project tidak boleh kosong");
            $("select[name=project]").focus();
            return false;
        }
        if ($("input[name=payment_number]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Nomor Invoice tidak boleh kosong");
            $("input[name=payment_number]").focus();
            return false;
        }
        if ($("input[name=payment_date_dpt]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Tanggal proyek tidak boleh kosong");
            $("input[name=payment_date_dpt]").focus();
            return false;
        }
        if ($("input[name=payment_date_due]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Tanggal jatuh tempo tidak boleh kosong");
            $("input[name=payment_date_due]").focus();
            return false;
        }
        if ($("input[name=payment_date_pry]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Tanggal proyek tidak boleh kosong");
            $("input[name=payment_date_pry]").focus();
            return false;
        }
        if ($("input[name=payment_age]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Umur tidak boleh kosong");
            $("input[name=payment_age]").focus();
            return false;
        }
        if ($("input[name=payment_tax_serial]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Nomor faktur tidak boleh kosong");
            $("input[name=payment_age]").focus();
            return false;
        }
        if ($("select[name=actor] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Supplier tidak boleh kosong");
            $("select[name=actor]").focus();
            return false;
        }
        
        if($("#transaction_1 option:selected").val() ==''){
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Belum ada barang/material yang diinputkan");
            return false;
        }
        var jmlTransM = $('.row_out').length;
        for (var e = 1; e <= jmlTransM; e++) {
            var mog = $("#transaction_" + e + " option:selected").val();
            if (mog == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>BAPP tidak boleh kosong");
                return false;
            }
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
                    $(".saving").html(json.msg_dt);
                    $('input').removeAttr('readonly', 'readonly');
                    $('select').removeAttr('readonly', 'readonly');
                    $('textarea').removeAttr('readonly', 'readonly');
                    $(".loadertabo1").hide();
                } else if (json.status == 1) {
                    $(".load_main_data").load("<?php echo base_url() . $url_access . 'form'; ?>");
                }
            }
        });
        return false;
    });
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
