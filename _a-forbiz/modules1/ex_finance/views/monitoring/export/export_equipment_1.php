<?php
//header("Content-type: application/vnd.ms-excel");
//header("Content-disposition: attachment; filename=" . $title_file . "_" . (date_format_indo_only_tgl(date('Y-m-d'))) . ".xls");
//header("Pragma: no-cache");
//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//header("Expires: 0");
//$br = '<br><br>';
?>
<table style="width: 100%;">
    <tr>
        <th colspan="15">&nbsp;</th>
    </tr>
    <tr>
        <th colspan="15"><h3>MONITORING PEMBAYARAN &  PROGRESS</h3></th>
</tr>
<tr>
    <th colspan="15">&nbsp;</th>
</tr>
</table>
<table border="1">
    <thead>
        <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">Tanggal</th>
            <th rowspan="2">No. Surat</th>
            <th rowspan="2">No. Pol</th>
            <?php $h = 0; ?>
            <?php foreach ($array as $indexhead => $rowhead) : ?>
                <?php foreach ($rowhead['equipment_data'] as $in => $rhe) : ?>
                    <th colspan="5"><?php echo $rhe['equipment_name'] . '-' . $rhe['equipment_type']; ?></th>
                <?php endforeach; ?>
                <?php $h++; ?>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php $h = 0; ?>
            <?php foreach ($array as $indexhead => $rowhead) : ?>
                <?php foreach ($rowhead['equipment_data'] as $in => $rhe) : ?>
                    <th>Harsat</th>
                    <th>IN</th>
                    <th>OUT</th>
                    <th>SALDO</th>
                    <th>RUPIAH</th>
                <?php endforeach; ?>
                <?php $h++; ?>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0; ?>
        <?php foreach ($array as $index => $row) : ?>
            <tr>
                <td>1</td>
                <td><?php echo indo_date($row['equipment_stock_date'], 2); ?></td>
                <td></td>
                <td></td>

                <?php $h = 0; ?>
                <?php foreach ($array as $indexhead => $rowhead) : ?>
                    <?php if (count($rowhead['equipment_data']) > 0) : ?>
                        <?php foreach ($rowhead['equipment_data'] as $iby => $rby) : ?>
                            <th><?php echo number_format($rby['equipment_stock_price'], 0, '', '.'); ?></th>
                            <th><?php echo $rby['entrys']; ?></th>
                            <th><?php echo $rby['exits']; ?></th>
                            <th><?php echo $rby['rests']; ?></th>
                            <th><?php echo number_format($rby['rests'] * $rby['selisih'] * $rby['equipment_stock_price'], 0, '', '.'); ?></th>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php $h++; ?>
                <?php endforeach; ?>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td>Jumlah</td>
            <td></td>
            <td></td>
            <?php $h = 0; ?>
            <?php foreach ($array as $indexhead => $rowhead) : ?>
                <?php foreach ($rowhead['equipment_data'] as $in => $rhe) : ?>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                <?php endforeach; ?>
                <?php $h++; ?>
            <?php endforeach; ?>
        </tr>
    </tfoot>
</table>
<?php
echo '<pre>';
print_r($array);
echo '</pre>';
