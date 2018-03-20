<div class="saving"></div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-plus mg-r-sm'></i> <?php echo $act . ' ' . $title; ?>
    </header>
    <div class="panel-body">
        <?php echo form_open_multipart($url_action, array('id' => 'form')); ?>
        <?php if (!empty($employee_dt)) { ?>
            <input type="hidden" name="employee_id" value="<?php echo $employee_dt->employee_id; ?>"/>
        <?php } ?>
        <div style="margin-top: -20px" class="hidden-xs"></div>
        <div style="margin-top: -15px" class="visible-xs"></div>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-4 col-xs-6">
                <div class="form-group mg-b-sm">
                    <label>Employee Name</label>
                    <input type="text" name="employee_name" value="<?php echo empty($employee_dt) ? set_value('employee_name') : $employee_dt->employee_name; ?>" class="form-control" placeholder="Employee Name">
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                <div class="form-group mg-b-sm">
                    <label>NIK</label>
                    <input type="text" name="employee_nik" value="<?php echo empty($employee_dt) ? set_value('employee_name') : $employee_dt->employee_nik; ?>" class="form-control" placeholder="NIK">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-4">
                <div class="form-group mg-t-sm mg-b-sm">
                    <label>Employee Address</label>
                    <textarea name="employee_address" class="form-control"><?php echo empty($employee_dt) ? set_value('employee_address') : $employee_dt->employee_address; ?></textarea>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>Telephone</label>
                    <input type="text" name="employee_phone" value="<?php echo empty($employee_dt) ? set_value('employee_phone') : $employee_dt->employee_phone; ?>" class="form-control" placeholder="Telephone">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6">
                <div class="form-group mg-b-sm">
                    <label>Email</label>
                    <input type="email" name="employee_email" value="<?php echo empty($employee_dt) ? set_value('employee_email') : $employee_dt->employee_email; ?>" class="form-control" placeholder="Email">
                </div>
            </div>
<!--            <div class="col-lg-12">
                <div class="form-group mg-t-sm">
                    <label>Photo</label>
                    <input type="file" name="foto" placeholder="Foto">
                </div>
            </div>-->
        </div>
        <hr/>
        <div class="row">
            <div class="<?php echo!empty($employee_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
            <?php if (!empty($employee_dt)) { ?>
                <div class="<?php echo!empty($employee_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a href="#" class="cancel btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<h4><i>Note ------</i></h4>
<hr class="divider"/>
<ul>
    <li><i class="fa fa-chevron-right mg-r-sm"></i>Use NIK random for employees who do not have</li>
    <li><i class="fa fa-chevron-right mg-r-sm"></i>So that employees can use the system, please register in the master user</li>
</ul>
<script type="text/javascript">
    $(document).ready(function() {        
<?php if ($permit->access_create == 0) { ?>
            $("#display-form").attr("class","col-lg-4 col-md-4 col-sm-12");    
            $("#load_main_data").attr("class","col-lg-8 col-md-8 col-sm-12");
<?php } ?>
        $(".cancel").click(function() {
<?php if ($permit->access_create == 1) { ?>
                $("#load_sub_form").load('<?php echo base_url() ?>dashboard/employee/form');
<?php } else { ?>
                $("#display-form").attr("class","hidden");    
                $("#load_main_data").attr("class","col-xs-12");  
<?php } ?>
        });
        $("#form").submit(function() {
            if ($("input[name=employee_name").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Employee names can not empty");
                $("input[name=employee_name").focus();
                return false;
            }

            if ($("input[name=employee_address").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Employee address can not empty");
                $("input[name=employee_address").focus();
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
                            $("#load_sub_form").load('<?php echo base_url() ?>dashboard/employee/form');
<?php } else { ?>
                            $("#display-form").attr("class","hidden");    
                            $("#load_main_data").attr("class","col-xs-12");  
<?php } ?>
                        $("#load_main_data").load('<?php echo base_url() ?>dashboard/employee/table');
                        
                    }
                }
            });
            return false;
        });
    });

</script>