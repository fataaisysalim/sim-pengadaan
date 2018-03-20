<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="row">
    <div id="dataAc" class="col-xs-12">
        <div class="load_access_data"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div>
    </div>
</div>
<script type="text/javascript">
    $(".load_access_data").load("<?php echo base_url() ?>dashboard/menu_access/table");
<?php if (in_array(1, array($permit->access_create, $permit->access_update))) { ?>
        function showForm(){
            $(".load_access_data").html('<i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...');
            $(".load_access_data").load('<?php echo base_url() ?>dashboard/menu_access/form');
        }
<?php } ?>
</script>
