<div class="saving_ut"></div>
<section class="panel panel-info row">
    <header class="panel-heading lead">
        <i class='fa fa-plus mg-r-sm'></i> <?php echo $act; ?> Unit
    </header>
    <div class="panel-body">
        <?php echo form_open($url_access . "save_unit/", array('id' => 'form_ut')); ?>
        <?php if (!empty($material_unit_dt)) { ?>
            <input type="hidden" name="material_unit_id" value="<?php echo $material_unit_dt->material_unit_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Material Unit Name</label>
                    <input type="text" name="material_unit_name" value="<?php echo empty($material_unit_dt) ? set_value('material_unit_name') : strtoupper($material_unit_dt->material_unit_name); ?>" class="form-control" placeholder="Material Unit Name">
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="<?php echo!empty($material_unit_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
            <?php if (!empty($material_unit_dt)) { ?>
                <div class="<?php echo!empty($material_unit_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a href="#" class="cancel_u btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">    
<?php if ($permit->access_create == 0) { ?>
        $("#unitable").attr("class","col-sm-8");
        $("#unitform").attr("class","col-sm-4"); 
<?php } ?>
    $(".cancel_u").click(function() {
<?php if ($permit->access_create == 1) { ?>
            $("#unitform").load("<?php echo base_url() ?>warehouse/material/form/material_unit");
<?php } else { ?>
            $("#unitable").attr("class","col-sm-12");
            $("#unitform").attr("class","hidden");    
<?php } ?>
    });
    $(document).ready(function() {
        $("#form_ut").submit(function() {
            if ($("input[name=material_unit_name]").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Material unit can not empty");
                $("input[name=material_unit_name]").focus();
                return false;
            }
            $(".saving_ut").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
            $.ajax({
                url: $("#form_ut").attr('action'),
                data: $("#form_ut").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 0) {
                        $(".saving_ut").html(json.msg);
                    } else {
<?php if ($permit->access_create == 1) { ?>
                            $("#unitform").load("<?php echo base_url() ?>warehouse/material/form/material_unit");
                            $("#load_sub_form").load('<?php echo base_url() ?>warehouse/material/form/material_sub');
<?php } else { ?>
                            $("#unitform").attr("class","hidden");    
                            $("#unitable").attr("class","col-xs-12");    
<?php } ?>
                        $("#modal-contents").load('<?php echo base_url() ?>warehouse/material/table/material_unit');
                    }
                }
            });
            return false;
        });
    });

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>