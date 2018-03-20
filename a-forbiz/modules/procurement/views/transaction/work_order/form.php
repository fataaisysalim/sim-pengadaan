<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-edit mg-r-sm'></i> <?php echo $header; ?>
    </header>
    <div class="panel-body">
        <?php echo form_open_multipart(isset($wo) ? "procurement/work-order/save/" . md5($wo->work_order_id) : "procurement/work-order/save", array('id' => 'formSc')); ?>
        <div class="row" style="margin-top: -20px">
            <div>
                <div class="col-xs-7">
                    <div class="form-group">
                        <label>Project</label>
                        <select name="project" onchange="getProData()" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Project">
                            <?php foreach ($project as $pro) : ?>
                                <option value="<?php echo $pro->project_id; ?>" <?php if (isset($wo) && $pro->project_id == $wo->project_id) echo "selected"; ?> <?php if ($pro->project_id == set_value('project')) echo "selected"; ?>><?php echo ucwords($pro->project_name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="form-group">
                        <label>Project Code</label>
                        <div class="input-group mg-b-md">
                            <span class="input-group-addon"><i class="fa fa-gavel"></i></span>
                            <input type="text" name="project_code" value="<?php echo isset($wo) ? $wo->project_code : NULL; ?>" class="proCode form-control" placeholder="Project Code" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="input-group mg-b-sm">
                            <a disabled id="btn_choose" onclick="input_actor(1)" class="btn btn-primary">Choose Subcon</a>
                            &nbsp;
                            <a id="btn_add" onclick="input_actor(2)" class="btn btn-success">Add New Subcon</a>
                            <input type="hidden" name="actor_input" value="1">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" id="choose">
                    <div class="form-group">
                        <label>Work Subcon</label>
                        <div class="input-group mg-b-sm">
                            <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                            <select class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Subcon" name="actor">
                                <option></option>
                                <?php foreach ($actor as $a) { ?>
                                    <option value="<?php echo $a->actor_id; ?>" <?php if (isset($wo)) : echo $wo->actor_id == $a->actor_id ? 'selected' : '';
                                endif; ?>><?php echo $a->actor_name; ?></option>
<?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" id="addnew" style="display: none;">
                    <div class="form-group">
                        <label>Work Subcon</label>
                        <div class="input-group mg-b-sm">
                            <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                            <input type="text" name="actor_name" value="<?php echo isset($wo) ? $wo->actor_name : null; ?>" class="form-control" placeholder="Work Subcon">
                            <?php if (isset($wo)) { ?>
                                <input type="hidden" name="actor_id" value="<?php echo isset($wo) ? $wo->actor_id : null; ?>">
<?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6" id="npwp" style="display: none;">
                    <div class="form-group">
                        <label>Subcon NPWP</label>
                        <div class="input-group mg-b-sm">
                            <input type="text" name="actor_identity" value="<?php echo isset($wo) ? $wo->actor_identity : null; ?>" class="form-control" placeholder="NPWP Subcon">
                        </div>
                    </div>
                </div>
                <div class="col-xs-6" id="phone" style="display: none;">
                    <div class="form-group">
                        <label>Subcon Phone</label>
                        <div class="input-group mg-b-sm">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="text" name="actor_phone" value="<?php echo isset($wo) ? $wo->actor_phone : null; ?>" class="form-control" placeholder="Subcon Phone">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" id="address" style="display: none;">
                    <div class="form-group">
                        <label>Subcon Address</label>
                        <textarea class="form-control" name="actor_address" placeholder="Subcon Address"><?php echo isset($wo) ? $wo->actor_address : NULL; ?></textarea>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label>Contract Number</label>
                        <div class="input-group mg-b-sm">
                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                            <input type="text" name="contract_num" value="<?php echo isset($wo) ? $wo->work_order_number : null; ?>" class="form-control" placeholder="Contract Number">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 mg-b-sm">
                    <div class="form-group">
                        <label>Work Order Description</label>
                        <textarea class="form-control" name="wo_desc" placeholder="Work Order Description"><?php echo isset($wo) ? $wo->work_order_desc : NULL; ?></textarea>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label>Contract Value</label>
                        <div class="input-group mg-b-sm">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" name="contract" onkeyup="format_number(this)" value="<?php echo isset($wo) ? rupiah($wo->work_order_contract) : null; ?>" class="form-control" placeholder="Contract">
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>DP Percentage</label>
                        <div class="input-group mg-b-sm">
                            <input type="text" name="dp" onkeyup="format_number(this)" value="<?php echo isset($wo) ? $wo->work_order_dp : null; ?>" class="form-control" placeholder="DP">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Retensi Percentage</label>
                        <div class="input-group mg-b-sm">
                            <input type="text" name="retensi" onkeyup="format_number(this)" value="<?php echo isset($wo) ? $wo->work_order_retensi : 5; ?>" class="form-control" placeholder="Retensi" readonly>
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-xs-12">
<?php if (!empty($wo)) { ?>
                    <div class="<?php echo!empty($wo) ? 'col-xs-6' : null ?>">
                        <a role="button" style="cursor: pointer" class="cancelWO btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                    </div>
<?php } ?>
                <div class="<?php echo!empty($wo) ? 'col-xs-6' : 'col-md-6 col-sm-12 col-xs-6' ?> pull-right">
                    <button type="submit" class="btn btn-primary col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
                </div>
            </div>

        </div>
<?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $("select.form-select2").select2();
        $.ajax({
            url: "<?php echo base_url('dashboard/project/getdata'); ?>/" + $('select[name=project] option:selected').val() + '/1',
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $(".proCode").attr('value', json.data.project_code);
                }
            }
        });
    });
    $(".cancelWO").click(function(){
        $(".load_main_form").load("<?php echo base_url() ?>procurement/work-order/form");
    });
    function format_number(a) {
        a.value = numberToCurrency(a.value);
        if (currencyToNumber($("input[name=dp]").val()) > 100) {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> DP percentage should not more than 100%");
            $("input[name=dp]").focus();
            $("input[name=dp]").val("");
            return false;
        }
        if ($("input[name=retensi]").val() > 5) {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> Retensi percentage should not more than 100%");
            $("input[name=retensi]").focus();
            $("input[name=retensi]").val("");
            return false;
        }
        
    }
    function getProData() {
        $.ajax({
            url: "<?php echo base_url('procurement/work-order/project'); ?>/" + $('select[name=project] option:selected').val() + '/1',
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $(".proCode").attr('value', json.data.project_code);
                }
            }
        });
        return false;
    }

    $("#formSc").submit(function() {
        var err = 0;
        if (err > 0) {
            return false;
        }
        if ($("select[name=project] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Project can not empty");
            $("select[name=project]").focus();
            return false;
        }
        if($("input[name=actor_input]").val() == 2) {
            if ($("input[name=actor_name").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Subcon Name can not empty");
                $("input[name=actor_name").focus();
                return false;
            }
            if ($("input[name=actor_identity").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Subcon NPWP can not empty");
                $("input[name=actor_identity").focus();
                return false;
            }
            if ($("input[name=actor_address").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Subcon Address can not empty");
                $("input[name=actor_address").focus();
                return false;
            }
            if ($("input[name=actor_phone").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Subcon Phone can not empty");
                $("input[name=actor_phone").focus();
                return false;
            }
        }
        if ($("input[name=contract]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Contract number can not empty");
            $("input[name=contract_num]").focus();
            return false;
        }
        if ($("input[name=work_desc]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Work Description should not empty");
            $("input[name=work_desc]").focus();
            return false;
        }
        if ($("select[name=contract_value] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Contract Value can not empty");
            $("select[name=contract_value]").focus();
            return false;
        }
        if ($("input[name=dp]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>DP Percentage should not empty");
            $("input[name=dp]").focus();
            return false;
        }
        $("input").attr("readonly","readonly");
        $("textarea").attr("readonly","readonly");
        $("select").attr("readonly","readonly");
        $(".saving").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
        $.ajax({
            url: $("#formSc").attr('action'),
            data: $("#formSc").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function (json) {
                if (json.status == 0) {
                    $(".saving").html(json.msg);
                } else {
                    $(".load_main_form").load("<?php echo base_url() ?>procurement/work-order/form");
                    $(".load_main_data").load('<?php echo base_url() ?>procurement/work-order/table/'+$('input[name=start]').val()+"/"+$('input[name=end]').val()+"/"+$('select[name=projectm] option:selected').val());
                }
                $("input").removeAttr("readonly","readonly");
                $("textarea").removeAttr("readonly","readonly");
                $("select").removeAttr("readonly","readonly");
            }
        });
        return false;
    });
    
    function input_actor(st) {
        if(st == 1) {
            $("#btn_choose").attr('disabled', 'disabled');
            $("#btn_add").attr('disabled', false);
            $("#choose").attr('style', 'display: block');
            $("#addnew").attr('style', 'display: none');
            $("#npwp").attr('style', 'display: none');
            $("#phone").attr('style', 'display: none');
            $("#address").attr('style', 'display: none');
        }
        if(st == 2) {
            $("#btn_choose").attr('disabled', false);
            $("#btn_add").attr('disabled', 'disabled');
            $("#addnew").attr('style', 'display: block');
            $("#choose").attr('style', 'display: none');
            $("#npwp").attr('style', 'display: block');
            $("#phone").attr('style', 'display: block');
            $("#address").attr('style', 'display: block');
        }
        $("input[name=actor_input]").val(st);
    }
    
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
