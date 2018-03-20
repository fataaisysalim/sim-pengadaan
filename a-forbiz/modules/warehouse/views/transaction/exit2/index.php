<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 load_main_data"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div>
</div>
<script type="text/javascript">
    $(".load_main_data").load("<?php echo base_url() ?>warehouse/transaction_exit/form");
    function get_material(el) {
        $("#add_btn").load('<?php echo base_url() . 'warehouse/transaction_exit/add_btn/'; ?>' + el.value);
    }
</script>
