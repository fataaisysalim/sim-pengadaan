<div class="saving_ut"></div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-plus mg-r-sm'></i> <?php echo $act; ?> Resource Code
    </header>
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'form')); ?>
        <?php if (!empty($code_dt)) { ?>
            <input type="hidden" name="code_ct_id" value="<?php echo $code_dt->code_ct_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Code Category</label>
                    <select id="code_ct" name="code_ct" class="form-control form-select2" data-style="btn-white" data-placeholder="Code Category">
                        <option value="">Choose Category Code</option>
                        <?php foreach ($code_ct as $ct) : ?>
                            <option value="<?php echo $ct->code_ct_id; ?>" <?php if (!empty($code_dt) && $ct->code_ct_id == $code_dt->code_ct_id) echo "selected"; ?> <?php if ($ct->code_ct_id == set_value('code_ct')) echo "selected"; ?>><?php echo ucwords($ct->code_ct_name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Resource Code Name</label>
                    <input type="text" maxlength="6" name="code_name" value="<?php echo empty($code_dt) ? set_value('code_name') : $code_dt->code_name; ?>" class="form-control" placeholder="Resource Code Name">
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <?php if (!empty($code_dt)) { ?>
                <div class="<?php echo!empty($code_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a role="button" class="cancel_code btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
            <div class="<?php echo!empty($code_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $("select.form-select2").select2();    
<?php if ($permit->access_create == 0) { ?>
        $("#display-form").attr("class","col-lg-4 col-md-4 col-sm-12");    
        $("#load_main_data").attr("class","col-lg-8 col-md-8 col-sm-12");
<?php } ?>
    $(".cancel_code").click(function() {
<?php if ($permit->access_create == 1) { ?>
            $("#load_sub_form").load('<?php echo base_url("$url_access/form"); ?>');
<?php } else { ?>
            $("#display-form").attr("class","hidden");    
            $("#load_main_data").attr("class","col-md-8");  
<?php } ?>
    });
    
    $(document).ready(function() {
        $("#form").submit(function() {
            if ($("select[name=code_ct] option:selected").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Code Category can not empty");
                $("select[name=code_ct] option:selected").focus();
                return false;
            }
            if ($("input[name=code_name]").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Code can not empty");
                $("input[name=code_ct_name]").focus();
                return false;
            }
            $(".saving_ut").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
            $.ajax({
                url: $("#form").attr('action'),
                data: $("#form").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 0) {
                        $(".saving_ut").html(json.msg);
                    } else {
<?php if ($permit->access_create == 1) { ?>
                            $("#load_sub_form").load('<?php echo base_url("$url_access/form"); ?>');
<?php } else { ?>
                            $("#display-form").attr("class","hidden");    
                            $("#load_main_data").attr("class","col-md-8");  
<?php } ?>
                        $("#load_main_data").load("<?php echo base_url("$url_access/table") ?>");
                    }
                }
            });
            return false;
        });
    });

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>