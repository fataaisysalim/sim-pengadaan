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
        $header[$he['equipment_id']] = $he['equipment_name'] . '-' . $he['equipment_type'];
    endforeach;
    $header_1++;
endforeach;
$header = array_unique($header);
$header_1 = count($header);
?>
<table border="1" style="width: 100%;">
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

                <?php foreach ($header as $head_index => $head) : ?>
                    <td style="vertical-align: middle; text-align: right;"><?php echo (isset($body['detail'][$i])) ? number_format($body['detail'][$i]['equipment_stock_price'], 0, '', '.') : '<center>-</center>'; ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo (isset($body['detail'][$i])) ? $body['detail'][$i]['entrys'] : '<center>-</center>'; ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo (isset($body['detail'][$i])) ? $body['detail'][$i]['exits'] : '<center>-</center>'; ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo (isset($body['detail'][$i])) ? $body['detail'][$i]['rests'] : '<center>-</center>'; ?></td>
                    <td style="vertical-align: middle; text-align: right;"><?php echo (isset($body['detail'][$i])) ? number_format(($body['detail'][$i]['equipment_stock_price'] * $body['detail'][$i]['selisih'] * $body['detail'][$i]['rests']), 0, '', '.') : '<center>-</center>'; ?></td>
                <?php endforeach; ?>
                <?php //for ($i = 0; $i < ($header_1); $i++) : ?>
                <?php //endfor; ?>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td style="vertical-align: middle; text-align: center;">NO.</td>
            <td>URAIAN</td>
            <td></td>
            <td></td>
            <?php for ($i = 0; $i < ($header_1); $i++) : ?>
                <td style="vertical-align: middle; text-align: right;"></td>
                <td style="vertical-align: middle; text-align: center;"><?php echo (isset($body['detail'][$i])) ? $body['detail'][$i]['entrys'] : '<center>-</center>'; ?></td>
                <td style="vertical-align: middle; text-align: center;"><?php echo (isset($body['detail'][$i])) ? $body['detail'][$i]['exits'] : '<center>-</center>'; ?></td>
                <td style="vertical-align: middle; text-align: center;"><?php echo (isset($body['detail'][$i])) ? $body['detail'][$i]['rests'] : '<center>-</center>'; ?></td>
                <td style="vertical-align: middle; text-align: right;"><?php echo (isset($body['detail'][$i])) ? number_format(($body['detail'][$i]['equipment_stock_price'] * $body['detail'][$i]['selisih'] * $body['detail'][$i]['rests']), 0, '', '.') : '<center>-</center>'; ?></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td style="vertical-align: middle; text-align: center;">A</td>
            <td>TOTAL HUTANG</td>
            <td></td>
            <td></td>
            <?php for ($i = 0; $i < ($header_1); $i++) : ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td style="vertical-align: middle; text-align: center;">B</td>
            <td>SUDAH DIBAYAR</td>
            <td></td>
            <td></td>
            <?php for ($i = 0; $i < ($header_1); $i++) : ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td></td>
            <td style="vertical-align: middle; text-align: right;">1.</td>
        </tr>
        <tr>
            <td></td>
            <td style="vertical-align: middle; text-align: right;">2.</td>
        </tr>
        <tr>
            <td></td>
            <td style="vertical-align: middle; text-align: right;">3.</td>
        </tr>
        <tr>
            <td style="vertical-align: middle; text-align: center;">C</td>
            <td>TOTAL B</td><td></td>
            <td></td>
            <?php for ($i = 0; $i < ($header_1); $i++) : ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td style="vertical-align: middle; text-align: center;">D</td>
            <td>SISA HUTANG A - B</td><td></td>
            <td></td>
            <?php for ($i = 0; $i < ($header_1); $i++) : ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            <?php endfor; ?>
        </tr>
    </tfoot>
</table>
<?php
echo '<pre>';
print_r($array);
echo '</pre>';
