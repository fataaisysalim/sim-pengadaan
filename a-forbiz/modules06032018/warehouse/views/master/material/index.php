<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="row">

    <div class="col-lg-4 col-md-4 col-sm-12">
        <a role="button" data-toggle="modal" data-target=".bs-modal-lg" onclick="additional('material_unit')" class="btn btn-md btn-dark col-md-12 col-sm-12 col-xs-12 mg-b-sm" style="padding: 8px"><i class="fa fa-indent pull-left mg-r-md"></i> Material Unit</a> 
        <a role="button" data-toggle="modal" data-target=".bs-modal-lg" onclick="additional('material_category')" class="btn btn-md btn-dark col-md-12 col-sm-12 col-xs-12 mg-b-sm" style="padding: 8px"><i class="fa fa-th-list pull-left mg-r-md"></i> Material Category</a> 
        <a role="button" data-toggle="modal" data-target=".bs-modal-lg" onclick="additional('material')" class="btn btn-md btn-dark col-md-12 col-sm-12 col-xs-12 mg-b-sm" style="padding: 8px"><i class="fa fa-inbox pull-left mg-r-md"></i> Material Type</a> 
        <div class="clearfix"></div>
        <?php if (in_array(1, array($permit->access_create, $permit->access_update))) { ?>
            <div id="load_sub_form"></div>
        <?php } ?>
    </div>
    <?php if ($permit->access_read == 1) { ?>
        <div class="loadertab"><div class="loader mg-t"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div></div>
        <div class="col-lg-8 col-md-8 col-sm-12 load_main_data"></div>
    <?php } ?>
</div>
<script type="text/javascript">
    <?php if ($permit->access_create == 1) { ?>
        $("#load_sub_form").load('<?php echo base_url() ?>warehouse/material/form/material_sub');
<?php } else { ?>
        $("#load_sub_form").attr("class","hidden");    
        $("#load_main_data").attr("class","col-xs-12");
<?php } ?> 
    <?php if ($permit->access_read == 1) { ?>
        $(".load_main_data").load("<?php echo base_url() ?>warehouse/material/table/material_sub");
<?php } ?>
    function additional(id) {
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-contents").html('');
        $("#modal-contents").load('<?php echo base_url() ?>warehouse/material/table/' + id);
    }
    function open_data(feature) {
        $("#load_sub_data").html('');
        $("#load_sub_form").html('');
        $("#load_sub_data").load('<?php echo base_url() ?>warehouse/material/table/' + feature);
        $("#load_sub_form").load('<?php echo base_url() ?>warehouse/material/form/' + feature);
    }

</script>
