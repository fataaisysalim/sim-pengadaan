<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="saving"></div>
<section class="panel panel-dark">
    <header class="panel-heading pd-sm"><i class='fa fa-credit-card mg-r-sm'></i> Pengembalian Equipment</header>
    <div class="panel-body">
        <?php echo form_open($url_access, array('id' => 'form')); ?>
        <?php if (isset($finance_id)) { ?>
            <input type="hidden" name="finance_id" id="finance_id" value="<?php echo $finance_id; ?>"/>
            <input type="hidden" name="finance_code" id="finance_id" value="<?php echo $finance_code; ?>"/>
        <?php } ?>
        <input type="hidden" name="menu_order_id" id="menu_order_id" value="<?php echo isset($row) ? md5($row->menu_order_id) : NULL; ?>"/>
        <input type="hidden" name="order_type" value="1"/>
        <div class="row mg-b-md">
            <div class="col-sm-6 paynow">
                <div class="form-group">
                    <label>Choose Order Date :</label>
                    <div class="col-sm-10">
                        <div class="input-group input-append date <?php echo empty($row) ? 'datepicker' : null; ?> row" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                            <input onchange="get_meja()" <?php echo isset($row) ? 'readonly' : null; ?> type="text" class="tanggal form-control tglPay" id="tanggal" name="tanggal" value="<?php echo isset($row) ? date('d-m-Y', strtotime($row->menu_order_date)) : date('d-m-Y'); ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-white add-on tglPay" type="button" disabled>
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 paynow">
                <div class="form-group">
                    <label>Show Data Order by :</label>
                    <div style="margin-top: 2px">
                        <div class="btn-group btn-group-justified">
                            <a role="button" class="eip btn btn-default" id="1" disabled><i class="fa fa-check text-dark mg-r-md"></i>Makan Ditempat</a>
                            <a role="button" class="taw btn btn-info" id="2">Take Away</a>
                        </div>

                        <script>
                            $(".taw").click(function() {
                                var getId = $(this).attr("id");
                                $(".eip").removeAttr("disabled", "disabled");
                                $(".eip").html("Makan Ditempat");
                                $(".eip").attr("class", "eip btn btn-info");
                                $(this).attr("disabled", "disabled");
                                $(this).html('<i class="fa fa-check text-dark mg-r-md"></i>Take Away');
                                $(this).attr("class", "taw btn btn-default");
                                var b = $("#tanggal").val();
                                $("input[name=order_type]").val(getId);
                                $(".form_mejas").load("<?php echo base_url(); ?>transaction/pay/table_no/" + b + "/null/" + getId);
                                $("#table_pay").html('<div class="table-responsive no-border"><table class="table table-bordered table-striped mg-t"><thead class="bg-dark" style="color: white"><tr><th class="text-center">No.</th><th class="text-center" style="min-width: 100px">Menu</th><th class="text-center" style="min-width: 100px">Harga</th><th class="text-center">Jumlah</th><th class="text-center" style="min-width: 100px">Total</th><th class="text-center">Status</th><th class="text-center" style="min-width: 60px"><i class="fa fa-gears"></i></th></tr></thead><tbody><tr><td colspan="7"><center><i class="fa fa-info-circle mg-r-sm"></i>Silahkan gunakan fitur diatas untuk mencari data order.</center></td></tr></tbody></table></div>');
                            });
                            $(".eip").click(function() {
                                var getId = $(this).attr("id");
                                $(".taw").removeAttr("disabled", "disabled");
                                $(".taw").html("Take Away");
                                $(".taw").attr("class", "taw btn btn-info");
                                $(this).attr("disabled", "disabled");
                                $(this).html('<i class="fa fa-check text-dark mg-r-md"></i>Makan Ditempat');
                                $(this).attr("class", "eip btn btn-default");
                                var b = $("#tanggal").val();
                                $("input[name=order_type]").val(getId);
                                $(".form_mejas").load("<?php echo base_url(); ?>transaction/pay/table_no/" + b + "/null/" + getId);
                                $("#table_pay").html('<div class="table-responsive no-border"><table class="table table-bordered table-striped mg-t"><thead class="bg-dark" style="color: white"><tr><th class="text-center">No.</th><th class="text-center" style="min-width: 100px">Menu</th><th class="text-center" style="min-width: 100px">Harga</th><th class="text-center">Jumlah</th><th class="text-center" style="min-width: 100px">Total</th><th class="text-center">Status</th><th class="text-center" style="min-width: 60px"><i class="fa fa-gears"></i></th></tr></thead><tbody><tr><td colspan="7"><center><i class="fa fa-info-circle mg-r-sm"></i>Silahkan gunakan fitur diatas untuk mencari data order.</center></td></tr></tbody></table></div>');
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Choose Order Data :</label>
                    <div class="col-sm-12 mg-b-md form_mejas"></div>
                </div>
            </div>
        </div>
        <div id='table_pay'>
            <div class="table-responsive no-border">
                <table class="table table-bordered table-striped mg-t">
                    <thead class="bg-dark" style="color: white">
                        <tr>
                            <th class="text-center" style="min-width: 50px">No.</th>
                            <th class="text-center" style="min-width: 160px">Menu</th>
                            <th class="text-center" style="min-width: 100px">Price</th>
                            <th class="text-center" style="min-width: 100px">Qty</th>
                            <th class="text-center" style="min-width: 100px">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7"><center><i class="fa fa-info-circle mg-r-sm"></i>Silahkan gunakan fitur diatas untuk mencari data order.</center></td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    function getTable() {
        var b = $("#no_meja option:selected").val();
        "" === b ? ($("#order_name").val(""), $("#no_order").val(""), $("#menu_order_id").val(""), $("#meja_id").val(""), $("#table_pay").html('<div class="table-responsive no-border"><table class="table table-bordered table-striped mg-t"><thead class="bg-dark" style="color: white"><tr><th class="text-center" style="min-width: 50px">No.</th><th class="text-center" style="min-width: 160px">Menu</th><th class="text-center" style="min-width: 100px">Harga</th><th class="text-center" style="min-width: 100px">Jumlah</th><th class="text-center" style="min-width: 100px">Total</th></tr></thead><tbody><tr><td colspan="5"><center><i class="fa fa-info-circle mg-r-sm"></i>Silahkan gunakan fitur diatas untuk mencari data order.</center></td></tr></tbody></table></div>')) :
                $.ajax({url: "<?php echo base_url('transaction/pay/auto_get_order'); ?>/" + b, dataType: "JSON", success: function(a) {
                        $("#order_name").val(a.menu_order_name);
                        $("#no_order").val(a.menu_order_number);
                        $("#menu_order_id").val(a.menu_order_id);
                        $("#meja_id").val(a.meja_id);
                        $("#table_pay").load("<?php echo base_url('transaction/pay/table_pay'); ?>/" + a.menu_order_id).show(function() {
                            $("#save").removeAttr("disabled");
                        });
                    }});
        $(".tglPay").removeAttr("disabled", "disabled");
        return !1;
    }
    ;
    function get_meja() {
        var b = $("#tanggal").val();
        $(".form_mejas").load("<?php echo base_url(); ?>transaction/pay/table_no/" + b + "/null");
        $("#order_name").val("");
        $("#no_order").val("");
        $("#menu_order_id").val("");
        $("#meja_id").val("");
        $("#table_pay").html('<div class="table-responsive no-border"><table class="table table-bordered table-striped mg-t"><thead class="bg-dark" style="color: white"><tr><th class="text-center" style="min-width: 50px">No.</th><th class="text-center" style="min-width: 160px">Menu</th><th class="text-center" style="min-width: 100px">Harga</th><th class="text-center" style="min-width: 100px">Jumlah</th><th class="text-center" style="min-width: 100px">Total</th></tr></thead><tbody><tr><td colspan="5"><center><i class="fa fa-info-circle mg-r-sm"></i>Silahkan gunakan fitur diatas untuk mencari data order.</center></td></tr></tbody></table></div>');
    }
    function cetak_bill() {
        for (var b = $(".row_out").length, a = 1; a <= b; a++) {
            var c = $(".dt_menu_" + a).val(), d = $("#qty_menu" + a).val();
            if ("" != c && "" == d) {
                return bootbox.alert("<i class='fa fa-info-circle mg-r-md'></i>Jumlah menu dipesan tidak boleh kosong", function(a) {
                }), $("#qty_menu" + a).focus(), !1;
            }
            if ("" == c && "" != d) {
                return bootbox.alert("<i class='fa fa-info-circle mg-r-md'></i>Menu dipesan tidak boleh kosong", function(a) {
                }), $(".dt_menu_" + a).focus(), !1;
            }
        }
        if ("" != $(".bayar").val()) {
            return bootbox.alert("<i class='fa fa-info-circle mg-r-md'></i>Anda memperbaharui data order, mohon jumlah bayar dapat dikosongi !<br/>Apabila ingin melakukan pembayaran silahkan pilih bayar...", function(a) {
            }), $(".bayar").focus(), !1;
        }
        $(".loadertab1").show();
        $("input").attr("readonly", "readonly");
        $("select").attr("readonly", "readonly");
        $("textarea").attr("readonly", "readonly");
        $.ajax({url: $("#form").attr("action"), data: $("#form").serialize(), type: "POST", dataType: "JSON", success: function(a) {
                0 == a.status ? ($(".saving").html(a.msg), $("input").removeAttr("readonly", "readonly"), $("select").removeAttr("readonly", "readonly"), $("textarea").removeAttr("readonly", "readonly"), $(".loadertab1").hide("slow")) : ($("#btn_add").attr("disabled"), id = a.menu_order_id, bootbox.confirm("<i class='fa fa-info-circle mg-r-md'></i>Data sudah diperbaharui. Tekan 'YES' untuk mencetak tagihan", function(a) {
                    1 == a ? (setInterval(window.location.replace("<?php echo base_url() ?>transaction/pay"), 3500), $.post("<?php echo base_url() ?>transaction/pay/cetak_tagihan/" + id, "json")) : setInterval(window.location.replace("<?php echo base_url() ?>transaction/pay"), 2E3);
                }));
            }});
        return !1;
    }
    ;
    $(document).ready(function() {
        $(".form_mejas").load("<?php echo base_url(); ?>transaction/pay/table_no/" + $("#tanggal").val() + "/<?php echo isset($row) ? md5($row->menu_order_id) : "null"; ?>/<?php echo isset($row) ? $row->order_type_id : 1; ?>");
<?php if (isset($row)) { ?>
    <?php if ($row->order_type_id == 2) { ?>
            $(".eip").removeAttr("disabled", "disabled");
            $(".eip").html("Makan Ditempat");
            $(".eip").attr("class", "eip btn btn-info");
            $(".taw").attr("disabled", "disabled");
            $(".taw").html('<i class="fa fa-check text-dark mg-r-md"></i>Take Away');
            $(".taw").attr("class", "taw btn btn-default");
            $("input[name=order_type]").val($(".taw").attr("id"));
<?php } ?>
            $("#table_pay").load("<?php echo base_url('transaction/pay/table_pay/' . md5($row->menu_order_id) . '/edit'); ?>").show();
<?php } ?>
        $(".datepicker").datepicker();
        $(".loadertab").hide();
        $("#form").submit(function() {
            var jml_row = $(".row_out").length;
            for (var a = 1; a <= jml_row; a++) {
                var menu = $('.dt_menu_' + a).val();
                var qty = $('#qty_menu' + a).val();

                if (menu != '' && qty == '') {
                    bootbox.alert("<i class='fa fa-info-circle mg-r-md'></i>Jumlah menu dipesan tidak boleh kosong", function(result) {
                    });
                    $("#qty_menu" + a).focus();
                    return false;
                }

                if (menu == '' && qty != '') {
                    bootbox.alert("<i class='fa fa-info-circle mg-r-md'></i>Menu dipesan tidak boleh kosong", function(result) {
                    });
                    $(".dt_menu_" + a).focus();
                    return false;
                }
            }

            if ($(".bayar").val() == "") {
                bootbox.alert("<i class='fa fa-info-circle mg-r-md'></i>Jumlah bayar tidak boleh kosong", function(result) {

                });
                $(".bayar").focus();
                return false;
            }

            $(".loadertab1").show();
            $('input').attr('readonly', 'readonly');
            $('select').attr('readonly', 'readonly');
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
                        $(".loadertab1").hide();
                    } else {
                        $("#btn_add").attr('disabled');
                        id = json.menu_order_id;
                        bootbox.confirm("<i class='fa fa-info-circle mg-r-md'></i>Data sudah tersimpan. <br/><center><h2>" + no_order(json.ids) + "</h2><br/>TOTAL : Rp " + numberToCurrency(json.final) + "<br/>JUMLAH BAYAR : Rp " + numberToCurrency(json.pay) + "<br/>KEMBALIAN : Rp " + numberToCurrency(json.pay_back) + "<br/><br/>Tekan 'YES' untuk mencetak nota</center>", function(result) {
                            if (result == true) {
                                setInterval(window.location.replace("<?php echo base_url() ?>transaction/pay"), 3500);
                                $.post("<?php echo base_url() ?>transaction/pay/cetak_pdf/" + id, "json");
                            } else {
                                setInterval(window.location.replace("<?php echo base_url() ?>transaction/pay"), 2000);
                            }
                        });
                    }
                }
            });
            return false;
        });
    });

</script>
