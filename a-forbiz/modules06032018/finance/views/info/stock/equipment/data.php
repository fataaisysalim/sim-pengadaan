<div class="table-responsive no-border mg-t-md">
    <table class="table table-bordered table-striped datatable" style="min-width: 450px;">
        <thead class="bg-dark" style="color: white;">
            <tr>
                <th class="text-center" style="min-width: 40px;">NO</th>
                <th class="text-center" style="min-width: 150px;">SUPPLIER/SUBCON</th>
                <th class="text-center visible-lg visible-xs" style="min-width: 100px;">DATE</th>
                <th class="text-center" style="min-width: 100px;">EQUIPMENT</th>
                <th class="text-center" style="min-width: 60px;">REST</th>
                <th class="text-center" style="min-width: 60px;">PRICE</th>
                <th class="text-center" style="min-width: 85px;">DATEDIFF</th>
                <th class="text-center" style="min-width: 75px;">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($show as $i => $rox) { ?>
                <tr>
                    <td class="text-center"><?php echo ++$i; ?></td>
                    <td class="text-left"><?php echo $rox->actor_name; ?></td> 
                    <td class=" visible-lg visible-xs"><?php echo indo_date($rox->equipment_stock_date, 1) ?></td>
                    <td><?php echo ucwords($rox->equipment_name) ?> <?php echo!empty($rox->equipment_type) ? ucwords($rox->equipment_type) : null ?></td>
                    <td class="text-center"><?php echo $rox->equipment_stock_rest; ?></td>
                    <td class="text-center"><?php echo number_format($rox->equipment_stock_price, 0, '', '.'); ?></td>
                    <td class="text-center"><?php echo selisih_hari(date('Y-m-d', strtotime($rox->equipment_stock_date)), date('Y-m-d')); ?></td>
                    <td class="text-center"><?php echo number_format($rox->equipment_stock_price * $rox->equipment_stock_rest, 0, '', '.'); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>