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
        <td colspan="15" style="text-align: center;">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="15" style="text-align: center; font-size: 18px; font-weight: bold;  text-transform: uppercase;"><?php echo strtoupper($title_page); ?></td>
    </tr>
    <tr>
        <td colspan="15" style="text-align: center; font-size: 18px; font-weight: bold;  text-transform: uppercase;"><?php echo strtoupper($title_company); ?></td>
    </tr>
    <tr>
        <td colspan="15" style="text-align: center;">&nbsp;<?php echo strtoupper(date_format_indo_tgl($setting_date)); ?></td>
    </tr>
    <tr>
        <td colspan="15" style="text-align: center;">&nbsp;</td>
    </tr>
</table>
<table border="1" style="width: 100%">
    <thead>
        <tr>
            <th class="text-center" style="background: whitesmoke; width: 100px;">NO.</th>
            <th class="text-center" style="background: whitesmoke; width: 450px;" colspan="4">NAMA <?php echo $title_file; ?></th>
            <th class="text-center" style="background: whitesmoke; width: 130px;" colspan="2">KODE <?php echo $title_file; ?></th>
            <th class="text-center" style="background: whitesmoke; width: 90px;" colspan="2"><?php echo strtoupper($identity); ?></th>
            <th class="text-center" style="background: whitesmoke; width: 90px;" colspan="2">ALAMAT</th>
            <th class="text-center" style="background: whitesmoke; width: 90px;" colspan="2">TELEPHONE</th>
            <th class="text-center" style="background: whitesmoke; width: 90px;" colspan="1">EMAIL</th>
            <th class="text-center" style="background: whitesmoke; width: 50px;">STATUS</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($show) > 0) : ?>
            <?php foreach ($show as $i => $row) { ?>
                <tr>
                    <td style="vertical-align: middle; text-align: center; text-decoration: <?php echo $row->actor_status != 1 ? 'line-through' : 'none'; ?>"><?php echo ++$i; ?></td>
                    <td style="vertical-align: middle;text-decoration: <?php echo $row->actor_status != 1 ? 'line-through' : 'none'; ?>" colspan="4"><?php echo strtoupper($row->actor_name); ?></td>
                    <td style="vertical-align: middle;text-decoration: <?php echo $row->actor_status != 1 ? 'line-through' : 'none'; ?>" colspan="2">&nbsp;<?php echo!empty($row->actor_code) ? $row->actor_code : "<center>-</center>"; ?></td>
                    <td style="vertical-align: middle;text-decoration: <?php echo $row->actor_status != 1 ? 'line-through' : 'none'; ?>" colspan="2">&nbsp;<?php echo ($row->actor_identity == '') ? '<center>-</center>' : $row->actor_identity; ?></td>
                    <td style="vertical-align: middle;text-decoration: <?php echo $row->actor_status != 1 ? 'line-through' : 'none'; ?>" colspan="2"><?php echo strtoupper($row->actor_address); ?></td>
                    <td style="vertical-align: middle;text-decoration: <?php echo $row->actor_status != 1 ? 'line-through' : 'none'; ?>" colspan="2">&nbsp;<?php echo strtoupper($row->actor_phone); ?></td>
                    <td style="vertical-align: middle;text-decoration: <?php echo $row->actor_status != 1 ? 'line-through' : 'none'; ?>" colspan="1"><?php echo ($row->actor_email == '') ? '<center>-</center>' : strtoupper($row->actor_email); ?></td>
                    <td style="vertical-align: middle;text-align: center; text-decoration: <?php echo $row->actor_status != 1 ? 'line-through' : 'none'; ?>"><?php echo ($row->actor_status) ? 'AKTIF' : 'TIDAK AKTIF'; ?></td>  
                </tr>
            <?php } ?>
        <?php else: ?>
            <tr>
                <td colspan="15" style="color: gray; vertical-align: middle; text-align: center;">BELUM ADA DATA TERSEDIA</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>