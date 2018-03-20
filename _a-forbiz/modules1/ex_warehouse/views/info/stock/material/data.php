<div class="table-responsive no-border mg-t-md">
    <table class="table table-bordered table-striped datatable" style="min-width: 450px;">
        <thead class="bg-dark" style="color: white;">
            <tr>
                <th class="text-center" style="min-width:50px">NO.</th>
                <th class="text-center" style="min-width:250px">MATERIAL</th>
                <th class="text-center" style="min-width:140px">FINAL STOCK</th>
                <th class="text-center" style="min-width:180px">UPDATED</th>
                <th class="text-center" style="min-width:60px"><i class="fa fa-gear"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($material as $i => $rox) { ?>
                <tr>
                    <td class="text-center" style="text-decoration: <?php echo $rox->material_sub_status != 1 || $rox->material_status != 1 ? 'line-through' : 'none'; ?>"><?php echo++$i; ?></td>
                    <td style="text-decoration: <?php echo $rox->material_sub_status != 1 || $rox->material_status != 1 ? 'line-through' : 'none'; ?>"><?php echo strtoupper($rox->material_sub_name); ?></td>
                    <td class="text-center" style="text-decoration: <?php echo $rox->material_sub_status != 1 || $rox->material_status != 1 ? 'line-through' : 'none'; ?>"><?php echo $rox->stock_final_rest ?> <?php echo $rox->material_unit_name ?></td>
                    <td class="text-center" style="text-decoration: <?php echo $rox->material_sub_status != 1 || $rox->material_status != 1 ? 'line-through' : 'none'; ?>"><?php echo strtoupper(indo_date($rox->stock_final_date, 1, 1)); ?></td>
                    <td class="text-center">
                        <a role="button" onclick="detail_stock('<?php echo md5($rox->material_sub_id); ?>')" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>