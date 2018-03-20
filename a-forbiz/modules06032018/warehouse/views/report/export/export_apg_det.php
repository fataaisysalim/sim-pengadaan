<?php
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=" . $title_file . "_" . (date_format_indo_only_tgl($start)) . "_" . (date_format_indo_only_tgl($ends)) . ".xls");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Expires: 0");
$br = '<br><br>';
$colti = 12;
$colvol = 3;
$coltovol = 7;
$colemp = 12;
if (!empty($mt->material_sub_convertion) || $mt->material_sub_convertion > 0) :
    $colti = 16;
    $colvol = 7;
    $coltovol = 11;
    $colemp = 16;
endif;
?>
<table style="text-align: left; width: 100%">
    <tr>
        <td colspan="<?php echo $colti; ?>" ><h3><?php echo strtoupper($apps->apps_client); ?></h3></td>
    </tr>
    <tr>
        <td colspan="<?php echo $colti; ?>" ><b><?php echo strtoupper($project->project_name); ?></b></td>
    </tr>
    <tr>
        <td colspan="<?php echo $colti; ?>" ><?php echo strtoupper($project->project_address); ?></td>
    </tr>
</table>
<table style="text-align: left; width: 100%">
    <tr>
        <th colspan="<?php echo $colti; ?>" style="text-align: right; font-size: 20px;">ADMINISTRASI PERSEDIAAN GUDANG (APG)</th>
    </tr>
    <tr>
        <td colspan="<?php echo $colti; ?>" style="text-align: right; font-size: 12px; font-weight: bold;"><?php echo strtoupper(date_format_indo_tgl($start)); ?><?php echo ($start != $ends && $start <= $ends) ? ' - ' . strtoupper(date_format_indo_tgl($ends)) : ''; ?></td>
    </tr>
</table>
<table style="text-align: center; width: 100%">
    <tr>
        <th style="text-align: left; width: 120px;" colspan="2">KODE MATERIAL</th>
        <th style="text-align: left;" colspan="<?php echo $colti - 2; ?>"> : <?php echo strtoupper($mt->material_code); ?></th>
    </tr>   
    <tr>
        <th style="text-align: left; width: 120px;" colspan="2">NAMA MATERIAL</th>
        <th style="text-align: left;" colspan="<?php echo $colti - 2; ?>"> : <?php echo strtoupper($mt->material_sub_name); ?></th>
    </tr>
    <tr>
        <td colspan="<?php echo $colti; ?>" style="text-align: center;">&nbsp;</td>
    </tr>
</table>
<table border="1" style="width: 100%">
    <thead>
        <tr>
            <th style="background: whitesmoke;" rowspan="2">NO</th>
            <th style="background: whitesmoke;" rowspan="2">TANGGAL</th>
            <th style="background: whitesmoke;" colspan="2">NO BUKTI</th>
            <th style="background: whitesmoke;" rowspan="2">URAIAN</th>
            <th style="background: whitesmoke;" colspan="<?php echo $colvol; ?>">VOLUME</th>
            <th style="background: whitesmoke;" colspan="4">PARAF</th>
        </tr>
        <tr>
            <th style="background: whitesmoke;">BAPB</th>
            <th style="background: whitesmoke;">BPM</th>
            <th style="background: whitesmoke;">MASUK</th>
            <?php if (!empty($mt->material_sub_convertion) || $mt->material_sub_convertion > 0) : ?>
                <th style="background: whitesmoke;">KONVERSI</th>
                <th style="background: whitesmoke;">KG</th>
            <?php endif; ?>
            <th style="background: whitesmoke;">KELUAR</th>
            <?php if (!empty($mt->material_sub_convertion) || $mt->material_sub_convertion > 0) : ?>
                <th style="background: whitesmoke;">KONVERSI</th>
                <th style="background: whitesmoke;">KG</th>
            <?php endif; ?>
            <th style="background: whitesmoke;">SISA</th>
            <th style="background: whitesmoke;" colspan="2">GUDANG</th>
            <th style="background: whitesmoke;" colspan="2">KEU</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($show) > 0) :
            $entrying = 0;
            $exiting = 0;
            $entrying_con = 0;
            $exiting_con = 0;
            $stok = 0;
            ?>
            <?php foreach ($show as $i => $row) { ?>
                <tr>
                    <td style="vertical-align: middle; text-align: center;"><?php echo++$i; ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo indo_date($row->stock_date, 1, 1); ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo ($row->transaction_ct_id == 1) ? $row->mog_number : '-'; ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo ($row->transaction_ct_id == 2) ? $row->mog_number : '-'; ?></td>
                    <td style="vertical-align: middle; text-align: left;"><?php echo!empty($row->actor_name) ? $row->actor_name : "STOK AWAL"; ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo!empty($row->stock_entry) ? rupiah($row->stock_entry) : "-" ?></td>
                    <?php if (!empty($row->material_sub_convertion) || $row->material_sub_convertion > 0) : ?>
                        <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo!empty($row->material_sub_convertion) ? rupiah($row->material_sub_convertion, 2) : "-" ?></td>
                        <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo!empty($row->stock_entry) ? rupiah($row->stock_entry * $row->material_sub_convertion) : "-" ?></td>
                    <?php endif; ?>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo!empty($row->stock_exit) ? $row->stock_exit : "-" ?></td>
                    <?php if (!empty($row->material_sub_convertion) || $row->material_sub_convertion > 0) : ?>
                        <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo!empty($row->material_sub_convertion) ? rupiah($row->material_sub_convertion, 2) : "-" ?></td>
                        <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo!empty($row->stock_entry) ? rupiah($row->stock_exit * $row->material_sub_convertion, 2) : "-" ?></td>
                    <?php endif; ?>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo!empty($row->stock_rest) ? rupiah($row->stock_rest) : 0 ?></td>
                    <td style="vertical-align: middle; text-align: center;" colspan="2"></td>
                    <td style="vertical-align: middle; text-align: center;" colspan="2"></td>
                </tr>
                <?php
                $entrying += $row->stock_entry;
                $exiting += $row->stock_exit;
                $entrying_con = $row->material_sub_convertion;
                $exiting_con = $row->material_sub_convertion;
                $stok += $row->stock_rest;
            }
            ?>
            <tr>
                <th colspan="<?php echo $coltovol; ?>" style="vertical-align: middle; text-align: right;">JUMLAH : </th>
                <th style="vertical-align: middle; text-align: center;">&nbsp;<?php echo rupiah($dt->stock_rest) ?></th>
                <th colspan="4"></th>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="<?php echo $colemp; ?>" style="color: gray; vertical-align: middle; text-align: center;">Belum ada data tersedia</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>