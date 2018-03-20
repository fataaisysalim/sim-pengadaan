<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <a role="button" data-toggle="modal" data-target=".bs-modal-lg" style="cursor: pointer; padding: 10px" id="equipment_ct" onclick="additional('ct')" class="btn btn-md btn-dark col-md-12 mg-b-md col-sm-12 col-xs-12" style="padding: 8px"><i id="btn" class="fa fa-gavel mg-r-md pull-left"></i> Equipment Category</a>
        <a role="button" data-toggle="modal" data-target=".bs-modal-lg" style="cursor: pointer; padding: 10px" id="equipment_unit" onclick="additional('unit')" class="btn btn-md btn-dark col-md-12 mg-b-md col-sm-12 col-xs-12" style="padding: 8px"><i id="btn" class="fa fa-list-alt mg-r-md pull-left"></i> Equipment Unit</a>
        <div class="clearfix"></div>
        <?php if (in_array(1, array($permit->access_create, $permit->access_update))) { ?>
            <div id="load_sub_form"><div class="loader mg-t"><i class="fa fa-refresh fa-spin mg-r-md"></i></div></div>
        <?php } ?>
    </div>
    <?php if ($permit->access_read == 1) { ?>
        <div class="loadertab"><div class="loader mg-t"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div></div>
        <div id="load_main_data" class="col-lg-8 col-md-8 col-sm-12 "></div>
    <?php } ?>
</div>
<script type="text/javascript">    
<?php if ($permit->access_create == 1) { ?>
            $("#load_sub_form").load('<?php echo base_url() ?>warehouse/equipment/form');
<?php } else { ?>
        $("#load_sub_form").attr("class","hidden");   
<?php } ?> 
<?php if ($permit->access_read == 1) { ?>
            $("#load_main_data").load("<?php echo base_url() ?>warehouse/equipment/table");
<?php } ?>
    function open_data() {
        $("#load_sub_data").html('');
        $("#load_sub_form").html('');
        $("#load_sub_data").load('<?php echo base_url() ?>warehouse/equipment/category/table/');
        $("#load_sub_form").load('<?php echo base_url() ?>warehouse/equipment/category/form/');
        $("#btn").attr("class", "fa fa-times mg-r-md");
        $("#equipment_ct").attr("onclick", "close_data()");
        $("#equipment_ct").attr("class", "btn btn-md btn-danger col-md-12 col-sm-12 col-xs-12");
    }
    function additional(ct) {
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-contents").html('');
        if(ct == 'ct'){
            $("#modal-contents").load('<?php echo base_url() ?>warehouse/equipment/category/');
        }else{
            $("#modal-contents").load('<?php echo base_url() ?>warehouse/equipment/unit/');    
        }
    }
    function close_data() {
        $("#load_sub_data").html('');
        $("#load_sub_form").html('');
        $("#load_sub_form").load('<?php echo base_url() ?>warehouse/equipment/form/');
        $("#btn").attr("class", "fa fa-thumb-tack mg-r-md");
        $("#equipment_ct").attr("onclick", "open_data()");
        $("#equipment_ct").attr("class", "btn btn-md btn-dark col-md-12 col-sm-12 col-xs-12");
    }

</script>
