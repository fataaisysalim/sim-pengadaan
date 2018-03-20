<?php
//header("Content-type: application/vnd.ms-excel");
//header("Content-disposition: attachment; filename=" . $title_file . "_" . (date_format_indo_only_tgl(date('Y-m-d'))) . ".xls");
//header("Pragma: no-cache");
//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//header("Expires: 0");
//$br = '<br><br>';
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
<br/>
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
        <?php if (count($head) > 0) : ?>
            <?php foreach ($head as $indexhead => $rowhead) : ?>
                <?php $total[] = 0; ?>
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

</table>
<table border="1" style="width: 100%;">
    <?php if (count($total) > 0) : ?>
            <!--<tfoot>-->
        <tr>
            <td colspan="4" style="vertical-align: middle; text-align: right;">Total :</td>
            <?php foreach ($total as $index => $row) : ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($row, 0, '', '.'); ?></td>
            <?php endforeach; ?>
        </tr>

        <tr>
            <th colspan="<?php echo ((count($head) * 5) + 4); ?>">&nbsp;</th>
        </tr>
        <tr>
            <th colspan="<?php echo ((count($head) * 5) + 4); ?>">&nbsp;</th>
        </tr>
        <tr>
            <td style="vertical-align: middle; text-align: center; background: whitesmoke;">NO</td>
            <td style="vertical-align: middle; text-align: center; background: whitesmoke;" colspan="<?php echo ((count($head) * 5) + 3); ?>">URAIAN</td>
        </tr>
        <tr>
            <td style="vertical-align: middle; text-align: center;">A</td>
            <td colspan="3" style="vertical-align: middle; text-align: left;">TOTAL HUTANG</td>
            <!--<td style="vertical-align: middle; text-align: left;"></td>-->
            <!--<td style="vertical-align: middle; text-align: left;"></td>-->
            <?php if (count($total) > 0) : ?>
                <?php foreach ($total as $index => $row) : ?>
                    <td colspan="4"></td>
                            <!--<td></td>-->
                            <!--<td></td>-->
                            <!--<td></td>-->
                            <!--<td></td>-->
                    <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($row, 0, '', '.'); ?></td>
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
                    <td><?php echo $arri + 1; ?>.</td>
                    <td colspan="3"><?php echo indo_date($rowi['debt_date']); ?></td>
                    <!--<td></td>-->
                    <!--<td></td>-->
                    <?php foreach ($rowi['debt_detail'] as $di => $rodi) : ?>
                        <td colspan="4"></td>
                        <!--<td style="vertical-align: middle; text-align: right;"></td>-->
                        <!--<td style="vertical-align: middle; text-align: right;"></td>-->
                        <!--<td style="vertical-align: middle; text-align: right;"></td>-->
                        <!--<td style="vertical-align: middle; text-align: right;"></td>-->
                        <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($rodi['equipment_pay'], 0, '', '.'); ?></td>
                        <?php $total_array[$di] = $total_array[$di] + $rodi['equipment_pay']; ?>
                        <?php $total_total[$di] = $total[$di] - $total_array[$di]; ?>
                    <?php endforeach; ?>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <tr>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td colspan="3" style="vertical-align: middle; text-align: left;">TOTAL B</td>
            <!--<td style="vertical-align: middle; text-align: left;"></td>-->
            <!--<td style="vertical-align: middle; text-align: left;"></td>-->
            <?php foreach ($total_array as $index => $row) : ?>
                <td colspan="4"></td>
                <!--<td></td>-->
                <!--<td></td>-->
                <!--<td></td>-->
                <!--<td></td>-->
                <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($row, 0, '', '.'); ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td colspan="<?php echo ((count($head) * 5) + 4); ?>" style="vertical-align: middle; text-align: left;">&nbsp;</td>
        </tr>
        <tr>
            <td style="vertical-align: middle; text-align: center;"></td>
            <td colspan="3" style="vertical-align: middle; text-align: left;">SISA HUTANG A - B</td>
            <!--<td style="vertical-align: middle; text-align: left;"></td>-->
            <!--<td style="vertical-align: middle; text-align: left;"></td>-->
            <?php foreach ($total_total as $index => $row) : ?>
                <td colspan="4"></td>
                <!--<td></td>-->
                <!--<td></td>-->
                <!--<td></td>-->
                <!--<td></td>-->
                <td style="vertical-align: middle; text-align: right;">&nbsp;<?php echo number_format($row, 0, '', '.'); ?></td>
            <?php endforeach; ?>
        </tr>
        <!--</tfoot>-->
    <?php endif; ?>
</table>