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
echo '<pre>';
print_r($header);
echo '</pre>';
echo $header_1;
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
        <?php $j = 0; ?>
        <?php $dummy = 0; ?>
        <?php foreach ($array as $body_index => $body) : ?>
            <tr>
                <td></td>
                <td><?php echo indo_date($body['equipment_stock_date'], 2); ?></td>
                <td></td>
                <td></td>
                <?php for ($i = 0; $i < $header_1; $i ++) : ?>
                    <?php $dummy = isset($body['detail'][$i]) ? $body['detail'][$i]['equipment_id'] : ''; ?>
                    <?php $vara = isset($body['detail'][$j]) ? $body['detail'][$j]['equipment_id'] : ''; ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                <?php endfor; ?>
            </tr>
            <?php $j++; ?>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
echo '<pre>';
print_r($array);
echo '</pre>  ';
