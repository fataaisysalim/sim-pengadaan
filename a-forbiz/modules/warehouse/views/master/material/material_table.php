<div class="panel-body">
    <?php if (in_array(1, array($permit->access_create, $permit->access_update))) { ?>
        <div id="mtform" class="col-xs-4"></div>
    <?php } ?>
    <div id="mtable" class="col-xs-8">
        <div class="row">
            <div class="loadertab_mt col-xs-12"><?php echo $this->session->flashdata('message_m') ?></div>
        </div>
        <div class="table-responsive no-border">
            <table class="table table-bordered table-striped datatable" style="min-width: 450px;">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="width: 60px">No.</th>
                        <th class="text-center" style="width: 150px">Category</th>
                        <th class="text-center" style="width: 170px">Material Type Name</th>
                        <th class="text-center" style="width: 90px">Code</th>
                        <th class="text-center" style="width: 90px"><i class="fa fa-gear"></i></th>
                </thead>
                <tbody>
                    <?php foreach ($material as $i => $row) { ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td><?php echo strtoupper($row->material_category_name); ?></td>
                            <td><?php echo strtoupper($row->material_name); ?></td>
                            <td><?php echo strtoupper($row->material_code); ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified">
                                    <?php if ($permit->access_update == 1) { ?>
                                        <a onclick="edit_mt('<?php echo md5($row->material_id); ?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                    <?php } ?>
                                    <?php if ($permit->access_delete == 1) { ?>
                                        <a <?php echo $row->child > 0 ? "disabled" : NULL; ?> onclick="erase_mt('<?php echo md5($row->material_id); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
                    <div class="col-xs-4">
                        <i class="fa fa-edit mg-r-md btn btn-sm btn-warning" disabled></i> Edit
                    </div>
                <?php } ?>
                <?php if ($permit->access_delete == 1) { ?>
                    <div class="col-xs-4">
                        <i class="fa fa-trash-o mg-r-md btn btn-sm btn-danger" disabled></i> Delete
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i>DATA MATERIAL TYPE');
    <?php if ($permit->access_create == 1) { ?>
        $("#mtform").load("<?php echo base_url() ?>warehouse/material/form/material");
<?php } else { ?>
        $("#mtable").attr("class","col-xs-12");
        $("#mtform").attr("class","hidden");    
<?php } ?>
<?php if ($permit->access_delete == 1) { ?>
        function erase_mt(id) {
            $(this).each(function() {
                bootbox.confirm("Are you going to remove the material type ?", function(result) {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>warehouse/material/delete/<?php echo md5('material'); ?>/" + id,
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    $("#modal-contents").load('<?php echo base_url() ?>warehouse/material/table/material');
                                }
                            }
                        });
                    }
                });
            });
        }
<?php } ?>
<?php if ($permit->access_update == 1) { ?>
        function edit_mt(id) {
            $("#mtform").load("<?php echo base_url() ?>warehouse/material/form/material/" + id);
        }
<?php } ?>

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
