<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-warning">
    <header class="panel-heading lead">
        <i class="fa fa-th-large mg-r-sm"></i> Data Employee
    </header>
    <div class="panel-body">
        <div style="margin-top: -20px" class="hidden-xs"></div>
        <div style="margin-top: -15px" class="visible-xs"></div>
        <div class="table-responsive no-border">
            <table class="table table-bordered table-striped datatable">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="min-width: 60px">No.</th>
                        <th class="text-center" style="min-width: 100px">NIK</th>
                        <th class="text-center" style="min-width: 200px">Employee Name</th>
                        <th class="text-center" style="min-width: 150px">Telephone</th>
                        <th class="text-center" style="min-width: 150px">Email</th>
                        <th class="text-center" style="min-width: 120px"><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($show as $i => $row) { ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td><?php echo $row->employee_nik; ?></td>
                            <td><?php echo ucwords($row->employee_name); ?></td>
                            <td><?php echo $row->employee_phone; ?></td>
                            <td><?php echo $row->employee_email; ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified">
                                    <a data-toggle="modal" data-target=".bs-modal-lg" onclick="detail('<?php echo md5($row->employee_id); ?>')" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></a>
                                    <?php if ($permit->access_update == 1) { ?>
                                        <a onclick="edit('<?php echo md5($row->employee_id); ?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                    <?php } ?>
                                    <?php if ($permit->access_delete == 1) { ?>
                                        <a <?php echo $row->child > 0 ? "disabled" : NULL; ?> onclick="erase('<?php echo md5($row->employee_id); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
                <div class="col-sm-3 col-md-3 col-xs-4">
                    <i class="fa fa-search mg-r-md btn btn-sm btn-primary" disabled></i> Detail
                </div>
                <?php if ($permit->access_update == 1) { ?>
                    <div class="col-sm-3 col-md-3 col-xs-4">
                        <i class="fa fa-edit mg-r-md btn btn-sm btn-warning" disabled></i> Edit
                    </div>
                <?php } ?>
                <?php if ($permit->access_delete == 1) { ?>
                    <div class="col-sm-3 col-md-3 col-xs-4">
                        <i class="fa fa-trash-o mg-r-md btn btn-sm btn-danger" disabled></i> Delete
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
<?php if ($permit->access_delete == 1) { ?>
            function erase(id) {
                $(this).each(function() {
                    bootbox.confirm("Are you going to remove employees ?", function(result) {
                        if (result == true) {
                            $.ajax({
                                url: "<?php echo base_url() ?>dashboard/employee/delete/" + id,
                                dataType: "JSON",
                                success: function(json) {
                                    if (json.status == 1) {
                                        $("#load_main_data").load('<?php echo base_url() ?>dashboard/employee/table');
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
                $("#load_sub_form").load("<?php echo base_url() ?>dashboard/employee/form/" + id);
            }
<?php } ?>
        function detail(id) {
            $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
            $("#modal-contents").html('');
            $("#modal-contents").load("<?php echo base_url() ?>dashboard/employee/detail/" + id);
        }

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
