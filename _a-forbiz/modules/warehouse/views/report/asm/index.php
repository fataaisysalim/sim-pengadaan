<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div>
    <div class="row">
        <?php echo form_open("", array('id' => "forms")); ?>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                <label>PROJECT :</label>
                <select id="project" name="project" class="form-control form-select2" data-style="btn-white">
                    <?php foreach ($project as $i => $pro) : ?>
                        <option value="<?php echo md5($pro->project_id); ?>"><?php echo strtoupper($pro->project_name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mg-b-sm"></div>
        </div>
        <div class="col-sm-2 col-xs-12">
            <div style="margin-top: 24px;" class="hidden-xs"></div>
            <button type="submit" <?php echo $permit->access_read == 0 ? "disabled" : null ?> class="btn btn-md btn-primary col-xs-12"><i class="fa fa-search mg-r-sm"></i> SEARCH</button>
        </div>
        <?php echo form_close(); ?>
        <?php if ($permit->access_read == 1) { ?>
            <div class="col-sm-3 col-xs-6 hidden-xs">
                <div style="margin-top: 24px;" class="hidden-xs"></div>
                <a onclick="onExport()" role="button" class="btn btn-md btn-dark col-xs-12"><i class="fa fa-download mg-r-sm"></i> EXCEL</a>
            </div>
        <?php } ?>
    </div>
    <hr class="divider" style="padding: 0px; margin: 15px 0px 10px 0px"/>
</div>
<?php if ($permit->access_read == 1) { ?>
    <div class="row">
        <div class="col-lg-12 col-md-8 col-sm-12 load_main_data"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div>
    </div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".datepickers").datepicker();
        $("select.form-select2").select2();
<?php if ($permit->access_read == 1) { ?>
            $(".load_main_data").load("<?php echo base_url() ?>warehouse/asm/table/"+$("select[name=project] option:selected").val());
<?php } ?>
    });
<?php if ($permit->access_read == 1) { ?>
        $("#forms").submit(function() {
            var project = $("select[name=project] option:selected").val();
            $(".load_main_data").load("<?php echo base_url() ?>warehouse/asm/table/" + project);
            return false;
        });
                        
        function onExport() {
            var project = $("select[name=project] option:selected").val();
            window.open("<?php echo base_url('warehouse/export/asm'); ?>" + '/' + project);
        }
<?php } ?>
</script>
