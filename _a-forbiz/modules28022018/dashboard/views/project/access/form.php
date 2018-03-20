<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
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
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div style="margin-top: -20px" class="hidden-xs"></div>
        <div style="margin-top: -15px" class="visible-xs"></div>
        <div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="form-group mg-b-sm">
                    <label>PROJECT</label>
                    <select name="project" onchange="proLoad()" class="form-control form-select2"  data-style="btn-white" data-placeholder="CHOOSE PROJECT">
                        <option value=""></option>
                        <?php foreach ($project as $p) : ?>
                            <option value="<?php echo $p->project_id; ?>" <?php if (!empty($project_access_dt) && $p->project_id == $project_access_dt->project_id) echo "selected"; ?> <?php if ($p->project_id == set_value('project')) echo "selected"; ?>><?php echo strtoupper($p->project_name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>USER</label>
                    <div class="userLoad">
                        <select name="users" class="form-control form-select2" data-style="btn-white" data-placeholder="CHOOSE USERS" disabled>
                            <option value=""></option>
                            <?php foreach ($users as $usr) : ?>
                                <option value="<?php echo $usr->users_id; ?>" <?php if (!empty($project_access_dt) && $usr->users_id == $project_access_dt->users_id) echo "selected"; ?> <?php if ($usr->users_id == set_value('users')) echo "selected"; ?>><?php echo strtoupper($usr->users_username); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="<?php echo!empty($project_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
            <?php if (!empty($project_dt)) { ?>
                <div class="<?php echo!empty($project_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a href="#" class="cancel btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $("select.form-select2").select2();
<?php if ($permit->access_create == 0) { ?>
            $("#display-form").attr("class","col-lg-4 col-md-4 col-sm-5");    
            $("#load_main_data").attr("class","col-lg-8 col-md-8 col-sm-7");
<?php } ?>
        $("#form").submit(function () {
            if ($("select[name=project] option:selected").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> Project can not be empty");
                $("select[name=project]").focus();
                return false;
            }
            
            if ($("#users option:selected").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> User can not be empty");
                $("select[name=users]").focus();
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
                            $("#load_sub_form").load('<?php echo base_url() ?>dashboard/project_access/form');
<?php } else { ?>
                            $("#display-form").attr("class","hidden");    
                            $("#load_main_data").attr("class","col-xs-12");  
<?php } ?>
                        $("#load_main_data").load('<?php echo base_url() ?>dashboard/project_access/table');
                        
                    }
                }
            });
            return false;
        });
    });
    function proLoad() {
        $(".userLoad").load('<?php echo base_url() ?>dashboard/project_access/data/' + $("select[name=project] option:selected").val());
    }
    
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>