<div class="table-responsive no-border">
    <table class="table table-bordered table-striped datatable">
        <thead class="bg-dark" style="color: white;">
            <tr>
                <th class="text-center" style="min-width: 80px;"><?php echo ucwords('No.'); ?></th>
                <th class="text-center" style="min-width: 200px;"><?php echo ucwords('Foreman'); ?></th>
                <th class="text-center" style="min-width: 120px;"><?php echo ucwords('No. SP3'); ?></th>
                <th class="text-center" style="min-width: 100px;"><?php echo ucwords('Date'); ?></th>
                <th class="text-center" style="min-width: 120px;"><?php echo ucwords('Fee'); ?></th>
                <?php if ($mode != 'monitoring') : ?>
                    <th class="text-center" style="min-width: 100px;"><?php echo ucwords('PPh 21'); ?></th>
                <?php endif; ?>
                <th class="text-center" style="min-width: 50px;"><i class="fa fa-gear"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $variable = array(
                'pay' => 0,
                'pph_cuts' => 0,
                'pph_nominal' => 0,
            );
            $total = array(
                'pay' => 0,
                'pph_cuts' => 0,
                'pph_nominal' => 0,
            );
            ?>
            <?php foreach ($show as $i => $row) { ?>
                <?php
                $variable['pay'] = $row->salary_pay;

                foreach ($row->salary_tax as $rowtax):
                    $variable['pph_cuts'] = $rowtax->salary_tax_cuts;
                    $variable['pph_nominal'] = $rowtax->salary_tax_nominal;
                endforeach;
                ?>
                <tr>
                    <td class="text-center"><?php echo++$i; ?></td>
                    <td class="text-left"><?php echo ucwords($row->actor_name); ?></td>
                    <td class="text-center"><?php echo $row->salary_number; ?></td>
                    <td class="text-center"><?php echo indo_date($row->salary_date, 1); ?></td>
                    <td class="text-right"><?php echo number_format($variable['pay'], 0, '', '.'); ?></td>
                    <?php if ($mode != 'monitoring') : ?>
                        <td class="text-right"><?php echo number_format($variable['pph_nominal'], 0, '', '.'); ?></td>
                    <?php endif; ?>
                    <td class="text-center">
                        <div class="btn-group btn-group-justified">
                            <a role="button" onclick="detail('<?php echo md5($row->salary_id); ?>')" class="btn btn-xs btn-primary" title="Detail"><i class="fa fa-search"></i></a>
                            <?php if ($permit->access_special == 1) { ?>
                                <a role="button" onclick="printFee('<?php echo $row->salary_id; ?>')" class="btn btn-xs btn-dark" title="Print Bukti Tagihan"><i class="fa fa-print"></i></a>
                            <?php } ?>
                                <?php if ($permit->access_update == 1) { ?>
                                <a href="<?php echo base_url() . "finance/fee-transaction/" . md5($row->salary_id); ?>" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                            <?php } ?>
                            <?php if ($permit->access_delete == 1) { ?>
                                <a role="button" onclick="delete_sal('<?php echo md5($row->salary_id); ?>')" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-times"></i></a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
<script type="text/javascript">
<?php if ($permit->access_delete == 1) { ?>
        function delete_sal(a) {
            bootbox.confirm("Are you going to remove data ?", function(result) {
                if (result == true) {
                    $.ajax({
                        url: "<?php echo base_url() . 'finance/fee-transaction/delete/'; ?>" + a,
                        dataType: "JSON",
                        success: function(json) {
                            if (json.status == 1) {
                                $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
                                $("#modal-contents").html("");
                                $("#modal-contents").load("<?php echo base_url() . 'finance/foreman-fee/'; ?>");
                            }
                        }
                    });
                }
            });
        }
<?php } ?>
<?php if ($permit->access_special == 1) { ?>
        function printFee(id) {
            window.open("<?php echo base_url() ?>finance/fee-receipt/" + id);    
            return false;
        }
<?php } ?>
</script>
