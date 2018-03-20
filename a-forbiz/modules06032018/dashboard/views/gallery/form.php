<div class="saving"></div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-plus mg-r-sm'></i> <?php echo strtoupper($act . ' ' . $title); ?>
    </header>
    <div class="panel-body">
        <?php echo form_open_multipart($url_action, array('id' => 'form')); ?>
        <?php if (!empty($gallery_dt)) { ?>
            <input type="hidden" name="gallery_id" value="<?php echo $gallery_dt->gallery_id; ?>"/>
        <?php } ?>
        <div style="margin-top: -20px" class="hidden-xs"></div>
        <div style="margin-top: -15px" class="visible-xs"></div>
        <div class='row'>
            <div class="col-md-12">
                <div class="form-group mg-t-sm">
                    <label>UPLOAD IMAGE :</label>
                    <input type="file" name="userfile"/>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="<?php echo!empty($gallery_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-upload mg-r-sm"></i> Upload</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<h4><i>Note ------</i></h4>
<hr class="divider"/>
<ul>
    <li><i class="fa fa-chevron-right mg-r-sm"></i>Allowed formats are png & jpg</li>
    <li><i class="fa fa-chevron-right mg-r-sm"></i>Please use the size of small pictures with great resolution</li>
</ul>
<script type="text/javascript">
    $(document).ready(function () {
<?php if ($permit->access_create == 0) { ?>
            $("#display-form").attr("class","col-lg-4 col-md-4 col-sm-12");    
            $("#load_main_data").attr("class","col-lg-8 col-md-8 col-sm-12");
<?php } ?>
        $(".cancel").click(function() {
<?php if ($permit->access_create == 1) { ?>
                $("#load_sub_form").load('<?php echo base_url() ?>dashboard/gallery/form');
<?php } else { ?>
                $("#display-form").attr("class","hidden");    
                $("#load_main_data").attr("class","col-xs-12");  
<?php } ?>
        });
    });

</script>