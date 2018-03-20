<div class="saving"></div>
<section class="panel panel-info">
    <header class="panel-heading lead"><i class='fa fa-plus mg-r-sm'></i> <?php echo strtoupper($act . ' ' . $header); ?></header>
    <div class="panel-body">
        <?php echo form_open($url_action, array('id' => 'forms')); ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <?php if (!empty($tax_dt)) { ?>
            <input type="hidden" name="tax_id" value="<?php echo $tax_dt->tax_id ?>"/>
        <?php } ?>
        <div class="row" style="margin-top: -20px">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label>TAX NAME</label>
                    <input type="text" readonly="" name="tax_name" value="<?php echo empty($tax_dt) ? set_value('tax_name') : $tax_dt->tax_name; ?>" class="form-control" placeholder="Tax Name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>TAX MODE</label>
                    <select readonly="" name="tax_mode" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Mode">
                        <option value=""></option>
                        <?php foreach ($tax_mode as $mode) : ?>
                            <option value="<?php echo $mode->tax_mode_id; ?>" <?php if (!empty($tax_dt) && $mode->tax_mode_id == $tax_dt->tax_mode_id) echo "selected"; ?> <?php if ($mode->tax_mode_id == set_value('tax_mode_id')) echo "selected"; ?>><?php echo $mode->tax_mode_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

<!--            <div class="col-md-8 mg-t-sm">
                <div class="form-group">
                    <label>TAX CATEGORY</label>
                    <select readonly="" name="tax_ct" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Category">
                        <option value=""></option>
                        <?php foreach ($tax_ct as $ec) : ?>
                            <option value="<?php echo $ec->tax_ct_id; ?>" <?php if (!empty($tax_dt) && $ec->tax_ct_id == $tax_dt->tax_ct_id) echo "selected"; ?> <?php if ($ec->tax_ct_id == set_value('tax_ct_id')) echo "selected"; ?>><?php echo $ec->tax_ct_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>-->
            <div class="col-md-4 col-sm-12 col-xs-12 mg-t-sm">
                <div class="form-group">
                    <label>PERCENTAGE</label>
                    <input type="hidden" name="tax_ct" value="<?php echo !empty($tax_dt)?$tax_dt->tax_ct_id:null; ?>"/>
                    <input type="number" name="tax_cuts" value="<?php echo empty($tax_dt) ? set_value("tax_cuts") : $tax_dt->tax_cuts; ?>" class="form-control" placeholder="Tax Cuts">
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="<?php echo!empty($tax_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> SAVE</button>
            </div>
            <?php if (!empty($tax_dt)) { ?>
                <div class="<?php echo!empty($tax_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a role="button" style="cursor: pointer" class="cancel btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> CANCEL </a>
                </div>
            <?php } ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $("select.form-select2").select2();
        $(".cancel").click(function () {
            $("#show_data").removeAttr("class");
            $("#show_data").attr("class", "col-lg-12 col-md-12 col-sm-12 load_main_data");
            $("#load_sub_form").html("");
        });
        $("#forms").submit(function () {
            $(".saving").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
            $.ajax({
                url: $("#forms").attr('action'),
                data: $("#forms").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function (json) {
                    if (json.status == 0) {
                        $(".saving").html(json.msg);
                    } else {
                        $("#show_data").removeAttr("class");
                        $("#show_data").attr("class", "col-lg-12 col-md-12 col-sm-12 load_main_data");
                        //$("#load_sub_form").load('<?php echo base_url() ?>finance/tax/form');
                        $("#load_sub_form").html("");
                        $(".load_main_data").load("<?php echo base_url() ?>finance/tax/table");
                    }
                }
            });
            return false;
        });
    });

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>