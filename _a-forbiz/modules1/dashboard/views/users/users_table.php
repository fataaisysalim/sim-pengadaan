<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-warning">
    <header class="panel-heading lead">
        <i class="fa fa-th-large mg-r-sm"></i> Data Users System
    </header>
    <div class="panel-body">
        <div class="table-responsive no-border" style="margin-top: -20px">
            <table class="table table-bordered table-striped datatable">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="min-width: 60px">No.</th>
                        <th class="text-center" style="min-width: 100px">Username</th>
                        <th class="text-center" style="min-width: 130px">Employee</th>
                        <th class="text-center" style="min-width: 100px">Position</th>
                        <th class="text-center" style="min-width: 150px">Registered</th>
                        <?php if ($permit->access_special == 1) { ?>
                            <th class="text-center" style="min-width: 90px">Status</th>
                        <?php } ?>
                        <th class="text-center" style="min-width: 130px"><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($show as $i => $row) { ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td><?php echo $row->users_username; ?></td>
                            <td><?php echo $row->employee_name; ?></td>
                            <td><?php echo $row->users_position_name; ?></td>
                            <td><?php echo indo_date($row->users_registered, 1, 1); ?></td>
                            <?php if ($permit->access_special == 1) { ?>
                                <td class="text-center">
                                    <?php if ($row->users_status == 1) { ?>
                                        <?php if (md5($row->users_id) != $sess['users_id']) { ?>
                                            <a role='button' onclick="statusUs('<?php echo md5($row->users_id) ?>', 2)" title='Nonaktifkan'><i class='fa fa-check text-success'></i></a>
                                        <?php } else { ?>
                                            <i class='fa fa-check text-success'></i>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <a role='button' onclick="statusUs('<?php echo md5($row->users_id) ?>', 1)" title='aktifkan'><i class='fa fa-times text-danger'></i></a>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified">
                                    <?php if ($permit->access_special == 1) { ?>
                                        <a onclick="reset('<?php echo md5($row->users_id); ?>')" class="btn btn-xs btn-dark" <?php echo md5($row->users_id) == $sess['users_id'] ? "disabled" : null ?>><i class="fa fa-refresh"></i></a>
                                    <?php } ?>
                                    <?php if ($permit->access_update == 1) { ?>
                                        <a onclick="edit('<?php echo md5($row->users_id); ?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                    <?php } ?>
                                    <?php if ($permit->access_delete == 1) { ?>
                                        <a <?php echo $row->child1 > 0 || $row->child2 > 0 || $row->child3 > 0 ? "disabled" : NULL; ?> onclick="erase('<?php echo md5($row->users_id); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
                <?php if ($permit->access_special == 1) { ?>
                    <div class="col-sm-3 col-md-3 col-xs-4">
                        <i class="fa fa-refresh mg-r-md btn btn-sm btn-dark" disabled></i> Reset
                    </div>
                <?php } ?>
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
                bootbox.confirm("Are you going to remove user ?", function(result) {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>dashboard/users/delete/" + id,
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    $("#load_main_data").load('<?php echo base_url() ?>dashboard/users/table');
                                }
                            }
                        });
                    }
                });
            });
        }
<?php } ?>
<?php if ($permit->access_special == 1) { ?>
        function statusUs(id, status) {
            $(this).each(function() {
                bootbox.confirm("Are you going to change the user status ?", function(result) {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>dashboard/users/status/" + id + "/" + status,
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    $("#load_main_data").load("<?php echo base_url() ?>dashboard/users/table");
                                }
                            }
                        });
                    }
                });
            });
        }
<?php } ?>
<?php if ($permit->access_special == 1) { ?>
        function reset(id) {
            $(this).each(function() {
                bootbox.confirm("Are you going to reset the password ?", function(result) {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>dashboard/users/reset/" + id,
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    bootbox.confirm("Password Reset : <b>wika<?php echo date("Hi") ?></b>", function(result) {
                                        $("#load_main_data").load('<?php echo base_url() ?>dashboard/users/table');
                                    });
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
            $("#load_sub_form").load("<?php echo base_url() ?>dashboard/users/form/" + id);
        }
<?php } ?>
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
