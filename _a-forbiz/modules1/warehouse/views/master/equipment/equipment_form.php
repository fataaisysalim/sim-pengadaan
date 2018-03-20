<div class="saving"></div>
<section class="panel panel-info">
    <header class="panel-heading lead"><i class='fa fa-plus mg-r-sm'></i> <?php echo $act . ' ' . $header; ?></header>
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'forms')); ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <?php if (!empty($equipment_dt)) { ?>
            <input type="hidden" name="equipment_id" value="<?php echo $equipment_dt->equipment_id ?>"/>
        <?php } ?>
        <div class="row" style="margin-top: -20px">
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>Equipment Name</label>
                    <input type="text" name="equipment_name" value="<?php echo empty($equipment_dt) ? set_value('equipment_name') : $equipment_dt->equipment_name; ?>" class="form-control" placeholder="Equipment Name">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>Equipment Type</label>
                    <input type="text" name="equipment_type" value="<?php echo empty($equipment_dt) ? set_value("equipment_type") : $equipment_dt->equipment_type; ?>" class="form-control" placeholder="Equipment Type">
                </div>
            </div>
            <div class="col-lg-6 col-md-12 mg-t-sm">
                <div class="form-group">
                    <label>Equipment Category</label>
                    <select name="equipment_ct" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Category">
                        <option value=""></option>
                        <?php foreach ($equipment_ct as $ec) : ?>
                            <option value="<?php echo $ec->equipment_ct_id; ?>" <?php if (!empty($equipment_dt) && $ec->equipment_ct_id == $equipment_dt->equipment_ct_id) echo "selected"; ?> <?php if ($ec->equipment_ct_id == set_value('equipment_ct_id')) echo "selected"; ?>><?php echo $ec->equipment_ct_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 mg-t-sm">
                <div class="form-group">
                    <label>Equipment Unit</label>
                    <select name="equipment_unit" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Unit">
                        <option value=""></option>
                        <?php foreach ($equipment_unit as $et) : ?>
                            <option value="<?php echo $et->equipment_unit_id; ?>" <?php if (!empty($equipment_dt) && $et->equipment_unit_id == $equipment_dt->equipment_unit_id) echo "selected"; ?> <?php if ($et->equipment_unit_id == set_value('equipment_unit_id')) echo "selected"; ?>><?php echo $et->equipment_unit_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <?php if (!empty($equipment_dt)) { ?>
                <div class="<?php echo!empty($equipment_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a role="button" style="cursor: pointer" class="cancel btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
            <div class="<?php echo!empty($equipment_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $("select.form-select2").select2();
        $("#load_sub_form").removeAttr("class"); 
        $(".cancel").click(function() {
<?php if ($permit->access_create == 1) { ?>
                $("#load_sub_form").load('<?php echo base_url() ?>warehouse/equipment/form');
<?php } else { ?>
                $("#load_sub_form").attr("class","hidden");   
<?php } ?>
            
        });
        $("#forms").submit(function() {
            if ($("input[name=equipment_name").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> Equipment Name can not empty");
                $("input[name=equipment_name").focus();
                return false;
            }
            if ($("input[name=equipment_type").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> Equipment Type can not empty");
                $("input[name=equipment_type").focus();
                return false;
            }

            $(".saving").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
            $.ajax({
                url: $("#forms").attr('action'),
                data: $("#forms").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 0) {
                        $(".saving").html(json.msg);
                    } else {
<?php if ($permit->access_create == 1) { ?>
                            $("#load_sub_form").load('<?php echo base_url() ?>warehouse/equipment/form');
<?php } else { ?>
                            $("#load_sub_form").attr("class","hidden");   
<?php } ?>
                        $("#load_main_data").load("<?php echo base_url() ?>warehouse/equipment/table");
                    }
                }
            });
            return false;
        });
    });

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>