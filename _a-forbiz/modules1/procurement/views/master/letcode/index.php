<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="row">
    <?php if ($sess['position_id'] == 1) { ?>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div id="load_sub_form"><div class="loader mg-t"><i class="fa fa-refresh fa-spin mg-r-md"></i></div></div>
        </div>
    <?php } ?>
    <div class="loadertab"><div class="loader mg-t"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div></div>
    <div class="col-lg-8 col-md-8 col-sm-12 load_main_data"></div>
</div>
<script type="text/javascript">
    <?php if ($sess['position_id'] == 1) { ?>
    $("#load_sub_form").load('<?php echo base_url() ?>secretariat/letcode/form');
    <?php } ?>
    $(".load_main_data").load("<?php echo base_url() ?>secretariat/letcode/table");

    function open_data() {
        $("#load_sub_form").html('');
        $("#btn").attr("class", "fa fa-times mg-r-md");
        $("#letcode_ct").attr("onclick", "close_data()");
        $("#letcode_ct").attr("class", "btn btn-md btn-danger col-md-12 col-sm-12 col-xs-12");
    }
    function close_data() {
        $("#load_sub_form").html('');
        $("#load_sub_form").load('<?php echo base_url() ?>secretariat/letcode/form/');
        $("#btn").attr("class", "fa fa-thumb-tack mg-r-md");
        $("#letcode_ct").attr("onclick", "open_data()");
        $("#letcode_ct").attr("class", "btn btn-md btn-dark col-md-12 col-sm-12 col-xs-12");
    }

</script>
