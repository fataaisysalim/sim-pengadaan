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
        <td colspan="6" style="text-align: center; font-size: 18px; font-weight: bold;  text-transform: uppercase;"><?php echo strtoupper($title_page); ?></td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center; font-size: 18px; font-weight: bold;  text-transform: uppercase;"><?php echo strtoupper($title_company); ?></td>
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
            <th class="text-center" style="background: whitesmoke;">NO.</th>
            <th class="text-center" style="background: whitesmoke;">KATEGORI</th>
            <th class="text-center" style="background: whitesmoke;">PERALATAN</th>
            <th class="text-center" style="background: whitesmoke;">TIPE</th>
            <th class="text-center" style="background: whitesmoke;">SATUAN</th>
            <th class="text-center" style="background: whitesmoke;">STATUS</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($show) > 0) : ?>
            <?php foreach ($show as $i => $row) { ?>
                <tr>
                    <td style="vertical-align: middle; text-align: center; text-decoration: <?php echo $row->equipment_status != 1 ? 'line-through' : 'none'; ?>"><?php echo ++$i; ?></td>
                    <td style="vertical-align: middle; text-decoration: <?php echo $row->equipment_status != 1 ? 'line-through' : 'none'; ?>"><?php echo strtoupper($row->equipment_ct_name); ?></td> 
                    <td style="vertical-align: middle; text-decoration: <?php echo $row->equipment_status != 1 ? 'line-through' : 'none'; ?>"><?php echo strtoupper($row->equipment_name); ?></td>  
                    <td style="vertical-align: middle; text-decoration: <?php echo $row->equipment_status != 1 ? 'line-through' : 'none'; ?>"><?php echo ($row->equipment_type != '') ? strtoupper($row->equipment_type) : "<center>-</center>"; ?></td>  
                    <td style="vertical-align: middle; text-align: center; text-decoration: <?php echo $row->equipment_status != 1 ? 'line-through' : 'none'; ?>"><?php echo strtoupper($row->equipment_unit_name); ?></td> 
                    <td style="vertical-align: middle; text-align: center; text-decoration: <?php echo $row->equipment_status != 1 ? 'line-through' : 'none'; ?>"><?php echo ($row->equipment_status == 1) ? 'AKTIF' : 'TIDAK AKTIF'; ?></td> 
                </tr>
            <?php } ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="color: gray; vertical-align: middle; text-align: center;">BELUM ADA DATA TERSEDIA</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>