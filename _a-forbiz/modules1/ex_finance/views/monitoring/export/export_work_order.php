<?php
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=" . $title_file . "_" . (date_format_indo_only_tgl(date('Y-m-d'))) . ".xls");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Expires: 0");
$br = '<br><br>';

$variable['work']['netto'] = $work['work_order_contract'];
$variable['work']['ppn'] = $variable['work']['netto'] * ($array['tax']['tax_ppn'] / 100);
$variable['work']['bruto'] = $variable['work']['netto'] + $variable['work']['ppn'];
$variable['work']['extra_plus'] = ($work['work_order_extra_mode'] == 1) ? $work['work_order_extra'] : 0;
$variable['work']['extra_minus'] = ($work['work_order_extra_mode'] == 2) ? $work['work_order_extra'] : 0;
$variable['work']['extra_ppn_plus'] = ($work['work_order_extra_mode'] == 1) ? $work['work_order_extra'] * ($array['tax']['tax_ppn'] / 100) : 0;
$variable['work']['extra_ppn_minus'] = ($work['work_order_extra_mode'] == 2) ? $work['work_order_extra'] * ($array['tax']['tax_ppn'] / 100) : 0;
$variable['work']['extra_bruto_plus'] = ($work['work_order_extra_mode'] == 1) ? $work['work_order_extra'] + ($array['tax']['tax_ppn'] / 100) : 0;
$variable['work']['extra_bruto_minus'] = ($work['work_order_extra_mode'] == 2) ? $work['work_order_extra'] + ($array['tax']['tax_ppn'] / 100) : 0;
$variable['work']['total_netto'] = $variable['work']['netto'] + $variable['work']['extra_plus'] - $variable['work']['extra_minus'];
$variable['work']['total_ppn'] = $variable['work']['ppn'] + $variable['work']['extra_plus'] - $variable['work']['extra_minus'];
$variable['work']['total_bruto'] = $variable['work']['bruto'] + $variable['work']['extra_plus'] - $variable['work']['extra_minus'];
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
<table border="1">
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
            <td style="text-align: left; vertical-align: top;"><?php echo $work['work_order_desc']; ?></td>
            <td style="min-width: 50px;"></td>
            <td style="min-width: 50px;"></td>
            <td style="text-align: right; vertical-align: top;"><?php echo number_format($variable['work']['netto'], 0, '', '.'); ?></td>
            <td style="text-align: right; vertical-align: top;"><?php echo number_format($variable['work']['ppn'], 0, '', '.'); ?></td>
            <td style="text-align: right; vertical-align: top;"><?php echo number_format($variable['work']['bruto'], 0, '', '.'); ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Pekerjaan Tambah</td>
            <td style="min-width: 50px;"></td>
            <td style="min-width: 50px;"></td>
            <td style="text-align: right;"><?php echo ($variable['work']['extra_plus'] == 0) ? '-' : number_format($variable['work']['extra_plus'], 0, '', '.'); ?></td>
            <td style="text-align: right;"><?php echo ($variable['work']['extra_ppn_plus'] == 0) ? '-' : number_format($variable['work']['extra_ppn_plus'], 0, '', '.'); ?></td>
            <td style="text-align: right;"><?php echo ($variable['work']['extra_bruto_plus'] == 0) ? '-' : number_format($variable['work']['extra_bruto_plus'], 0, '', '.'); ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Pekerjaan Kurang</td>
            <td style="min-width: 50px;"></td>
            <td style="min-width: 50px;"></td>
            <td style="text-align: right;"><?php echo ($variable['work']['extra_minus'] == 0) ? '-' : number_format($variable['work']['extra_minus'], 0, '', '.'); ?></td>
            <td style="text-align: right;"><?php echo ($variable['work']['extra_ppn_minus'] == 0) ? '-' : number_format($variable['work']['extra_ppn_minus'], 0, '', '.'); ?></td>
            <td style="text-align: right;"><?php echo ($variable['work']['extra_bruto_minus'] == 0) ? '-' : number_format($variable['work']['extra_bruto_minus'], 0, '', '.'); ?></td>
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
            <th style="text-align: right;"><?php echo number_format($variable['work']['total_netto'], 0, '', '.'); ?></th>
            <th style="text-align: right;"><?php echo number_format($variable['work']['total_ppn'], 0, '', '.'); ?></th>
            <th style="text-align: right;"><?php echo number_format($variable['work']['total_bruto'], 0, '', '.'); ?></th>
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
        <?php if(isset($array['downinvoice_wo'])) : ?>
        <tr>
            <td style="vertical-align: middle; text-align: left;">1</td>
            <td style="vertical-align: middle; text-align: left;">UANG MUKA</td>
            <td style="vertical-align: middle; text-align: center;"><?php echo $array['downinvoice_wo']['presentase']; ?> %</td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['downinvoice_wo']['prenetto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"></td>
            <td style="vertical-align: middle; text-align: right;"></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['downinvoice_wo']['netto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['downinvoice_wo']['ppn'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['downinvoice_wo']['bruto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['downinvoice_wo']['pph'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['downinvoice_wo']['penerimaan'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
        </tr>
        <?php endif; ?>
        
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
        <?php $i = 1; ?>
        
        <?php if(isset($array['termin'])) : ?>
        <?php foreach ($array['termin'] as $index => $row) : ?>
            <tr>
                <td style="vertical-align: middle; text-align: left;"><?php echo $i; ?></td>
                <td style="vertical-align: middle; text-align: left;">TERMIN <?php echo $array['termin'][$index]['sequence'] ?></td>
                <td style="vertical-align: middle; text-align: center;"><?php echo ($array['termin'][$index]['prenetto'] / $variable['work']['total_netto']) * 100; ?> %</td>
                <td style="vertical-align: middle; text-align: center;"><?php echo $array['termin'][$index]['kumulatif']; ?> %</td>
                <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['termin'][$index]['prenetto'], 0, '', '.'); ?></td>
                <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['termin'][$index]['angsuran'], 0, '', '.'); ?></td>
                <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['termin'][$index]['retensi'], 0, '', '.'); ?></td>
                <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['termin'][$index]['netto'], 0, '', '.'); ?></td>
                <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['termin'][$index]['ppn'], 0, '', '.'); ?></td>
                <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['termin'][$index]['bruto'], 0, '', '.'); ?></td>
                <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['termin'][$index]['pph'], 0, '', '.'); ?></td>
                <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['termin'][$index]['penerimaan'], 0, '', '.'); ?></td>
                <td style="vertical-align: middle; text-align: center;"></td>
                <td style="vertical-align: middle; text-align: center;"></td>
                <td style="vertical-align: middle; text-align: center;"></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
        <?php endif; ?>
            
            
        <?php if(isset($array['last'])) : ?>
        <tr>
            <td style="vertical-align: middle; text-align: left;"></td>
            <td style="vertical-align: middle; text-align: left;">TOTAL</td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['last']['prenetto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['last']['angsuran'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['last']['retensi'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['last']['netto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['last']['ppn'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['last']['bruto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['last']['pph'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['last']['penerimaan'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
        </tr>  
        <?php endif; ?>
        
        <tr>
            <th style="background: whitesmoke; vertical-align: middle; text-align: left;">C</th>
            <th style="background: whitesmoke; vertical-align: middle; text-align: left;">PEKERJAAN +/-</th>
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
            <td style="vertical-align: middle; text-align: left;">PEKERJAAN TAMBAH</td>
            <td style="vertical-align: middle; text-align: center;"><?php echo $array['work_extra_plus']['presentase']; ?> %</td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['work_extra_plus']['prenetto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['work_extra_plus']['angsuran'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['work_extra_plus']['retensi'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['work_extra_plus']['netto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['work_extra_plus']['ppn'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['work_extra_plus']['bruto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['work_extra_plus']['pph'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['work_extra_plus']['penerimaan'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
        </tr>    
        
        <tr>
            <td style="vertical-align: middle; text-align: left;">2</td>
            <td style="vertical-align: middle; text-align: left;">PEKERJAAN KURANG</td>
            <td style="vertical-align: middle; text-align: center;"><?php echo $array['work_extra_minus']['presentase']; ?> %</td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['work_extra_minus']['prenetto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['work_extra_minus']['angsuran'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['work_extra_minus']['retensi'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['work_extra_minus']['netto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['work_extra_minus']['ppn'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['work_extra_minus']['bruto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['work_extra_minus']['pph'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['work_extra_minus']['penerimaan'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
        </tr>    
        
        <tr>
            <td style="vertical-align: middle; text-align: left;"></td>
            <td style="vertical-align: middle; text-align: left;">TOTAL</td>
            <td style="vertical-align: middle; text-align: center;"><?php echo $array['work_extra']['presentase']; ?> %</td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['work_extra']['prenetto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['work_extra']['angsuran'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['work_extra']['retensi'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['work_extra']['netto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['work_extra']['ppn'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['work_extra']['bruto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['work_extra']['pph'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['work_extra']['penerimaan'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
        </tr>    
        
        <tr>
            <th style="background: whitesmoke; vertical-align: middle; text-align: left;">D</th>
            <th style="background: whitesmoke; vertical-align: middle; text-align: left;">SISA PEMBAYARAN PROGRESS</th>
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
            <td style="vertical-align: middle; text-align: left;"></td>
            <td style="vertical-align: middle; text-align: left;">TOTAL FINAL ACCOUNT</td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['final']['final_account']['prenetto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['final']['final_account']['angsuran'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['final']['final_account']['retensi'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['final_account']['netto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['final_account']['ppn'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['final_account']['bruto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['final_account']['pph'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['final_account']['penerimaan'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
        </tr>    
        
        <tr>
            <td style="vertical-align: middle; text-align: left;"></td>
            <td style="vertical-align: middle; text-align: left;">SISA PROGRESS INDUK</td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['final']['sisa_progress_induk']['prenetto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['final']['sisa_progress_induk']['angsuran'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['final']['sisa_progress_induk']['retensi'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['sisa_progress_induk']['netto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['sisa_progress_induk']['ppn'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['sisa_progress_induk']['bruto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['sisa_progress_induk']['pph'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['sisa_progress_induk']['penerimaan'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
        </tr>    
        
        <tr>
            <td style="vertical-align: middle; text-align: left;"></td>
            <td style="vertical-align: middle; text-align: left;">PEKERJAAN TAMBAH</td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['final']['work_extra_plus']['prenetto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['final']['work_extra_plus']['angsuran'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['final']['work_extra_plus']['retensi'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['work_extra_plus']['netto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['work_extra_plus']['ppn'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['work_extra_plus']['bruto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['work_extra_plus']['pph'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['work_extra_plus']['penerimaan'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
        </tr>    
        
        <tr>
            <td style="vertical-align: middle; text-align: left;"></td>
            <td style="vertical-align: middle; text-align: left;">PEKERJAAN KURANG</td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['final']['work_extra_minus']['prenetto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['final']['work_extra_minus']['angsuran'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['final']['work_extra_minus']['retensi'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['work_extra_minus']['netto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['work_extra_minus']['ppn'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['work_extra_minus']['bruto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['work_extra_minus']['pph'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['work_extra_minus']['penerimaan'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
        </tr>
        
        <tr>
            <td style="vertical-align: middle; text-align: left;"></td>
            <td style="vertical-align: middle; text-align: left;">NILAI YANG HARUS DIBAYARKAN</td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['final']['final_total']['prenetto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['final']['final_total']['angsuran'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['final']['final_total']['retensi'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['final_total']['netto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['final_total']['ppn'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['final_total']['bruto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['final_total']['pph'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final']['final_total']['penerimaan'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
        </tr>    
        
        <tr>
            <th style="background: whitesmoke; vertical-align: middle; text-align: left;">E</th>
            <th style="background: whitesmoke; vertical-align: middle; text-align: left;">RETENSI</th>
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
            <td style="vertical-align: middle; text-align: left;">RETENSI</td>
            <td style="vertical-align: middle; text-align: center;"><?php echo $array['retensi']['presentase']; ?> %</td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['retensi']['prenetto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['retensi']['angsuran'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['retensi']['retensi'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi']['netto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi']['ppn'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi']['bruto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi']['pph'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi']['penerimaan'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
        </tr>    
        
        <!--
        <tr>
            <td style="vertical-align: middle; text-align: left;"></td>
            <td style="vertical-align: middle; text-align: left;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['retensi_minus']['prenetto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['retensi_minus']['angsuran'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['retensi_minus']['retensi'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi_minus']['netto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi_minus']['ppn'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi_minus']['bruto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi_minus']['pph'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi_minus']['penerimaan'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
        </tr>    
        -->
        
        <tr>
            <td style="vertical-align: middle; text-align: left;"></td>
            <td style="vertical-align: middle; text-align: left;">RETENSI DIBAYARKAN</td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['retensi_bayar']['prenetto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['retensi_bayar']['angsuran'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['retensi_bayar']['retensi'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi_bayar']['netto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi_bayar']['ppn'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi_bayar']['bruto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi_bayar']['pph'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi_bayar']['penerimaan'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
        </tr>    
        
        <tr>
            <td style="vertical-align: middle; text-align: left;"></td>
            <td style="vertical-align: middle; text-align: left;">TOTAL SISA PEMBAYARAN RETENSI</td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['retensi_total']['prenetto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['retensi_total']['angsuran'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;"><?php echo number_format($array['retensi_total']['retensi'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi_total']['netto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi_total']['ppn'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi_total']['bruto'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi_total']['pph'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['retensi_total']['penerimaan'], 0, '', '.'); ?></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td style="vertical-align: middle; text-align: center;"></td>
        </tr>    
        
        <tr>
            <th style="background: whitesmoke; vertical-align: middle; text-align: left;"></th>
            <th style="background: whitesmoke; vertical-align: middle; text-align: left;">TOTAL</th>
            <td style="background: whitesmoke; vertical-align: middle; text-align: center;"></td>
            <td style="background: whitesmoke; vertical-align: middle; text-align: center;"></td>
            <td style="background: whitesmoke; vertical-align: middle; text-align: right;"><?php echo number_format($array['final_total_final']['prenetto'], 0, '', '.'); ?></td>
            <td style="background: whitesmoke; vertical-align: middle; text-align: right;"><?php echo number_format($array['final_total_final']['angsuran'], 0, '', '.'); ?></td>
            <td style="background: whitesmoke; vertical-align: middle; text-align: right;"><?php echo number_format($array['final_total_final']['retensi'], 0, '', '.'); ?></td>
            <td style="background: whitesmoke; vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final_total_final']['netto'], 0, '', '.'); ?></td>
            <td style="background: whitesmoke; vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final_total_final']['ppn'], 0, '', '.'); ?></td>
            <td style="background: whitesmoke; vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final_total_final']['bruto'], 0, '', '.'); ?></td>
            <td style="background: whitesmoke; vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final_total_final']['pph'], 0, '', '.'); ?></td>
            <td style="background: whitesmoke; vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($array['final_total_final']['penerimaan'], 0, '', '.'); ?></td>
            <td style="background: whitesmoke; vertical-align: middle; text-align: center;"></td>
            <td style="background: whitesmoke; vertical-align: middle; text-align: center;"></td>
            <td style="background: whitesmoke; vertical-align: middle; text-align: center;"></td>
        </tr>    
        
    </tbody>
</table>