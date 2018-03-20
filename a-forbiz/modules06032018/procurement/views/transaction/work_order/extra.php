<div class="panel-body">
    <div class="row">
        <div class="loadertab col-sm-12"><?php echo $this->session->flashdata('message') ?></div>
    </div>
    <?php echo form_open_multipart(isset($wo) ? "procurement/work-order/save/" . md5($wo->work_order_id) : "procurement/work-order/save", array('id' => 'formFn')); ?>
    <div class="row">
        <div>
            <div class="col-sm-7 col-xs-12">
                <div class="form-group">
                    <label>PROJECT</label>
                    <div class=" mg-b-sm">
                        <select name="project" onchange="getProData()" class="form-control" disabled>
                            <?php foreach ($project as $pro) : ?>
                                <option value="<?php echo $pro->project_id; ?>" <?php if (isset($wo) && $pro->project_id == $wo->project_id) echo "selected"; ?> <?php if ($pro->project_id == set_value('project')) echo "selected"; ?>><?php echo ucwords($pro->project_name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 hidden-xs">
                <div class="form-group">
                    <label>PROJECT CODE</label>
                    <div class="input-group mg-b-md">
                        <span class="input-group-addon"><i class="fa fa-gavel"></i></span>
                        <input type="text" name="project_code" value="<?php echo isset($wo) ? $wo->project_code : NULL; ?>" class="proCode form-control" placeholder="Project Code" disabled>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>SUBCON</label>
                    <div class="input-group mg-b-sm">
                        <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                        <input type="text" name="actor_name" value="<?php echo isset($wo) ? $wo->actor_name : null; ?>" class="form-control" placeholder="Work Subcon" disabled>
                        <?php if (isset($wo)) { ?>
                            <input type="hidden" name="actor_id" value="<?php echo isset($wo) ? $wo->actor_id : null; ?>">
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div class="form-group">
                    <label>SUBCON NPWP</label>
                    <div class="mg-b-sm">
                        <input type="text" name="actor_identity" value="<?php echo isset($wo) ? $wo->actor_identity : null; ?>" class="form-control" placeholder="NPWP Subcon" disabled>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div class="form-group">
                    <label>SUBCON PHONE</label>
                    <div class="input-group mg-b-sm">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="text" name="actor_phone" value="<?php echo isset($wo) ? $wo->actor_phone : null; ?>" class="form-control" placeholder="Subcon Phone" disabled>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <label>NO. CONTRACT</label>
                    <div class="input-group mg-b-sm">
                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        <input type="text" name="contract_num" value="<?php echo isset($wo) ? $wo->work_order_number : null; ?>" class="form-control" placeholder="Contract Number" disabled>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <label>CONTRACT VALUE</label>
                    <div class="input-group mg-b-sm">
                        <span class="input-group-addon">Rp</span>
                        <input type="text" name="contract" onkeyup="format_number(this)" value="<?php echo isset($wo) ? rupiah($wo->work_order_contract) : null; ?>" class="form-control" placeholder="Contract" disabled>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-xs-6">
                <div class="form-group">
                    <label>DP</label>
                    <div class="input-group mg-b-sm">
                        <input type="text" name="dp" onkeyup="format_number(this)" value="<?php echo isset($wo) ? $wo->work_order_dp : null; ?>" class="form-control" placeholder="DP" disabled>
                        <span class="input-group-addon">%</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-xs-6">
                <div class="form-group">
                    <label>RETENSI</label>
                    <div class="input-group mg-b-sm">
                        <input type="text" name="retensi" onkeyup="format_number(this)" value="<?php echo isset($wo) ? $wo->work_order_retensi : 5; ?>" class="form-control" placeholder="Retensi" disabled>
                        <span class="input-group-addon">%</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xs-12 mg-b-sm">
                <div class="form-group">
                    <label>WO DESCRIPTION</label>
                    <textarea class="form-control" name="wo_desc" placeholder="Work Order Description" disabled><?php echo isset($wo) ? ucwords($wo->work_order_desc) : NULL; ?></textarea>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>EXTRA WO</label>
                    <div class="input-group mg-b-sm">
                        <span class="input-group-addon">Rp</span>
                        <input type="text " <?php echo $permit->access_update == 0 ? "disabled" : null ?> name="extra" onkeyup="format_num(this)" value="<?php echo isset($wo) ? $wo->work_order_extra : null; ?>" class="form-control" placeholder="Extra work" <?php echo isset($wo) ? !empty($wo->work_order_extra) ? "disabled" : null  : null; ?>>
                        <input type="hidden" name="ex_mode" value="1"/>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-xs-6">
                <div class="form-group">
                    <label>STATUS EXTRA</label>
                    <div class="btn-group btn-group-justified">
                        <a role="button" onclick="extraStatus('1')" id="est_1" class="btn btn-sm <?php echo isset($wo) ? $wo->work_order_extra_mode == 1 ? "btn-default" : "btn-default"  : null; ?>" disabled><i class="fa fa-plus"></i></a>
                        <a role="button" onclick="extraStatus('2')" id="est_2" class="btn btn-sm <?php echo isset($wo) ? $wo->work_order_extra_mode == 1 ? "btn-dark" : "btn-default"  : null; ?>" <?php echo isset($wo) ? isset($wo->work_order_extra_mode) ? "disabled" : null  : null; ?>><i class="fa fa-minus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($permit->access_update == 1) { ?>
        <?php if (!empty($wo)) { ?>
            <?php if (empty($wo->work_order_extra)) { ?>
                <hr/>
                <div class="row">
                    <div class="col-xs-6 hidden-xs"></div>
                    <div class="col-sm-6 col-xs-12">
                        <button type="submit" class="btn btn-primary col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".modal-title").html('<a role="button" onclick="backFn()" class="pull-left btn btn-sm btn-danger" style="margin-top:-5px"><i class="fa fa-reply"></i></a><i class="fa fa-th-large mg-r-md"></i>Work Order Detail');
    });
    function extraStatus(sts) {
        if (sts == 2) {
            $("#est_1").removeAttr("disabled", "disabled");
            $("#est_2").attr("disabled", "disabled");
            $("input[name=ex_mode]").val("2");
        } else {
            $("#est_2").removeAttr("disabled", "disabled");
            $("#est_1").attr("disabled", "disabled");
            $("input[name=ex_mode]").val("1");
        }

    }
    function backFn() {
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-contents").html("");
        $("#modal-contents").load("<?php echo base_url($this->uri->segment(1)) ?>/wo-progress");
    }
    function format_number(a) {
        a.value = numberToCurrency(a.value);
        if (currencyToNumber($("input[name=dp]").val()) > 100) {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> DP percentage should not be more than 100%");
            $("input[name=dp]").focus();
            $("input[name=dp]").val("");
            return false;
        }
        if ($("input[name=retensi]").val() > 5) {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> Retensi percentage should not be more than 100%");
            $("input[name=retensi]").focus();
            $("input[name=retensi]").val("");
            return false;
        }

    }

    $("#formFn").submit(function() {
        if ($("input[name=wo_extra").val() == '') {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Extra work can not be empty");
            $("input[name=wo_extra").focus();
            return false;
        }
        $.ajax({
            url: $("#formFn").attr('action'),
            data: $("#formFn").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function(json) {
                if (json.status == 0) {
                    $(".saving").html(json.msg);
                } else {
                    $("#modal-contents").html("");
                    $("#modal-contents").load("<?php echo base_url($this->uri->segment(1)) ?>/work-order/extra/" + json.id);
                }
            }
        });
        return false;
    });
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
