<div class="row">
    <div class="loadertab_sub col-xs-12"><?php echo $this->session->flashdata('message_sub') ?></div>
</div>
<section class="panel panel-warning">
    <header class="panel-heading lead">
        <i class="fa fa-th-large"></i> Data Material
    </header>
    <div class="panel-body">
        <div class="row">
            <div style="margin-top: -35px" class="hidden-xs"></div>
            <div style="margin-top: -15px" class="visible-xs"></div>
            <ul class="nav nav-tabs">
                <?php foreach ($material_sub['ct'] as $number => $rowx) { ?>
                    <li <?php echo $number == 0 ? 'class="active"' : null ?>>
                        <a href="#mts<?php echo $rowx->material_category_id ?>" data-toggle="tab"><?php echo strtoupper($rowx->material_category_name) ?></a>
                    </li>
                <?php } ?>
            </ul>
            <section>
                <div class="tab-content ">
                    <?php foreach ($material_sub['ct'] as $numb => $rows) { ?>
                        <section class="tab-pane <?php echo $numb == 0 ? 'active' : null ?>" id="mts<?php echo $rows->material_category_id ?>">
                            <div class="col-xs-12 mg-t-md">
                                <div class="table-responsive no-border">
                                    <table class="table table-bordered table-striped datatable" style="min-width: 450px;">
                                        <thead class="bg-dark" style="color: white;">
                                            <tr>
                                                <th class="text-center" style="min-width: 50px">No.</th>
                                                <th class="text-center" style="min-width: 100px">Type</th>
                                                <th class="text-center" style="min-width: 170px">Material</th>
                                                <th class="text-center" style="min-width: 90px">Unit</th>
                                                <th class="text-center" style="min-width: 90px">Convertion</th>
                                                <th class="text-center" style="min-width: 90px">Price</th>
                                                <?php if ($sess['position_id'] == 1 OR $sess['position_id'] == 4) { ?>
                                                    <th class="text-center" style="min-width: 90px"><i class="fa fa-gear"></i></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($material_sub['mtt'][$numb] as $i => $row) { ?>
                                                <tr>
                                                    <td class="text-center"><?php echo++$i; ?></td>
                                                    <td><?php echo strtoupper($row->material_name); ?></td>
                                                    <td><?php echo strtoupper($row->material_sub_name); ?></td>
                                                    <td class="text-center"><?php echo strtoupper($row->material_unit_name); ?></td>
                                                    <td class="text-center"><?php echo rupiah($row->material_sub_convertion, 2); ?></td>
                                                    <td><?php echo $row->material_sub_price != 0 ? rupiah($row->material_sub_price) : "<center>-</center>"; ?></td>
                                                    <?php if ($sess['position_id'] == 1 OR $sess['position_id'] == 4) { ?>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-justified">
                                                                <?php if ($permit->access_update == 1) { ?>
                                                                    <a onclick="edit_sub('<?php echo md5($row->material_sub_id); ?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                                                <?php } ?>
                                                                <?php if ($permit->access_delete == 1) { ?>
                                                                    <a onclick="erase_sub('<?php echo md5($row->material_sub_id); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div> 
                            </div>
                            <div class="col-md-12">
                                <b>Note :</b>
                                <div class="row mg-t-md mg-b-sm">
                                    <?php if ($permit->access_update == 1) { ?>
                                        <div class="col-xs-6">
                                            <button type="button" class="btn btn-sm btn-warning mg-r-md" disabled><i class="fa fa-edit"></i></button> Edit
                                        </div>
                                    <?php } ?>
                                    <?php if ($permit->access_delete == 1) { ?>
                                        <div class="col-xs-6">
                                            <button type="button" class="btn btn-sm btn-danger mg-r-md" disabled><i class="fa fa-trash"></i></button> Delete
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </section>
                    <?php } ?>
                </div>
            </section>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(".loadertab").hide();
<?php if ($permit->access_delete == 1) { ?>
        function erase_sub(id) {
            $(this).each(function() {
                bootbox.confirm("Are you going to remove the material ?", function(result) {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>warehouse/material/delete/<?php echo md5('material_sub'); ?>/" + id,
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    $(".load_main_data").load("<?php echo base_url() ?>warehouse/material/table/material_sub");
                                }
                            }
                        });
                    }
                });
            });

        }
<?php } ?>
<?php if ($permit->access_update == 1) { ?>
        function edit_sub(id) {
            $("#load_sub_form").load("<?php echo base_url() ?>warehouse/material/form/material_sub/" + id);
        }
<?php } ?>
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>