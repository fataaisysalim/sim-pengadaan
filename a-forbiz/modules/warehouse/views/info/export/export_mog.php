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
        <td colspan="7" style="text-align: center;">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7" style="text-align: center; font-size: 18px; font-weight: bold;  text-transform: uppercase;"><?php echo strtoupper($title_page); ?></td>
    </tr>
    <tr>
        <td colspan="7" style="text-align: center; font-size: 18px; font-weight: bold;  text-transform: uppercase;"><?php echo strtoupper($title_company); ?></td>
    </tr>
    <tr>
        <td colspan="7" style="text-align: center; font-size: 12px; font-weight: bold;"><?php echo strtoupper(date_format_indo_tgl($starts)); ?><?php echo ($starts != $ends && $starts < $ends) ? ' - ' . strtoupper(date_format_indo_tgl($ends)) : ''; ?></td>
    </tr>
    <tr>
        <td colspan="7" style="text-align: center;">&nbsp;<?php echo strtoupper(date_format_indo_tgl($setting_date)); ?></td>
    </tr>
    <tr>
        <td colspan="7" style="text-align: center;">&nbsp;</td>
    </tr>
</table>
<table border="1" style="width: 100%">
    <thead>
        <tr>
            <th style="min-width:50px; background: whitesmoke;">NO.</th>
            <th style="min-width:50px; background: whitesmoke;">PROJECT</th>
            <th style="min-width:100px; background: whitesmoke;">NO.<?php echo $category->transaction_ct_id == 1 ? "BAPB" : "BPM" ?></th>
            <th style="min-width:100px; background: whitesmoke;">SURAT JALAN</th>
            <th style="min-width:140px; background: whitesmoke;">TANGGAL</th>
            <th style="min-width:230px; background: whitesmoke;"><?php echo $category->transaction_ct_id == 1 ? "SUPPLIER/SUBKON" : "MANDOR/SUBKON" ?></th>
            <th style="min-width:90px; background: whitesmoke;"> <?php echo $category->transaction_ct_id == 1 ? "MASUK" : "KELUAR" ?></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($show) > 0) : ?>
            <?php foreach ($show as $i => $row) { ?>
                <tr>
                    <td style="vertical-align: middle; text-align: center;"><?php echo ++$i; ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo strtoupper($row->project_name); ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo strtoupper($row->mog_number) ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo strtoupper($row->mog_number_letter); ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo strtoupper(indo_date($row->mog_date, 1, 1)); ?></td>
                    <td style="vertical-align: middle; text-align: left;"><?php echo strtoupper($row->actor_name); ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo $row->item_usage ?></td>
                </tr>
            <?php } ?>
        <?php else: ?>
            <tr>
                <td colspan="7" style="color: gray; vertical-align: middle; text-align: center;">BELUM ADA DATA TERSEDIA</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>