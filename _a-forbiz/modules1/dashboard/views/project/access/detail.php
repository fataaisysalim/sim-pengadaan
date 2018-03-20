<div class="panel-body">
    <div class="table-responsive no-border">
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th class="text-center">NO.</th>
                    <th class="text-center">USERNAME</th>
                    <?php if ($permit->access_delete == 1) { ?>
                        <th class="text-center"><li class="fa fa-gear"></li></th>
            <?php } ?>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($project_access_dt as $i => $row) { ?>
                    <tr>
                        <td class="text-center"><?php echo++$i; ?></td>
                        <td><?php echo strtoupper($row->users_username); ?></td>
                        <?php if ($permit->access_delete == 1) { ?>
                            <td class="text-center">
                                <a onclick="erases('<?php echo md5($row->project_access_id); ?>',<?php echo $row->project_id; ?>)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-search mg-r-md"></i>Detail Project');
<?php if ($permit->access_delete == 1) { ?>
            function erases(id, project) {
                $.ajax({
                    url: "<?php echo base_url() ?>dashboard/project_access/delete/" + id,
                    dataType: "JSON",
                    success: function(json) {
                        if (json.status == 1) {
                            $("#modal-content").load("<?php echo base_url() ?>dashboard/project_access/detail/" + project);
                            $(".load_main_data").load("<?php echo base_url() ?>dashboard/project_access/table");
                        }
                    }
                });
            }
<?php } ?>

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>