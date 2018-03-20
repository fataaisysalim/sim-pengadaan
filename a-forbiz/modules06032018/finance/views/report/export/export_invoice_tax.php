<?php
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=" . $title_file . "_" . (date_format_indo_only_tgl($starts)) . "_" . (date_format_indo_only_tgl($ends)) . ".xls");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0", false);
header("Expires: 0");
$br = '<br><br>';
?>
<table style="text-align: left; width: 100%">
    <tr>
        <td></td>
        <td colspan="1">
            <img src="<?php echo base_url("assets/folarium/pajak.png"); ?>" style="padding-left: 10px; padding-right: 10px; margin-left: auto; margin-right: auto;"/>
        </td>
        <td colspan="8" style="text-align: center;">
            <h3 style="margin: 5px;">LAMPIRAN 2</h3>
            <h3 style="margin: 5px;">DAFTAR PAJAK MASUKAN DAN <?php echo strtoupper($mode); ?> BM</h3>
            <h3 style="margin: 5px;">MASA PAJAK : 
                <?php echo (count($start_date) > 0) ? strtoupper(date_format_indo_without_tgl($start_date->starts)) : strtoupper(date_format_indo_without_tgl($starts)); ?>
            </h3>
        </td>
    </tr>
    <tr>
        <td colspan="10" style="text-align: center;">&nbsp;</td>
    </tr>
</table>
<table style="text-align: center; width: 100%">
    <tr>
        <td colspan="2" style="text-align: left;">NAMA PKP</td>
        <td colspan="3" style="text-align: left;">: <?php echo strtoupper($apps->apps_client); ?></td>
        <td colspan="2" style="text-align: left;">NPWP</td>
        <td colspan="3" style="text-align: left;">: <?php echo $apps->app_client_npwp; ?></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">NP. PKP</td>
        <td colspan="3" style="text-align: left;">: <?php echo strtoupper($apps->app_client_npkp); ?></td>
        <td colspan="2" style="text-align: left;">TGL. PENGUKUHAN PKP</td>
        <td colspan="3" style="text-align: left;">: <?php echo $apps->app_client_npkp_date; ?></td>
    </tr>
</table>
<table border="1" style="width: 100%">
    <thead>
        <tr>
            <th rowspan="2" style="background: whitesmoke;"><?php echo strtoupper('No.'); ?></th>
            <th rowspan="2" style="background: whitesmoke;"><?php echo strtoupper('Nama'); ?></th>
            <th rowspan="2" style="background: whitesmoke;"><?php echo strtoupper('NPWP'); ?></th>
            <th rowspan="2" style="background: whitesmoke;"><?php echo strtoupper('NPPKP'); ?></th>
            <th colspan="2" style="background: whitesmoke;"><?php echo strtoupper('Faktur Pajak / Nota Retur'); ?></th>
            <th rowspan="2" style="background: whitesmoke;"><?php echo strtoupper('DPP'); ?></th>
            <th rowspan="2" style="background: whitesmoke;"><?php echo strtoupper($mode); ?></th>
            <th rowspan="2" style="background: whitesmoke;"><?php echo strtoupper('Nomor Bukti'); ?></th>
            <th rowspan="2" style="background: whitesmoke;"><?php echo strtoupper('Unit Kerja'); ?></th>
        </tr>
        <tr>
            <th style="background: whitesmoke;"><?php echo strtoupper('Nomor Seri'); ?></th>
            <th style="background: whitesmoke;"><?php echo strtoupper('Tanggal'); ?></th>
        </tr>
    </thead>
    <tbody>        
        <?php
        $variable = array(
            'netto' => 0,
            'bruto' => 0,
            'tax_cuts' => 0,
            'tax_nominal' => 0,
            'dpp' => 0,
        );
        $total = array(
            'netto' => 0,
            'bruto' => 0,
            'tax_cuts' => 0,
            'tax_nominal' => 0,
            'dpp' => 0,
        );
        ?>
        <?php if (count($show) > 0) : ?> 
            <?php foreach ($show as $i => $row) { ?>
                <?php
                $variable['tax_cuts'] = 0;
                $variable['tax_nominal'] = 0;
                $variable['netto'] = $row->invoice_netto;
                $variable['dpp'] = $row->invoice_netto;

                foreach ($row->invoice_tax as $index_tax => $row_tax):
                    if (strtolower(str_replace(" ", "", $row_tax->tax_name)) == $mode) :
                        $variable['tax_cuts'] = $variable['tax_cuts'] + $row_tax->invoice_tax_cuts;
                        $variable['tax_nominal'] = $variable['tax_nominal'] + $row_tax->invoice_tax_nominal;
                    endif;
                endforeach;

                $total ['dpp'] = $total['dpp'] + $variable['dpp'];
                $total ['tax_nominal'] = $total['tax_nominal'] + $variable['tax_nominal'];
                ?>
                <tr>
                    <td style="vertical-align: middle; text-align: center;"><?php echo ++$i; ?></td>
                    <td style="vertical-align: middle; text-align: left;"><?php echo $row->actor_name; ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo ($row->actor_identity == '') ? '-' : $row->actor_identity; ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo ($row->actor_pkp_number == '') ? '-' : $row->actor_pkp_number; ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo $row->invoice_tax_serial; ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo indo_date($row->invoice_date_kwt, 1); ?></td>
                    <td style="vertical-align: middle; text-align: right;"><?php echo number_format($variable['dpp'], 0, '', '.'); ?></td>
                    <td style="vertical-align: middle; text-align: right;"><?php echo number_format($variable['tax_nominal'], 0, '', '.'); ?></td>
                    <td style="vertical-align: middle; text-align: center;"></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo strtoupper($row->project_name); ?></td>    
                </tr>
            <?php } ?>
        <tfoot>
            <tr>
                <th colspan="6" style="text-align: right;">Total :</th>
                <th style="text-align: right;"><?php echo number_format($total['dpp'], 0, '', '.'); ?></th>
                <th style="text-align: right;"><?php echo number_format($total['tax_nominal'], 0, '', '.'); ?></th>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
    <?php else: ?>
        <tr>
            <td colspan="10" style="color: gray; vertical-align: middle; text-align: center;">Belum ada data tersedia</td>
        </tr>
    <?php endif; ?>
</tbody>
</table>

<table style="width: 100%">
    <tbody>
        <tr>
            <td colspan="10" style="text-align: center;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: center;">Mengetahui</td>
            <td colspan="4" style="text-align: left;">Yogyakarta <?php echo date_format_indo_tgl($setting_date); ?></td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: center;">&nbsp;</td>
            <td colspan="4" style="text-align: left;">Penyusun, </td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: center;">&nbsp;</td>
            <td colspan="4" style="text-align: center;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: center;">&nbsp;</td>
            <td colspan="4" style="text-align: center;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: left;"></td>
            <td colspan="3" style="text-align: left;"></td>
            <td colspan="4" style="text-align: left;"></td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;">Manajer Proyek</td>
            <td colspan="3" style="text-align: center;">KSKA</td>
            <td colspan="4" style="text-align: left;">Staf Keuangan</td>
        </tr>
    </tbody>
</table>