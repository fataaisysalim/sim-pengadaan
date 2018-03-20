<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-warning ">
    <header class="panel-heading lead">
        <i class="fa fa-th-large mg-r-sm"></i> Data Position Available
        <?php if (in_array(1, array($permit->access_create, $permit->access_update))) { ?>
            <a role="button" onclick="showForm()" style="margin-top: 2px" class="btn btn-md btn-dark pull-right"><i class=" fa fa-plus mg-r-sm"></i>New Position</a>
        <?php } ?>
    </header>
    <div class="panel-body">
        <div class="table-responsive no-border">
            <table class="table table-bordered table-striped datatable">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="min-width: 50px">No</th>
                        <th class="text-center" style="min-width: 150px">Position</th>
                        <th class="text-center" style="min-width: 100px">Menu Activated</th>
                        <th class="text-center" style="min-width: 100px">Users Activated</th>
                        <?php if ($permit->access_special == 1) { ?>
                            <th class="text-center" style="min-width: 100px">Status</th>
                        <?php } ?>
                        <th class="text-center" style="width: 150px"><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($show as $x => $row) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no ?></td>
                            <td><?php echo strtoupper($row->users_position_name) ?></td>
                            <td class="text-center"><?php echo $row->menu_available ?></td>
                            <td class="text-center"><?php echo $row->check_users ?></td>
                            <?php if ($permit->access_special == 1) { ?>
                                <td class="text-center">
                                    <?php if ($row->users_position_status == 1) { ?>
                                        <a role='button' onclick="statusUs('<?php echo md5($row->users_position_id) ?>', 2)" title='Nonaktifkan'><i class='fa fa-check text-success'></i></a>
                                    <?php } else { ?>
                                        <a role='button' onclick="statusUs('<?php echo md5($row->users_position_id) ?>', 1)" title='aktifkan'><i class='fa fa-times text-danger'></i></a>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified">
                                    <a <?php echo $row->menu_available == 0 ? "disabled" : null ?> onclick="detailAccess('<?php echo md5($row->users_position_id); ?>')" data-toggle="modal" data-target=".bs-modal-lg" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></a>
                                    <a <?php echo $row->check_users == 0 ? "disabled" : null ?> onclick="usersUsed('<?php echo md5($row->users_position_id); ?>')" data-toggle="modal" data-target=".bs-modal-lg" class="btn btn-xs btn-dark"><i class="fa fa-users"></i></a>
                                    <?php if ($permit->access_update == 1) { ?>
                                        <a onclick="editPosition('<?php echo md5($row->users_position_id); ?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                    <?php } ?>
                                    <?php if ($permit->access_delete == 1) { ?>
                                        <a <?php echo $row->check_users > 0 ? "disabled" : null ?> onclick="removePosition('<?php echo md5($row->users_position_id); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                        <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <b>Note :</b>
            <div class="row mg-t-md">
                <div class="col-sm-3 col-md-3 col-xs-4">
                    <i class="fa fa-search mg-r-md btn btn-sm btn-primary" disabled></i> Detail
                </div>
                <div class="col-sm-3 col-md-3 col-xs-4">
                    <i class="fa fa-users mg-r-md btn btn-sm btn-dark" disabled></i> Users
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
        function removePosition(id) {
            $(this).each(function() {
                bootbox.confirm("Are you going to remove position ?", function(result) {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>dashboard/menu_access/delete/" + id,
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    $(".load_access_data").load("<?php echo base_url() ?>dashboard/menu_access/table");
                                }
                            }
                        });
                    }
                });
            });
        }
<?php } ?>
    function detailAccess(id){
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-contents").html("");
        $("#modal-contents").load("<?php echo base_url()?>dashboard/menu_access/detail/group/"+id);
    }
    function usersUsed(id){
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-contents").html("");
        $("#modal-contents").load("<?php echo base_url()?>dashboard/menu_access/detail/users/"+id);
    }
<?php if ($permit->access_special == 1) { ?>
        function statusUs(id, status) {
            $(this).each(function() {
                bootbox.confirm("Are you going to change the position status ?", function(result) {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>dashboard/menu_access/status/" + id + "/" + status,
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    $(".load_access_data").load("<?php echo base_url() ?>dashboard/menu_access/table");    
                                }
                            }
                        });
                    }
                });
            });
        }
<?php } ?>
<?php if ($permit->access_update == 1) { ?>
        function editPosition(id) {
            $(".load_access_data").load('<?php echo base_url() ?>dashboard/menu_access/form/'+id);
        }
<?php } ?>

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
