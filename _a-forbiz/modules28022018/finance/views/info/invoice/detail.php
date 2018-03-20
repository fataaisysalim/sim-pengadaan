<div class="panel-body">
    <div class="row">
        <div class="col-xs-12">
            <?php
            $variable = array(
                'totalworkorder' => 0,
                'dp_percent' => 0,
                'dp_amount' => 0,
                'retensi_percent' => 0,
                'retensi_amount' => 0,
                'amount' => 0,
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
                'summary' => 0,
                'debit' => 0,
                'credit' => 0
            );
            ?>

            <?php
            $variable['totalworkorder'] = $show->work_order_contract;
            $variable['dp_percent'] = $show->work_order_dp;
            if (count($inwo) > 0) {
                $variable['amount'] = $inwo->invoice_wo_nominal;
            }
            $variable['retensi_percent'] = $show->work_order_retensi;
            $variable['amount'] = $show->work_order_contract;
            $variable['netto'] = $show->invoice_netto;
            $variable['bruto'] = $show->invoice_bruto;
            $variable['summary'] = $show->invoice_netto;
            foreach ($tax as $rowtax):
                if ($rowtax->tax_name == 'PPN') :
                    $variable['summary'] = $variable['summary'] + $rowtax->invoice_tax_nominal;
                else:
                    $variable['summary'] = $variable['summary'] - $rowtax->invoice_tax_nominal;
                endif;
            endforeach;
            $variable['debit'] = ($show->invoice_payment_status == 1) ? $variable['summary'] : 0;
            $variable['credit'] = ($show->invoice_payment_status != 1) ? $variable['summary'] : 0;

            $modewo = null;
            $modeper = null;
            if (count($inwo) > 0) {
                if ($inwo->invoice_wo_ct_id == 1) :
                    $modeper = $show->work_order_dp;
                    $modewo = 'Uang Muka (' . $modeper . '%)';
                elseif ($inwo->invoice_wo_ct_id == 2) :
                    $modeper = $inwo->invoice_wo_percent;
                    $modewo = 'Termin ' . $inwo->invoice_wo_sequence . '(' . $modeper . '%)';
                elseif ($inwo->invoice_wo_ct_id == 3) :
                    $modeper = $show->work_order_retensi;
                    $modewo = 'Retensi (' . $modeper . '%)';
                endif;
            }
            ?>
            <div class="row">
                <div class="col-sm-8">
                    <div class="table-responsive no-border">
                        <table class="table table-striped datatable">
                            <tr>
                                <td><?php echo ucwords('No. Invoice'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td><?php echo $show->invoice_number; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo ucwords('Vendor'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td><?php echo ucwords($show->actor_name); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo ucwords('Tax Serial'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td><?php echo $show->invoice_tax_serial; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo ucwords('Invoice Date'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td><?php echo indo_date($show->invoice_date_kwt, 1); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo ucwords('Project Date'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td><?php echo indo_date($show->invoice_date_pry, 1); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo ucwords('Project'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td><?php echo strtoupper($show->project_name); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo ucwords('Status'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td><?php echo ($show->invoice_payment_status != 1) ? '<label class="text-danger">Outstanding</label>' : '<label class="text-success">Paid</label>'; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="table-responsive no-border">
                        <table class="table table-striped datatable">
                            <?php if ($show->work_order_id != '') : ?>
                                <tr>
                                    <td><?php echo ucwords('Total Kontrak'); ?></td>
                                    <td style="width: 10px;"> : </td>
                                    <td class="text-right"><?php echo number_format($variable['totalworkorder'], 0, '', '.'); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo ucwords('Sisa tagihan'); ?></td>
                                    <td style="width: 10px;"> : </td>
                                    <td class="text-right"><?php echo number_format($inwo_rest, 0, '', '.'); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo ucwords($modewo); ?></td>
                                    <td style="width: 10px;"> : </td>
                                    <td class="text-right"><?php echo number_format($inwo->invoice_wo_nominal, 0, '', '.'); ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td><?php echo ucwords('Netto'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td class="text-right"><?php echo number_format($variable['netto'], 0, '', '.'); ?></td>
                            </tr>
                            <?php foreach ($tax as $rowtax): ?>
                                <tr>
                                    <td><?php echo ucwords($rowtax->tax_name) . ' (' . $rowtax->invoice_tax_cuts . ' %)'; ?></td>
                                    <td style="width: 10px;"> : </td>
                                    <td class="text-right"><?php echo number_format($rowtax->invoice_tax_nominal, 0, '', '.'); ?></td>
                                </tr>
                                <?php if ($rowtax->tax_name == 'PPN') : ?>
                                    <tr>
                                        <td><?php echo ucwords('Bruto (Netto + PPN)'); ?></td>
                                        <td style="width: 10px;"> : </td>
                                        <td class="text-right"><?php echo number_format($variable['bruto'], 0, '', '.'); ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <tr>
                                <td><?php echo ucwords('Total'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td class="text-right"><?php echo number_format($variable['summary'], 0, '', '.'); ?></td>
                            </tr>
                            <?php if ($show->invoice_resource_code != 4) : ?>
                                <tr>
                                    <td><?php echo ucwords('Debit'); ?></td>
                                    <td style="width: 10px;"> : </td>
                                    <td class="text-right"><?php echo number_format($variable['debit'], 0, '', '.'); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo ucwords('Credit'); ?></td>
                                    <td style="width: 10px;"> : </td>
                                    <td class="text-right"><?php echo number_format($variable['credit'], 0, '', '.'); ?></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<a role="button" onclick="back()" class="pull-left btn btn-sm btn-danger" style="margin-top:-5px"><i class="fa fa-reply"></i></a> <i class="fa fa-search mg-r-md"></i>Invoice Detail');
    function back() {
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-contents").html("");
        $("#modal-contents").load("<?php echo base_url(); ?>finance/inv-information");
    }
</script>