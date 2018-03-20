<?php
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=" . $title_file . "_" . (date_format_indo_only_tgl($start)) . "_" . (date_format_indo_only_tgl($ends)) . ".xls");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Expires: 0");
$br = '<br><br>';
?>
<table style="text-align: left; width: 100%">
    <tr>
        <td colspan="17" style="text-align: left;"><h2 style="margin-bottom: 0;"><?php echo strtoupper($apps->apps_client); ?></h2></td>
    </tr>
    <tr>
        <td colspan="10" style="text-align: left;"><?php echo ucwords($project->project_name); ?></td>
        <td colspan="7" rowspan="2" style="text-align: right;"><h2>INVOICE MONITORING</h2></td>
    </tr>
    <tr>
        <td colspan="10" ><?php echo ucwords($project->project_address); ?></td>
    </tr>
    <tr>
        <td colspan="17" style="text-align: right;">Exported on <b><?php echo date_format_indo_tgl($setting_date); ?></b></td>
    </tr>
    <tr>
        <td colspan="17" style="text-align: center;">&nbsp;</td>
    </tr>
</table>
<table border="1" style="width: 100%">
    <thead>
        <tr>
            <th rowspan="2" style="background: whitesmoke;">No.</th>
            <th rowspan="2" style="background: whitesmoke;">VENDOR</th>
            <th rowspan="2" style="background: whitesmoke;">NO.KWITANSI</th>
            <th rowspan="2" style="background: whitesmoke;">FAKTUR PAJAK</th>
            <th colspan="4" style="background: whitesmoke;">TANGGAL TERIMA</th>
            <th colspan="2" style="background: whitesmoke;">NILAI TAGIHAN</th>
            <th rowspan="2" style="background: whitesmoke;">BRUTO</th>
            <th colspan="2" style="background: whitesmoke;">POTONGAN</th>
            <th rowspan="2" style="background: whitesmoke;">JUMLAH</th>
            <th colspan="2" style="background: whitesmoke;">SALDO HUTANG</th>
            <th rowspan="2" style="background: whitesmoke;">KETERANGAN</th>
        </tr>
        <tr>
            <th style="background: whitesmoke;">KW</th>
            <th style="background: whitesmoke;">PRYK</th>
            <th style="background: whitesmoke;">DEPT</th>
            <th style="background: whitesmoke;">UMUR</th>
            <th style="background: whitesmoke;">NETTO</th>
            <th style="background: whitesmoke;">PPN</th>
            <th style="background: whitesmoke;">PPH23</th>
            <th style="background: whitesmoke;">%PPH</th>
            <th style="background: whitesmoke;">DIBAYAR</th>
            <th style="background: whitesmoke;">SISA HUTANG</th>
        </tr>
    </thead>

    <?php if (count($show) > 0) { ?> 
        <?php
        $variable = array(
            'netto' => 0,
            'bruto' => 0,
            'rowtax' => 0,
            'pph' => 0
        );
        $total = array(
            'netto' => 0,
            'bruto' => 0,
            'summary' => 0,
            'ppn' => 0,
            'pph' => 0,
            'paid' => 0,
            'outstanding' => 0
        );
        ?>
        <tbody>
            <?php
            $no = 1;
            foreach ($show['invoice'] as $i => $row) {
                ?>
                <?php
                $variable['netto'] = $row->invoice_netto;
                $variable['bruto'] = $row->invoice_bruto;
                $variable['rowtax'] = count($show['taxexppn'][$i]);
                $variable['ppn'] = !empty($show['taxppn'][$i]) ? $show['taxppn'][$i]->invoice_tax_nominal : 0;
                if (count($show['taxexppn'][$i]) > 0) {
                    foreach ($show['taxexppn'][$i] as $indetax => $row_tax) {
                        $variable['summary'] = ($variable['netto'] + $variable['ppn']) - $row_tax->invoice_tax_nominal;
                        $variable['pph'] = $row_tax->invoice_tax_nominal;
                    }
                } else {
                    $variable['summary'] = ($variable['netto'] + $variable['ppn']);
                    $variable['pph'] = 0;
                }
                $total['netto'] += $variable['netto'];
                $total['bruto'] += $variable['bruto'];
                $total['ppn'] += $variable['ppn'];
                $total['pph'] += $variable['pph'];
                $total['summary'] += $variable['summary'];
                $total['paid'] +=$row->invoice_payment_status != 0 ? $variable['summary'] : 0;
                $total['outstanding'] +=$row->invoice_payment_status == 0 ? $variable['summary'] : 0;
                ?>
                <tr>
                    <td style="vertical-align: middle; text-align: center;"><?php echo $no; ?></td>
                    <td style="vertical-align: middle;"><?php echo $row->actor_name; ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo $row->invoice_number; ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo $row->invoice_tax_serial; ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo indo_date($row->invoice_date_kwt, 1); ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo indo_date($row->invoice_date_pry, 1); ?></td>
                    <td style="vertical-align: middle; text-align: center;"></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo selisih_hari(date('Y-m-d', strtotime($row->invoice_date_kwt)), date('Y-m-d')); ?></td>
                    <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($variable['netto'], 0, '', '.'); ?></td>
                    <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format(!empty($show['taxppn'][$i]) ? $show['taxppn'][$i]->invoice_tax_nominal : 0, 0, '', '.'); ?></td>
                    <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($variable['bruto'], 0, '', '.'); ?></td>
                    <?php if (count($show['taxexppn'][$i]) > 0) { ?>
                        <?php foreach ($show['taxexppn'][$i] as $indetax => $rowtax) { ?>
                            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($rowtax->invoice_tax_nominal, 0, '', '.'); ?></td>
                            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo $rowtax->invoice_tax_cuts; ?> %</td>
                        <?php } ?>
                    <?php } else { ?>
                        <td style="vertical-align: middle;"><center>-</center></td>
            <td style="vertical-align: middle;"><center>-</center></td>
        <?php } ?>
        <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($variable['summary'], 0, '', '.'); ?></td>
        <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo $row->invoice_payment_status != 0 ? number_format($variable['summary'], 0, '', '.') : "<center>-</center>"; ?></td>
        <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo $row->invoice_payment_status == 0 ? number_format($variable['summary'], 0, '', '.') : "<center>-</center>"; ?></td>
        <td style="vertical-align: middle; text-align: center;"><b><?php echo ($row->invoice_payment_status == 0) ? '<p style="color: red;">OUSTANDING</p>' : 'PAID' ?></b></td>
        </tr>
        <?php
        $no++;
    }
    ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="8" style="text-align: right;">Total :</th>
            <th style="text-align: right;">&nbsp;<?php echo number_format($total['netto'], 0, '', '.'); ?></th>
            <th style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($total['ppn'], 0, '', '.'); ?></th>
            <th style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($total['bruto'], 0, '', '.'); ?></th>
            <th style="vertical-align: middle; text-align: center;" colspan="2">&nbsp;<?php echo number_format($total['pph'], 0, '', '.'); ?></th>
            <th style="text-align: right;">&nbsp;<?php echo number_format($total['summary'], 0, '', '.'); ?></th>
            <th style="text-align: right;">&nbsp;<?php echo number_format($total['paid'], 0, '', '.'); ?></th>
            <th style="text-align: right;">&nbsp;<?php echo number_format($total['outstanding'], 0, '', '.'); ?></th>
        </tr>
    </tfoot>
<?php } else { ?>
    <tr>
        <td colspan="17" style="color: gray; vertical-align: middle; text-align: center;">Belum ada data tersedia</td>
    </tr>
<?php } ?>
</table>