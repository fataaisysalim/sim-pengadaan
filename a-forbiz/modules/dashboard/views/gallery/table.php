<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-warning">
    <header class="panel-heading lead">
        <i class="fa fa-th-large mg-r-sm"></i> DATA GALLERY
    </header>
    <div class="panel-body">
        <div style="margin-top: -20px" class="hidden-xs"></div>
        <div style="margin-top: -15px" class="visible-xs"></div>
        <div class="table-responsive no-border">
            <table class="table table-bordered table-striped datatable" style="min-width: 450px;">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="min-width: 60px">NO.</th>
                        <th class="text-center" style="min-width: 220px">IMAGE</th>
                        <th class="text-center" style="min-width: 190px">STATUS</th>
                        <th class="text-center" style="min-width: 80px"><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($show as $i => $row) { ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td class="text-center">
                                <a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo base_url($row->apps_gallery_files); ?>">
                                    <div style="width: 100%; height: 70px; overflow: hidden">
                                        <img style="width: 100%;" src="<?php echo base_url($row->apps_gallery_files); ?>"/>
                                    </div>
                                </a>
                            </td>
                            <td class="text-center <?php echo ($row->apps_gallery_status == 1) ? null : 'text-danger'; ?>"><i class="fa <?php echo ($row->apps_gallery_status == 1) ? 'fa-check' : 'fa-minus-circle'; ?> mg-r-sm"></i><?php echo ($row->apps_gallery_status == 1) ? 'SHOW' : 'NOT SHOW'; ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified">
                                    <?php if ($permit->access_special == 1) { ?>
                                        <?php if ($row->apps_gallery_status == 1) : ?>
                                            <a onclick="status('<?php echo md5($row->apps_gallery_id); ?>', 'uncheck')" class="btn btn-xs btn-info"><i class="fa fa-unlink"></i></a>
                                        <?php else: ?>
                                            <a onclick="status('<?php echo md5($row->apps_gallery_id); ?>', '')" class="btn btn-xs btn-primary"><i class="fa fa-check"></i></a>
                                        <?php endif; ?>
                                    <?php } ?>
                                    <?php if ($permit->access_delete == 1) { ?>
                                        <a onclick="erase('<?php echo md5($row->apps_gallery_id); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <b><i>Note ------</i></b>
            <p style="padding-top: 10px;"><i>Only displays max 4 images and 1 image on the login page</i></p>
            <div class="row mg-t-md">
                <?php if ($permit->access_update == 1) { ?>
                    <div class="col-sm-4 col-md-3 col-xs-6">
                        <i class="fa fa-check mg-r-md btn btn-sm btn-primary" disabled></i> SHOW ON LOGIN
                    </div>
                    <div class="col-sm-4 col-md-3 col-xs-6">
                        <i class="fa fa-unlink mg-r-md btn btn-sm btn-info" disabled></i> NOT SHOW ON LOGIN
                    </div>
                <?php } ?>
                <?php if ($permit->access_delete == 1) { ?>
                    <div class="col-sm-4 col-md-3 col-xs-6">
                        <i class="fa fa-trash-o mg-r-md btn btn-sm btn-danger" disabled></i> DELETE
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
<?php if ($permit->access_delete == 1) { ?>
        function erase(id) {
            $(this).each(function () {
                bootbox.confirm("Are going to remove the gallery ?", function (result) {
                    if (result === true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>dashboard/gallery/delete/" + id,
                            dataType: "JSON",
                            success: function (json) {
                                if (json.status === 1) {
                                    $("#load_main_data").load('<?php echo base_url() ?>dashboard/gallery/table');
                                }
                            }
                        });
                    }
                });
            });
        }
<?php } ?>
<?php if ($permit->access_special == 1) { ?>
        function status(id, mode) {
            $(this).each(function () {
                bootbox.confirm("Are going to change status ?", function (result) {
                    if (result === true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>dashboard/gallery/status/" + id + '/' + mode,
                            dataType: "JSON",
                            success: function (json) {
                                $("#load_main_data").load("<?php echo base_url() ?>dashboard/gallery/table");
                            }
                        });
                    }
                });
            });
        }
<?php } ?>
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>