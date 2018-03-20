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
        <?php foreach ($array as $arri => $rowi) : ?>
            <?php if (is_numeric($arri)) : ?>
                <tr>
                    <td><?php echo $arri + 1; ?>.</td>
                    <td><?php echo indo_date($rowi['equipment_stock_date']); ?></td>
                    <td></td>
                    <td></td>
                    <?php foreach ($rowi['equipment_stock_detail'] as $di => $rodi) : ?>
                        <td style="vertical-align: middle; text-align: right;"><?php echo number_format($rodi['equipment_price'], 0, '', '.'); ?></td>
                        <td style="vertical-align: middle; text-align: center;"><?php echo $rodi['equipment_entry']; ?></td>
                        <td style="vertical-align: middle; text-align: center;"><?php echo $rodi['equipment_exit']; ?></td>
                        <td style="vertical-align: middle; text-align: center;"><?php echo $rodi['equipment_rest']; ?></td>
                        <td style="vertical-align: middle; text-align: right;"><?php echo number_format($rodi['equipment_subtotal'], 0, '', '.'); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" style="vertical-align: middle; text-align: right;">Total : </td>
            <?php foreach ($array['total'] as $di => $rodi) : ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="vertical-align: middle; text-align: right;"><?php echo number_format($rodi['equipment_stock_total'], 0, '', '.'); ?></td>
            <?php endforeach; ?>
        </tr>
    </tfoot>
</table>