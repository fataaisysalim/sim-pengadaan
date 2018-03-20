<div class="table-responsive no-border mg-t-md">
    <table class="table table-bordered table-striped datatable" style="min-width: 450px;">
        <thead class="bg-dark" style="color: white;">
            <tr>
                <th class="text-center" style="min-width: 50px;">NO</th>
                <th class="text-center" style="min-width: 200px;">SUPPLIER/SUBCON</th>
                <th class="text-center" style="min-width: 100px;">DATE</th>
                <th class="text-center" style="min-width: 80px;">EQUIPMENT</th>
                <th class="text-center" style="min-width: 50px;">REST</th>
                <th class="text-center" style="min-width: 80px;">DATEDIFF</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($show as $i => $rox) { ?>
                <tr>
                    <td class="text-center"><?php echo ++$i; ?></td>
                    <td class="text-left"><?php echo $rox->actor_name; ?></td> 
                    <td><?php echo indo_date($rox->equipment_stock_date, 1) ?></td>
                    <td><?php echo ucwords($rox->equipment_name) ?> <?php echo!empty($rox->equipment_type) ? ucwords($rox->equipment_type) : null ?></td>
                    <td class="text-center"><?php echo $rox->equipment_stock_rest; ?></td>
                    <td class="text-center"><?php echo selisih_hari(date('Y-m-d', strtotime($rox->equipment_stock_date)), date('Y-m-d')); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>