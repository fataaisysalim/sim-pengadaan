<?php
//header("Content-type: application/vnd.ms-excel");
//header("Content-disposition: attachment; filename=" . $title_file . "_" . (date_format_indo_only_tgl(date('Y-m-d'))) . ".xls");
//header("Pragma: no-cache");
//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//header("Expires: 0");
//$br = '<br><br>';
$header = array();
$header_1 = 0;
foreach ($array as $head_index => $head) :
    foreach ($head['detail'] as $heaex => $he) :
        $header[] = $he['equipment_name'] . '-' . $he['equipment_type'];
    endforeach;
    $header_1++;
endforeach;
$header = array_unique($header);
echo $header_1;
?>
<table border="1">
    <thead>
        <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">Tanggal</th>
            <th rowspan="2">No. Surat</th>
            <th rowspan="2">No. Pol</th>
            <?php foreach ($header as $head_index => $head) : ?>
                <th colspan="5"><?php echo $head; ?></th>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($header as $head_index => $head) : ?>
                <th>HARSAT</th>
                <th>IN</th>
                <th>OUT</th>
                <th>SALDO</th>
                <th>RUPIAH</th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0; ?>
        <?php foreach ($array as $body_index => $body) : ?>
            <tr>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo indo_date($body['equipment_stock_date'], 2); ?></td>
                <td></td>
                <td></td>
                <?php if (count($body['detail'][$i]) > 0) : ?>
                    <?php foreach ($body['detail'] as $body_detail => $bodydetail) : ?>
                        <?php if (!isset($body_detail)) : ?>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        <?php else: ?>
                            <td><?php echo $bodydetail['equipment_stock_price']; ?></td>
                            <td><?php echo $bodydetail['entrys']; ?></td>
                            <td><?php echo $bodydetail['exits']; ?></td>
                            <td><?php echo $bodydetail['rests']; ?></td>
                            <td><?php echo $bodydetail['rests'] * $bodydetail['selisih'] * $bodydetail['equipment_stock_price']; ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                <?php endif; ?>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
//echo '<pre>';
//print_r($array);
//echo '</pre>';
?>
