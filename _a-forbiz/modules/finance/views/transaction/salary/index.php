<?php if (in_array(1, array($permit->access_create,$permit->access_special, $permit->access_update))) { ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
    <script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 load_main_data"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div>
    </div>
    <script type="text/javascript">
        $(".load_main_data").load("<?php echo base_url($url). '/form/'; echo isset($salary_id) ? $salary_id : NULL; ?>");
    </script>
<?php } else { ?>
    <h1 class="pull-left mg-t-sm"><i class="fa fa-warning mg-r-sm"></i></h1><h3><small>Sorry you are not authorized to access the features</small><br/> <b>Fee Transaction</b></h3>
    <?php } ?>

