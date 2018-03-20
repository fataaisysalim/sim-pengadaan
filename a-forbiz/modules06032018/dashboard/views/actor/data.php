<div class="table-responsive no-border">
    <table class="table table-bordered datatable">
        <thead class="bg-dark" style="color: white;">
            <tr>
                <th class="text-center" style="min-width: 50px">NO.</th>
                <th class="text-center" style="min-width: 180px"><?php echo strtoupper($ct->actor_category_name) ?> Name</th>
                <th class="text-center" style="min-width: 100px">CODE</th>
                <th class="text-center" style="min-width: 100px">NPWP</th>
                <?php if ($permit->access_special == 1) { ?>
                    <th class="text-center hidden-xs" style="min-width: 50px"><i class="fa fa-check"></i></th>
                <?php } ?>
                <th class="text-center" style="width: 50px"><i class="fa fa-gear"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($show as $i => $row) { ?>
                <tr>
                    <td class="text-center" style="text-decoration: <?php echo $row->actor_status != 1 ? 'line-through' : 'none'; ?>"><?php echo ++$i; ?></td>
                    <td style="text-decoration: <?php echo $row->actor_status != 1 ? 'line-through' : 'none'; ?>"><?php echo strtoupper($row->actor_name); ?></td>
                    <td style="text-decoration: <?php echo $row->actor_status != 1 ? 'line-through' : 'none'; ?>"><?php echo!empty($row->actor_code) ? strtoupper($row->actor_code) : "<center>-</center>"; ?></td>
                    <td style="text-decoration: <?php echo $row->actor_status != 1 ? 'line-through' : 'none'; ?>"><?php echo strtoupper($row->actor_identity); ?></td>  
                    <?php if ($permit->access_special == 1) { ?>
                        <td class="text-center hidden-xs" style="text-decoration: <?php echo $row->actor_status != 1 ? 'line-through' : 'none'; ?>">
                            <?php if ($row->actor_status == 1) { ?>
                                <a role="button" onclick="statusAct('<?php echo $ct->actor_category_id ?>', '<?php echo $row->actor_name ?>',<?php echo $row->actor_id ?>, '<?php echo md5($ct->actor_category_id) ?>', 2)" title="NONACTIVE"><i class="fa fa-check text-success"></i></a>
                            <?php } else { ?>
                                <a role="button" onclick="statusAct('<?php echo $ct->actor_category_id ?>', '<?php echo $row->actor_name ?>',<?php echo $row->actor_id ?>, '<?php echo md5($ct->actor_category_id) ?>', 1)" title="ACTIVE"><i class="fa fa-times text-danger"></i></a>
                            <?php } ?>
                        </td>
                    <?php } ?>
                    <td class="text-center">
                        <a role="button" onclick="detailAtr('<?php echo md5($row->actor_id); ?>')" class="btn btn-xs btn-primary" title="Detail"><i class="fa fa-search"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
