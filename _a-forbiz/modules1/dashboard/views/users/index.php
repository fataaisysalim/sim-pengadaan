<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="row">
    <?php if (in_array(1, array($permit->access_create, $permit->access_update))) { ?>
        <div id="display-form" class="col-lg-4 col-md-4 col-sm-5">
            <div id="load_sub_form"></div>
        </div>
    <?php } ?>
    <?php if ($permit->access_read == 1) { ?>
        <div id="load_main_data" class="col-lg-8 col-md-8 col-sm-7"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div>
    <?php } ?>
</div>
<script type="text/javascript">    
<?php if ($permit->access_create == 1) { ?>
            $("#load_sub_form").load('<?php echo base_url() ?>dashboard/users/form');
<?php } else { ?>
        $("#display-form").attr("class","hidden");    
        $("#load_main_data").attr("class","col-xs-12");
<?php } ?> 
<?php if ($permit->access_read == 1) { ?>
        $("#load_main_data").load("<?php echo base_url() ?>dashboard/users/table");
<?php } ?>
    function open_data(feature) {
        $("#load_sub_data").html('');
        $("#load_sub_form").html('');
        $("#load_sub_data").load('<?php echo base_url() ?>dashboard/material/table/' + feature);
        $("#load_sub_form").load('<?php echo base_url() ?>dashboard/material/form/' + feature);
    }
    
</script>
