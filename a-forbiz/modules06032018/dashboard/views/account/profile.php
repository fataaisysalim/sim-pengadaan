<div class="col-xs-12">
    <div class="saving"></div>
    <section class="panel panel-success">
        <header class="panel-heading"><i class="fa fa-user mg-r-sm"></i> Profile
            <a role="button" class="cancel pull-right"><i class="fa fa-times"></i></a>
        </header>
        <div class="panel-body">
            <?php echo form_open('dashboard/account/save', array('class' => 'form-horizontal row', 'id' => 'form')); ?>
            <div class="col-xs-6">
                <div class="form-group col-xs-12">
                    <label>NIK</label>
                    <div>
                        <input type="text" name="nik" value="<?php echo $sess['employee']->employee_nik ?>" class="form-control" placeholder="NIK">
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group col-xs-12">
                    <label>Name</label>
                    <div>
                        <input type="text" name="fullname" value="<?php echo $sess['employee']->employee_name ?>" class="form-control" placeholder="Nama Lengkap">
                    </div>
                </div>
            </div>
            <div class="col-xs-6 mg-t-md">
                <div class="form-group col-xs-12">
                    <label>Phone</label>
                    <div>
                        <input type="text" name="phone" value="<?php echo $sess['employee']->employee_phone ?>" class="form-control" placeholder="Handphone">
                    </div>
                </div>
            </div>
            <div class="col-xs-6 mg-t-md">
                <div class="form-group col-xs-12">
                    <label>Email</label>
                    <div>
                        <div class="input-group">
                            <input type="text" name="email" value="<?php echo $sess['employee']->employee_email ?>" class="form-control" placeholder="Email">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col-xs-12 mg-t-md mg-b-md">
                <div class="form-group col-xs-12">
                    <label>Address</label>
                    <div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <textarea name="address" class="form-control"><?php echo $sess['employee']->employee_address ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-6 col-sm-6">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check mg-r-sm"></i>Save</button>
                    <a class="cancel btn btn-warning"><i class="fa fa-times mg-r-sm"></i>Cancel</a>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </section>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $(".cancel").click(function() {
            $(".proform").html(" ");
            return false;
        });
        $("#form").submit(function() {
            $('input').attr('readonly', 'readonly');
            $('select').attr('readonly', 'readonly');
            $(".saving").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
            $.ajax({
                url: $("#form").attr('action'),
                data: $("#form").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 0) {
                        $(".saving").html(json.message);
                        $('input').removeAttr('readonly', 'readonly');
                        $('select').removeAttr('readonly', 'readonly');
                    } else {
                        window.location.replace("<?php echo base_url() ?>dashboard/account");
                    }
                }
            });
            return false;
        });
    });
</script>