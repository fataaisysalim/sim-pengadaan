<div class="row">
    <div class="loadertabs col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<div class="table-responsive no-border">
    <table class="table table-bordered table-striped datatable" style="min-width: 450px;">
        <thead class="bg-dark" style="color: white;">
            <tr>
                <th class="text-center" style="min-width:50px">NO.</th>
                <th class="text-center" style="min-width:100px">NO.<?php echo $category->transaction_ct_id == 1 ? "BAPB" : "BPM" ?></th>
                <th class="text-center" style="min-width:140px">DATE</th>
                <th class="text-center" style="min-width:230px"><?php echo $category->transaction_ct_id == 1 ? "SUPPLIER/SUBCON" : "FOREMAN/SUBCON"; ?></th>
                <th class="text-center" style="min-width:90px"> <?php echo $category->transaction_ct_id == 1 ? "ENTRY" : "EXIT"; ?></th>
                <th class="text-center" style="min-width:90px">STATUS</th>
                <th class="text-center" style="min-width:140px">DETAIL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($show as $i => $rox) { ?>
                <tr>
                    <td class="text-center"><?php echo++$i; ?></td>
                    <td class="text-center"><?php echo strtoupper($rox->mog_number); ?></td>
                    <td class="text-center"><?php echo strtoupper(indo_date($rox->mog_date, 1)); ?></td>
                    <td><?php echo strtoupper($rox->actor_name); ?></td>
                    <td class="text-center"><?php echo strtoupper($rox->item_usage); ?></td>
                    <td class="text-center"><?php echo $rox->mog_status != 0 ? "<i class='fa fa-check text-success'></i>" : "<i class='fa fa-times text-danger'></i>"; ?></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-justified">
                            <a role="button" onclick="detail_mog('<?php echo md5($rox->mog_id); ?>')" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></a>
                            <a  role="button" onclick="printMog('<?php echo md5($rox->mog_id); ?>', '<?php echo $category->transaction_ct_id ?>')" class="btn btn-xs btn-dark"><i class="fa fa-print"></i></a>
                            <?php if (!empty($permit)) { ?>
                                <?php if ($permit->access_update == 1) { ?>
                                    <a href="<?php echo $category->transaction_ct_id == 1 ? base_url() . "warehouse/bapb/index/" . md5($rox->mog_id) : base_url() . 'warehouse/bpm/index/' . md5($rox->mog_id) ?>" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                <?php } ?>
                                <?php if ($permit->access_delete == 1) { ?>
                                    <a <?php echo check_mog_inv(md5($rox->mog_id)) > 0 ? 'disabled' : NULL; ?> role="button" <?php echo date('Y-m-d', strtotime($rox->mog_date)) != date('Y-m-d') ? 'disabled' : NULL; ?> onclick="delete_mog('<?php echo md5($rox->mog_id); ?>',<?php echo $category->transaction_ct_id ?>,'<?php echo md5($category->transaction_ct_id) ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
    $(".start_<?php echo $category->transaction_ct_id ?>").val("<?php echo $starts ?>");
    $(".end_<?php echo $category->transaction_ct_id ?>").val("<?php echo $ends ?>");
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>