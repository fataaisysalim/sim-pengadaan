<div class="panel-body">
    <div class="row">
        <div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Project</label>
                    <div class="input-group mg-b-md">
                        <span class="input-group-addon"><i class="fa fa-gavel"></i></span>
                        <input disabled type="text" name="project_code" value="<?php echo isset($wo) ? $wo->project_name : NULL; ?>" class="proCode form-control" placeholder="Project Code" readonly>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Work Subcon</label>
                    <div class="input-group mg-b-sm">
                        <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                        <input disabled type="text" name="actor_name" value="<?php echo isset($wo) ? $wo->actor_name : null; ?>" class="form-control" placeholder="Work Subcon">

                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Subcon NPWP</label>
                    <input disabled type="text" name="actor_identity" value="<?php echo isset($wo) ? $wo->actor_identity : null; ?>" class="form-control mg-b-sm" placeholder="NPWP Subcon">
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Subcon Phone</label>
                    <div class="input-group mg-b-sm">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input disabled type="text" name="actor_phone" value="<?php echo isset($wo) ? $wo->actor_phone : null; ?>" class="form-control" placeholder="Subcon Phone">
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Subcon Address</label>
                    <textarea  disabled class="form-control mg-b-sm" name="actor_address" placeholder="Subcon Address"><?php echo isset($wo) ? $wo->actor_address : NULL; ?></textarea>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Contract Number</label>
                    <div class="input-group mg-b-sm">
                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        <input disabled type="text" name="contract_num" value="<?php echo isset($wo) ? $wo->work_order_number : null; ?>" class="form-control" placeholder="Contract Number">
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Work Order Description</label>
                    <textarea disabled class="form-control mg-b-sm" name="wo_desc" placeholder="Work Order Description"><?php echo isset($wo) ? $wo->work_order_desc : NULL; ?></textarea>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Contract Value</label>
                    <div class="input-group mg-b-sm">
                        <span class="input-group-addon">Rp</span>
                        <input disabled type="text" name="contract" onkeyup="format_number(this)" value="<?php echo isset($wo) ? rupiah($wo->work_order_contract) : null; ?>" class="form-control" placeholder="Contract">
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label>DP</label>
                    <div class="input-group mg-b-sm">
                        <input disabled type="text" name="dp" onkeyup="format_number(this)" value="<?php echo isset($wo) ? $wo->work_order_dp : null; ?>" class="form-control" placeholder="DP">
                        <span class="input-group-addon">%</span>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Retensi</label>
                    <div class="input-group mg-b-sm">
                        <input disabled type="text" name="retensi" onkeyup="format_number(this)" value="<?php echo isset($wo) ? $wo->work_order_retensi : 5; ?>" class="form-control" placeholder="Retensi" readonly>
                        <span class="input-group-addon">%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-search mg-r-md"></i>Detail Work Order');
</script>