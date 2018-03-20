<?php
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=" . $title_file . "_" . (date_format_indo_only_tgl($starts)) . "_" . (date_format_indo_only_tgl($ends)) . ".xls");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Expires: 0");
$br = '<br><br>';
?>
<table style="text-align: center; width: 100%">
    <tr>
        <td colspan="6" style="text-align: center;">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center; font-size: 18px; font-weight: bold; text-transform: uppercase;"><?php echo strtoupper($title_page); ?></td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center; font-size: 18px; font-weight: bold; text-transform: uppercase;"><?php echo strtoupper($title_company); ?></td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center; font-size: 12px; font-weight: bold;"><?php echo strtoupper(date_format_indo_tgl($starts)); ?><?php echo ($starts != $ends && $starts < $ends) ? ' - ' . strtoupper(date_format_indo_tgl($ends)) : ''; ?></td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center;">&nbsp;<?php echo strtoupper(date_format_indo_tgl($setting_date)); ?></td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center;">&nbsp;</td>
    </tr>
</table>
<table border="1" style="width: 100%">
    <thead>
        <tr>
            <th style="background: whitesmoke; width: 60px;">NO.</th>
            <th style="background: whitesmoke; width: 180px;">PERALATAN</th>
            <th style="background: whitesmoke; width: 100px;">TANGGAL SEWA</th>
            <th style="background: whitesmoke; width: 100px;">TANGGAL KEMBALI</th>
            <th style="background: whitesmoke; width: 60px;">JUMLAH</th>
            <th style="background: whitesmoke; width: 100px;">STOCK</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($show['etrans']) > 0) : ?>
            <?php foreach ($show['etrans'] as $i => $row) { ?>
                <tr>
                    <td style="vertical-align: middle; text-align: center;"><?php echo ++$i; ?></td> 
                    <td><?php echo strtoupper($row->equipt_transaction_number); ?></td>
                    <td style="vertical-align: middle; text-align: left;"><?php echo strtoupper($row->actor_name); ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo strtoupper(indo_date($row->equipt_transaction_date, 1)); ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo!empty($show['etransc'][$i]->equipt_transaction_date) ? strtoupper(indo_date($show['etransc'][$i]->equipt_transaction_date, 1)) : "<center>-</center>"; ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo calculate_date(date("Y-m-d", strtotime($row->equipt_transaction_date)), !empty($show['etransc'][$i]->equipt_transaction_date) ? date("Y-m-d", strtotime($show['etransc'][$i]->equipt_transaction_date)) : date("Y-m-d")); ?></td>
                </tr>
            <?php } ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="color: gray; vertical-align: middle; text-align: center;">BELUM ADA DATA TERSEDIA</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>