<div class="saving"></div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-plus mg-r-sm'></i> <?php echo $act . ' ' . $title; ?>
    </header>
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'form')); ?>
        <?php if (!empty($users_dt)) { ?>
            <input type="hidden" name="users_id" value="<?php echo $users_dt->users_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="hidden-xs" style="margin-top: -20px"></div>
        <div class="visible-xs" style="margin-top: -15px"></div>
        <div class="row">
            <div class="col-lg-12 mg-b-sm">
                <div class="form-group">
                    <label>Employee</label>
                    <?php if (!empty($users_dt)) { ?>
                        <input type="hidden" name="users_employee" value="<?php echo $users_dt->users_id; ?>">
                    <?php } ?>
                    <select name="users_employee" class="form-control form-select2" <?php echo $act == "Edit" ? "disabled" : null ?> data-placeholder="Choose Employee" data-style="btn-white">
                        <option value=""></option>
                        <?php foreach ($users_employee as $ep) : ?>
                            <?php if (empty($ep->users_id) OR $act == "Edit") { ?>
                                <option value="<?php echo $ep->employee_id; ?>" <?php echo!empty($users_dt) ? ($ep->users_id == $users_dt->users_id) ? "selected" : null  : null; ?> <?php if ($ep->employee_id == set_value('users_employee')) echo "selected"; ?>><?php echo $ep->employee_nik; ?> - <?php echo $ep->employee_name; ?></option>
                            <?php } ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="users_username" value="<?php echo empty($users_dt) ? set_value('users_username') : $users_dt->users_username; ?>" class="form-control" placeholder="Username">
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label>Position</label>
                    <select name="users_position" class="form-control form-select2" data-placeholder="Choose Position" data-style="btn-white">
                        <option value=""></option>
                        <?php foreach ($users_position as $up) : ?>
                            <option value="<?php echo $up->users_position_id; ?>" <?php if (!empty($users_dt) && $up->users_position_id == $users_dt->users_position_id) echo "selected"; ?> <?php if ($up->users_position_id == set_value('users_position')) echo "selected"; ?>><?php echo $up->users_position_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="<?php echo!empty($users_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
            <?php if (!empty($users_dt)) { ?>
                <div class="<?php echo!empty($users_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
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
                $("#load_sub_form").load('<?php echo base_url() ?>dashboard/users/form');
<?php } else { ?>
                $("#display-form").attr("class","hidden");    
                $("#load_main_data").attr("class","col-xs-12");  
<?php } ?>
        });
        $("#form").submit(function() {
            if ($("input[name=users_username").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Username can not be empty");
                $("input[name=users_name").focus();
                return false;
            }
            if ($("select[name=users_employee").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Employee can not be empty");
                $("select[name=users_employee").focus();
                return false;
            }
            if ($("select[name=users_position").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Position can not be empty");
                $("select[name=users_address").focus();
                return false;
            }

            $(".saving").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
            $.ajax({
                url: $("#form").attr('action'),
                data: $("#form").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 0) {
                        $(".saving").html(json.msg);
                    } else {
<?php if ($permit->access_create == 1) { ?>
                            $("#load_sub_form").load('<?php echo base_url() ?>dashboard/users/form');
<?php } else { ?>
                            $("#display-form").attr("class","hidden");    
                            $("#load_main_data").attr("class","col-xs-12");  
<?php } ?>
                        $("#load_main_data").load('<?php echo base_url() ?>dashboard/users/table');
                    }
                }
            });
            return false;
        });
    });

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>