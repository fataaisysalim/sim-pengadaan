<div class="table-responsive no-border mg-t-md">
    <table class="table table-bordered table-striped datatable" style="min-width: 450px;">
        <thead class="bg-dark" style="color: white;">
            <tr>
                <th class="text-center">NO.</th>
                <th class="text-center">EQUIPMENT</th>
                <th class="text-center">UNIT</th>
                <?php if ($permit->access_special == 1) { ?>
                    <th class="text-center hidden-xs">STATUS</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($show as $i => $rox) { ?>
                <tr>
                    <td class="text-center"><?php echo++$i; ?></td>
                    <td><?php echo strtoupper($rox->equipment_name) ?> <?php echo!empty($rox->equipment_type) ? strtoupper($rox->equipment_type) : null ?></td>
                    <td><?php echo strtoupper($rox->equipment_unit_name) ?></td>
                    <?php if ($permit->access_special == 1) { ?>
                        <td class="text-center hidden-xs">
                            <?php if ($rox->equipment_status == 1) { ?>
                                <a role='button' onclick="statusEq(<?php echo $rox->equipment_ct_id ?>, '<?php echo md5($rox->equipment_ct_id) ?>',<?php echo $rox->equipment_id ?>, 2)" title='NONACTIVE'><i class='fa fa-check text-success'></i></a>
                            <?php } else { ?>
                                <a role='button' onclick="statusEq(<?php echo $rox->equipment_ct_id ?>, '<?php echo md5($rox->equipment_ct_id) ?>',<?php echo $rox->equipment_id ?>, 1)" title='ACTIVE'><i class='fa fa-times text-danger'></i></a>
                            <?php } ?>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>