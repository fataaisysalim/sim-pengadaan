<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="row">
    <?php if ($permit->access_read == 1) { ?>
        <div id="dataMod" class="col-xs-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Modul</label>
                        <select name="mod_info" onchange="loadModules()" class="form-control" data-style="btn-white" data-placeholder="Choose Modul to display">
                            <?php foreach ($modul as $x => $mod) { ?>
                                <option value="<?php echo md5($mod->modul_id); ?>"><?php echo strtoupper($mod->modul_name); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <?php if (in_array(1, array($permit->access_create, $permit->access_update))) { ?>
                    <div class="col-md-6" id="neForm">
                        <div class="hidden-xs" style="margin-top: 23px"></div>
                        <?php if ($permit->access_special == 1) { ?>
                            <a href="<?php echo base_url() ?>dashboard/backup" class="btn btn-dark pull-right mg-l-sm"><i class="fa fa-cloud-download mg-r-sm"></i> Backup DB</a>
                        <?php } ?>
                        <button type="button" onclick="showForm()" class="btn btn-primary pull-right"><i class="fa fa-plus mg-r-sm"></i> New Menu</button>
                    </div>
                <?php } ?>
            </div>
            <div class="load_mod_data mg-t-md"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div>
        </div>
    <?php } ?>
    <?php if (in_array(1, array($permit->access_create, $permit->access_update))) { ?>
        <div id="load_mod_form" class="hidden"><div class="loader mg-t"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div></div>
    <?php } ?>
</div>
<script type="text/javascript">
<?php if ($permit->access_read == 1) { ?>
        $(".load_mod_data").load("<?php echo base_url() ?>dashboard/menu/table/"+ $("select[name=mod_info] option:selected").val());
<?php } ?>
<?php if (in_array(1, array($permit->access_create, $permit->access_update))) { ?>
        function showForm(){
            $("#neForm").attr("class","hidden");
            $("#dataMod").attr("class","col-lg-8 col-md-8 col-sm-12");
            $("#load_mod_form").removeAttr("class");
            $("#load_mod_form").load('<?php echo base_url() ?>dashboard/menu/form');
        }
<?php } ?>
<?php if ($permit->access_read == 1) { ?>
        function loadModules(){
            $(".load_mod_data").load("<?php echo base_url() ?>dashboard/menu/table/"+ $("select[name=mod_info] option:selected").val());    
        }
<?php } ?>
</script>
