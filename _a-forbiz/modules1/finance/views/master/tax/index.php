<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="row">
    <div class="loadertab"><div class="loader mg-t"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div></div>
    <div id="show_data" class="col-lg-12 col-md-12 col-sm-12 load_main_data"></div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="clearfix"></div>
            <div id="load_sub_form"></div>
        </div>
</div>
<script type="text/javascript">
    $(".load_main_data").load("<?php echo base_url() ?>finance/tax/table");
    function open_data() {
        $("#load_sub_data").html('');
        $("#load_sub_form").html('');
        $("#load_sub_data").load('<?php echo base_url() ?>finance/tax/category/table/');
        $("#load_sub_form").load('<?php echo base_url() ?>finance/tax/category/form/');
        $("#btn").attr("class", "fa fa-times mg-r-md");
        $("#tax_ct").attr("onclick", "close_data()");
        $("#tax_ct").attr("class", "btn btn-md btn-danger col-md-12 col-sm-12 col-xs-12");
    }
    function additional(ct) {
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-contents").html('');
        if(ct == 'ct'){
            $("#modal-contents").load('<?php echo base_url() ?>finance/tax/category/');
        }
    }
    function close_data() {
        $("#load_sub_data").html('');
        $("#load_sub_form").html('');
        $("#load_sub_form").load('<?php echo base_url() ?>finance/tax/form/');
        $("#btn").attr("class", "fa fa-thumb-tack mg-r-md");
        $("#tax_ct").attr("onclick", "open_data()");
        $("#tax_ct").attr("class", "btn btn-md btn-dark col-md-12 col-sm-12 col-xs-12");
    }

</script>
