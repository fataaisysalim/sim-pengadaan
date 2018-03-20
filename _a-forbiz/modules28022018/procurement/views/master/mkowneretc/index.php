<div class="row">
    <?php if ($sess['position_id'] == 1) { ?>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div id="group_k"></div>
            <div id="load_sub_form"><div class="loader mg-t"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div></div>
        </div>
    <?php } ?>
    <div class="col-lg-8 col-md-8 col-sm-12 load_main_data"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div>
</div>
<script type="text/javascript">
        <?php if ($sess['position_id'] == 1) { ?>
              $("#load_sub_form").load('<?php echo base_url() ?>secretariat/mkowneretc/form');
        <?php } ?>
        $(".load_main_data").load("<?php echo base_url() ?>secretariat/mkowneretc/table");
        function open_data(feature) {
            $("#load_sub_data").html('');
            $("#load_sub_form").html('');
            $("#load_sub_data").load('<?php echo base_url() ?>secretariat/material/table/' + feature);
            $("#load_sub_form").load('<?php echo base_url() ?>secretariat/material/form/' + feature);
        }

</script>
