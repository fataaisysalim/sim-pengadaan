<div class="row">
    <div class="loadertabs col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-warning">
    <header class="panel-heading lead">
        <i class="fa fa-th-large"></i> DATA <?php echo strtoupper($title); ?>
    </header>
    <div class="panel-body">
        <div class="table-responsive no-border" style="margin-top: -20px">
            <table class="table table-bordered table-striped datatable">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="width: 80px;">NO.</th>
                        <th class="text-center" style="width: 163px;">CATEGORY</th>
                        <th class="text-center" style="width: 160px;">TAX</th>
                        <th class="text-center" style="width: 130px;">PERCENTAGE</th>
                        <th class="text-center" style="width: 50px;"><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($show as $i => $row) { ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td><?php echo strtoupper($row->tax_ct_name); ?></td>
                            <td><?php echo strtoupper($row->tax_name); ?> <?php echo strtoupper($row->tax_mode_name); ?></td>
                            <td class="text-center"><?php echo!empty($row->tax_cuts) ? strtoupper($row->tax_cuts) . ' %' : "<center>-</center>"; ?></td>
                            <td class="text-center" style="width: 50px;">
                                <div class="btn-group btn-group-justified">
                                    <?php if ($permit->access_update == 1) { ?>
                                        <a onclick="edit('<?php echo md5($row->tax_id); ?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-12">
                <b>NOTE :</b>
                <div class="row mg-t-md">
                    <div class="col-sm-3 col-md-3">
                        <i class="fa fa-edit mg-r-md btn btn-sm btn-warning" disabled></i> EDIT
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(".loadertab").hide();
<?php if ($permit->access_delete == 1) { ?>
        function erase(id) {
            $(this).each(function () {
                bootbox.confirm("Are you going to remove the tax ?", function (result) {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>finance/tax/delete/" + id,
                            dataType: "JSON",
                            success: function (json) {
                                if (json.status == 1) {
                                    $(".load_main_data").load('<?php echo base_url() ?>finance/tax/table');
                                    $("#load_sub_form").load('<?php echo base_url() ?>finance/tax/form');
                                }
                            }
                        });
                    }
                });
            });
        }
<?php } ?>
<?php if ($permit->access_update == 1) { ?>
        function edit(id) {
            $("#show_data").removeAttr("class");
            $("#show_data").attr("class","col-lg-8 col-md-8 col-sm-8 load_main_data");
            $("#load_sub_form").load("<?php echo base_url() ?>finance/tax/form/" + id);
        }
<?php } ?>
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
