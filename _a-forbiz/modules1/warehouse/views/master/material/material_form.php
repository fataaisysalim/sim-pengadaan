<div class="saving_m"></div>
<section class="panel panel-info row">
    <header class="panel-heading lead">
        <i class='fa fa-plus mg-r-sm'></i> <?php echo $act; ?> Material Type
    </header>
    <div class="panel-body">
        <?php echo form_open($url_access . "save_material/", array('id' => 'form_m')); ?>
        <?php if (!empty($material_dt)) { ?>
            <input type="hidden" name="material_id" value="<?php echo $material_dt->material_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Material Type Name</label>
                    <input type="text" name="material_name" value="<?php echo empty($material_dt) ? set_value('material_name') : strtoupper($material_dt->material_name); ?>" class="form-control" placeholder="Material Type Name">
                </div>
            </div>
            <div class="col-lg-12 mg-t-sm">
                <div class="form-group">
                    <label>Material Type Code</label>
                    <input type="text" name="material_code" value="<?php echo empty($material_dt) ? set_value('material_name') : strtoupper($material_dt->material_code); ?>" class="form-control" placeholder="Material Type Code">
                </div>
            </div>
            <div class="col-lg-12 mg-t-sm">
                <div class="form-group">
                    <label>Material Category</label>
                    <select name="material_category" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Category" required>
                        <option value=""></option>
                        <?php foreach ($material_category as $mc) : ?>
                            <option value="<?php echo $mc->material_category_id; ?>" <?php if (!empty($material_dt) && $mc->material_category_id == $material_dt->material_category_id) echo "selected"; ?> <?php if ($mc->material_category_id == set_value('material_category')) echo "selected"; ?>><?php echo strtoupper($mc->material_category_name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row mg-t-sm">
            <?php if (!empty($material_dt)) { ?>
                <div class="<?php echo!empty($material_dt) ? 'col-xs-6' : null ?> pull-right">
                    <a role="button" style="cursor: pointer" class="cancel_m btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
            <div class="<?php echo!empty($material_dt) ? 'col-xs-6' : 'col-md-6 col-sm-12 col-xs-6' ?> pull-right">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $("select.form-select2").select2();
<?php if ($permit->access_create == 0) { ?>
            $("#mtable").attr("class","col-sm-8");
            $("#mtform").attr("class","col-sm-4"); 
<?php } ?>
        $(".cancel_m").click(function() {
<?php if ($permit->access_create == 1) { ?>
                $("#mtform").load("<?php echo base_url() ?>warehouse/material/form/material");
<?php } else { ?>
                $("#mtable").attr("class","col-sm-12");
                $("#mtform").attr("class","hidden");    
<?php } ?>
        });
        $("#form_m").submit(function() {
            if ($("input[name=material_name]").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> Material Name Type can not empty");
                $("input[name=material_name]").focus();
                return false;
            }
            if ($("input[name=material_code]").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> Material Code can not empty");
                $("input[name=material_code]").focus();
                return false;
            }
            //            if ($("select[name=material_unit]").val() == '') {
            //                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Material Unit tidak boleh kosong");
            //                $("select[name=material_unit]").focus();
            //                return false;
            //            }
            if ($("select[name=material_category]").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Material category can not empty");
                $("select[name=material_category]").focus();
                return false;
            }
            $(".saving_m").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
            $.ajax({
                url: $("#form_m").attr('action'),
                data: $("#form_m").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 0) {
                        $(".saving_m").html(json.msg);
                    } else {
<?php if ($permit->access_create == 1) { ?>
                            $("#mtform").load("<?php echo base_url() ?>warehouse/material/form/material");
                            $("#load_sub_form").load('<?php echo base_url() ?>warehouse/material/form/material_sub');
<?php } else { ?>
                            $("#mtable").attr("class","col-sm-12");
                            $("#mtform").attr("class","hidden");    
<?php } ?>
                        $("#modal-contents").load('<?php echo base_url() ?>warehouse/material/table/material');
                        
                    }
                }
            });
            return false;
        });
    });

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>