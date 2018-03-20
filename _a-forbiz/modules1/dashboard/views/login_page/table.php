<div class="row">
    <div class="loadertab_ct col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-info">
    <header class="panel-heading">
        <i class='fa fa-th-large mg-r-sm'></i> <?php echo $header ?>
    </header>
    <div class="panel-body">

        <div class="table-responsive no-border">
            <table class="table table-bordered table-striped datatable">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="min-width: 60px">No.</th>
                        <th class="text-center" style="min-width: 220px">Screenshoot</th>
                        <th class="text-center" style="min-width: 220px">Template Name</th>
                        <th class="text-center" style="min-width: 150px">Status</th>
                        <th class="text-center" style="<?php echo $sess['development'] == TRUE ? "min-width: 80px" : "width: 80px" ?>"><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $i => $row) { ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td class="text-center">
                                <a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo base_url(!empty($row->page_config_picture) ? $row->page_config_picture : "assets/folarium/no-preview-available.png"); ?>">
                                    <div style="width: 100%; height: 70px; overflow: hidden">
                                        <img style="width: 100%;" src="<?php echo base_url(!empty($row->page_config_picture) ? $row->page_config_picture : "assets/folarium/no-preview-available.png"); ?>"/>
                                    </div>
                                </a>
                            </td>
                            <td><?php echo ucwords($row->page_config_name) ?></td>
                            <td class="text-center <?php echo ($row->page_config_status == 1) ? null : 'text-danger'; ?>"><i class="fa <?php echo ($row->page_config_status == 1) ? 'fa-check' : 'fa-minus-circle'; ?> mg-r-sm"></i><?php echo ($row->page_config_status == 1) ? 'SHOW' : 'NOT SHOW'; ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified">
                                    <?php if ($permit->access_special == 1) { ?>
                                        <?php if ($row->page_config_status == 0) : ?>
                                            <a onclick="status('<?php echo md5($row->page_config_id); ?>', 'active')" class="btn btn-xs btn-primary"><i class="fa fa-check"></i></a>
                                        <?php endif; ?>
                                    <?php } ?>
                                    <?php if ($sess['development'] == TRUE) { ?>
                                        <?php if ($permit->access_update == 1) { ?>
                                            <a onclick="edit('<?php echo md5($row->page_config_id); ?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                        <?php } ?>
                                        <?php if ($permit->access_delete == 1) { ?>
                                            <a onclick="erase('<?php echo md5($row->page_config_id); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                        <?php } ?>
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
                    <div class="col-xs-4">
                        <i class="fa fa-check mg-r-md btn btn-sm btn-primary" disabled></i> Show
                    </div>
                <?php } ?>
                <?php if ($sess['development'] == TRUE) { ?>
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
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
<?php if ($sess['development'] == TRUE) { ?>
    <?php if ($permit->access_update == 1) { ?>
                function edit(id) {
                    $("#load_sub_form").load('<?php echo base_url() ?>dashboard/login-page/form/'+id);
                }
    <?php } ?>
    <?php if ($permit->access_delete == 1) { ?>
                function erase(id) {
                    $(this).each(function () {
                        bootbox.confirm("Are going to remove the template ?", function (result) {
                            if (result === true) {
                                $.ajax({
                                    url: "<?php echo base_url() ?>dashboard/login-page/delete/" + id,
                                    dataType: "JSON",
                                    success: function (json) {
                                        if (json.status === 1) {
                                            $("#load_main_data").load('<?php echo base_url() ?>dashboard/login-page/table');
                                        }
                                    }
                                });
                            }
                        });
                    });
                }
    <?php } ?>
<?php } ?>
<?php if ($permit->access_special == 1) { ?>
        function status(id, mode) {
            $(this).each(function () {
                bootbox.confirm("Are going to change status ?", function (result) {
                    if (result === true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>dashboard/login-page/status/" + id + '/' + mode,
                            dataType: "JSON",
                            success: function (json) {
                                $("#load_main_data").load("<?php echo base_url() ?>dashboard/login-page/table");
                            }
                        });
                    }
                });
            });
        }
<?php } ?>
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
