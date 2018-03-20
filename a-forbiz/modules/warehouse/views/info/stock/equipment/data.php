<div class="table-responsive no-border mg-t-md">
    <table class="table table-bordered table-striped datatable" style="min-width: 450px;">
        <thead class="bg-dark" style="color: white;">
            <tr>
                <th class="text-center" style="min-width: 50px;">NO.</th>
                <th class="text-center" style="min-width: 150px;">SUPPLIER/SUBKON</th>
                <th class="text-center" style="min-width: 200px;">EQUIPMENT</th>
                <th class="text-center" style="min-width: 120px;">FINAL STOCK</th>
                <th class="text-center" style="min-width: 120px;">UPDATED</th>
                <th class="text-center" style="min-width: 90px;">DETAIL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipment as $i => $rox) { ?>
                <tr>
                    <td class="text-center"><?php echo++$i; ?></td>
                    <td class="text-left"><?php echo $rox->actor_name; ?></td>
                    <td><?php echo ucwords($rox->equipment_name) ?> <?php echo!empty($rox->equipment_type) ? strtoupper($rox->equipment_type) : null ?></td>
                    <td class="text-center"><?php echo $rox->equipment_stock_final_rest ?></td>
                    <td><?php echo strtoupper(indo_date($rox->equipment_stock_final_date, 1)); ?></td>
                    <td class="text-center">
                        <a role="button" onclick="detail_stock_eq('<?php echo md5($rox->equipment_id); ?>','<?php echo $category->equipment_ct_id; ?>','<?php echo md5($rox->actor_id); ?>')" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<!--<script>
    $(".starte_<?php echo $category->equipment_ct_id ?>").val("<?php echo $starts ?>");
    $(".ende_<?php echo $category->equipment_ct_id ?>").val("<?php echo $ends ?>");
</script>-->
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>