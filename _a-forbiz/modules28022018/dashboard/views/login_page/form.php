<div class="saving_ct"></div>
<section class="panel panel-info row">
    <header class="panel-heading">
        <i class='fa fa-plus mg-r-sm'></i> <?php echo $act; ?> Template
    </header>
    <div class="panel-body">
        <?php echo form_open_multipart($url_access . "save/$pageid", array('id' => 'formlog')); ?>
        <div class="row">
            <div class="col-xs-12 mg-b-sm">
                <div class="form-group">
                    <label>Template Name</label>
                    <input type="text" name="page_name" value="<?php echo empty($dt) ? set_value('page_name') : strtoupper($dt->page_config_name); ?>" class="form-control" placeholder="Template Name">
                </div>
            </div>
            <div class="col-xs-12 mg-b-sm">
                <div class="form-group">
                    <label>Template Location</label>
                    <input type="text" name="page_url" value="<?php echo empty($dt) ? set_value('page_url') : strtoupper($dt->page_config_url); ?>" class="form-control" placeholder="Template Location">
                </div>
            </div>
            <div class="col-xs-12">
                <?php if (!empty($dt)) { ?>
                    <?php if (!empty($dt->page_config_picture)) { ?>
                        <img src="<?php echo base_url($dt->page_config_picture) ?>" class="mg-b-sm"/>
                    <?php } ?>
                <?php } ?>
                <div class="form-group">
                    <label>Template Screenshoot</label>
                    <input type="file" name="filetemplate">
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="<?php echo!empty($dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
            <?php if (!empty($dt)) { ?>
                <div class="<?php echo!empty($dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a role="button" style="cursor: pointer" class="cancelog btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $(".cancelog").click(function() {
            $("#load_sub_form").load('<?php echo base_url() ?>dashboard/login-page/form');
        });
        $("#formlog").submit(function() {
            if ($("input[name=page_name]").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> Template Name can not empty");
                $("input[name=page_name]").focus();
                return false;
            }
            if ($("input[name=page_url]").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> Template Location can not empty");
                $("input[name=page_url]").focus();
                return false;
            }
            var attach = $("input[type=file]").val();
            var extmg = attach.split('.').pop();
            if (attach != '') {
                if (extmg != 'jpg' && extmg != 'png') {
                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Format screenshoot not allowed");
                    return false;
                }
            }
        });
    });

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>