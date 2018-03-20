<div class="row">
    <div class="loadertabs col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-warning">
    <header class="panel-heading lead">
        <i class="fa fa-th-large mg-r-sm"></i> Data Document Code
    </header>
    <div class="panel-body">
        <div class="table-responsive no-border" style="margin-top: -20px">
            <table class="table table-bordered table-striped datatable">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="min-width: 60px">No.</th>
                        <th class="text-center" style="min-width: 180px">Code Name</th>
                        <th class="text-center" style="min-width: 150px">Code Number</th>
                        <th class="text-center" style="width: 100px"><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($show as $i => $row) { ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td><?php echo ucwords($row->doc_control_letcode_name); ?></td>
                            <td class="text-center"><?php echo $row->doc_control_letcode_number; ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified">
                                    <?php if ($permit->access_update == 1) { ?>
                                        <a onclick="edit('<?php echo md5($row->doc_control_letcode_id); ?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                    <?php } ?>
                                    <?php if ($permit->access_delete == 1) { ?>
                                        <a <?php echo $row->child > 0 ? "disabled" : NULL; ?> onclick="erase('<?php echo md5($row->doc_control_letcode_id); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
                    <div class="col-sm-3 col-md-3 col-xs-6">
                        <i class="fa fa-edit mg-r-md btn btn-sm btn-warning" disabled></i> Edit
                    </div>
                <?php } ?>
                <?php if ($permit->access_delete == 1) { ?>
                    <div class="col-sm-3 col-md-3 col-xs-6">
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
                bootbox.confirm("Are you going to remove document code ?", function(result) {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>secretariat/doc-code/delete/" + id,
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    $("#load_main_data").load('<?php echo base_url() ?>secretariat/doc-code/table');
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
            $("#load_sub_form").load("<?php echo base_url() ?>secretariat/doc-code/form/" + id);
        }
<?php } ?>

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
