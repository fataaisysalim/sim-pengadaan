<?php
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=" . $title_file . "_" . date_format_indo_only_tgl($setting_date) . ".xls");
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
        <td colspan="6" style="text-align: center;">&nbsp;<?php echo strtoupper(date_format_indo_tgl($setting_date)); ?></td>
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
            <th style="background: whitesmoke;">SUPPLIER CODE</th>
            <th style="background: whitesmoke;">SUPPLIER</th>
            <th style="background: whitesmoke;">JUMLAH BAPB</th>
            <th style="background: whitesmoke;">TOTAL TAGIHAN</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($show) > 0) : ?>
            <?php foreach ($show as $i => $row) { ?>
                <tr>
                    <td style="vertical-align: middle; text-align: center;"><?php echo ++$i; ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo strtoupper($row->project_name); ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo!empty($row->actor_code) ? strtoupper($row->actor_code) : "<center>-</center>"; ?></td>
                    <td style="vertical-align: middle; text-align: left;"><?php echo strtoupper($row->actor_name); ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo $row->count_mog; ?></td>
                    <td style="vertical-align: middle; text-align: left;">Rp <?php echo rupiah($row->invoice); ?></td></tr>
            <?php } ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="color: gray; vertical-align: middle; text-align: center;">Belum ada data tersedia</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>