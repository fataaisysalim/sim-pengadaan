<div class="row">
    <div class="loadertabs col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-warning">
    <header class="panel-heading lead">
        <i class="fa fa-th-large"></i> Data <?php echo $title; ?>
    </header>
    <div class="panel-body">
        <div class="table-responsive no-border" style="margin-top: -20px">
            <table class="table table-bordered table-striped datatable">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="width: 80px">No.</th>
                        <th class="text-center" style="width: 153px">Category</th>
                        <th class="text-center" style="width: 130px">Equipment</th>
                        <th class="text-center" style="width: 120px">Type</th>
                        <th class="text-center" style="width: 80px">Unit</th>
                        <th class="text-center" style="width: 100px"><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($show as $i => $row) { ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td><?php echo ucwords($row->equipment_ct_name); ?></td>
                            <td><?php echo ucwords($row->equipment_name); ?></td>
                            <td><?php echo!empty($row->equipment_type) ? ucwords($row->equipment_type) : "<center>-</center>"; ?></td>
                            <td><?php echo ucwords($row->equipment_unit_name); ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified">
                                    <?php if ($permit->access_update == 1) { ?>
                                        <a onclick="edit('<?php echo md5($row->equipment_id); ?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                    <?php } ?>
                                    <?php if ($permit->access_delete == 1) { ?>
                                        <a <?php echo $row->child > 0 ? "disabled" : NULL; ?> onclick="erase('<?php echo md5($row->equipment_id); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <b>Note :</b>
            <div class="row mg-t-md">
                <?php if ($permit->access_update == 1) { ?>
                    <div class="col-sm-3 col-md-3">
                        <i class="fa fa-edit mg-r-md btn btn-sm btn-warning" disabled></i> Edit
                    </div>
                <?php } ?>
                <?php if ($permit->access_delete == 1) { ?>
                    <div class="col-sm-3 col-md-3">
                        <i class="fa fa-trash-o mg-r-md btn btn-sm btn-danger" disabled></i> Delete
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(".loadertab").hide();
<?php if ($permit->access_delete == 1) { ?>
        function erase(id) {
            $(this).each(function() {
                bootbox.confirm("Are you going to remove the  <?php echo $header; ?> ?", function(result) {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>warehouse/equipment/delete/" + id,
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    $("#load_main_data").load('<?php echo base_url() ?>warehouse/equipment/table');
                                    $("#load_sub_form").load('<?php echo base_url() ?>warehouse/equipment/form');
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
            $("#load_sub_form").load("<?php echo base_url() ?>warehouse/equipment/form/" + id);
        }
<?php } ?>

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
