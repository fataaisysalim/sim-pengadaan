<?php
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=docOut_" . str_replace(" ", "_", $starts != $ends ? indo_date(date("Y-m-d", strtotime($starts))) . "-" . indo_date(date("Y-m-d", strtotime($ends))) : indo_date(date("Y-m-d", strtotime($starts)))) . ".xls");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Expires: 0");
$br = '<br><br>';
?>
<table style="text-align: center; width: 100%">
    <tr>
        <td colspan="9" style="text-align: center;">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="9" style="text-align: center; font-size: 18px; font-weight: bold;  text-transform: uppercase;">DOCUMENT CONTROL IN</td>
    </tr>
    <tr>
        <td colspan="9" style="text-align: center; font-size: 18px; font-weight: bold;  text-transform: uppercase;"><?php echo strtoupper($sess['external']->apps_client) ?></td>
    </tr>
    <tr>
        <td colspan="9" style="text-align: center; font-size: 18px;  text-transform: uppercase;"><?php echo strtoupper($pro->project_name) ?></td>
    </tr>
    <tr>
        <td colspan="9" style="text-align: center;"><?php echo $starts != $ends ? indo_date(date("Y-m-d", strtotime($starts))) . "-" . indo_date(date("Y-m-d", strtotime($ends))) : indo_date(date("Y-m-d", strtotime($starts))) ?></td>
    </tr>
    <tr>
        <td colspan="9" style="text-align: center;">&nbsp;</td>
    </tr>
</table>
<table border="1" style="width: 100%">
    <thead>
        <tr>
            <th class="text-center" style="width:80px">No.</th>
            <th class="text-center" style="width:180px">Doc Number</th>
            <th class="text-center" style="width:140px">Send to</th>
            <th class="text-center" style="width:200px">Subject</th>
            <th class="text-center" colspan="3">Description</th>
            <th class="text-center" style="width:140px">Date</th>
            <th class="text-center" style="width:180px">Operator</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($doc) > 0) : ?>
            <?php foreach ($doc as $i => $rox) { ?>
                <tr>
                    <td class="text-center" style="vertical-align: middle"><?php echo++$i; ?></td>
                    <td class="text-center" style="vertical-align: middle"><?php echo $rox->doc_control_number ?></td>
                    <td style="vertical-align: middle"><?php echo ucwords($rox->actor_name) ?></td>
                    <td style="vertical-align: middle"><?php echo ucwords($rox->doc_control_case) ?></td>
                    <td colspan="3"><?php echo $rox->doc_control_desc ?></td>
                    <td class="text-center" style="vertical-align: middle"><?php echo indo_date($rox->doc_control_date, 1) ?></td>
                    <td style="vertical-align: middle"><?php echo ucwords($rox->employee_name) ?></td>
                </tr>
            <?php } ?>
        <?php else: ?>
            <tr>
                <td colspan="9" style="color: gray; vertical-align: middle; text-align: center;">No data available</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>