<div class="panel-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive no-border">
                <table class="table table-bordered table-striped datatable">
                    <thead class="bg-dark" style="color: white;">
                        <tr>
                            <th class="text-center" style="min-width: 50px">No</th>
                            <th class="text-center" style="min-width: 100px">Username</th>
                            <th class="text-center" style="min-width: 100px">Employee</th>
                            <th class="text-center" style="min-width: 100px">NIK</th>
                            <th class="text-center" style="min-width: 100px">Registered</th>
                            <?php if ($permit->access_special == 1) { ?>
                                <th class="text-center" style="min-width: 100px">Status</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($show as $x => $row) {
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $no ?></td>
                                <td><?php echo ucwords($row->users_username) ?></td>
                                <td><?php echo ucwords($row->employee_name) ?></td>
                                <td class="text-center"><?php echo $row->employee_nik ?></td>
                                <td class="text-center"><?php echo indo_date($row->users_registered, 1, 1) ?></td>
                                <?php if ($permit->access_special == 1) { ?>
                                    <td class="text-center">
                                        <?php if ($row->users_status == 1) { ?>
                                            <a role='button' onclick="stsUsers('<?php echo md5($row->users_id) ?>', 2)" title='Nonaktifkan'><i class='fa fa-check text-success'></i></a>
                                        <?php } else { ?>
                                            <a role='button' onclick="stsUsers('<?php echo md5($row->users_id) ?>', 1)" title='aktifkan'><i class='fa fa-times text-danger'></i></a>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i> Privilege <b><?php echo strtoupper($detail->users_position_name) ?></b>');
<?php if ($permit->access_special == 1) { ?>
        function stsUsers(id, status) {
            $(this).each(function() {
                bootbox.confirm("Are you going to change the user status ?", function(result) {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>dashboard/users/status/" + id + "/" + status,
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    $("#modal-contents").load("detail/users/<?php echo md5($detail->users_position_id) ?>");
                                }
                            }
                        });
                    }
                });
            });
        }
<?php } ?>
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
