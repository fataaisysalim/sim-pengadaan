<div class="saving_sub"></div>
<section class="panel panel-info">
    <header class="panel-heading lead"><i class='fa fa-plus mg-r-sm'></i> <?php echo $act; ?> Material</header>
    <div class="panel-body">
        <?php echo form_open("$url_access/save_sub", array('id' => 'forms_sub')); ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <?php if (!empty($material_sub_dt)) { ?>
            <input type="hidden" name="material_sub_id" value="<?php echo $material_sub_dt->material_sub_id ?>"/>
        <?php } ?>
        <div class="row" style="margin-top: -20px">
            <div class="col-lg-12 col-md-6 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>Material Name</label>
                    <input type="text" min="1" name="material_sub_name" value="<?php echo empty($material_sub_dt) ? set_value('material_sub_name') : strtoupper($material_sub_dt->material_sub_name); ?>" class="form-control" placeholder="Material Name">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mg-t-sm">
                <div class="form-group">
                    <label>Material Unit</label>
                    <select name="material_unit" class="form-control  form-select2" data-style="btn-white" data-placeholder="Choose Unit">
                        <option value=""></option>
                        <?php foreach ($material_unit as $mu) : ?>
                            <option value="<?php echo $mu->material_unit_id; ?>" <?php if (!empty($material_sub_dt) && $mu->material_unit_id == $material_sub_dt->material_unit_id) echo "selected"; ?> <?php if ($mu->material_unit_id == set_value('material_unit')) echo "selected"; ?>><?php echo strtoupper($mu->material_unit_name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6 mg-t-sm">
                <div class="form-group">
                    <label>Material Type</label>
                    <select name="material" class="form-control  form-select2" data-style="btn-white" data-placeholder="Choose Type">
                        <option value=""></option>
                        <?php foreach ($material['ct'] as $numb => $mx) : ?>
                            <optgroup label="<?php echo strtoupper($mx->material_category_name) ?>">
                                <?php foreach ($material['type'][$numb] as $nub => $mt) { ?>
                                    <option value="<?php echo $mt->material_id; ?>" <?php if (!empty($material_sub_dt) && $mt->material_id == $material_sub_dt->material_id) echo "selected"; ?> <?php if ($mt->material_id == set_value('material_type')) echo "selected"; ?>><?php echo strtoupper($mt->material_name); ?></option>
                                <?php } ?>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6 mg-t-sm">
                <div class="form-group">
                    <label>Convertion (Kg)</label>
                    <input type="text" onkeyup="format_num(this)" name="conversion_qty" value="<?php echo empty($material_sub_dt) ? set_value("conversion_qty") : str_replace('.', ',', $material_sub_dt->material_sub_convertion); ?>" class="form-control" placeholder="Convertion (Kg)">
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6 mg-t-sm">
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="material_sub_price" onkeyup="format_num(this)" value="<?php echo empty($material_sub_dt) ? set_value("material_sub_price") : rupiah($material_sub_dt->material_sub_price); ?>" class="form-control" placeholder="Price">
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="<?php echo!empty($material_sub_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
            <?php if (!empty($material_sub_dt)) { ?>
                <div class="<?php echo!empty($material_sub_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a role="buton" class="cancelsub btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $("select.form-select2").select2();        
<?php if ($permit->access_create == 0) { ?>
            $("#load_sub_form").removeAttr("class");    
<?php } ?>
        $(".cancelsub").click(function() {
<?php if ($permit->access_create == 1) { ?>
                $("#load_sub_form").load('<?php echo base_url() ?>warehouse/material/form/material_sub');
<?php } else { ?>
                $("#load_sub_form").attr("class","hidden");    
<?php } ?>
        });
        
        $("#forms_sub").submit(function() {
            if ($("input[name=material_sub_name").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Material Name can not empty");
                $("input[name=material_sub_name").focus();
                return false;
            }
            if ($("select[name=material]").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Material Category can not empty");
                $("select[name=material]").focus();
                return false;
            }
            $(".saving_sub").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i> Loading saving. Please wait... !</div>');
            $.ajax({
                url: $("#forms_sub").attr('action'),
                data: $("#forms_sub").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 0) {
                        $(".saving_sub").html(json.msg);
                    } else {
<?php if ($permit->access_create == 1) { ?>
                            $("#load_sub_form").load('<?php echo base_url() ?>warehouse/material/form/material_sub');
<?php } else { ?>
                            $("#load_sub_form").attr("class","hidden");    
<?php } ?>
                        $(".load_main_data").load("<?php echo base_url() ?>warehouse/material/table/material_sub");
                    }
                }
            });
            return false;
        });
    });

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>