<?php
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=" . $title_file . ".xls");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Expires: 0");
$br = '<br><br>';
?>
<table style="text-align: left; width: 100%">
    <tr>
        <td colspan="8"><h3><?php echo strtoupper($apps->apps_client); ?></h3></td>
    </tr>
    <tr>
        <td colspan="8"><b><?php echo ucwords($project->project_name); ?></b></td>
    </tr>
    <tr>
        <td colspan="8"><?php echo ucwords($project->project_address); ?></td>
    </tr>
</table>
<table style="text-align: left; width: 100%">
    <tr>
        <th colspan="8" style="text-align: right; font-size: 20px;">MONITORING BAPB SUPPLIER</th>
    </tr>
</table>
<table style="text-align: center; width: 100%">
    <tr>
        <th style="text-align: left; width: 120px;" colspan="2">KODE SUPPLIER</th>
        <th style="text-align: left;"> : <?php echo!empty($sp->actor_code) ? strtoupper($sp->actor_code) : "&nbsp;&nbsp;&nbsp;-"; ?></th>
    </tr>   
    <tr>
        <th style="text-align: left; width: 120px;" colspan="2">NAMA SUPPLIER</th>
        <th style="text-align: left;"> : <?php echo strtoupper($sp->actor_name); ?></th>
    </tr>
    <tr>
        <td colspan="8" style="text-align: center;">&nbsp;</td>
    </tr>
</table>
<table border="1" style="width: 100%">
    <thead>
        <tr>
            <th style="background: whitesmoke;" rowspan="2">NO</th>
            <th style="background: whitesmoke;" colspan="2">BAPB</th>
            <th style="background: whitesmoke;" rowspan="2">URAIAN</th>
            <th style="background: whitesmoke;" rowspan="2">KONVERSI</th>
            <th style="background: whitesmoke;" rowspan="2">VOLUME</th>
            <th style="background: whitesmoke;" rowspan="2">HARGA</th>
            <th style="background: whitesmoke;" rowspan="2">TOTAL</th>
        </tr>
        <tr>
            <th style="background: whitesmoke;">TANGGAL</th>
            <th style="background: whitesmoke;">NOMOR</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($show) > 0) : ?>
            <?php $total = 0; foreach ($show as $i => $row) { ?>
                <tr>
                    <td style="vertical-align: middle; text-align: center;"><?php echo ++$i; ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo strtoupper(indo_date($row->mog_dt_date, 1, 1)); ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo $row->mog_number; ?></td>
                    <td style="vertical-align: middle; text-align: left;"><?php echo strtoupper($row->material_sub_name); ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo!empty($row->mog_dt_convertion) ? rupiah($row->mog_dt_convertion) : "<center>-</center>"; ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo rupiah($row->mog_dt_volume); ?></td>
                    <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo $row->mog_dt_price != 0 ? rupiah($row->mog_dt_price) : 0; ?></td>
                    <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo ($row->mog_dt_volume * $row->mog_dt_price * $row->mog_dt_convertion== 0?1:$row->mog_dt_convertion) != 0 ? rupiah($row->mog_dt_volume * $row->mog_dt_price * ($row->mog_dt_convertion == 0?1:$row->mog_dt_convertion)) : 0; ?></td>
                </tr>
            <?php $total += ($row->mog_dt_volume * $row->mog_dt_price * ($row->mog_dt_convertion == 0?1:$row->mog_dt_convertion)); } ?>
                <tr>
                    <td colspan="7" style="text-align: right; font-weight: bold">TOTAL KESELURUHAN</td>
                    <td style="text-align: right; font-weight: bold">&nbsp;<?php echo rupiah($total)?></td>
                </tr>
        <?php else: ?>
            <tr>
                <td colspan="8" style="color: gray; vertical-align: middle; text-align: center;">Belum ada data tersedia</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>