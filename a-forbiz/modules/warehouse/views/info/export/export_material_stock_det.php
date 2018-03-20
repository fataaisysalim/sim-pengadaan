<?php
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=" . $title_file . ".xls");
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
        <td colspan="6" style="text-align: center; font-size: 16px; font-weight: bold; text-transform: uppercase;"><?php echo strtoupper($title_page); ?></td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center; font-size: 16px; font-weight: bold; text-transform: uppercase;"><?php echo strtoupper($title_company); ?></td>
    </tr>
<!--    <tr>
        <td colspan="6" style="text-align: center; font-size: 12px; font-weight: bold;"><?php echo strtoupper(date_format_indo_tgl($starts)); ?><?php echo ($starts != $ends && $starts < $ends) ? ' - ' . strtoupper(date_format_indo_tgl($ends)) : ''; ?></td>
    </tr>-->
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
            <th style="min-width: 80px; background: whitesmoke;">NO.</th>
            <th style="min-width: 200px; background: whitesmoke;">TANGGAL</th>
            <th style="min-width: 150px; background: whitesmoke;">SUPPLIER/SUBKON</th>
            <th style="min-width: 100px; background: whitesmoke;">MASUK</th>
            <th style="min-width: 100px; background: whitesmoke;">KELUAR</th>
            <th style="min-width: 100px; background: whitesmoke;">SISA</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($show) > 0) : ?>
            <?php foreach ($show as $i => $row) { ?>
                <tr>
                    <td style="vertical-align: middle; text-align: center;"><?php echo ++$i; ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo strtoupper(indo_date($row->stock_date, 1, 1)) ?></td>
                    <td style="vertical-align: middle; text-align: left;"><?php echo strtoupper($row->actor_name); ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo!empty($row->stock_entry) ? $row->stock_entry : "-" ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo!empty($row->stock_exit) ? $row->stock_exit : "-" ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo!empty($row->stock_rest) ? $row->stock_rest : 0 ?></td>
                </tr>
            <?php } ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="color: gray; vertical-align: middle; text-align: center;">BELUM ADA DATA TERSEDIA</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>