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
        <td colspan="6" style="text-align: center; font-size: 16px; font-weight: bold; text-transform: uppercase;"><?php echo strtoupper($title_page); ?> <?php echo $eq->equipment_name ?> <?php echo $eq->equipment_type ?></td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center; font-size: 16px; font-weight: bold; text-transform: uppercase;"><?php echo strtoupper($title_company); ?></td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center; font-size: 16px; text-transform: uppercase;"><?php echo strtoupper($project->project_name); ?> ( <?php echo strtoupper($project->project_code); ?> )</td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center;">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">PERALATAN</td>
        <td colspan="4" style="text-align: left;">: <?php echo strtoupper($eq->equipment_name)?></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">SUPPLIER/SUBKON</td>
        <td colspan="4" style="text-align: left;">: <?php echo strtoupper($actor->actor_name)?></td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center;">&nbsp;</td>
    </tr>
</table>
<table border="1" style="width: 100%">
    <thead>
        <tr>
            <th style="width: 50px; background: whitesmoke;">NO.</th>
            <th style="min-width: 150px; background: whitesmoke;" colspan="2">TANGGAL</th>
            <th style="min-width: 100px; background: whitesmoke;">MASUK</th>
            <th style="min-width: 100px; background: whitesmoke;">KELUAR</th>
            <th style="min-width: 100px; background: whitesmoke;">SISA</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($show) > 0) : ?>
            <?php
            $total = 0;
            $entrs = 0;
            $exts = 0;
            foreach ($show as $i => $row) {
                ?>
                <tr>
                    <td style="vertical-align: middle; text-align: center;"><?php echo++$i; ?></td>
                    <td style="vertical-align: middle; text-align: center;" colspan="2"><?php echo strtoupper(indo_date($row->equipment_stock_date, 1, 1)); ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo!empty($row->equipment_stock_entry) ? $row->equipment_stock_entry : "-" ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo!empty($row->equipment_stock_exit) ? $row->equipment_stock_exit : "-" ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo!empty($row->equipment_stock_rest) ? $row->equipment_stock_rest : 0 ?></td>
                </tr>
                <?php
                $total += $row->equipment_stock_rest;
                $entrs += $row->equipment_stock_entry;
                $exts += $row->equipment_stock_exit;
            }
            ?>
            <tr>
                <th colspan="3">JUMLAH</th>
                <th><?php echo rupiah($entrs) ?></th>
                <th><?php echo rupiah($exts) ?></th>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="6" style="color: gray; vertical-align: middle; text-align: center;">BELUM ADA DATA TERSEDIA</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>