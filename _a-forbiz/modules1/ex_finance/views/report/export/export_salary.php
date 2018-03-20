<?php
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=" . $title_file . "_" . (date_format_indo_only_tgl($start)) . "_" . (date_format_indo_only_tgl($ends)) . ".xls");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Expires: 0");
$br = '<br><br>';
?>
<table style="text-align: left; width: 50%">
    <tr>
        <td colspan="<?php echo ($mode == 'monitoring') ? '7' : '11'; ?>" style="text-align: center;"><h3 style="margin: 0;"><?php echo ($mode == 'monitoring') ? 'Monitoring Upah Mandor' : 'Laporan PPH Pasal '; ?></h3></td>
    </tr>
    <tr>
        <td colspan="<?php echo ($mode == 'monitoring') ? '7' : '11'; ?>" style="text-align: center;"><?php echo date_format_indo_tgl($setting_date); ?></td>
    </tr>
    <tr>
        <td colspan="<?php echo ($mode == 'monitoring') ? '7' : '11'; ?>" style="text-align: left;">&nbsp;</td>
    </tr>
</table>
<table border="1" style="width: 50%">
    <thead>
        <tr>
            <th style="background: whitesmoke;"><?php echo strtoupper('No.'); ?></th>
            <th style="background: whitesmoke;"><?php echo strtoupper('Unit Kerja'); ?></th>
            <th style="background: whitesmoke;"><?php echo strtoupper('Nama Mandor'); ?></th>
            <th style="background: whitesmoke;"><?php echo strtoupper('Nomor SP3'); ?></th>
            <th style="background: whitesmoke;"><?php echo strtoupper('Tgl'); ?></th>
            <th style="background: whitesmoke;"><?php echo strtoupper('Upah Mandor'); ?></th>
            <?php if ($mode != 'monitoring') : ?>
                <th style="background: whitesmoke;"><?php echo strtoupper('Upah yang diopnam'); ?></th>
                <th style="background: whitesmoke;"><?php echo strtoupper('Penghasilan Kena Pajak'); ?></th>
                <th style="background: whitesmoke;"><?php echo strtoupper('PPh Ps 21'); ?></th>
                <th style="background: whitesmoke;"><?php echo strtoupper('Tarif'); ?></th>
            <?php endif; ?>
            <th style="background: whitesmoke;"><?php echo strtoupper('No. Bukti'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($show) > 0) : ?> 
            <?php
            $variable = array(
                'pay' => 0,
                'opname' => 0,
                'pkp' => 0,
                'pph_cuts' => 0,
                'pph_nominal' => 0,
            );
            $total = array(
                'pay' => 0,
                'opname' => 0,
                'pkp' => 0,
                'pph_cuts' => 0,
                'pph_nominal' => 0,
            );
            ?>
            <?php foreach ($show as $i => $row) { ?>
                <?php
                $variable['pph_cuts'] = 0;
                $variable['pph_nominal'] = 0;
                $variable['pay'] = $row->salary_pay;
                $variable['opname'] = $row->salary_opname;
                $variable['pkp'] = $row->salary_pkp;

                foreach ($row->salary_tax as $index_tax => $row_tax):
                    if (strtolower(str_replace(" ", "", $row_tax->tax_name)) == "pph21") :
                        $variable['pph_cuts'] = $row_tax->salary_tax_cuts;
                        $variable['pph_nominal'] = $row_tax->salary_tax_nominal;
                    endif;
                endforeach;

                $total['pkp'] = $total['pkp'] + $variable['pkp'];
                $total['pph_nominal'] = $total['pph_nominal'] + $variable['pph_nominal'];
                ?>
                <tr>
                    <td style="vertical-align: middle; text-align: center;"><?php echo ++$i; ?></td>
                    <td style="vertical-align: middle; text-align: left;"><?php echo strtoupper($row->project_name); ?></td>
                    <td style="vertical-align: middle; text-align: left;"><?php echo $row->actor_name; ?></td>
                    <td style="vertical-align: middle; text-align: center;">&nbsp;<?php echo $row->salary_number; ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo indo_date($row->salary_date, 1); ?></td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo number_format($variable['pay'], 0, '', '.'); ?></td>
                    <?php if ($mode != 'monitoring') : ?>
                        <td style="vertical-align: middle; text-align: right;"><?php echo number_format($variable['opname'], 0, '', '.'); ?></td>
                        <td style="vertical-align: middle; text-align: right;"><?php echo number_format($variable['pkp'], 0, '', '.'); ?></td>
                        <td style="vertical-align: middle; text-align: right;"><?php echo number_format($variable['pph_nominal'], 0, '', '.'); ?></td>
                        <td style="vertical-align: middle; text-align: center;"><?php echo $variable['pph_cuts']; ?> %</td>
                    <?php endif; ?>
                    <td style="vertical-align: middle; text-align: left;">&nbsp;<?php echo $row->salary_evidence; ?></td>
                </tr>
            <?php } ?>
            <?php if ($mode != 'monitoring') : ?>
            <tfoot>
                <tr>
                    <th colspan="6"></th>
                    <th style='text-align: right;'>Total :</th>            
                    <th style="text-align: right;"><?php echo number_format($total['pkp'], 0, '', '.'); ?></th>
                    <th style="text-align: right;"><?php echo number_format($total['pph_nominal'], 0, '', '.'); ?></th>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        <?php endif; ?>
    <?php else: ?>
        <tr>
            <td colspan="<?php echo ($mode == 'monitoring') ? '7' : '11'; ?>" style="color: gray; vertical-align: middle; text-align: center;">Belum ada data tersedia</td>
        </tr>
    <?php endif; ?>
</tbody>
</table>
<?php if ($mode != 'monitoring') : ?>
    <table style="width: 50%">
        <tbody>
            <tr>
                <td colspan="11" style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: center;">Mengetahui</td>
                <td colspan="5" style="text-align: left;">Yogyakarta <?php echo date_format_indo_tgl($setting_date); ?></td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: center;">&nbsp;</td>
                <td colspan="5" style="text-align: left;">Penyusun, </td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: center;">&nbsp;</td>
                <td colspan="5" style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: center;">&nbsp;</td>
                <td colspan="5" style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: left;"></td>
                <td colspan="3" style="text-align: left;"></td>
                <td colspan="5" style="text-align: left;"></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;">Manajer Proyek</td>
                <td colspan="3" style="text-align: center;">KSKA</td>
                <td colspan="5" style="text-align: left;">Staf Keuangan</td>
            </tr>
        </tbody>
    </table>
<?php endif; ?>
