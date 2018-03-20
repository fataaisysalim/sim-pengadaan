<?php
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=" . $title_file . "_" . (date_format_indo_only_tgl(date('Y-m-d'))) . ".xls");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Expires: 0");
$br = '<br><br>';
?>
<table style="text-align: left; width: 100%">
    <tr>
        <td colspan="<?php echo ((count($head) * 5) + 4); ?>" ><h3 style="margin: 0px 0 10px 0;"><?php echo strtoupper($apps->apps_client); ?></h3></td>
    </tr>
    <tr>
        <td colspan="<?php echo ((count($head) * 5) + 4); ?>"><b><?php echo ucwords($project->project_name); ?></b></td>
    </tr>
    <tr>
        <td colspan="<?php echo ((count($head) * 5) + 4); ?>" ><?php echo ucwords($project->project_address); ?></td>
    </tr>
</table>
<table style="width: 100%;">
    <tr>
        <th colspan="<?php echo ((count($head) * 5) + 4); ?>">&nbsp;</th>
    </tr>
    <tr>
        <th colspan="<?php echo ((count($head) * 5) + 4); ?>" style="vertical-align: middle;"><h3>MONITORING STOCK SCAFFOLDING</h3></th>
</tr>
<tr>
    <th colspan="1" style=" width: 100px; text-align: left;">Dari</th>
    <th colspan="<?php echo ((count($head) * 5) + 3); ?>" style="text-align: left;">: <?php echo $actor->actor_name; ?></th>
</tr>
</table>
<table border="1" style="width: 100%;">
    <thead>
        <tr>
            <th rowspan="2" style="background: whitesmoke; text-align: center;">No.</th>
            <th rowspan="2" style="background: whitesmoke; text-align: center;">Tanggal</th>
            <th rowspan="2" style="background: whitesmoke; text-align: center;">No. Surat</th>
            <th rowspan="2" style="background: whitesmoke; text-align: center;">No. Pol</th>
            <?php foreach ($head as $indexhead => $rowhead) : ?>
                <th colspan="5" style="background: whitesmoke; text-align: center;"><?php echo $rowhead['equipment_name'] . '-' . $rowhead['equipment_type']; ?></th>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($head as $indexhead => $rowhead) : ?>
                <th style="background: whitesmoke; text-align: center;">HARSAT</th>
                <th style="background: whitesmoke; text-align: center;">IN</th>
                <th style="background: whitesmoke; text-align: center;">OUT</th>
                <th style="background: whitesmoke; text-align: center;">SALDO</th>
                <th style="background: whitesmoke; text-align: center;">RUPIAH</th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php $total = array(); ?>
        <?php $total_in = array(); ?>
        <?php $total_out = array(); ?>
        <?php $total_rest = array(); ?>
        <?php if (count($head) > 0) : ?>
            <?php foreach ($head as $indexhead => $rowhead) : ?>
                <?php $total[] = 0; ?>
                <?php $total_in[] = 0; ?>
                <?php $total_out[] = 0; ?>
                <?php $total_rest[] = 0; ?>
            <?php endforeach; ?>
            <?php foreach ($array as $arri => $rowi) : ?>
                <?php if (is_numeric($arri)) : ?>
                    <tr>
                        <td><?php echo $arri + 1; ?>.</td>
                        <td><?php echo indo_date($rowi['equipment_stock_date']); ?></td>
                        <td></td>
                        <td></td>
                        <?php foreach ($rowi['equipment_stock_detail'] as $di => $rodi) : ?>
                            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($rodi['equipment_price'], 0, '', '.'); ?></td>
                            <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo $rodi['equipment_entry']; ?></td>
                            <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo $rodi['equipment_exit']; ?></td>
                            <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo $rodi['equipment_rest']; ?></td>
                            <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($rodi['equipment_subtotal'], 0, '', '.'); ?></td>
                            <?php $total[$di] = $total[$di] + $rodi['equipment_subtotal']; ?>
                            <?php $total_in[$di] = $total_in[$di] + $rodi['equipment_entry']; ?>
                            <?php $total_out[$di] = $total_out[$di] + $rodi['equipment_exit']; ?>
                            <?php $total_rest[$di] = $total_rest[$di] + $rodi['equipment_rest']; ?>
                        <?php endforeach; ?>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="<?php echo ((count($head) * 5) + 4); ?>" style="vertical-align: middle; text-align: left;">Data belum tersedia</td>
            </tr>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" style="vertical-align: middle; text-align: right;">Total :</td>
            <?php foreach ($total as $index => $row) : ?>
                <td></td>
                <td style="vertical-align: middle; text-align: center;"><?php echo $total_in[$index]; ?></td>
                <td style="vertical-align: middle; text-align: center;"><?php echo $total_out[$index]; ?></td>
                <td style="vertical-align: middle; text-align: center;"><?php echo $total_in[$index] - $total_out[$index]; ?></td>
                <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($row, 0, '', '.'); ?></td>
            <?php endforeach; ?>
        </tr>
    </tfoot>
</table>
<table style="width: 100%;">
    <tr>
        <th colspan="<?php echo ((count($head) * 5) + 4); ?>">&nbsp;</th>
    </tr>
</table>
<table border="1" style="width: 100%;">
    <?php if (count($total) > 0) : ?>
        <tr>
            <td style="vertical-align: middle; text-align: center; background: whitesmoke;">NO</td>
            <td style="vertical-align: middle; text-align: center; background: whitesmoke;" colspan="3">URAIAN</td>
            <?php if (count($total) > 0) : ?>
                <?php foreach ($total as $index => $row) : ?>
                    <td style="vertical-align: middle; text-align: center; background: whitesmoke;" colspan="1">SATUAN</td>
                    <td style="vertical-align: middle; text-align: center; background: whitesmoke;" colspan="4">NILAI HUTANG</td>
                <?php endforeach; ?>
            <?php endif; ?>
        </tr>
        <tr>
            <td style="vertical-align: middle; text-align: center;">A</td>
            <td colspan="3" style="vertical-align: middle; text-align: left;">TOTAL HUTANG</td>
            <?php if (count($total) > 0) : ?>
                <?php foreach ($total as $index => $row) : ?>
                    <td colspan="1" style="text-align: center;">Rp.</td>
                    <td colspan="4" style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($row, 0, '', '.'); ?></td>
                <?php endforeach; ?>
            <?php endif; ?>
        </tr>
    <?php endif; ?>
</table>
<table style="width: 100%;">
    <tr>
        <th colspan="<?php echo ((count($head) * 5) + 4); ?>">&nbsp;</th>
    </tr>
</table>
<table border="1" style="width: 100%;">
    <?php if (count($total) > 0) : ?>
        <tr>
            <td style="vertical-align: middle; text-align: center; background: whitesmoke;">NO</td>
            <td style="vertical-align: middle; text-align: center; background: whitesmoke;" colspan="3">URAIAN</td>
            <?php if (count($total) > 0) : ?>
                <?php foreach ($total as $index => $row) : ?>
                    <td style="vertical-align: middle; text-align: center; background: whitesmoke;" colspan="1">SATUAN</td>
                    <td style="vertical-align: middle; text-align: center; background: whitesmoke;" colspan="4">NILAI HUTANG</td>
                <?php endforeach; ?>
            <?php endif; ?>
        </tr>
        <tr>
            <td style="vertical-align: middle; text-align: center;">A</td>
            <td colspan="3" style="vertical-align: middle; text-align: left;">TOTAL HUTANG</td>
            <?php if (count($total) > 0) : ?>
                <?php foreach ($total as $index => $row) : ?>
                    <td colspan="1" style="text-align: center;">Rp.</td>
                    <td colspan="4" style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($row, 0, '', '.'); ?></td>
                <?php endforeach; ?>
            <?php endif; ?>
        </tr>
        <tr>
            <td style="vertical-align: middle; text-align: center;">B</td>
            <td colspan="<?php echo ((count($head) * 5) + 3); ?>" style="vertical-align: middle; text-align: left;">SUDAH DIBAYAR</td>
        </tr>
        <?php $total_array = array(); ?>
        <?php $total_total = array(); ?>
        <?php foreach ($head as $indexhead => $rowhead) : ?>
            <?php $total_array[] = 0; ?>
            <?php $total_total[] = 0; ?>
        <?php endforeach; ?>
        <?php foreach ($array_total as $arri => $rowi) : ?>
            <?php if (is_numeric($arri)) : ?>
                <tr>
                    <td style="text-align: right;"><?php echo $arri + 1; ?>.</td>
                    <td colspan="3"><?php echo indo_date($rowi['debt_date']); ?></td>
                    <?php foreach ($rowi['debt_detail'] as $di => $rodi) : ?>
                        <td colspan="1" style="text-align: center;">Rp.</td>
                        <td colspan="4" style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($rodi['equipment_pay'], 0, '', '.'); ?></td>
                        <?php $total_array[$di] = $total_array[$di] + $rodi['equipment_pay']; ?>
                        <?php $total_total[$di] = $total[$di] - $total_array[$di]; ?>
                    <?php endforeach; ?>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <tr>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td colspan="3" style="vertical-align: middle; text-align: left;">TOTAL B</td>
            <?php foreach ($total_array as $index => $row) : ?>
                <td colspan="1" style="text-align: center;">Rp.</td>
                <td colspan="4" style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($row, 0, '', '.'); ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td colspan="<?php echo ((count($head) * 5) + 4); ?>" style="vertical-align: middle; text-align: left;">&nbsp;</td>
        </tr>
        <tr>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td colspan="3" style="vertical-align: middle; text-align: left;">SISA HUTANG A - B</td>
            <?php foreach ($total_total as $index => $row) : ?>
                <td colspan="1" style="text-align: center;">Rp.</td>
                <td colspan="4" style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($row, 0, '', '.'); ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endif; ?>
</table>