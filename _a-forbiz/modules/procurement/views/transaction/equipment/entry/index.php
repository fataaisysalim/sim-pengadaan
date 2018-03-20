<?php if ($sess['position_id'] == 1 OR $sess['position_id'] == 4 OR $sess['position_id'] == 5 OR ($sess['position_id'] == 1 && isset($equipt_transaction))) { ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
    <script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 load_main_data"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div>
    </div>
    <script type="text/javascript">
        $(".load_main_data").load("<?php echo base_url() . 'procurement/transaction/equipment/form/entry/';
    echo isset($equipt_transaction) ? $equipt_transaction : NULL; ?>");
    </script>
<?php } else { ?>
    <h1 class="pull-left mg-t-sm"><i class="fa fa-warning mg-r-sm"></i></h1><h3><small>Sorry you are not authorized to access the features</small><br/> <b>Equipment Receipt</b></h3>
<?php } ?>
