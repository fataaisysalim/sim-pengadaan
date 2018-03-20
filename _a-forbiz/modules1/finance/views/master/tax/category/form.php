<div class="saving_ct"></div>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-plus mg-r-sm'></i> <?php echo $act . ' ' . $title; ?>
    </header>
    <div class="panel-body">
        <?php echo form_open_multipart($url_action, array('id' => 'form_ct')); ?>
        <?php if (!empty($tax_ct_dt)) { ?>
            <input type="hidden" name="tax_ct_id" value="<?php echo $tax_ct_dt->tax_ct_id; ?>"/>
        <?php } ?>
        <input type="hidden" name="action" value="<?php echo md5($act); ?>"/>
        <div class="row" style="margin-top: -20px">
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="tax_ct_name" value="<?php echo empty($tax_ct_dt) ? set_value('tax_ct_name') : $tax_ct_dt->tax_ct_name; ?>" class="form-control" placeholder="Equipment Category">
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="<?php echo!empty($tax_ct_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
            </div>
            <?php if (!empty($tax_ct_dt)) { ?>
                <div class="<?php echo!empty($tax_ct_dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a role="button" style="cursor: pointer" class="cancel_ct btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            <?php } ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $(".cancel_ct").click(function() {
            $(".ctform").load("<?php echo base_url() ?>finance/tax/category/form/");
        });
        $("#form_ct").submit(function() {
            if ($("input[name=tax_ct_name").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Nama kateori peralatan tidak boleh kosong");
                $("input[name=tax_ct_name").focus();
                return false;
            }

            $(".saving_ct").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
            $.ajax({
                url: $("#form_ct").attr('action'),
                data: $("#form_ct").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 0) {
                        $(".saving_ct").html(json.msg);
                    } else {
                        $(".saving").html('');
                        $("#modal-contents").load('<?php echo base_url() ?>finance/tax/category/');
                        $("#load_sub_form").load('<?php echo base_url() ?>finance/tax/form');
                    }
                }
            });
            return false;
        });
    });

</script>