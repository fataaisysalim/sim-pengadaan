<div class="saving_ct"></div>
<section class="panel panel-info row">
    <header class="panel-heading lead">
        <i class='fa fa-plus mg-r-sm'></i> <?php echo $act; ?> Material Category
    </header>
    <div class="panel-body">
        <?php echo form_open($url_access . "save_category/", array('id' => 'form_ct')); ?>
        <?php if (!empty($material_category_dt)) { ?>
            <input type="hidden" name="material_category_id" value="<?php echo $material_category_dt->material_category_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">

            <div class="col-xs-12">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="material_category_name" value="<?php echo empty($material_category_dt) ? set_value('material_category_name') : strtoupper($material_category_dt->material_category_name); ?>" class="form-control" placeholder="Category Material Name">
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="<?php echo!empty($material_category_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
            <?php if (!empty($material_category_dt)) { ?>
                <div class="<?php echo!empty($material_category_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a role="button" style="cursor: pointer" class="cancel_ct btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
<?php if ($permit->access_create == 0) { ?>
            $("#ctable").attr("class","col-sm-8");
            $("#ctform").attr("class","col-sm-4"); 
<?php } ?>
        $(".cancel_ct").click(function() {
<?php if ($permit->access_create == 1) { ?>
                $("#ctform").load("<?php echo base_url() ?>warehouse/material/form/material_category");
<?php } else { ?>
                $("#ctable").attr("class","col-sm-12");
                $("#ctform").attr("class","hidden");    
<?php } ?>
        });
        $("#form_ct").submit(function() {
            if ($("input[name=material_category_name]").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> Material Category Name can not empty");
                $("input[name=material_category_name]").focus();
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
                            $("#unitform").load("<?php echo base_url() ?>warehouse/material/form/material_unit");
                            $("#load_sub_form").load('<?php echo base_url() ?>warehouse/material/form/material_sub');
<?php } else { ?>
                            $("#unitable").attr("class","col-sm-12");
                            $("#unitform").attr("class","hidden");    
<?php } ?>
                        $("#modal-contents").load('<?php echo base_url() ?>warehouse/material/table/material_category');
                    }
                }
            });
            return false;
        });
    });

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>