<div class="table-responsive no-border mg-t-md">
    <table class="table table-bordered table-striped datatable" style="min-width: 450px;">
        <thead class="bg-dark" style="color: white;">
            <tr>
                <th class="text-center" style="min-width: 50px">NO.</th>
                <th class="text-center" style="min-width: 200px">MATERIAL</th>
                <th class="text-center" style="min-width: 130px">UNIT</th>
                <th class="text-center" style="min-width: 130px">CONVERTION</th>
                <?php if ($permit->access_special == 1) { ?>
                    <th class="text-center hidden-xs" style="min-width: 50px">STATUS</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($material as $i => $rox) { ?>
                <tr>
                    <td class="text-center" style="text-decoration: <?php echo $rox->material_sub_status != 1 || $rox->material_status != 1 ? 'line-through' : 'none'; ?>"><?php echo++$i; ?></td>
                    <td style="text-decoration: <?php echo $rox->material_sub_status != 1 || $rox->material_status != 1 ? 'line-through' : 'none'; ?>"><?php echo strtoupper($rox->material_sub_name) ?></td>
                    <td class="text-center" style="text-decoration: <?php echo $rox->material_sub_status != 1 || $rox->material_status != 1 ? 'line-through' : 'none'; ?>"><?php echo strtoupper($rox->material_unit_name) ?></td>
                    <td class="text-center" style="text-decoration: <?php echo $rox->material_sub_status != 1 || $rox->material_status != 1 ? 'line-through' : 'none'; ?>"><?php echo rupiah($rox->material_sub_convertion,2) ?></td>
                    <?php if ($permit->access_special == 1) { ?>
                        <td class="text-center hidden-xs">
                            <?php if ($rox->material_sub_status == 1 && $rox->material_status == 1) { ?>
                                <a role='button' onclick="statusMt(<?php echo $rox->material_category_id ?>,'<?php echo md5($rox->material_category_id) ?>',<?php echo $rox->material_sub_id ?> ,2)" title='NONACTIVE'><i class='fa fa-check text-success'></i></a>
                            <?php } else { ?>
                                <a role='button' onclick="statusMt(<?php echo $rox->material_category_id ?>,'<?php echo md5($rox->material_category_id) ?>',<?php echo $rox->material_sub_id ?> ,1)" title='ACTIVE'><i class='fa fa-times text-danger'></i></a>
                            <?php } ?>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>