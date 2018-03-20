<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('msgTransM'); ?></div>
</div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-edit mg-r-sm'></i> Payments
    </header>
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'form')); ?>
        <?php if (!empty($payment_id)) { ?>
            <input type="hidden" name="payment_id" value="<?php echo $payment_id->payment_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group" style="margin: 10px 0;">
                            <label>Supplier</label>
                            <select id="actor" name="actor" onchange="get_invoice(this)" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Supplier">
                                <option value=""></option>
                                <?php foreach ($suplier as $s) : ?>
                                    <option value="<?php echo md5($s->actor_id); ?>" <?php if (isset($invoice_id) && $s->actor_id == $invoice->actor_id) echo "selected"; ?>><?php echo ucwords($s->actor_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12" id="select_invoice"></div>
                    <div class="col-xs-12">
                        <div class="form-group" style="margin: 10px 0;">
                            <label>Payment Status</label>
                            <select id="invoice_payment_status" name="invoice_payment_status" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Status">
                                <option value=""></option>
                                <option value="1" <?php
                                if (isset($invoice_id)) {
                                    echo $invoice->invoice_payment_status == 1 ? 'selected' : NULL;
                                }
                                ?>>Paid</option>
                                <option value="0" <?php
                                        if (isset($invoice_id)) {
                                            echo $invoice->invoice_payment_status == 0 ? 'selected' : NULL;
                                        }
                                ?>>Outstanding</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div id="detail_payment"></div>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-xs-12 mg-t-sm">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-xs-6 text-left">Payment Date</label>
                                <div class="col-xs-6">
                                    <?php echo indo_date(date('Y-m-d')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 mg-t-sm">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-xs-6 text-left">Operator</label>
                                <div class="col-xs-6">
                                    <?php echo ucwords($sess['employee']->employee_name); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 mg-t-sm">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-xs-6 text-left">Position</label>
                                <div class="col-xs-6">
                                    <?php echo ucwords($sess['users']->users_position_name) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="visible-xs" style="margin-top: 30px;"></div>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-6">
                <div class="row">
                    <?php if (!empty($payment_id)) { ?>
                        <div class="<?php echo!empty($payment_id) ? 'col-xs-6' : null ?>">
                            <a role="button" style="cursor: pointer" class="cancel_m btn btn-danger btn-block col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                        </div>
                    <?php } ?>
                    <div class="<?php echo!empty($payment_id) ? 'col-xs-6' : 'col-md-6 col-sm-12 col-xs-6' ?> pull-right">
                        <button type="submit" class="btn btn-primary btn-block col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
                    </div>
                </div>
            </div>

        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $(".datepicker").datepicker();
        $("select.form-select2").select2();
        $(".cancel_m").click(function () {
            $(".load_main_data").load("<?php echo base_url("$url/form") ?>");
        });

<?php if (isset($invoice_id)) { ?>
            $("#select_invoice").load("<?php echo base_url("$url/get-invoice/" . md5($invoice->actor_id)) . '/' . $invoice_id; ?>");
            $("#detail_payment").load("<?php echo base_url("$url/invoice/$invoice_id"); ?>");
<?php } ?>

    });

    function get_invoice(a) {
        $("#select_invoice").load("<?php echo base_url("$url") . '/get-invoice/'; ?>" + a.value);
    }

    function get_invoice_payment(a) {
        $("#detail_payment").load("<?php echo base_url($url) . "/invoice/"; ?>" + a.value);
    }

    $("#form").submit(function () {
        var err = 0;
        if (err > 0) {
            return false;
        }
        if ($("select[name=invoice] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Invoice cannot empty");
            $("select[name=project]").focus();
            return false;
        }
        if ($("select[name=invoice_payment_status] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Project cannot empty");
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
            success: function (json) {
                if (json.status == 0) {
                    $(".saving").html(json.msg_dt);
                    $('input').removeAttr('readonly', 'readonly');
                    $('select').removeAttr('readonly', 'readonly');
                    $('textarea').removeAttr('readonly', 'readonly');
                    $(".loadertabo1").hide();
                } else if (json.status == 1) {
<?php if (empty($id)) { ?>
                        $(".load_main_data").load("<?php echo base_url("$url/form"); ?>");
<?php } else { ?>
                        window.location.href="<?php echo base_url($url); ?>";
<?php } ?>
                }
            }
        });
        return false;
    });
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
