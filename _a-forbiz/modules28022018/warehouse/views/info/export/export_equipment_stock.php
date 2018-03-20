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
    <tr>
        <td colspan="6" style="text-align: center; font-size: 16px; text-transform: uppercase;"><?php echo strtoupper($project->project_name); ?> ( <?php echo strtoupper($project->project_code); ?> )</td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center; font-size: 16px; font-weight: bold;">&nbsp;<?php echo strtoupper(date_format_indo_tgl(date("Y-m-d"))) ?></td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center;">&nbsp;</td>
    </tr>
</table>
<table border="1" style="width: 100%">
    <thead>
        <tr>
            <th class="text-center" style="width: 60px; background: whitesmoke;">NO.</th>
            <th class="text-center" style="min-width: 160px; background: whitesmoke;">SUPPLIER/SUBKON</th>
            <th class="text-center" style="min-width: 160px; background: whitesmoke;">PERALATAN</th>
            <th class="text-center" style="min-width: 120px; background: whitesmoke;">TIPE</th>
            <th class="text-center" style="min-width: 100px; background: whitesmoke;">SISA STOK</th>
            <th class="text-center" style="min-width: 120px; background: whitesmoke;">TANGGAL PEMBAHARUAN</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($show) > 0) : ?>
            <?php
            $total = 0;
            foreach ($show as $i => $row) {
                ?>
                <tr>
                    <td style="vertical-align: middle; text-align: center;"><?php echo++$i; ?></td>
                    <td style="vertical-align: middle; text-align: left;"><?php echo strtoupper($row->actor_name) ?></td>
                    <td style="vertical-align: middle; text-align: left;"><?php echo strtoupper($row->equipment_name) ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo!empty($row->equipment_type) ? strtoupper($row->equipment_type) : "<center>-</center>" ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo rupiah($row->equipment_stock_final_rest); ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo strtoupper(indo_date($row->equipment_stock_final_date, 1, 1)); ?></td>
                </tr>
                <?php
                $total += $row->equipment_stock_final_rest;
            }
            ?>
            <tr>
                <th colspan="4">JUMLAH STOK</th>
                <th><?php echo rupiah($total) ?></th>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="6" style="color: gray; vertical-align: middle; text-align: center;">BELUM ADA DATA TERSEDIA</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>