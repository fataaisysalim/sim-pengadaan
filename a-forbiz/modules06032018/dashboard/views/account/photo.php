<div class="col-xs-12" id="ganti-foto">
    <section class="panel panel-warning">
        <header class="panel-heading"><i class="fa fa-camera mg-r-sm"></i> Upload Photo
            <a role="button" style="cursor: pointer" class="cancel pull-right"><i class="fa fa-times"></i></a>
        </header>
        <div class="panel-body">
            <?php echo form_open('dashboard/account/photo_profile', array("enctype" => "multipart/form-data", 'class' => 'form-horizontal')); ?>
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="file" name="foto" class="form-control" style="padding-bottom: 40px">
                    <p class="help-block"><i class="fa fa-info-circle mg-r-sm"></i>Maksimal upload 1MB</p>
                </div>
                <div class="col-sm-12">
                    <button type="button" class="cancel btn btn-danger pull-right"><i class="fa fa-times mg-r-sm"></i>cancel</button>
                    <button type="submit" class="btn btn-primary pull-right mg-r-sm"><i class="fa fa-upload mg-r-sm"></i>Upload</button>
                </div>
            </div>  
            <?php echo form_close(); ?>
        </div>
    </section>
</div>
<?php if (!empty($sess['employee']->employee_photo)) { ?>
    <div class="col-xs-12 mg-b-sm">
        <button type="button" class="col-sm-12 btn btn-dark" id="removeph"><i class="fa fa-trash mg-r-lg"></i>Delete Photo</button>
    </div>
<?php } ?>
<script>
    $(".cancel").click(function() {
        $(".proform").html(' ');
        return false;
    });
    $("#removeph").click(function() {
        $(this).each(function() {
            bootbox.confirm("Apakah anda akan menghapus foto profil ?", function(result) {
                if (result == true) {
                    window.location.replace("<?php echo base_url() ?>dashboard/account/delete_photo");
                }
            });
        });
    });
</script>