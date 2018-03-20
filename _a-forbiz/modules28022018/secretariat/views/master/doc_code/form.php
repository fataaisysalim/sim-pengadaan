<div class="saving"></div>
<section class="panel panel-info">
    <header class="panel-heading lead"><i class='fa fa-plus mg-r-sm'></i> <?php echo $act . ' Document Code'; ?></header>
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'forms')); ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <?php if (!empty($letcode_dt)) { ?>
            <input type="hidden" name="letcode_id" value="<?php echo $letcode_dt->doc_control_letcode_id ?>"/>
        <?php } ?>
        <div style="margin-top: -20px" class="hidden-xs"></div>
        <div style="margin-top: -15px" class="visible-xs"></div>
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label>Code Name</label>
                    <input type="text" name="letcode_name" value="<?php echo empty($letcode_dt) ? set_value('doc_control_letcode_name') : $letcode_dt->doc_control_letcode_name; ?>" class="form-control" placeholder="Document Code Name">
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 10px">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label>Code Number</label>
                    <input type="text" name="letcode_number" value="<?php echo empty($letcode_dt) ? set_value('doc_control_letcode_number') : $letcode_dt->doc_control_letcode_number; ?>" class="form-control" placeholder="Document Code Number">
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="<?php echo!empty($letcode_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
            <?php if (!empty($letcode_dt)) { ?>
                <div class="<?php echo!empty($letcode_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a role="button" style="cursor: pointer" class="cancel btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $("select.form-select2").select2();
<?php if ($permit->access_create == 0) { ?>
            $("#display-form").attr("class","col-lg-4 col-md-4 col-sm-5");    
            $("#load_main_data").attr("class","col-lg-8 col-md-8 col-sm-7");
<?php } ?>
        $(".cancel").click(function() {
<?php if ($permit->access_create == 1) { ?>
                $("#load_sub_form").load('<?php echo base_url() ?>secretariat/doc-code/form');
<?php } else { ?>
                $("#display-form").attr("class","hidden");    
                $("#load_main_data").attr("class","col-xs-12");  
<?php } ?>
        });
        $("#forms").submit(function() {
            if ($("input[name=letcode_name]").val() == "") {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Code name can not empty");
                $("input[name=letcode_name]").focus();
                return false;
            }
            if ($("input[name=letcode_number]").val() == "") {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Code number can not empty");
                $("input[name=letcode_number]").focus();
                return false;
            }
            $.ajax({
                url: $("#forms").attr('action'),
                data: $("#forms").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function(json) {
                    if (json.status === 0) {
                        $(".saving").html(json.msg);
                    } else {
<?php if ($permit->access_create == 1) { ?>
                            $("#load_sub_form").load('<?php echo base_url() ?>secretariat/doc-code/form');
<?php } else { ?>
                            $("#display-form").attr("class","hidden");    
                            $("#load_main_data").attr("class","col-xs-12");  
<?php } ?>
                        $("#load_main_data").load("<?php echo base_url() ?>secretariat/doc-code/table");
                    }
                }
            });
            return false;
        });
    });

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>