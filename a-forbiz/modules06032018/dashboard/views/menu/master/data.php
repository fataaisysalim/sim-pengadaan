<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-warning ">
    <header class="panel-heading lead">
        <i class="fa fa-th-large mg-r-sm"></i> Data Menu
    </header>
    <div class="panel-body">
        <div class="table-responsive row" style="margin-top: -40px">
            <table class="table table-bordered">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th rowspan="2" class="text-center" style="min-width: 60px; vertical-align: middle">NO</th>
                        <th rowspan="2" class="text-center" style="min-width: 100px; vertical-align: middle">MENU</th>
                        <th rowspan="2" class="text-center" style="min-width: 130px; vertical-align: middle">URL</th>
                        <th colspan="5" class="text-center" style="min-width: 150px">Permission</th>
                        <?php if ($permit->access_special == 1) { ?>
                            <th rowspan="2" class="text-center" style="min-width: 90px; vertical-align: middle">Status</th>
                        <?php } ?>
                        <th rowspan="2" class="text-center" style="width: 100px; max-width: 120px; vertical-align: middle"><i class="fa fa-gear"></i></th>
                    </tr>
                    <tr>
                        <th class="text-center">Create</th>
                        <th class="text-center">Read</th>
                        <th class="text-center">Update</th>
                        <th class="text-center">Delete</th>
                        <th class="text-center">Special</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($show as $x => $row) {
                        ?>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;<?php echo $row->mod_menu_position ?></td>
                            <td><?php echo ucwords($row->mod_menu_name) ?></td>
                            <td><?php echo!empty($row->mod_menu_url) ? ucwords($row->mod_menu_url) : "#" ?></td>
                            <td class="text-center"><?php echo $row->mod_menu_create == 1 ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times text-danger'></i>" ?></td>
                            <td class="text-center"><?php echo $row->mod_menu_read == 1 ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times text-danger'></i>" ?></td>
                            <td class="text-center"><?php echo $row->mod_menu_update == 1 ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times text-danger'></i>" ?></td>
                            <td class="text-center"><?php echo $row->mod_menu_delete == 1 ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times text-danger'></i>" ?></td>
                            <td class="text-center bg-dark"><?php echo $row->mod_menu_special == 1 ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times text-danger'></i>" ?></td>
                            <?php if ($permit->access_special == 1) { ?>
                                <td class="text-center">
                                    <?php if ($row->mod_menu_status == 1) { ?>
                                        <a role='button' onclick="statusUs('<?php echo md5($row->mod_menu_id) ?>', 2)" title='Nonaktifkan'><i class='fa fa-check text-success'></i></a>
                                    <?php } else { ?>
                                        <a role='button' onclick="statusUs('<?php echo md5($row->mod_menu_id) ?>', 1)" title='aktifkan'><i class='fa fa-times text-danger'></i></a>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified">
                                    <?php if ($permit->access_update == 1) { ?>
                                        <a onclick="edit('<?php echo md5($row->mod_menu_id); ?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                    <?php } ?>
                                    <?php if ($permit->access_delete == 1) { ?>
                                        <a <?php echo $row->access != 0 ? "disabled" : null ?> onclick="erase('<?php echo md5($row->mod_menu_id); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
                bootbox.confirm("Are you going to remove menu ?", function(result) {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>dashboard/menu/delete/" + id,
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    $(".load_mod_data").load("<?php echo base_url() ?>dashboard/menu/table/"+ $("select[name=mod_info] option:selected").val());    
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
                bootbox.confirm("Are you going to change the menu status ?", function(result) {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>dashboard/menu/status/" + id + "/" + status,
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    $(".load_mod_data").load("<?php echo base_url() ?>dashboard/menu/table/"+ $("select[name=mod_info] option:selected").val());    
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
            $("#neForm").attr("class","hidden");
            $("#dataMod").attr("class","col-lg-8 col-md-8 col-sm-12");
            $("#load_mod_form").removeAttr("class");
            $("#load_mod_form").load('<?php echo base_url() ?>dashboard/menu/form/'+id);
        }
<?php } ?>
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
