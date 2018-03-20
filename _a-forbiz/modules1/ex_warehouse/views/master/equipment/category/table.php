<div class="panel-body">
    <div>
        <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('message_ct') ?></div>
    </div>
    <?php if (in_array(1, array($permit->access_create, $permit->access_update))) { ?>
        <div id="ctform" class="col-xs-4"></div>
    <?php } ?>
    <div id="ctable" class="col-sm-8">
        <div class="table-responsive no-border">
            <table class="table table-bordered table-striped datatable">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="width: 90px">No.</th>
                        <th class="text-center" style="width: 170px">Equipment Category</th>
                        <th class="text-center" style="width: 90px"><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($show as $i => $row) { ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td><?php echo $row->equipment_ct_name; ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified">
                                    <?php if ($permit->access_update == 1) { ?>
                                        <a onclick="edit('<?php echo md5($row->equipment_ct_id); ?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                    <?php } ?>
                                    <?php if ($permit->access_delete == 1) { ?>
                                        <a <?php echo $row->child > 0 ? "disabled" : NULL; ?> onclick="erase('<?php echo md5($row->equipment_ct_id); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i>Data Equipment Category');
<?php if ($permit->access_create == 1) { ?>
        $("#ctform").load("<?php echo base_url() ?>warehouse/equipment/category/form/");
<?php } else { ?>
        $("#ctable").attr("class","col-xs-12");
        $("#ctform").attr("class","hidden");    
<?php } ?>
<?php if ($permit->access_delete == 1) { ?>
        function erase(id) {
            $(this).each(function() {
                bootbox.confirm("Are you going to remove the equipment category ?", function(result) {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>warehouse/equipment/category/delete/" + id,
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
    <?php if ($permit->access_create == 1) { ?>
                                            $("#load_sub_form").load('<?php echo base_url() ?>warehouse/equipment/form');            
    <?php } ?>
                                        $("#modal-contents").load('<?php echo base_url() ?>warehouse/equipment/category');
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
            $("#ctform").load("<?php echo base_url() ?>warehouse/equipment/category/form/" + id);
        }
<?php } ?>
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
