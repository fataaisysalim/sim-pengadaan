<div class="table-responsive no-border">
    <table class="table table-bordered table-striped datatable">
        <thead class="bg-dark" style="color: white;">
            <tr>
                <th class="text-center" style="min-width: 50px">NO</th>
                <th class="text-center" style="min-width: 120px">VENDOR</th>
                <th class="text-center" style="min-width: 120px">NO. INVOICE</th>
                <?php if ($ctid == 4) : ?>
                    <th class="text-center" style="min-width: 120px">CATEGORY</th>
                <?php endif; ?>
                <th class="text-center" style="min-width: 100px">DATE</th>
                <th class="text-center" style="min-width: 100px">TOTAL</th>
                <th class="text-center" style="min-width: 80px">STATUS</th>
                <th class="text-center" style="min-width: 80px"><i class="fa fa-gear"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $variable = array(
                'netto' => 0,
                'bruto' => 0,
                'ppn_cuts' => 0,
                'ppn_nominal' => 0,
                'pph23_cuts' => 0,
                'pph23_nominal' => 0,
                'summary' => 0,
                'debit' => 0,
                'credit' => 0
            );
            $total = array(
                'netto' => 0,
                'bruto' => 0,
                'ppn_cuts' => 0,
                'ppn_nominal' => 0,
                'pph23_cuts' => 0,
                'pph23_nominal' => 0,
                'summary' => 0,
                'debit' => 0,
                'credit' => 0
            );
            $modewo = null;
            $modeper = null;
            ?>
            <?php foreach ($show as $i => $row) { ?>
                <?php
                $variable['netto'] = $row->invoice_netto;
                $variable['summary'] = $row->invoice_netto;
                foreach ($row->invoice_tax as $rowtax):
                    if ($rowtax->tax_name == 'PPN') :
                        $variable['summary'] = $variable['summary'] + $rowtax->invoice_tax_nominal;
                    else:
                        $variable['summary'] = $variable['summary'] - $rowtax->invoice_tax_nominal;
                    endif;
                endforeach;

                if ($ctid == 4) :
                    if ($row->invoice_wo_ct_id == 1) :
                        $modeper = $row->work_order_dp;
                        $modewo = 'Uang Muka (' . $modeper . '%)';
                    elseif ($row->invoice_wo_ct_id == 2) :
                        $modeper = $row->invoice_wo_percent;
                        $modewo = 'Termin ' . $row->invoice_wo_sequence . '(' . $modeper . '%)';
                    elseif ($row->invoice_wo_ct_id == 3) :
                        $modeper = $row->work_order_retensi;
                        $modewo = 'Retensi (' . $modeper . '%)';
                    else:
                    endif;
                endif;
                ?>
                <tr>
                    <td class="text-center"><?php echo++$i; ?></td>
                    <td class="text-left"><?php echo ucwords($row->actor_name); ?></td>
                    <td><?php echo $row->invoice_number; ?></td>
                    <?php if ($ctid == 4) : ?>
                        <td class="text-right"><?php echo $modewo; ?></td>
                    <?php endif; ?>
                    <td class="text-center"><?php echo indo_date($row->invoice_date_kwt, 1); ?></td>
                    <td class="text-right"><?php echo number_format($variable['summary'], 0, '', '.'); ?></td>
                    <td class="text-center"><?php echo ($row->invoice_payment_status == 0) ? 'OUSTANDING' : 'PAID' ?></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-justified">
                            <a role="button" onclick="detail('<?php echo md5($row->invoice_id); ?>')" class="btn btn-xs btn-primary" title="Detail"><i class="fa fa-search"></i></a>
                            <?php if ($permit->access_special == 1) { ?>
                                <a role="button" onclick="printInv('<?php echo $row->invoice_id; ?>')" class="btn btn-xs btn-dark" title="Print Invoice"><i class="fa fa-print"></i></a>
                            <?php } ?>
                            <?php if ($permit->access_update == 1) { ?>
                                <a <?php echo ($row->invoice_payment_status == 0) ? 'disabled=""' : ''; ?> href="<?php echo base_url() . "finance/payment/" . md5($row->invoice_id); ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil-square"></i></a>
                                <a <?php echo check_inv_edit_button($row->invoice_id, $row->work_order_id); ?> href="<?php echo base_url() . "finance/invoice/" . md5($row->invoice_id); ?>" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                            <?php } ?>
                            <?php if ($permit->access_delete == 1) { ?>
                                <a role="button" <?php echo date('Y-m-d', strtotime($row->invoice_date_kwt)) != date('Y-m-d') ? 'disabled' : NULL; ?> onclick="delete_inv('<?php echo md5($row->invoice_id); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
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
        function delete_inv(a) {
            bootbox.confirm("Are you going to delete data ?", function (result) {
                if (result == true) {
                    $.ajax({
                        url: "<?php echo base_url() . 'finance/transaction/invoice/delete/'; ?>" + a,
                        dataType: "JSON",
                        success: function (json) {
                            if (json.status == 1) {
                                $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
                                $("#modal-contents").html("");
                                $("#modal-contents").load("<?php echo base_url() . 'finance/inv-information/'; ?>")
                            }
                        }
                    });
                }
            });
        }
<?php } ?>
<?php if ($permit->access_special == 1) { ?>
        function printInv(id) {
            window.open("<?php echo base_url() ?>finance/invoice-receipt/" + id);
            return false;
        }
<?php } ?>
</script>