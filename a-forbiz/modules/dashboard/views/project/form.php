<div class="saving"></div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-plus mg-r-sm'></i> <?php echo strtoupper($act . ' ' . $title); ?>
    </header>
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'form')); ?>
        <?php if (!empty($project_dt)) { ?>
            <input type="hidden" name="project_id" value="<?php echo $project_dt->project_id; ?>"/>
        <?php } ?>
        <div style="margin-top: -20px" class="hidden-xs"></div>
        <div style="margin-top: -15px" class="visible-xs"></div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group mg-b-sm">
                    <label>PROJECT NAME</label>
                    <input type="text" name="project_name" value="<?php echo empty($project_dt) ? set_value('project_name') : $project_dt->project_name; ?>" class="form-control" placeholder="PROJECT NAME">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group mg-b-sm">
                    <label>PROJECT ADDRESS</label>
                    <textarea name="project_address" placeholder="PROJECT ADDRESS" class="form-control"><?php echo empty($project_dt) ? set_value('project_address') : $project_dt->project_address; ?></textarea>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>PROJECT NUMBER</label>
                    <input type="text" name="project_number" value="<?php echo empty($project_dt) ? set_value('project_number') : $project_dt->project_number; ?>" class="form-control" placeholder="PROJET NUMBER">
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>PROJECT CODE</label>
                    <input type="text" maxlength="4" name="project_code" value="<?php echo empty($project_dt) ? set_value('project_code') : $project_dt->project_code; ?>" class="form-control" placeholder="CODE, EX: UTR, BRPK">
                </div>
            </div>
        </div>
        <div class='row'>
            <div class="col-md-12">
                <div class="form-group mg-t-sm">
                    <label>PROJECT REGION</label>
                    <input type="text" name="project_region" value="<?php echo empty($project_dt) ? set_value('project_region') : $project_dt->project_region; ?>" class="form-control" placeholder="PROJECT REGION">
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="<?php echo!empty($project_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> SAVE</button>
            </div>
            <?php if (!empty($project_dt)) { ?>
                <div class="<?php echo!empty($project_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a href="#" class="cancel btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> CANCEL </a>
                </div>
            <?php } ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
<?php if ($permit->access_create == 0) { ?>
            $("#display-form").attr("class","col-lg-4 col-md-4 col-sm-12");    
            $("#load_main_data").attr("class","col-lg-8 col-md-8 col-sm-12");
<?php } ?>
        $(".cancel").click(function() {
<?php if ($permit->access_create == 1) { ?>
                $("#load_sub_form").load('<?php echo base_url() ?>dashboard/project/form');
<?php } else { ?>
                $("#display-form").attr("class","hidden");    
                $("#load_main_data").attr("class","col-xs-12");  
<?php } ?>
        });
        $("#form").submit(function () {
            if ($("input[name=project_name").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Project name can not be empty");
                $("input[name=project_name").focus();
                return false;
            }
            if ($("textarea[name=project_address").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Project address should not be empty");
                $("textarea[name=project_address").focus();
                return false;
            }
            if ($("input[name=project_code").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Project code should not be empty");
                $("input[name=project_name").focus();
                return false;
            }
            if ($("input[name=project_number").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Project numbers can not be empty");
                $("input[name=project_number").focus();
                return false;
            }
            if ($("input[name=project_address").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Project address can not be empty");
                $("input[name=project_address").focus();
                return false;
            }

            $(".saving").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
            $.ajax({
                url: $("#form").attr('action'),
                data: $("#form").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function (json) {
                    if (json.status == 0) {
                        $(".saving").html(json.msg);
                    } else {
<?php if ($permit->access_create == 1) { ?>
                            $("#load_sub_form").load('<?php echo base_url() ?>dashboard/project/form');
<?php } else { ?>
                            $("#display-form").attr("class","hidden");    
                            $("#load_main_data").attr("class","col-xs-12");  
<?php } ?>
                        $("#load_main_data").load('<?php echo base_url() ?>dashboard/project/table');
                    }
                }
            });
            return false;
        });
    });

</script>