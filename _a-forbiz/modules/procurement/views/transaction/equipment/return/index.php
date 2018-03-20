<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 load_main_data">
        <div class="saving_m"></div>
        <div class="row">
            <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('msg_success') ?></div>
        </div>
        <section class="panel panel-info row">
            <header class="panel-heading lead">
                <i class='fa fa-edit mg-r-sm'></i> Pengembalian Peralatan
            </header>
            <div class="panel-body">
                <?php echo form_open($url_action, array('id' => 'form')); ?>
                <input type="hidden" name="transaction_ct" value="1"/>
                <?php if (!empty($equip_trans_dt)) { ?>
                    <input type="hidden" name="equipment_transaction_id" value="<?php echo $equip_trans_dt->equipment_transaction_id; ?>"/>
                <?php } ?>
                <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
                <div class="row" style="margin-top: -20px">
                    <div class="col-sm-6 mg-b-md">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <div class="input-group input-append date datepicker" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control" name="start" value="<?php echo date('d-m-Y') ?>" onchange="get_data(this)" id="date">
                                    <span class="input-group-btn">
                                        <button class="btn btn-white add-on" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="form-group" id="equipment_trans">
                                <label>Data Peminjaman</label>
                                <select id="actor" name="actor" style="margin-top: 5px" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih data Peminjaman" required>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label class="col-xs-6 text-right">Petugas</label>
                                <div class="col-xs-6">
                                    <?php echo ucwords($sess['employee']->employee_name) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label class="col-xs-6 text-right">Posisi</label>
                                <div class="col-xs-6">
                                    <?php echo ucwords($sess['position']) ?>
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
                                        <th class="text-center hidden-xs" style="width: 40px; padding: 15px">No.</th>
                                        <th class="text-center" style="width: 200px; padding: 15px">Equipment</th>
                                        <th class="text-center" style="width: 100px; padding: 15px">Unit</th>
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
                                <input class="form-control" readonly type="text" name="equipment_transaction_total" id="equipment_transaction_total"/>
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
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("select.form-select2").select2();
        $(".datepicker").datepicker();
        get_data();
    });

    function get_data(el) {
        if (el) {
            var b = el.value;
        } else {
            var b = '<?php echo date('d-m-Y'); ?>';
        }

        $("#equipment_trans").load("<?php echo base_url() . $url_access . 'equipment_transaction/'; ?>" + b);
//        $("#order_name").val("");
//        $("#no_order").val("");
//        $("#menu_order_id").val("");
//        $("#meja_id").val("");
    }

    function get_detail(el) {
        $("#show_row").load("<?php echo base_url() . $url_access . 'transaction_detail/'; ?>" + el.value);
    }

    function get_count(a, i) {
        if (a && i) {
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
                    $(".load_main_data").load("<?php echo base_url() ?>warehouse/transaction/equipment/returned");
                }
            }
        });
        return false;
    });
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
