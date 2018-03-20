<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-warning">
    <header class="panel-heading lead">
        <i class="fa fa-th-large"></i> Invoice <?php if ($mode != null) echo ($mode == 0) ? 'Outstanding' : 'Paid'; ?>
    </header>
    <div class="panel-body">
        <div class="table-responsive no-border" style="margin-top: -10px">
            <table class="table table-bordered table-striped datatable" style="min-min-width: 450px;">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="min-width: 80px;"><?php echo ucwords('No.'); ?></th>
                        <th class="text-center" style="min-width: 100px;"><?php echo ucwords('Vendor'); ?></th>
                        <th class="text-center" style="min-width: 100px;"><?php echo ucwords('No. Invoice'); ?></th>
                        <!--<th class="text-center" style="min-width: 150px;"><?php echo ucwords('Tax Serial'); ?></th>-->
                        <th class="text-center" style="min-width: 80px;"><?php echo ucwords('Inv Date'); ?></th>
                        <th class="text-center" style="min-width: 80px;"><?php echo ucwords('Pro Date'); ?></th>
                        <th class="text-center" style="min-width: 100px;"><?php echo ucwords('Netto'); ?></th>
                        <th class="text-center" style="min-width: 100px;"><?php echo ucwords('Total'); ?></th>
                        <th class="text-center" style="min-width: 80px;"><?php echo ucwords('Status'); ?></th>
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
                        'summary' => 0,
                        'debit' => 0,
                        'credit' => 0
                    );
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
                        ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td class="text-left"><?php echo ucwords($row->actor_name); ?></td>
                            <td class="text-center"><?php echo $row->invoice_number; ?></td>
                            <td class="text-center"><?php echo indo_date($row->invoice_date_kwt, 1); ?></td>
                            <td class="text-center"><?php echo indo_date($row->invoice_date_pry, 1); ?></td>
                            <td class="text-right"><?php echo number_format($variable['netto'], 0, '', '.'); ?></td>
                            <td class="text-right"><?php echo number_format($variable['summary'], 0, '', '.'); ?></td>
                            <td class="text-center"><?php echo ($row->invoice_payment_status == 0) ? 'OUSTANDING' : 'PAID' ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
