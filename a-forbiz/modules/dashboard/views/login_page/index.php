<div class="row">
    <?php if ($sess['development'] == TRUE) { ?>
        <?php if (in_array(1, array($permit->access_create, $permit->access_update))) { ?>
            <div id="display-form" class="col-lg-3 col-md-3 col-sm-12">
                <?php echo $this->session->flashdata('messageform') ?>
                <div id="load_sub_form"></div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php if ($permit->access_read == 1) { ?>
        <div id="load_main_data" class="col-lg-9 col-sm-9 col-xs-12"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div>
    <?php } ?>
    <?php if ($sess['development'] == FALSE) { ?>
        <div class="col-lg-3 col-sm-3 col-xs-12">
            <h4><i><b>Note :</b></i></h4>
            <hr class="divider"/>
            <ul>
                <li class="mg-b-sm"><i class="fa fa-chevron-right mg-r-sm"></i>Please contact vendor to update login template</li>
                <li><i class="fa fa-chevron-right mg-r-sm"></i>Choose 1 template to active</li>
            </ul>
        </div>
    <?php } ?>
</div>
<script type="text/javascript">    
<?php if ($sess['development'] == TRUE) { ?>
    <?php if ($permit->access_create == 1) { ?>
                $("#load_sub_form").load('<?php echo base_url() ?>dashboard/login-page/form');
    <?php } else { ?>
                $("#display-form").attr("class","hidden");    
                $("#load_main_data").attr("class","col-xs-12");
    <?php } ?> 
<?php } ?>
<?php if ($permit->access_read == 1) { ?>
        $("#load_main_data").load("<?php echo base_url() ?>dashboard/login-page/table");
<?php } ?>
</script>
