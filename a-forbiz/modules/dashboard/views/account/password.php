<div class="col-xs-12">
    <div class="saving"></div>
    <section class="panel panel-danger">
        <header class="panel-heading"><i class="fa fa-key mg-r-sm"></i> Password
            <a role="button" style="cursor: pointer" class="cancel pull-right"><i class="fa fa-times"></i></a>
        </header>
        <div class="panel-body">
            <?php echo form_open('dashboard/account/save_password', array('class' => 'form-horizontal ', 'id' => 'form')); ?>
            <div class="form-group">
                <label class="col-sm-4 control-label">Old Password</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="password" name="old" class="form-control" placeholder="Password Lama">
                        <span class="input-group-addon"><i class="fa fa-check"></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group mg-t-sm">
                <label class="col-sm-4 control-label">New Password</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="password" name="new" class="form-control" placeholder="Password Baru">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group mg-t-md">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check mg-r-sm"></i>Update</button>
                    <a role="button" class="cancel btn btn-danger"><i class="fa fa-times mg-r-sm"></i>Cancel</a>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".cancel").click(function() {
            $(".proform").html(' ');
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
                        $(".saving").html(json.message);
                        $('input').removeAttr('readonly', 'readonly');
                        $('select').removeAttr('readonly', 'readonly');
                    }
                }
            });
            return false;
        });
    });

</script>