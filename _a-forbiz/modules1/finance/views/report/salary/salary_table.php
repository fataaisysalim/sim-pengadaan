<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-warning">
    <header class="panel-heading lead">
        <i class="fa fa-th-large"></i> <?php if ($mode != null) echo ($mode == 'monitoring') ? 'Foreman Fee Monitoring' : 'Reports Tax Article 21'; ?>
    </header>
    <div class="panel-body">
        <div class="table-responsive no-border" style="margin-top: -10px">
            <table class="table table-bordered table-striped datatable" style="min-min-width: 450px;">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="min-width: 80px;"><?php echo ucwords('No.'); ?></th>
                        <th class="text-center" style="min-width: 220px;"><?php echo ucwords('Name Taxpayer'); ?></th>
                        <th class="text-center" style="min-width: 150px;"><?php echo ucwords('No. SP3'); ?></th>
                        <th class="text-center" style="min-width: 150px;"><?php echo ucwords('Date'); ?></th>
                        <th class="text-center" style="min-width: 200px;"><?php echo ucwords('Fee'); ?></th>
                        <?php if ($mode != 'monitoring') : ?>
                            <th class="text-center" style="min-width: 200px;"><?php echo ucwords('PPh 21'); ?></th>
                        <?php else: ?>
                            <th class="text-center" style="min-width: 200px;"><?php echo ucwords('Fare'); ?></th>
                        <?php endif; ?>
                        <th class="text-center" style="min-width: 150px;"><?php echo ucwords('No. Evidance'); ?></th>
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
                            <?php else: ?>
                                <td class="text-right"><?php echo number_format($variable['pph_cuts'], 0, '', '.'); ?></td>
                            <?php endif; ?>
                            <td class="text-center"><?php echo $row->salary_evidence; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
