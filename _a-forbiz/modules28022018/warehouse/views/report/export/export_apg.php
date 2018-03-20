<?php
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=" . $title_file . "_" . (date_format_indo_only_tgl($start)) . "_" . (date_format_indo_only_tgl($ends)) . ".xls");
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
        <td colspan="6" style="text-align: center; font-size: 12px; font-weight: bold;"><?php echo strtoupper(date_format_indo_tgl($start)); ?><?php echo ($start != $ends && $start <= $ends) ? ' - ' . strtoupper(date_format_indo_tgl($ends)) : ''; ?></td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center;">&nbsp;</td>
    </tr>
</table>
<table border="1" style="width: 100%">
    <thead>
        <tr>
            <th style="background: whitesmoke;">NO.</th>
            <th style="background: whitesmoke;">PROJECT</th>
            <th style="background: whitesmoke;">MATERIAL</th>
            <th style="background: whitesmoke;">SISA STOCK</th>
            <th style="background: whitesmoke;">DATE UPDATED</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($show) > 0) : ?>
            <?php foreach ($show as $i => $row) { ?>
                <tr>
                    <td style="vertical-align: middle; text-align: center;"><?php echo ++$i; ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo strtoupper($row->project_name); ?></td>
                    <td style="vertical-align: middle; text-align: left;"><?php echo strtoupper($row->material_sub_name); ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo rupiah($row->stock_final_rest); ?></td>
                    <td style="vertical-align: middle; text-align: left;"><?php echo indo_date($row->stock_final_date, 1, 1); ?></td>
                </tr>
            <?php } ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="color: gray; vertical-align: middle; text-align: center;">BELUM ADA DATA TERSEDIA</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>