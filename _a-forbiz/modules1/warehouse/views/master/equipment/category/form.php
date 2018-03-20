<div class="saving_ct"></div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-plus mg-r-sm'></i> <?php echo $act; ?>
    </header>
    <div class="panel-body">
        <?php echo form_open_multipart($url_action, array('id' => 'form_ct')); ?>
        <?php if (!empty($equipment_ct_dt)) { ?>
            <input type="hidden" name="equipment_ct_id" value="<?php echo $equipment_ct_dt->equipment_ct_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="equipment_ct_name" value="<?php echo empty($equipment_ct_dt) ? set_value('equipment_ct_name') : $equipment_ct_dt->equipment_ct_name; ?>" class="form-control" placeholder="Equipment Category">
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="<?php echo!empty($equipment_ct_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
            <?php if (!empty($equipment_ct_dt)) { ?>
                <div class="<?php echo!empty($equipment_ct_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a role="button" style="cursor: pointer" class="cancel_ct btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $("#ctable").attr("class","col-sm-8");
        $("#ctform").attr("class","col-sm-4");
        $(".cancel_ct").click(function() {
<?php if ($permit->access_create == 1) { ?>
                $("#ctform").load("<?php echo base_url() ?>warehouse/equipment/category/form/");
<?php } else { ?>
                $("#ctable").attr("class","col-xs-12");
                $("#ctform").attr("class","hidden");    
<?php } ?>
        });
        $("#form_ct").submit(function() {
            if ($("input[name=equipment_ct_name").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> Equipment Category Name can not empty");
                $("input[name=equipment_ct_name").focus();
                return false;
            }

            $(".saving_ct").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
            $.ajax({
                url: $("#form_ct").attr('action'),
                data: $("#form_ct").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 0) {
                        $(".saving_ct").html(json.msg);
                    } else {
<?php if ($permit->access_create == 1) { ?>
                            $("#load_sub_form").load('<?php echo base_url() ?>warehouse/equipment/form');
<?php } ?>
                        $(".saving").html('');
                        $("#modal-contents").load('<?php echo base_url() ?>warehouse/equipment/category/');
                        
                    }
                }
            });
            return false;
        });
    });

</script>