<div class="row">
    <?php if (in_array(1, array($permit->access_create, $permit->access_update))) { ?>
        <div id="display-form" class="col-lg-3 col-md-3 col-sm-12">
            <div id="load_sub_form"></div>
        </div>
    <?php } ?>
    <?php if ($permit->access_read == 1) { ?>
        <div id="load_main_data" class="col-lg-9 col-md-9 col-sm-12"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div>
    <?php } ?>
</div>
<script type="text/javascript">    
    <?php if ($permit->access_create == 1) { ?>
            $("#load_sub_form").load('<?php echo base_url() ?>dashboard/gallery/form');
<?php } else { ?>
        $("#display-form").attr("class","hidden");    
        $("#load_main_data").attr("class","col-xs-12");
<?php } ?> 
<?php if ($permit->access_read == 1) { ?>
        $("#load_main_data").load("<?php echo base_url() ?>dashboard/gallery/table");
<?php } ?>
</script>