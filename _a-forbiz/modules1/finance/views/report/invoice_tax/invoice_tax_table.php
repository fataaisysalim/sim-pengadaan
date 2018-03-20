<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-warning">
    <header class="panel-heading lead">
        <i class="fa fa-th-large"></i> <?php echo ucwords($mode_title); ?>
    </header>
    <div class="panel-body">
        <div class="table-responsive no-border" style="margin-top: -10px">
            <table class="table table-bordered table-striped datatable" style="min-min-width: 450px;">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="min-width: 80px;"><?php echo ucwords('No.'); ?></th>
                        <th class="text-center" style="min-width: 120px;"><?php echo ucwords('Name'); ?></th>
                        <th class="text-center" style="min-width: 120px;"><?php echo ucwords('NPWP'); ?></th>
                        <th class="text-center" style="min-width: 80px;"><?php echo ucwords('NPPKP'); ?></th>
                        <th class="text-center" style="min-width: 80px;"><?php echo ucwords('No. Serial'); ?></th>
                        <th class="text-center" style="min-width: 80px;"><?php echo ucwords('date'); ?></th>
                        <th class="text-center" style="min-width: 120px;"><?php echo ucwords('DPP'); ?></th>
                        <th class="text-center" style="min-width: 120px;"><?php echo strtoupper($mode); ?></th>
                        <th class="text-center" style="min-width: 80px;"><?php echo ucwords('No. Evidance'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $variable = array(
                        'netto' => 0,
                        'bruto' => 0,
                        'tax_cuts' => 0,
                        'tax_nominal' => 0,
                        'dpp' => 0,
                    );
                    $total = array(
                        'netto' => 0,
                        'bruto' => 0,
                        'tax_cuts' => 0,
                        'tax_nominal' => 0,
                        'dpp' => 0,
                    );
                    ?>
                    <?php foreach ($show as $i => $row) { ?>
                        <?php
                        $variable['netto'] = $row->invoice_netto;
                        $variable['dpp'] = $row->invoice_netto;
                        foreach ($row->invoice_tax as $rowtax):
                            if (strtolower(str_replace(' ', '', $rowtax->tax_name)) == $mode) :
                                $variable['tax_cuts'] = $rowtax->invoice_tax_cuts;
                                $variable['tax_nominal'] = $rowtax->invoice_tax_nominal;
                            endif;
                        endforeach;
                        ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td class="text-left"><?php echo ucwords($row->actor_name); ?></td>
                            <td class="text-center"><?php echo ($row->actor_identity == '') ? '-' : $row->actor_identity; ?></td>
                            <td class="text-center"><?php echo ($row->actor_pkp_number == '') ? '-' : $row->actor_pkp_number; ?></td>
                            <td class="text-center"><?php echo $row->invoice_tax_serial; ?></td>
                            <td class="text-center"><?php echo indo_date($row->invoice_date_kwt, 1); ?></td>
                            <td class="text-right"><?php echo number_format($variable['dpp'], 0, '', '.'); ?></td>
                            <td class="text-right"><?php echo number_format($variable['tax_nominal'], 0, '', '.'); ?></td>
                            <td class="text-left"></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
