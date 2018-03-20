<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div>
    <div class="row">
        <?php echo form_open("", array('id' => "forms")); ?>
        <div class="col-sm-3 col-xs-12">
            <div class="form-group">
                <label>PROJECT</label>
                <select id="projectapg" name="projectapg" class="form-control form-select2" data-style="btn-white">
                    <?php foreach ($project as $i => $pro) : ?>
                        <option value="<?php echo md5($pro->project_id); ?>"><?php echo strtoupper($pro->project_name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br style="margin-bottom: 15px" class="visible-xs"/>
        </div>
        <div class="col-sm-5 col-xs-12">
            <label>DATA DATE :</label>
            <div class="row">
                <div col-xs-12>
                    <div>
                        <div class="col-xs-5">
                            <div class="input-group input-append date datepickers" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                <input type="text" class="form-control startas" name="start" value="<?php echo date('d-m-Y') ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-white add-on" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-1"><b style="font-size: 20px; padding-top: 120px">-</b></div>
                        <div class="col-xs-5">
                            <div class="input-group input-append date datepickers" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                <input type="text" class="form-control endas" name="end" value="<?php echo date('d-m-Y') ?>">
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
        </div>
        <div class="col-sm-2 col-xs-12">
            <br style="margin-top: 5px"/>
            <button type="submit" <?php echo $permit->access_read == 0 ? "disabled" : null ?> class="btn btn-md btn-primary col-xs-12" ><i class="fa fa-search mg-r-sm"></i>Search</button>
        </div>
        <?php echo form_close(); ?>
        <?php if ($permit->access_read == 1) { ?>
            <div class="col-sm-2 col-xs-6 hidden-xs">
                <br style="margin-top: 5px"/>
                <a onclick="onExport();" role="button" class="btn btn-md btn-dark col-xs-12"><i class="fa fa-download mg-r-sm"></i>Export</a>
            </div>
        <?php } ?>
    </div>
    <hr class="divider" style="padding: 0px; margin: 15px 0px 10px 0px"/>
</div>
<?php if ($permit->access_read == 1) { ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 load_main_data"><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</div>
    </div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".datepickers").datepicker();
        $("select.form-select2").select2();
<?php if ($permit->access_read == 1) { ?>
            $(".load_main_data").load("<?php echo base_url() ?>warehouse/apg/table/" + $("select[name=projectapg] option:selected").val() + "/" + $('.startas').val() + "/" + $('.endas').val());
<?php } ?>
    });
<?php if ($permit->access_read == 1) { ?>
        $("#forms").submit(function() {
            var starts = $('.startas').val();
            var ends = $('.endas').val();
            var project = $("select[name=projectapg] option:selected").val();
            $(".load_main_data").load("<?php echo base_url() ?>warehouse/apg/table/" + project + "/" + starts + "/" + ends);
            return false;
        });

        function onExport() {
            var starts = $('.startas').val();
            var ends = $('.endas').val();
            var project = $("select[name=projectapg] option:selected").val();

            window.open("<?php echo base_url('warehouse/export/apg'); ?>" + '/' + project + '/' + starts + '/' + ends);
        }
<?php } ?>
</script>
