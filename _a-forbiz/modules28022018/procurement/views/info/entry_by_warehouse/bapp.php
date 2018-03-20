<div class="table-responsive no-border mg-t-md">
    <table class="table table-bordered table-striped datatable" style="min-width: 450px;">
        <thead class="bg-dark" style="color: white;">
            <tr>
                <th class="text-center" style="min-width:50px">NO.</th>
                <th class="text-center" style="min-width:100px">NO.BAPP</th>
                <th class="text-center" style="min-width:140px">DATE</th>
                <th class="text-center" style="min-width:230px">SUPPLIER/SUBCON</th>
                <th class="text-center" style="min-width:90px">ENTRY</th>
                <th class="text-center" style="width:140px">STATUS</th>
                <th class="text-center" style="width:140px">DETAIL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($show as $i => $rox) { ?>
                <tr>
                    <td class="text-center"><?php echo++$i; ?></td>
                    <td class="text-center"><?php echo $rox->equipt_transaction_number ?></td>
                    <td class="text-center"><?php echo strtoupper(indo_date($rox->equipt_transaction_date, 1, 1)); ?></td>
                    <td><?php echo strtoupper($rox->actor_name); ?></td>
                    <td class="text-center"><?php echo strtoupper($rox->item_usage); ?></td>
                    <td class="text-center"><?php echo $rox->equipt_transaction_status != 0 ? "<i class='fa fa-check text-success'></i>" : "<i class='fa fa-times text-danger'></i>" ?></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-justified">
                            <a role="button" onclick="detailEntry('bapp','<?php echo md5($rox->equipt_transaction_id); ?>')" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></a>
                                <!--<a role="button"onclick="printEntry('bapp','<?php echo md5($rox->equipt_transaction_id); ?>')" class="btn btn-xs btn-dark"><i class="fa fa-print"></i></a>-->
                            <?php if ($permit->access_update == 1) { ?>
                                <a href="<?php echo base_url() ?>" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
    $(".start_<?php echo $xyz ?>").val("<?php echo $starts ?>");
    $(".end_<?php echo $xyz ?>").val("<?php echo $ends ?>");
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>