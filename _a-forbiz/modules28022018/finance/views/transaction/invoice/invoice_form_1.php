<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('msgTransM') ?></div>
</div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-edit mg-r-sm'></i> <?php echo $transaction_ct; ?>
    </header>
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'form')); ?>
        <?php if (isset($invoice_id)) { ?>
            <input type="hidden" name="invoice_id" value="<?php echo $invoice_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -10px">

            <div class="col-sm-6">
                <div class="row"> 
                    <div class="col-xs-12 mg-b-sm">
                        <p>Choose Invoice Mode : </p>
                        <div class="btn-group btn-group-justified" data-toggle="buttons">
                        <?php if(!isset($invoice_id)) { ?>
                            <label class="btn btn-success">
                                <input type="radio" name="invoice_resource_code" class="resource" value="1"/>
                                Material
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="invoice_resource_code" class="resource" value="2" />
                                Equipment
                            </label>
                            <label class="btn btn-warning">
                                <input type="radio" name="invoice_resource_code" class="resource" value="4" />
                                Subcon
                            </label>
                        <?php } else { ?>
                            <label class="btn btn-<?php if($invoice->invoice_resource_code == 1) echo 'success'; if($invoice->invoice_resource_code == 2) echo 'primary'; if($invoice->invoice_resource_code == 4) echo 'warning'; ?> active">
                                <input checked type="radio" name="invoice_resource_code" class="resource" value="<?php echo $invoice->invoice_resource_code; ?>"/>
                                <?php if($invoice->invoice_resource_code == 1) echo 'Material'; if($invoice->invoice_resource_code == 2) echo 'Equipment'; if($invoice->invoice_resource_code == 4) echo 'Subcon'; ?>
                            </label>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label>Project</label>
                            <select id="project" onchange="getProData()" name="project" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih Proyek">
                                <option value=""></option>
                                <?php foreach ($project as $pro) : ?>
                                    <option value="<?php echo $pro->project_id; ?>" <?php if (isset($invoice_id) && $pro->project_id == $invoice->project_id) echo "selected"; ?> <?php if ($pro->project_id == set_value('project')) echo "selected"; ?>><?php echo ucwords($pro->project_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Project Code</label>
                            <div class="input-group mg-b-md">
                                <span class="input-group-addon"><i class="fa fa-gavel"></i></span>
                                <input type="text" name="invoice_project_code" value="<?php echo isset($invoice_id) ? $invoice->project_code : NULL; ?>" class="proCode form-control" placeholder="Kode Project" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>No. Invoice</label>
                            <div class="input-group mg-b-md">
                                <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                <input type="text" name="invoice_number" value="<?php echo empty($invoice_id) ? set_value('invoice_number') : $invoice->invoice_number; ?>" class="form-control" placeholder="No. Invoice">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>No. Serial Tax</label>
                            <div class="input-group mg-b-md">
                                <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                <input type="text" name="invoice_tax_serial" value="<?php echo empty($invoice_id) ? set_value('invoice_tax_serial') : $invoice->invoice_tax_serial; ?>" class="form-control" placeholder="Serial Tax">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 mg-b-sm">
                        <div class="form-group">
                            <label id="actor_label">Supplier</label>
                            <div id="select_actor">
                                <select disabled id="actor" name="actor" onchange="getActData()" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Supplier/Subcon">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label id="actor_code_label">Supplier Code</label>
                            <div class="input-group mg-b-md">
                                <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                                <input type="text" class="codeAct form-control" value="<?php echo isset($invoice_id) ? $invoice->actor_code : NULL; ?>" placeholder="Supplier Code" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label>NPWP</label>
                            <input type="text" class="npwpAct form-control" value="<?php echo isset($invoice_id) ? $invoice->actor_identity : NULL; ?>" placeholder="NPWP Supplier" readonly/>
                        </div>
                    </div>
                </div>
                <!--
                <div class="row mg-b-md">
                    <div class="col-xs-12">
                        <div class="col-sm-6">
                            <label>Invoice Date</label>
                            <div class="input-group input-append date datepicker" data-date="" data-date-format="dd-mm-yyyy">
                                <input type="text" class="form-control" onkeydown="get_debt()" name="invoice_date_kwt" value="<?php echo isset($invoice_id) ? date('d-m-Y', strtotime($invoice->invoice_date_kwt)) : NULL; ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-white add-on" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>Project Date</label>
                            <div class="input-group input-append date datepicker" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                <input type="text" class="form-control" name="invoice_date_pry" value="<?php echo isset($invoice_id) ? date('d-m-Y', strtotime($invoice->invoice_date_pry)) : date('d-m-Y'); ?>" readonly>
                                <span class="input-group-btn">
                                    <button class="btn btn-white add-on" type="button" disabled>
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                

                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-12">
                            <label>Description</label>
                            <textarea style="height: 100px;" class="form-control" name="invoice_note">
                                <?php echo isset($invoice_id) ? $invoice->invoice_note : NULL; ?>
                            </textarea>
                        </div>
                    </div>
                </div>
                -->
            </div>

            <div class="col-sm-6">
                <div class="hidden-xs" style="margin-top: 40px;"></div>
                <div class="visible-xs" style="margin-top: 20px;"></div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table" style="width: 100%; border: none; margin-right: 5px; margin-left: 5px;">
                            <tr>
                                <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Invoice Date</b></td>
                                <td style="padding: 0 0 10px 0; border: none;" width="5%"><b> : </b></td>
                                <td style="padding: 0 0 10px 0; border: none;"><?php echo indo_date(date('Y-m-d')) ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; border: none;" width="30%"><b>Operator</b></td>
                                <td style="padding: 10px 0 10px 0; border: none;" width="5%"><b> : </b></td>
                                <td style="padding: 10px 0; border: none;"><?php echo ucwords($sess['employee']->employee_name) ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0 0 0; border: none;" width="30%"><b>Position</b></td>
                                <td style="padding: 10px 0 10px 0; border: none;" width="5%"><b> : </b></td>
                                <td style="padding: 10px 0 0 0; border: none;"><?php echo ucwords($sess['position']) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group"> 
                            <label style="margin: 0 5px;">Invoice Date</label>
                            <div class="input-group input-append date datepicker" data-date="" data-date-format="dd-mm-yyyy">
                                <input type="text" class="form-control" onkeydown="get_debt()" name="invoice_date_kwt" value="<?php echo isset($invoice_id) ? date('d-m-Y', strtotime($invoice->invoice_date_kwt)) : NULL; ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-white add-on" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label style="margin: 0 5px;">Project Date</label>
                            <div class="input-group input-append date datepicker" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                <input type="text" class="form-control" name="invoice_date_pry" value="<?php echo isset($invoice_id) ? date('d-m-Y', strtotime($invoice->invoice_date_pry)) : date('d-m-Y'); ?>" readonly>
                                <span class="input-group-btn">
                                    <button class="btn btn-white add-on" type="button" disabled>
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="clearfix" style="margin-bottom: 10px;"></div>

                <div class="row">
                    <div class="col-sm-12" style="margin-right: 5px; margin-left: 5px;">
                        <div class="form-group">
                        <label>Description</label>
                        <textarea style="height: 75px;" class="form-control" name="invoice_note"><?php echo isset($invoice_id) ? $invoice->invoice_note : NULL; ?></textarea>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <section class="panel">
            <div class="row_detail">

            </div>
        </section>
        <div class="row">
            <div class="col-lg-6">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label></label>
                        <div class="input-group mg-b-md">
                            <input disabled type="radio" name="invoice_ct" value="1" class="invoice_ct" <?php
                            if (isset($invoice_id)) : echo $invoice->invoice_ct_id == 1 ? 'checked' : NULL;
                            endif;
                            ?>> Pajak PKP
                            <input disabled type="radio" name="invoice_ct" value="2" class="invoice_ct" <?php
                                   if (isset($invoice_id)) : echo $invoice->invoice_ct_id == 2 ? 'checked' : NULL;
                                   endif;
                            ?>> Pajak Non PKP
                            <!--<input disabled type="radio" name="invoice_ct" value="3" class="invoice_ct" <?php
                                   if (isset($invoice_id)) : echo $invoice->invoice_ct_id == 3 ? 'checked' : NULL;
                                   endif;
                            ?>> Tidak Kena Pajak-->
                        </div>
                    </div>
                </div>
                <div class="col-xs-6" id="taxs">
                    <!--pajak-->
                </div>
            </div>
            <input class="form-control" type="hidden" style="font-weight: bold" name="work_order_dp" id="work_order_dp" value=""/>
            <input class="form-control" type="hidden" style="font-weight: bold" name="work_order_retensi" id="work_order_retensi" value=""/>
            <div class="col-lg-6 row_count">
                <table class="table">
                    <tr>
                        <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Total</b></td>
                        <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
                        <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
                            <input readonly class="form-control text-right" type="text" style="font-weight: bold" name="invoice_total" id="invoice_total" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Netto</b></td>
                        <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
                        <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
                            <input class="form-control text-right" onkeyup="netto_bruto(this)" type="text" style="font-weight: bold" name="invoice_netto" id="invoice_netto" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>PPN</b></td>
                        <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
                        <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
                            <input class="form-control text-right" type="text" style="font-weight: bold" name="ppn" id="ppn" value="" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Bruto</b></td>
                        <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
                        <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
                            <input readonly class="form-control text-right" type="text" style="font-weight: bold" name="invoice_bruto" id="invoice_bruto" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Reduce PPH</b></td>
                        <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
                        <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
                            <input class="form-control text-right" type="text" style="font-weight: bold" name="pph" id="pph" value="" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Total Invoice</b></td>
                        <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
                        <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
                            <input class="form-control text-right" type="text" style="font-weight: bold" name="total" id="total" value="" readonly/>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6" style="padding-top: 20px">
            </div>
            <div class="col-xs-12">
                <?php if (!empty($invoice_id)) { ?>
                    <div class="<?php echo!empty($invoice_id) ? 'col-xs-6' : null ?>">
                        <a role="button" style="cursor: pointer" class="cancel_m btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                    </div>
                <?php } ?>
                <div class="<?php echo!empty($invoice_id) ? 'col-xs-6' : 'col-md-6 col-sm-12 col-xs-6' ?> pull-right">
                    <button disabled type="submit" class="btn btn-primary col-xs-12" id="save"><i class="fa fa-check mg-r-sm"></i> Save</button>
                </div>
            </div>

        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        <?php if(isset($invoice_id)) : ?> 
            $("#select_actor").load("<?php echo base_url() . $url_access . 'get_select_actor/'; echo isset($invoice_id) ? $invoice->invoice_resource_code . '/' . md5($invoice->actor_id) : NULL; ?>");
            $("#taxs").load("<?php echo base_url() . $url_access . 'get_select_tax/'; ?>" + $("input[name=invoice_ct]:checked").val() + "/" + $("input[name=invoice_resource_code]:checked").val() + "/<?php echo isset($invoice_id) ? $invoice_id : NULL; ?>");
            $("#save").attr('disabled', false);
        <?php endif; ?>
        
        $(".datepicker").datepicker();
        $("select.form-select2").select2();
        
        if($("#actor").val() == '' || $("#project_id").val() == '') {
            $("#add_btn").attr('disabled', 'disabled');
            $(".invoice_ct").attr('disabled', 'disabled');
        } else {
            if($("input[name=invoice_resource_code]:checked").val() == 1) {
                adds_row();
            } else if($("input[name=invoice_resource_code]:checked").val() == 2) {
                adds_equipt();
            }
        }
        
        $(".cancel_m").click(function() {
            $(".mtform").load("<?php echo base_url() ?>warehouse/invoice/form/invoice");
        });
        
        $(".resource").change(function(){
            $('#show_row').html('');
            $('#taxs').html('');
            $('#invoice_netto').val('');
            $('#invoice_bruto').val('');
            $('#ppn').val('');
            $('#pph').val('');
            $('#total').val('');
            $("#add_btn").attr('disabled', 'disabled');
            if($("input[name=invoice_resource_code]:checked").val() == 1) {
                $("#form").attr('action', "<?php echo base_url() . $url_action; ?>");
                $("#actor_label").html('Suplier');
                $("#actor_code_label").html('Suplier Code');
                $("#transaction_name").html('BAPB');
            } else if($("input[name=invoice_resource_code]:checked").val() == 2) {
                $("#form").attr('action', "<?php echo base_url() . $url_action; ?>");
                $("#actor_label").html('Suplier');
                $("#actor_code_label").html('Suplier Code');
                $("#transaction_name").html('Alat');
            } else if($("input[name=invoice_resource_code]:checked").val() == 4) {
                $("#form").attr('action', "<?php echo base_url() . $url_access . 'save_subkon/'; ?>");
                $("#actor_label").html('Subkon');
                $("#actor_code_label").html('Subkon Code');
            } 
            $("#select_actor").load("<?php echo base_url() . $url_access . 'get_select_actor/' ?>" + $("input[name=invoice_resource_code]:checked").val());
        });
        
        $(".invoice_ct").change(function(){
            if($("input[name=invoice_ct]:checked").val() != 3) {
                $("#ppn").val('')
                $("#pph").val('')
                $("#invoice_bruto").val($("#invoice_netto").val());
                $("#total").val($("#invoice_bruto").val())
                $("#taxs").load("<?php echo base_url() . $url_access . 'get_select_tax/'; ?>" + $("input[name=invoice_ct]:checked").val() + "/" + $("input[name=invoice_resource_code]:checked").val());
            } else if($("input[name=invoice_ct]:checked").val() == 3) {
                $("#taxs").html("");
            }
            if($("#actor").val() != '' && $("#project_id").val() != '' && $("input[name=invoice_ct]:checked").val() != '') {
                $("#save").attr('disabled', false);
            }
        });
        
        $(".tax").change(function(){
            if($("input[name=invoice_ct]:checked").val() != '' && $("#invoice_netto").val() != '') {
            }
        });
    });
    
    function check() {
        if($("#actor").val() == '' || $("#project_id").val() == '') {
            $("#add_btn").attr('disabled', 'disabled');
            $(".invoice_ct").attr('disabled', 'disabled');
        } else {
            if($("input[name=invoice_resource_code]:checked").val() == 1) {
                adds_row();
            } else if($("input[name=invoice_resource_code]:checked").val() == 2) {
                adds_equipt();
            }
        }
    }
    
    function netto_bruto(a) {
        if(a){
            a.value = numberToCurrency(a.value);
            $("#invoice_bruto").val(a.value);
            $("#total").val(a.value);
        } else {
            $("#invoice_bruto").val($("#invoice_netto").val());
            $("#total").val($("#invoice_netto").val());
        
        }
        tax_count();
    }
    
    function tax(i) {
        if(i) {
            if($("#invoice_netto").val() != '') {
                var cuts = $("#tax_" + i).attr('cut');
                var netto = currencyToNumber($("#invoice_netto").val());
                var pph = $("#pph").val() ? currencyToNumber($("#pph").val()) : 0;
                if($("#tax_" + i).is(":checked") == true) {
                    if($("#tax_" + i).attr('data') == 'PPN') {
                        var nominal_ppn = (parseInt(cuts) / 100) * netto;
                        var bruto = numberToCurrency2(netto + nominal_ppn);
                        $("#ppn").val(numberToCurrency2(nominal_ppn));
                        $("#invoice_bruto").val(bruto);

                        $("#total").val(numberToCurrency2(currencyToNumber($("#invoice_bruto").val()) - pph));
                    } else {
                        var nominal = (cuts / 100) * netto;
                        var new_pph = parseFloat(nominal) + parseFloat(pph);
                        $("#pph").val(numberToCurrency2(new_pph));
                        $("#total").val(numberToCurrency2(currencyToNumber($("#invoice_bruto").val()) - new_pph));
                    }
                } else {
                    if($("#tax_" + i).attr('data') == 'PPN') {
                        var ppn = currencyToNumber($("#ppn").val());
                        var nominal_ppn = (parseInt(cuts) / 100) * netto;
                        var bruto = numberToCurrency2(currencyToNumber($("#invoice_bruto").val()) - nominal_ppn);
                        
                        $("#ppn").val(numberToCurrency2(ppn - nominal_ppn));
                        $("#invoice_bruto").val(bruto);

                        $("#total").val(numberToCurrency2(currencyToNumber($("#invoice_bruto").val()) - pph));
                    } else {
                        var nominal = (cuts / 100) * netto;
                        var new_pph = parseFloat(pph) - parseFloat(nominal);
                        
                        $("#pph").val(numberToCurrency2(new_pph));
                        $("#total").val(numberToCurrency2(currencyToNumber($("#invoice_bruto").val()) - new_pph));
                    }
                }
            }
        }
    }
    
    function tax_count() {
        var jml = $(".tax").length;
        var total_cuts = parseInt(0);
        
        for(var e = 1; e <= jml; e++) {
            if($("#tax_" + e).is(':checked')) {
                var cuts = $("#cuts_" + e).val();
                if($("#tax_" + e).attr('data') == 'PPN') {
                    if($("#invoice_netto").val() != '') {
                        var nominal_ppn = (parseInt(cuts) / 100) * currencyToNumber($("#invoice_netto").val());
                        var bruto = numberToCurrency2(currencyToNumber($("#invoice_netto").val()) + nominal_ppn);
                        $("#invoice_bruto").val(bruto);
                        $("#ppn").val(numberToCurrency2(nominal_ppn));
                    }
                } else {
                    var nominal = (parseFloat(cuts) / 100) * currencyToNumber($("#invoice_netto").val());
                    
                    var total_cuts = total_cuts + parseInt(nominal);
                }
                $("#pph").val(numberToCurrency2(total_cuts));
                $("#total").val(numberToCurrency2(currencyToNumber($("#invoice_bruto").val()) - total_cuts));
            } 
        }
    }
    
    function get_btn() {
        if($("#actor").val() != '' && $("#project").val() != '') {
            $("#add_btn").attr('disabled', false);
            $(".invoice_ct").attr('disabled', false);
            $('#show_row').html('');
            $('.row_detail').html('');
            if($("input[name=invoice_resource_code]:checked").val() == 1) {
                $(".row_detail").load("<?php echo base_url() . $url_access . 'show_row_detail/'; ?>" + $("input[name=invoice_resource_code]:checked").val() + "/" + $("#actor").val() + "/" + $("#project").val() + "<?php echo isset($invoice_id) ? '/' . md5($invoice->invoice_id) : NULL; ?>");
                $("#add_btn").attr("onclick", "adds_row()");
                adds_row();
            } else if($("input[name=invoice_resource_code]:checked").val() == 2) {
                $(".row_detail").load("<?php echo base_url() . $url_access . 'show_row_detail/'; ?>" + $("input[name=invoice_resource_code]:checked").val() + "/" + $("#actor").val() + "/" + $("#project").val() + "<?php echo isset($invoice_id) ? '/' . md5($invoice->invoice_id) : NULL; ?>");
                $("#add_btn").attr("onclick", "adds_equipt()");
                adds_equipt();
            } else if($("input[name=invoice_resource_code]:checked").val() == 4) {
                $(".row_detail").load("<?php echo base_url() . $url_access . 'show_row_detail/'; ?>" + $("input[name=invoice_resource_code]:checked").val() + "/" + $("#actor").val() + "/" + $("#project").val() + "<?php echo isset($invoice_id) ? '/' . md5($invoice->invoice_id) : NULL; ?>");
            }
            
            $(".row_count").load("<?php echo base_url() . $url_access . 'show_row_count/'; ?>" + $("input[name=invoice_resource_code]:checked").val() + "<?php echo isset($invoice_id) ? '/' . md5($invoice->invoice_id) : NULL; ?>");
        }
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
            + '<input type="hidden" name="transaction_dt_status[]" value="1" class="form-control">'
            + '<input type="hidden" id="transaction_total_' + counter + '" name="mog_total[]" value="" class="form-control">'
            + '<td colspan="1" id="transaction_select_' + counter + '"></td>'
            + '<td ></td>'
            + '<td rowspan="2" class="text-center"><button type="button" class="btn btn-danger" id="btn_' + counter + '" onclick="cut(this, ' + counter + ')"><i class="fa fa-times"></i></button></td>'
            + '</tr><tr class="note_row_' + counter + '">'
            + '<td class="hidden-xs" colspan="2">'
        //            + '<input type="text" id="invoice_dt_note_' + counter + '" name="invoice_dt_note[]" value="" class="form-control" placeholder="Keterangan">'
            + '<table>'
            + '<thead class="bg-dark" style="color: white">'
            + '<tr>'
            + '<th class="text-center hidden-xs" style="width: 30px; padding: 15px">No.</th>'
            + '<th class="text-center hidden-xs" style="width: 170px; padding: 15px">Material</th>'
            + '<th class="text-center hidden-xs" style="width: 30px; padding: 15px">Code</th>'
            + '<th class="text-center hidden-xs" style="width: 30px; padding: 15px">Unit</th>'
            + '<th class="text-center hidden-xs" style="width: 30px; padding: 15px">Convertion</th>'
            + '<th class="text-center hidden-xs" style="width: 30px; padding: 15px">Volume</th>'
            + '<th class="text-center hidden-xs" style="width: 130px; padding: 15px">Price</th>'
            + '<th class="text-center hidden-xs" style="width: 130px; padding: 15px">Subtotal</th>'
            + '</tr>'
            + '<tbody id="show_dt_'+ counter + '">'
            + '</tbody>'
            + '</thead>'
            + '</table>'
            + '</td></tr>';
        $('#show_row').append(baris);
        $('#transaction_select_' + counter).load("<?php echo base_url() . $url_access . 'get_select_transaction/' ?>" + counter + "/" + $("#actor").val() + "/" + $("#project").val() + "/" + $("input[name=invoice_resource_code]:checked").val());
    }
    
    function adds_equipt() {
        var counterss = $('.row_tam').length + 1;
        var counter = $('.row_out').length + 1;
        for (var a = counter; a >= counterss; a--) {
            var rz = a + 1;
            $(".nom_" + a).html(rz);
            $(".nom_" + a).attr('class', "nom_" + rz);
            $("#btn_" + a).attr('onclick', "cut(this, " + rz + ")");
            $("#btn_" + a).attr('id', "btn_" + rz);
        }

        var baris = '<tr class="row_out row_tam">'
            + '<td class="text-center hidden-xs"><p id="nom_' + counter + '">' + counter + '</p></td>'
            + '<input type="hidden" name="action[]" value="add" class="form-control">'
            + '<input type="hidden" name="transaction_dt_status[]" value="1" class="form-control">'
            + '<input type="hidden" id="transaction_total_' + counter + '" name="mog_total[]" value="" class="form-control">'
            + '<td colspan="1" id="select_equipment_' + counter + '"></td>'
            + '<td>'
            + '<input readonly type="text" id="debt_' + counter + '" name="debt[]" value="" class="form-control">'
            + '</td>'
            + '<td>'
            + '<input type="text" onkeyup="total_equipt(this)" name="invoice_dt_total[]" id="invoice_dt_total_' + counter + '" value="" class="form-control">'
            + '</td>'
            + '<td class="text-center"><button type="button" class="btn btn-danger" id="btn_' + counter + '" onclick="cut_e(this, ' + counter + ')"><i class="fa fa-times"></i></button></td>'
            + '</tr>';
        $('#show_row').append(baris);
        $('#select_equipment_' + counter).load("<?php echo base_url() . $url_access . 'get_select_equipment/' ?>" + counter + "/" + $("#actor").val() + "/" + $("#project").val() + "/" + $("input[name=invoice_resource_code]:checked").val());
    }

    function get_transaction_detail(a, i, resource) {
        $("#show_dt_" + i).load("<?php echo base_url() . $url_access . 'get_transaction_detail/'; ?>" + a.value + "/" + i + '/' + resource);
    }
    
    function getActData() {
        $.ajax({
            url: "<?php echo base_url('warehouse/supplier/getdata'); ?>/" + $('#actor').val(),
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $(".codeAct").attr('value', json.data.actor_code);
                    $(".npwpAct").attr('value', json.data.actor_identity);
                    
                    get_btn();
                }
            }
        });
        return false;
    }
    
    function get_detail(el) {
        $.ajax({
            url: "<?php echo base_url() . 'warehouse/transaction/material/get_invoice/'; ?>" + el.value,
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $("#formTransM").attr('action', "<?php echo base_url() . $url_action ?>" + el.value);
                    $("input[name=actor_name]").attr('value', json.invoice.actor_name);
                    $("input[name=actor]").attr('value', json.invoice.actor_id);
                    $("input[name=project]").attr('value', json.invoice.project_id);
                    $("input[name=project_name]").attr('value', json.invoice.project_name);
                    $("input[name=invoice_project_code]").attr('value', json.invoice.project_code);
                    $("input[name=invoice_number]").attr('value', json.invoice.invoice_number);
                    $("input[name=invoice_number_letter]").attr('value', json.invoice.invoice_number_letter);
                    $(".npwpAct").attr('value', json.invoice.actor_id);
                    $('#show_row').load("<?php echo base_url() . 'warehouse/transaction/material/get_invoice_detail/'; ?>" + el.value);
                }
            }
        });
        return false;
    }
    
    function getProData() {
        $.ajax({
            url: "<?php echo base_url('warehouse/project/getdata'); ?>/" + $('#project').val() + '/1/invoice',
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $(".proCode").attr('value', json.data.project_code);
                    //                    $("input[name=invoice_number]").attr('value', json.data.project_code + json.number);
                    //                    $("input[name=invoice_number]").attr('value', json.number);
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
            var volume = currencyToNumber($("#invoice_dt_volume_" + i).val() != '' ? $("#invoice_dt_volume_" + i).val() : 0);
            var convertion = currencyToNumber($("#invoice_dt_convertion_" + i).val() != '' ? $("#invoice_dt_convertion_" + i).val() : 0);
            if($("#invoice_dt_price_" + i).val()) {
                var price = currencyToNumber($("#invoice_dt_price_" + i).val() != '' ? $("#invoice_dt_price_" + i).val() : 0);
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
        $("#invoice_total").val(numberToCurrency(total));
        $("#invoice_netto").val(numberToCurrency(total));
    }
    
    function total() {
        for (var length = $(".row_out").length, total = parseInt(0), e = 1; e <= length; e++) {
            var sub_total = currencyToNumber($("#transaction_total_" + e).val() ? $("#transaction_total_" + e).val() : 0);
            total = total + sub_total;
        }
        
        $("#invoice_total").val(numberToCurrency(total));
        $("#invoice_netto").val(numberToCurrency(total));
        netto_bruto();
    }

    function cut(el, i) {
        var rowx = $('.row_out').length;
        $(".note_row_"+i).remove();
        for (var a = i; a < rowx; a++) {
            var rz = a + 1;
            $("#nom_" + rz).html(a);
            $("#nom_" + rz).attr('class', "nom_" + a);
            $("#nom_" + rz).attr('id', "nom_" + a);
            $("#transaction_total_" + rz).attr('id', "transaction_total_" + a);
            $("#transaction_select_" + rz).attr('id', "transaction_select_" + a);
            $("#transaction_" + rz).attr('id', "transaction_" + a);
            $(".note_row_" + rz).attr('class', "note_row_" + a);
            $("#show_dt_" + rz).attr('id', "show_dt_" + a);
            $("#total_sub_" + rz).attr('id', "total_sub_" + a);
            $("#btn_" + rz).attr('onclick', "cut(this, " + a + ")");
            $("#btn_" + rz).attr('id', "btn_" + a);
        }
        var parent = el.parentNode.parentNode;
        parent.parentNode.removeChild(parent);
        
        //        get_count();
        total();
    }
    
    function cut_e(el, i) {
        var rowx = $('.row_out').length;
        $(".note_row_"+i).remove();
        for (var a = i; a < rowx; a++) {
            var rz = a + 1;
            $("#nom_" + rz).html(a);
            $("#nom_" + rz).attr('class', "nom_" + a);
            $("#nom_" + rz).attr('id', "nom_" + a);
            $("#debt_" + rz).attr('id', "debt_" + a);
            $("#invoice_dt_total_" + rz).attr('id', "invoice_dt_total_" + a);
            $("#equipment_" + rz).attr('id', "equipment_" + a);
            $("#select_equipment_" + rz).attr('id', "select_equipment_" + a);
            $("#total_sub_" + rz).attr('id', "total_sub_" + a);
            $("#btn_" + rz).attr('onclick', "cut_e(this, " + a + ")");
            $("#btn_" + rz).attr('id', "btn_" + a);
        }
        var parent = el.parentNode.parentNode;
        parent.parentNode.removeChild(parent);
        
        //        get_count();
        total_equipt();
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
        if ($("input[name=invoice_number]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Nomor Invoice tidak boleh kosong");
            $("input[name=invoice_number]").focus();
            return false;
        }
        if ($("input[name=invoice_netto]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Netto tidak boleh kosong");
            $("input[name=invoice_netto]").focus();
            return false;
        }
        //        if ($("input[name=invoice_date_dpt]").val() == "") {
        //            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Tanggal proyek tidak boleh kosong");
        //            $("input[name=invoice_date_dpt]").focus();
        //            return false;
        //        }
        if ($("input[name=invoice_date_kwt]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Tanggal kwitansi tidak boleh kosong");
            $("input[name=invoice_date_kwt]").focus();
            return false;
        }
        
        if ($("input[name=invoice_date_pry]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Tanggal proyek tidak boleh kosong");
            $("input[name=invoice_date_pry]").focus();
            return false;
        }
        if ($("input[name=invoice_tax_serial]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Nomor faktur tidak boleh kosong");
            $("input[name=invoice_age]").focus();
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
        
        var min = parseFloat($("#invoice_wo_percent").val());
        <?php if(!isset($invoice_id)) { ?> 
        if(min) {
            if (min > currencyToNumber($("#percent_netto").val())) {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Nilai progres tidak boleh kurang atau sama dengan progres sebelumnya. Nilai progres sebelumnya adalah " + min + "%");
                $("input[name=percent_netto]").focus();
                return false;
            }
            if (min == currencyToNumber($("#percent_netto").val())) {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Nilai progres tidak boleh kurang atau sama dengan progres sebelumnya. Nilai progres sebelumnya adalah " + min + "%");
                $("input[name=percent_netto]").focus();
                return false;
            }
        
        }
        <?php } ?>
        
        if($("#percent_netto").val()) {
            if (currencyToNumber($("#percent_netto").val()) > 100) {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Nilai progres tidak boleh lebih dari 100");
                $("input[name=percent_netto]").focus();
                return false;
            }
        }
        var jmlTransM = $('.row_out').length;
        for (var e = 1; e <= jmlTransM; e++) {
            if($("input[name=invoice_resource_code]:checked").val() == 1) {
                var mog = $("#transaction_" + e + " option:selected").val();
                if (mog == '') {
                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>BAPP tidak boleh kosong");
                    return false;
                }
            } else if ($("input[name=invoice_resource_code]:checked").val() == 2) { 
                var equ = $("#equipment_" + e + " option:selected").val();
                if (equ == '') {
                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Equipment tidak boleh kosong");
                    return false;
                } else {
                    var debt = currencyToNumber($("#debt_" + e).val());
                    var tagihan = currencyToNumber($("#invoice_dt_total_" + e).val());
                    if(tagihan > debt) {
                        bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Tagihan tidak boleh lebih dari sisa hutang. Sisa hutang adalah " + numberToCurrency(debt));
                        return false;
                    }
                }
            }
        }
                    
        $(".loadertabo1").show();
        $('input').attr('readonly', 'readonly');
        $('select').attr('readonly', 'disabled');
        $('textarea').attr('readonly', 'readonly');
        $('#save').attr('disabled', 'disabled');
        $.ajax({
            url: $("#form").attr('action'),
            data: $("#form").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function(json) {
                if (json.status == 0) {
                    $('#save').attr('disabled', false);
                    $(".saving").html(json.msg_dt);
                    $('input').removeAttr('readonly', 'readonly');
                    $('select').removeAttr('readonly', 'readonly');
                    $('textarea').removeAttr('readonly', 'readonly');
                    $(".loadertabo1").hide();
                    bootbox.alert(json.msg);
                } else if (json.status == 1) {
                    <?php if ($sess['position_id'] == 4 || $sess['position_id'] == 1) { ?>
                        window.open("<?php echo base_url() ?>warehouse/invoice/bapb/" + json.id);
                    <?php } elseif ($sess['position_id'] == 5) { ?>
                        window.open("<?php echo base_url() ?>warehouse/invoice/bapb_pengadaan/" + json.id);    
                    <?php } ?>
                    $(".load_main_data").load("<?php echo base_url() . $url_access . 'form'; ?>");
                }
            }
        });
        return false;
    });
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
