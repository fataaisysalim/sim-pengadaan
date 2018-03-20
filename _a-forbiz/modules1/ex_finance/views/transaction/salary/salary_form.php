<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('msgTransM') ?></div>
</div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-edit mg-r-sm'></i> Foreman Fee
    </header>
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'form')); ?>
        <?php if (!empty($salary_id)) { ?>
            <input type="hidden" name="salary_id" value="<?php echo $salary_id->salary_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Foreman</label>
                            <select id="actor" onchange="" name="actor" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Foreman">
                                <option value=""></option>
                                <?php foreach ($actor as $act) : ?>
                                    <option value="<?php echo $act->actor_id; ?>" <?php if (isset($salary_id) && $act->actor_id == $salary_id->actor_id) echo "selected"; ?>><?php echo $act->actor_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Project</label>
                            <select id="project" onchange="" name="project" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Project">
                                <option value=""></option>
                                <?php foreach ($project as $p) : ?>
                                    <option value="<?php echo $p->project_id; ?>" <?php if (isset($salary_id) && $p->project_id == $salary_id->project_id) echo "selected"; ?>><?php echo $p->project_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group mg-t-sm">
                            <label>No. SP3</label>
                            <input type="text" name="salary_number" value="<?php echo isset($salary_id) ? $salary_id->salary_number : NULL; ?>" class="form-control" placeholder="No. SP3">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group mg-t-sm">
                            <label>Date</label>
                            <div class="input-group input-append date datepicker" data-date="" data-date-format="dd-mm-yyyy">
                                <input type="text" class="form-control start" name="salary_date" value="<?php echo isset($salary_id) ? date('d-m-Y', strtotime($salary_id->salary_date)) : NULL; ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-white add-on" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 mg-t-sm">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea style="height: 150px;" class="form-control" placeholder="Description" name="salary_note"><?php echo isset($salary_id) ? $salary_id->salary_note : NULL; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 mg-t-sm">
                        <div class="form-group">
                            <label>Fee</label>
                            <input onkeyup="get_pkp(this)" type="text" id="salary_pay" name="salary_pay" value="<?php echo isset($salary_id) ? rupiah($salary_id->salary_pay) : NULL; ?>" class="form-control" placeholder="Fee">
                        </div>
                    </div>
                    <div class="col-xs-6 mg-t-sm">
                        <div class="form-group">
                            <label>PKP</label>
                            <input <?php echo isset($salary_id) ? NULL : 'readonly'; ?> type="text" name="salary_pkp" id="salary_pkp" value="<?php echo isset($salary_id) ? rupiah($salary_id->salary_pkp) : NULL; ?>" class="form-control" placeholder="PKP">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 mg-t-lg">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <input type="radio" name="salary_ct" value="1" class="salary_ct" <?php if (isset($salary_id)) : echo $salary_id->salary_ct_id == 1 ? 'checked' : NULL; endif; ?> style="margin: 0 10px;"> Pajak PKP
                            <input type="radio" name="salary_ct" value="2" class="salary_ct" <?php if (isset($salary_id)) : echo $salary_id->salary_ct_id == 2 ? 'checked' : NULL; endif; ?> style="margin: 0 10px;"> Pajak Non PKP
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 mg-t-sm">
                        <div class="form-group" id="taxs">
                            <?php if (isset($salary_id) && $salary_id->salary_ct_id != 3) { ?>
                                <label>Tax</label>
                                <div class="input-group mg-b-md">
                                    <table>
                                        <?php foreach ($tax as $i => $t) { ?>
                                            <?php $ct = $i + 1; ?>
                                            <tr>
                                                <td>
                                                    <input <?php echo $t->child > 0 ? 'checked' : NULL; ?> onchange="tax(<?php echo $ct; ?>)" class="tax" id="tax_<?php echo $ct; ?>" type="checkbox" name="tax[]" value="<?php echo $t->tax_id; ?>" /> <?php echo $t->tax_name . ' ' . $t->tax_cuts . '%'; ?>
                                                    <input <?php echo $t->child > 0 ? 'checked' : NULL; ?> type="hidden" id="cuts_<?php echo $ct; ?>" value="<?php echo $t->tax_cuts; ?>" /> <?php echo $t->tax_name . ' ' . $t->tax_cuts . '%'; ?>
                                                </td>
                                            </tr>    
                                        <?php } ?>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-xs-12 mg-t-lg">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-xs-4 text-left">Date</label>
                                <div class="col-xs-8">
                                    <?php echo indo_date(date('Y-m-d')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 mg-t-lg">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-xs-4 text-left">Operator</label>
                                <div class="col-xs-8">
                                    <?php echo ucwords($sess['employee']->employee_name) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 mg-t-lg">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-xs-4 text-left">Position</label>
                                <div class="col-xs-8">
                                    <?php echo ucwords($sess['users']->users_position_name) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 mg-t-lg">
                        <table class="table" width="100%">
                            <tr>
                                <td style="border: none;"><b>Fee </b></td>
                                <td style="border: none;">&nbsp;</td>
                                <td style="border: none;"><input type="text" id="upah" value="<?php echo isset($salary_id) ? rupiah($salary_id->salary_pay) : NULL; ?>" class="form-control" readonly /></td>
                            </tr>
                            <tr><td style="border: none;">&nbsp;</td></tr>
                            <tr>
                                <td style="border: none;"><b>Reduction </b></td>
                                <td style="border: none;">&nbsp;</td>
                                <td style="border: none;"><input type="text" id="pajak" value="" class="form-control" readonly /></td>
                            </tr>
                            <tr><td style="border: none;">&nbsp;</td></tr>
                            <tr>
                                <td style="border: none;"><b>Total Paid </b></td>
                                <td style="border: none;">&nbsp;</td>
                                <td style="border: none;"><input type="text" name="salary_total_final" id="total" value="<?php echo isset($salary_id) ? rupiah($salary_id->salary_total_final) : NULL; ?>" class="form-control" readonly /></td>
                            </tr>
                        </table>
                        <hr class="divider"/>
                    </div>

                    <div class="col-xs-12">
                        <div class="row"> 
                            <?php if (!empty($salary_id)) { ?>
                                <div class="<?php echo!empty($salary_id) ? 'col-xs-6' : null ?>">
                                    <a role="button" style="cursor: pointer" class="cancel_m btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                                </div>
                            <?php } ?>
                            <div class="<?php echo!empty($salary_id) ? 'col-xs-6' : 'col-md-6 col-sm-12 col-xs-6' ?> pull-right">
                                <button disabled type="submit" id="save_btn" class="btn btn-primary btn-block"><i class="fa fa-check mg-r-sm"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        tax();
        get_btn();
        $(".datepicker").datepicker();
        $("select.form-select2").select2();

        $(".cancel_m").click(function () {
            $(".mtform").load("<?php echo base_url($url) ?>");
        });

        $(".resource").change(function () {
            $('#show_row').html('');
            $("#add_btn").attr('disabled', 'disabled');
            $("#select_actor").load("<?php echo base_url() . $url_access . 'get_select_actor/' ?>" + $("input[name=salary_resource_code]:checked").val());
        });

        $(".salary_ct").change(function () {
            if ($("input[name=salary_ct]:checked").val() != 3) {
                if ($("#salary_pay").val() != '') {
                    $("#upah").val($("#salary_pay").val());
                    $("#total").val($("#salary_pay").val());
                    $("#pajak").val(0);
                }
                $("#taxs").load("<?php echo base_url("$url/get-tax"); ?>/" + $("input[name=salary_ct]:checked").val());
            } else if ($("input[name=salary_ct]:checked").val() == 3) {
                $("#taxs").html("");
                $("#tax").attr("disabled", "disabled");
            }
            $("input[name=salary_pay]").attr('readonly', false);
        });
    });

    function get_btn() {
        if ($("#actor").val() != '' && $("#project").val() != '' && $("#salary_pay").val() != '') {
            $("#save_btn").attr('disabled', false);
        }
    }

    function getProData() {
        $.ajax({
            url: "<?php echo base_url('warehouse/project/getdata'); ?>/" + $('#project').val() + '/1/salary',
            dataType: "JSON",
            success: function (json) {
                if (json.status == 1) {
                    $(".proCode").attr('value', json.data.project_code);
                    //                    $("input[name=salary_number]").attr('value', json.data.project_code + json.number);
                    $("input[name=salary_number]").attr('value', json.number);
                    get_btn();
                }
            }
        });
        return false;
    }

    function get_pkp(a) {
        format_number(a);
        var pkp = currencyToNumber(a.value) * parseFloat(0.01);
        $("#salary_pkp").val(numberToCurrency(pkp));
        $("#upah").val(a.value);
        $("#pajak").val(0);
        $("#total").val(numberToCurrency(currencyToNumber(a.value) - $("#pajak").html()));
        tax();
        get_btn();
    }

    function format_number(a) {
        a.value = numberToCurrency(a.value);
    }

    function tax(i) {
        var jml = $(".tax").length;
        for (var e = 1; e <= jml; e++) {
            var cuts = $("#cuts_" + e).val();
            if ($("#tax_" + e).is(':checked') == true) {
                var salary = currencyToNumber($("#salary_pay").val());

                if (salary != '') {
                    var cut = (parseFloat(cuts) / 100) * currencyToNumber($("#salary_pkp").val());

                    $("#pajak").val(numberToCurrency(cut));
                    $("#total").val(numberToCurrency(salary - cut));
                }
            } else {
                var salary = currencyToNumber($("#salary_pay").val());
                var cut = (parseFloat(cuts) / 100) * currencyToNumber($("#salary_pkp").val());
                var pph = currencyToNumber($("#pajak").val());

                $("#pajak").val(numberToCurrency(pph - cut));
                $("#total").val(numberToCurrency(salary - (pph - cut)));
            }
        }
        get_btn();
    }

    $("#form").submit(function () {
        var err = 0;
        if (err > 0) {
            return false;
        }
        if ($("select[name=project] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Project tidak boleh kosong");
            $("select[name=project]").focus();
            return false;
        }
        if ($("select[name=actor] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Mandor tidak boleh kosong");
            $("select[name=actor]").focus();
            return false;
        }
        if ($("input[name=salary_number]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Nomor gaji tidak boleh kosong");
            $("input[name=salary_number]").focus();
            return false;
        }
        if ($("input[name=salary_date]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Tanggal penggajian tidak boleh kosong");
            $("input[name=salary_date]").focus();
            return false;
        }
        if ($("input[name=salary_evidence]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Nomor bukti tidak boleh kosong");
            $("input[name=salary_evidence]").focus();
            return false;
        }
        if ($("input[name=salary_pay]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Upah tidak boleh kosong");
            $("input[name=salary_pay]").focus();
            return false;
        }

        var jmlTax = $('.tax').length;
        //        if(jmlTax > 0) {
        //            for (var e = 1; e <= jmlTax; e++) {
        //                var tax = $("#tax_" + e + ":checked").val();
        //                var count = 0
        //                if (tax != '') {
        //                    count = count++
        //                }
        //                if(count == 0) {
        //                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Pajak tidak boleh kosong");
        //                    return false;
        //                }
        //            }
        //        }

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
                    window.open("<?php echo base_url() ?>finance/fee-receipt/" + json.id);
                    window.location.href="<?php echo base_url($url); ?>";
                }
            }
        });
        return false;
    });
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
