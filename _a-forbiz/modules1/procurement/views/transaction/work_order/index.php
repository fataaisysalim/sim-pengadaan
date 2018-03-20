<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="row">
    <?php if (in_array(1, array($permit->access_create, $permit->access_update))) { ?>
        <div class="col-lg-4 col-md-5 col-sm-5 ">
            <div class="load_main_form"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div>
        </div>
    <?php } ?>
    <?php if ($permit->access_read == 1) { ?>
        <div class="col-lg-8 col-md-7 col-sm-7 ">
            <section class="panel panel-info">
                <header class="panel-heading lead">
                    <i class='fa fa-edit mg-r-sm'></i> Data Work Order
                </header>
                <div class="panel-body ">
                    <div class="row">
                        <div style="margin-top: -20px" class="col-xs-12">
                            <?php echo form_open("", array('id' => "formWO")); ?>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="">Project :</label>
                                    <select id="project" name="projectm" class="projectm_ form-control form-select2  mg-t-xs" data-style="btn-white">
                                        <?php foreach ($project as $i => $pro) : ?>
                                            <option value="<?php echo md5($pro->project_id); ?>"><?php echo ucwords($pro->project_name); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="row">
                                    <label>WO Date :</label>
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="input-group input-append date datepicker" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                                <input type="text" class="form-control startRent" name="start" value="<?php echo date('d-m-Y') ?>">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-white add-on" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-xs-1"><b style="font-size: 20px; padding-top: 120px">-</b></div>
                                        <div class="col-xs-5">
                                            <div class="input-group input-append date datepicker" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                                <input type="text" class="form-control endRent" name="end" value="<?php echo date('d-m-Y') ?>">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-white add-on" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-12">
                                <button type="submit" class="btn btn-md btn-primary" style="margin-top: 28px"><i class="fa fa-search mg-r-sm"></i>Search</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <hr class="divider" style="padding: 0px; margin: 15px 0px 10px 0px"/>
                    <div class="load_main_data row"><div class="col-xs-12"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div></div> 
                </div>
            </section>
        </div>
    <?php } ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".datepicker").datepicker();
    });
<?php if (in_array(1, array($permit->access_create, $permit->access_update))) { ?>
        $(".load_main_form").load("<?php echo base_url() ?>procurement/work-order/form");
<?php } ?>
<?php if ($permit->access_read == 1) { ?>
        $(".load_main_data").load('<?php echo base_url() ?>procurement/work-order/table/'+$('input[name=start]').val()+"/"+$('input[name=end]').val()+"/"+$('select[name=projectm] option:selected').val());
        $("#formWO").submit(function() {
            $(".load_main_data").load('<?php echo base_url() ?>procurement/work-order/table/'+$('input[name=start]').val()+"/"+$('input[name=end]').val()+"/"+$('select[name=projectm] option:selected').val());
            return false;
        });
<?php } ?>
</script>

