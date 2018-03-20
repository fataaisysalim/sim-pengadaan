<div class="saving_unit"></div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-plus mg-r-sm'></i> <?php echo $act . ' ' . $title; ?>
    </header>
    <div class="panel-body">
        <?php echo form_open_multipart($url_action, array('id' => 'form_unit')); ?>
        <?php if (!empty($equipment_unit_dt)) { ?>
            <input type="hidden" name="equipment_unit_id" value="<?php echo $equipment_unit_dt->equipment_unit_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Unit Name</label>
                    <input type="text" name="equipment_unit_name" value="<?php echo empty($equipment_unit_dt) ? set_value('equipment_unit_name') : $equipment_unit_dt->equipment_unit_name; ?>" class="form-control" placeholder="Equipment Unit">
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="<?php echo!empty($equipment_unit_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
            <?php if (!empty($equipment_unit_dt)) { ?>
                <div class="<?php echo!empty($equipment_unit_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a role="button" style="cursor: pointer" class="cancel_unit btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $("#utable").attr("class","col-sm-8");
        $("#uform").attr("class","col-sm-4");
        $(".cancel_unit").click(function() {
<?php if ($permit->access_create == 1) { ?>
                $("#uform").load("<?php echo base_url() ?>warehouse/equipment/unit/form/");
<?php } else { ?>
                $("#utable").attr("class","col-xs-12");
                $("#uform").attr("class","hidden");    
<?php } ?>
        });
        $("#form_unit").submit(function() {
            if ($("input[name=equipment_unit_name").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> Equipment Unit can not empty");
                $("input[name=equipment_unit_name").focus();
                return false;
            }

            $(".saving_unit").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
            $.ajax({
                url: $("#form_unit").attr('action'),
                data: $("#form_unit").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 0) {
                        $(".saving_unit").html(json.msg);
                    } else {
<?php if ($permit->access_create == 1) { ?>
                            $("#load_sub_form").load('<?php echo base_url() ?>warehouse/equipment/form');
<?php } ?>
                        $(".saving").html('');
                        $("#modal-contents").load('<?php echo base_url() ?>warehouse/equipment/unit');
                        
                    }
                }
            });
            return false;
        });
    });

</script>