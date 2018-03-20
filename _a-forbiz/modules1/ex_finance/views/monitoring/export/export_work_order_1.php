<?php
//header("Content-type: application/vnd.ms-excel");
//header("Content-disposition: attachment; filename=" . $title_file . "_" . (date_format_indo_only_tgl(date('Y-m-d'))) . ".xls");
//header("Pragma: no-cache");
//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//header("Expires: 0");
//$br = '<br><br>';
$variable = array(
    'netto' => $work->work_order_contract,
    'ppn' => ($work->work_order_contract * 0.1),
    'bruto' => ($work->work_order_contract + ($work->work_order_contract * 0.1)),
    'extra_plus' => ($work->work_order_extra_mode == 1) ? $work->work_order_extra : 0,
    'extra_minus' => ($work->work_order_extra_mode == 2) ? $work->work_order_extra : 0,
    'extra_ppn_plus' => ($work->work_order_extra_mode == 1) ? ($work->work_order_extra * 0.1) : 0,
    'extra_ppn_minus' => ($work->work_order_extra_mode == 2) ? ($work->work_order_extra * 0.1) : 0,
    'extra_bruto_plus' => ($work->work_order_extra_mode == 1) ? $work->work_order_extra + ($work->work_order_extra * 0.1) : 0,
    'extra_bruto_minus' => ($work->work_order_extra_mode == 2) ? $work->work_order_extra + ($work->work_order_extra * 0.1) : 0,
);
$variable += array(
    'total_netto' => $variable['netto'] + $variable['extra_plus'] + $variable['extra_minus'],
    'total_ppn' => $variable['ppn'] + $variable['extra_ppn_plus'] + $variable['extra_ppn_minus'],
    'total_bruto' => $variable['bruto'] + $variable['extra_bruto_plus'] + $variable['extra_bruto_minus'],
);
$dummy_value = array(
    'progress' => 0,
    'downpayment' => 0,
    'retention' => 0,
    'netto' => 0,
    'ppn' => 0,
    'bruto' => 0,
    'pph' => 0,
    'net' => 0,
);
?>
<table style="width: 100%;">
    <tr>
        <th colspan="15">&nbsp;</th>
    </tr>
    <tr>
        <th colspan="15"><h3>MONITORING PEMBAYARAN &  PROGRESS</h3></th>
</tr>
<tr>
    <th colspan="15">&nbsp;</th>
</tr>
</table>
<table border="1" style="width: 50%;">
    <thead>
        <tr>
            <th style="background: whitesmoke;"></th>
            <th style="background: whitesmoke;">Uraian</th>
            <th style="background: whitesmoke;"></th>
            <th style="background: whitesmoke;"></th>
            <th style="background: whitesmoke;">Netto</th>
            <th style="background: whitesmoke;">PPN</th>
            <th style="background: whitesmoke;">Bruto</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align: left; vertical-align: top;">1</td>
            <td style="text-align: left; vertical-align: top;"><?php echo $work->work_order_desc; ?></td>
            <td style="min-width: 50px;"></td>
            <td style="min-width: 50px;"></td>
            <td style="text-align: right; vertical-align: top;"><?php echo number_format($variable['netto'], 0, '', '.'); ?></td>
            <td style="text-align: right; vertical-align: top;"><?php echo number_format($variable['ppn'], 0, '', '.'); ?></td>
            <td style="text-align: right; vertical-align: top;"><?php echo number_format($variable['bruto'], 0, '', '.'); ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Pekerjaan Tambah</td>
            <td style="min-width: 50px;"></td>
            <td style="min-width: 50px;"></td>
            <td style="text-align: right;"><?php echo ($variable['extra_plus'] == 0) ? '-' : number_format($variable['extra_plus'], 0, '', '.'); ?></td>
            <td style="text-align: right;"><?php echo ($variable['extra_ppn_plus'] == 0) ? '-' : number_format($variable['extra_ppn_plus'], 0, '', '.'); ?></td>
            <td style="text-align: right;"><?php echo ($variable['extra_bruto_plus'] == 0) ? '-' : number_format($variable['extra_bruto_plus'], 0, '', '.'); ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Pekerjaan Tambah</td>
            <td style="min-width: 50px;"></td>
            <td style="min-width: 50px;"></td>
            <td style="text-align: right;"><?php echo ($variable['extra_minus'] == 0) ? '-' : number_format($variable['extra_minus'], 0, '', '.'); ?></td>
            <td style="text-align: right;"><?php echo ($variable['extra_ppn_minus'] == 0) ? '-' : number_format($variable['extra_ppn_minus'], 0, '', '.'); ?></td>
            <td style="text-align: right;"><?php echo ($variable['extra_bruto_minus'] == 0) ? '-' : number_format($variable['extra_bruto_minus'], 0, '', '.'); ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th></th>
            <th>Total</th>
            <th style="min-width: 50px;"></th>
            <th style="min-width: 50px;"></th>
            <th style="text-align: right;"><?php echo number_format($variable['total_netto'], 0, '', '.'); ?></th>
            <th style="text-align: right;"><?php echo number_format($variable['total_ppn'], 0, '', '.'); ?></th>
            <th style="text-align: right;"><?php echo number_format($variable['total_bruto'], 0, '', '.'); ?></th>
        </tr>
    </tbody>
</table>
<table>
    <tr>
        <td colspan="15">&nbsp;</td>
    </tr>
</table>
<table border="1">
    <thead>
        <tr>
            <th rowspan="3" style="background: whitesmoke;">No. </th>
            <th rowspan="3" style="background: whitesmoke;">Uraian</th>
            <th colspan="3" style="background: whitesmoke;">Prestasi Netto</th>
            <th colspan="3" style="background: whitesmoke;">Uang Muka & Retensi</th>
            <th colspan="2" style="background: whitesmoke;">Kwitansi</th>
            <th rowspan="1" style="background: whitesmoke;">Potongan</th>
            <th rowspan="3" style="background: whitesmoke;">Penerimaan Bersih (Incl. PPN)</th>
            <th colspan="3" style="background: whitesmoke;">Monitor Waktu</th>
        </tr>
        <tr>
            <th rowspan="2" style="background: whitesmoke;">%</th>
            <th rowspan="2" style="background: whitesmoke;">Komulatif</th>
            <th rowspan="2" style="background: whitesmoke;">Rupiah</th>
            <th rowspan="2" style="background: whitesmoke;">Angsuran U/M</th>
            <th rowspan="2" style="background: whitesmoke;">Retensi</th>
            <th rowspan="2" style="background: whitesmoke;">Netto</th>
            <th rowspan="2" style="background: whitesmoke;">PPN</th>
            <th rowspan="2" style="background: whitesmoke;">Tagihan</th>
            <th rowspan="2" style="background: whitesmoke;">PPH Final</th>
            <th colspan="2" style="background: whitesmoke;">Tanggal</th>
            <th rowspan="2" style="background: whitesmoke;">Jangka Waktu</th>
        </tr>
        <tr>
            <th style="background: whitesmoke;">Masuk</th>
            <th style="background: whitesmoke;">J. Tempo</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($show) > 0) : ?>
            <?php foreach ($show as $index => $row) : ?>
                <?php
                $variable_tax = array('ppn' => 0, 'pph' => 0);
                if (count($row['invoice_tax']) > 0) :
                    foreach ($row['invoice_tax'] as $rotax) :
                        if ($rotax['tax_name'] == 'PPN') :
                            $variable_tax['ppn'] = $rotax['tax_cuts'];
                        elseif ($rotax['tax_name'] == 'PPh 23') :
                            $variable_tax['pph'] = $rotax['tax_cuts'];
                        endif;
                    endforeach;
                endif;
                ?>
                <?php if (count($row['payment']) > 0) : ?>
                    <?php foreach ($row['payment'] as $inpa => $ropa) : ?>
                        <?php if ($ropa['payment_ct_id'] == 1) : ?>
                            <?php
                            $downpayment = array(
                                'dp' => ($ropa['payment_total'] / 100) * $variable['netto'],
                                'netto' => ($ropa['payment_total'] / 100) * $variable['netto'],
                                'ppn' => (($ropa['payment_total'] / 100) * $variable['netto']) * ($variable_tax['ppn'] / 100),
                                'bruto' => (($ropa['payment_total'] / 100) * $variable['netto']) + (($ropa['payment_total'] / 100) * $variable['netto']) * ($variable_tax['ppn'] / 100),
                                'pph' => (($ropa['payment_total'] / 100) * $variable['netto']) * ($variable_tax['pph'] / 100),
                                'clear' => ((($ropa['payment_total'] / 100) * $variable['netto']) + (($ropa['payment_total'] / 100) * $variable['netto']) * ($variable_tax['ppn'] / 100)) - (($ropa['payment_total'] / 100) * $variable['netto']) * ($variable_tax['pph'] / 100),
                            );
                            ?>
                            <tr>
                                <th style="background: whitesmoke; vertical-align: middle; text-align: left;">A</th>
                                <th style="background: whitesmoke; vertical-align: middle; text-align: left;">UANG MUKA</th>
                                <th style="background: whitesmoke; vertical-align: middle; text-align: center;"></th>
                                <th style="background: whitesmoke; vertical-align: middle; text-align: center;"></th>
                                <th style="background: whitesmoke; vertical-align: middle; text-align: right;"></th>
                                <th style="background: whitesmoke; vertical-align: middle; text-align: right;"></th>
                                <th style="background: whitesmoke; vertical-align: middle; text-align: right;"></th>
                                <th style="background: whitesmoke; vertical-align: middle; text-align: right;"></th>
                                <th style="background: whitesmoke; vertical-align: middle; text-align: right;"></th>
                                <th style="background: whitesmoke; vertical-align: middle; text-align: right;"></th>
                                <th style="background: whitesmoke; vertical-align: middle; text-align: right;"></th>
                                <th style="background: whitesmoke; vertical-align: middle; text-align: right;"></th>
                                <td style="background: whitesmoke; vertical-align: middle; text-align: center;"></td>
                                <td style="background: whitesmoke; vertical-align: middle; text-align: center;"></td>
                                <td style="background: whitesmoke; vertical-align: middle; text-align: center;"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle; text-align: left;">1</td>
                                <td style="vertical-align: middle; text-align: left;">UANG MUKA</td>
                                <td style="vertical-align: middle; text-align: center;"><?php echo $ropa['payment_total']; ?> %</td>
                                <td style="vertical-align: middle; text-align: center;"></td>
                                <td style="vertical-align: middle; text-align: right;"><?php echo number_format($downpayment['dp'], 0, '', '.'); ?></td>
                                <td style="vertical-align: middle; text-align: right;"></td>
                                <td style="vertical-align: middle; text-align: right;"></td>
                                <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($downpayment['netto'], 0, '', '.'); ?></td>
                                <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($downpayment['ppn'], 0, '', '.'); ?></td>
                                <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($downpayment['bruto'], 0, '', '.'); ?></td>
                                <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($downpayment['pph'], 0, '', '.'); ?></td>
                                <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($downpayment['clear'], 0, '', '.'); ?></td>
                                <td style="vertical-align: middle; text-align: center;"></td>
                                <td style="vertical-align: middle; text-align: center;"></td>
                                <td style="vertical-align: middle; text-align: center;"></td>
                            </tr>
                        <?php else: ?>
                            <?php if ($inpa == 1) : ?>
                                <tr>
                                    <th style="background: whitesmoke; vertical-align: middle; text-align: left;">B</th>
                                    <th style="background: whitesmoke; vertical-align: middle; text-align: left;">TERMIN</th>
                                    <th style="background: whitesmoke; vertical-align: middle; text-align: center;"></th>
                                    <th style="background: whitesmoke; vertical-align: middle; text-align: center;"></th>
                                    <th style="background: whitesmoke; vertical-align: middle; text-align: right;"></th>
                                    <th style="background: whitesmoke; vertical-align: middle; text-align: right;"></th>
                                    <th style="background: whitesmoke; vertical-align: middle; text-align: right;"></th>
                                    <th style="background: whitesmoke; vertical-align: middle; text-align: right;"></th>
                                    <th style="background: whitesmoke; vertical-align: middle; text-align: right;"></th>
                                    <th style="background: whitesmoke; vertical-align: middle; text-align: right;"></th>
                                    <th style="background: whitesmoke; vertical-align: middle; text-align: right;"></th>
                                    <th style="background: whitesmoke; vertical-align: middle; text-align: right;"></th>
                                    <td style="background: whitesmoke; vertical-align: middle; text-align: center;"></td>
                                    <td style="background: whitesmoke; vertical-align: middle; text-align: center;"></td>
                                    <td style="background: whitesmoke; vertical-align: middle; text-align: center;"></td>
                                </tr>
                            <?php endif; ?>
                            <?php
                            $dummy_value['progress'] = $ropa['payment_total'];
                            $varia['progress'] = ($ropa['payment_total'] / 100);
                            $varia['netto'] = $variable['netto'] * $varia['progress'];
                            $varia['ppn'] = $varia['netto'] * ($variable_tax['ppn'] / 100);
                            $varia['bruto'] = $varia['netto'] + $varia['ppn'];
                            $varia['pph'] = $varia['netto'] * ($variable_tax['pph'] / 100);
                            ?>
                            <tr>
                                <td style="vertical-align: middle; text-align: left;"><?php echo $inpa; ?></td>
                                <td style="vertical-align: middle; text-align: left;">TERMIN <?php echo $ropa['payment_sequence']; ?></td>
                                <td style="vertical-align: middle; text-align: center;"><?php echo $ropa['payment_total']; ?> %</td>
                                <td style="vertical-align: middle; text-align: center;"><?php echo $ropa['payment_total'] + ($dummy_value['progress'] + $ropa['payment_total']); ?> %</td>
                                <td style="vertical-align: middle; text-align: right;"></td>
                                <td style="vertical-align: middle; text-align: right;"></td>
                                <td style="vertical-align: middle; text-align: right;"></td>
                                <td style="vertical-align: middle; text-align: right;"></td>
                                <td style="vertical-align: middle; text-align: right;"></td>
                                <td style="vertical-align: middle; text-align: right;"></td>
                                <td style="vertical-align: middle; text-align: right;"></td>
                                <td style="vertical-align: middle; text-align: right;"></td>
                                <td style="vertical-align: middle; text-align: center;"></td>
                                <td style="vertical-align: middle; text-align: center;"></td>
                                <td style="vertical-align: middle; text-align: center;"></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="15" style="color: gray; vertical-align: middle; text-align: center;">Belum ada data tersedia</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>