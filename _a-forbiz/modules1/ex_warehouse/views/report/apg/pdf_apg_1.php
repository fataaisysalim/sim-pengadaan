<?php

$html = '
<html>
<head>
<style>
*{{
    font-family: monospace;
    line-height: 1.2;
}
body{
    width: 768px;
    margin: 40px auto;
}
table{
    font-family: monospace;
    width: 100%;
    font-size: 10px;
    border-collapse: collapse;
}
table th{
    font-size: 10px;
}
table thead{
    text-align: center;
}
</style>
</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">';
$html .= '<table style="text-align: left; width: 100%">'
        . '<tr> <td colspan="10" ><h3>' . strtoupper($apps->apps_client) . '</h3></td> </tr>'
        . '<tr> <td colspan="10" ><b>' . ucwords($project->project_name) . '</b></td> </tr>'
        . '<tr> <td colspan="10" >' . ucwords($project->project_address) . '</td>'
        . '</tr> '
        . '</table>';
$html .= '<table style="text-align: left; width: 100%"> '
        . '<tr> <th colspan="10" style="text-align: right; font-size: 20px;">ADMINISTRASI PERSEDIAAN GUDANG (APG)</th> </tr> '
        . '<tr> '
        . '<td colspan="10" style="text-align: right; font-size: 12px; font-weight: bold;">';
$html .= date_format_indo_tgl($start);
$html .= ($start != $ends && $start <= $ends) ? ' - ' . strtoupper(date_format_indo_tgl($ends)) : '';
$html .= '</td> '
        . '</tr> '
        . '</table>';
$html .= '<table style="text-align: center; width: 100%"> '
        . '<tr> '
        . '<th style="text-align: left; width: 120px;">Kode Material</th> '
        . '<th style="text-align: left;"> : ' . $mt->material_code . '</th> '
        . '</tr> '
        . '<tr> '
        . '<th style="text-align: left; width: 120px;">Nama Material</th> '
        . '<th style="text-align: left;"> : ' . $mt->material_sub_name . '</th> '
        . '</tr> '
        . '<tr> '
        . '<td colspan="10" style="text-align: center;">&nbsp;</td> '
        . '</tr> '
        . '</table>';
$html .= '</htmlpageheader>'
        . '<htmlpagefooter name="myfooter"> '
        . '<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; "> Page {PAGENO} of {nb} </div> '
        . '</htmlpagefooter>'
        . '<sethtmlpageheader name="myheader" value="on" show-this-page="1" />'
        . '<sethtmlpagefooter name="myfooter" value="on" />'
        . 'mpdf-->';

$html .= '<table border="1" style="width: 100%"> '
        . '<thead> '
        . '<tr> '
        . '<th style="background: whitesmoke;" rowspan="2">NO</th> '
        . '<th style="background: whitesmoke;" rowspan="2">TANGGAL</th> '
        . '<th style="background: whitesmoke;" colspan="2">NO BUKTI</th> '
        . '<th style="background: whitesmoke;" rowspan="2">URAIAN</th> '
        . '<th style="background: whitesmoke;" colspan="3">VOLUME</th> '
        . '<th style="background: whitesmoke;" colspan="2">PARAF</th> '
        . '</tr> '
        . '<tr> '
        . '<th style="background: whitesmoke;">BAPB</th> '
        . '<th style="background: whitesmoke;">BPM</th> '
        . '<th style="background: whitesmoke;">MASUK</th> '
        . '<th style="background: whitesmoke;">KELUAR</th> '
        . '<th style="background: whitesmoke;">SISA</th> '
        . '<th style="background: whitesmoke;">GUDANG</th> '
        . '<th style="background: whitesmoke;">KEU</th> '
        . '</tr> '
        . '</thead>';
$html .= '<tbody>';
if (count($show) > 0) :
    $entrying = 0;
    $exiting = 0;
    $stok = 0;
    foreach ($show as $i => $row) :
        $html .= '<tr>';
        $html .= '<td style="vertical-align: middle; text-align: center;">' . ++$i . '</td> '
                . '<td style="vertical-align: middle; text-align: center;">' . indo_date($row->stock_date, 1, 1) . '</td> '
                . '<td style="vertical-align: middle; text-align: center;">&nbsp;' . (($row->transaction_ct_id == 1) ? $row->mog_number : ' - ') . '</td> '
                . '<td style="vertical-align: middle; text-align: center;">&nbsp;' . (($row->transaction_ct_id == 2) ? $row->mog_number : ' - ') . '</td> '
                . '<td style="vertical-align: middle; text-align: left;">' . (!empty($row->actor_name) ? $row->actor_name : 'Stok Awal') . '</td> '
                . '<td style="vertical-align: middle; text-align: center;">' . (!empty($row->stock_entry) ? $row->stock_entry : '-') . '</td> '
                . '<td style="vertical-align: middle; text-align: center;">' . (!empty($row->stock_exit) ? $row->stock_exit : '-') . '</td> '
                . '<td style="vertical-align: middle; text-align: center;">' . (!empty($row->stock_rest) ? $row->stock_rest : '0') . '</td> '
                . '<td style="vertical-align: middle; text-align: center;"></td> '
                . '<td style="vertical-align: middle; text-align: center;"></td>';
        $html .= '</tr>';
        $entrying += $row->stock_entry;
        $exiting += $row->stock_exit;
        $stok += $row->stock_rest;
    endforeach;
    $html .= '<tr> '
            . '<th colspan="5" style="vertical-align: middle; text-align: right;">JUMLAH</th> '
            . '<th style="vertical-align: middle; text-align: center;">' . $entrying . '</th> '
            . '<th style="vertical-align: middle; text-align: center;">' . $exiting . '</th> '
            . '<th style="vertical-align: middle; text-align: center;">' . $stok . '</th> '
            . '</tr>';
else:
    $html .= '<tr> <td colspan="11" style="color: gray; vertical-align: middle; text-align: center;">Belum ada data tersedia</td> </tr>';
endif;
$html .= '</tbody>';
$html .= '</table>';
$html .= '</body></html>';

$mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 48, 25, 10, 10);
$mpdf->SetProtection(array('print'));
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
?>