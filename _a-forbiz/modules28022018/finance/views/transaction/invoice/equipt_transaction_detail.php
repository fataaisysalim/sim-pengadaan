<?php foreach($equipt_dt as $i => $row) { ?>
<?php $no = $i + 1; ?>
<tr class="row_detail">
    <td class="text-center hidden-xs"><p <?php echo $row->equipt_transaction_dt_status == 3 ? "style='background-color: red'" : NULL; ?> id="nom_<?php echo $no; ?>"><?php echo ++$i; ?></p></td>
    <input type="hidden" name="equipt_transaction_dt[]" value="<?php echo $row->equipt_transaction_dt_id; ?>" class="form-control">
    <input type="hidden" id="equipt_transaction_dt_status_<?php echo $no; ?>" name="equipt_transaction_dt_status[]" value="<?php echo $row->equipt_transaction_dt_status; ?>" class="form-control">
    <td id="equipment_counter_<?php echo $no; ?>">
        <input id="equipment_<?php echo $no; ?>" type="hidden" name="equipment[]" value="<?php echo $row->equipment_id; ?>" class="form-control">
        <?php echo $row->equipment_name; ?>
    </td>
    <td>
        <?php echo $row->code_name; ?>
    </td>
    <td class="hidden-xs">
        <input type="text" id="equipt_transaction_dt_unit_<?php echo $no; ?>" name="unit[]" value="<?php echo $row->equipment_unit_name; ?>" class="form-control" placeholder="Satuan" readonly>
    </td>
    <td class="hidden-xs">
    </td>
    <td>
        <input readonly id="equipt_transaction_dt_volume_<?php echo $no; ?>" class=" form-control " onkeyup="get_count(this, <?php echo $no; ?>, 'volume')" name="equipt_transaction_dt_volume[]" value="<?php echo rupiah($row->equipt_transaction_dt_volume); ?>" class="form-control" placeholder="Volume">
    </td>
    <td>
        <input id="equipt_transaction_dt_price_<?php echo $no; ?>" class=" form-control " onkeyup="get_count(this, <?php echo $no; ?>, 'price')" name="equipt_transaction_dt_price[]" value="<?php echo rupiah($row->equipt_transaction_dt_price); ?>" class="form-control" placeholder="Price" readonly>
    </td>
    <td class="hidden-xs total_sub" id="total_sub_<?php echo $no; ?>">
        <?php echo rupiah($row->equipt_transaction_dt_price * $row->equipt_transaction_dt_volume); ?>
    </td>
    <td class="text-center">
        <?php if($sess['position_id'] == 1) { ?>
        <button type="button" class="btn btn-<?php echo $row->equipt_transaction_dt_status == 1 ? 'danger' : 'primary'; ?>" id="btn_status_<?php echo $no; ?>" onclick="change_status(<?php echo $no; ?>, <?php echo $row->equipt_transaction_dt_status == 1 ? 0 : 1; ?>)"><i class="fa fa-<?php echo $row->equipt_transaction_dt_status == 1 ? 'times' : 'check'; ?>"></i></button>
            <input type="hidden" id="price_<?php echo $no; ?>" class=" form-control " name="price[]" value="<?php echo $row->equipt_transaction_dt_price; ?>" class="form-control" placeholder="Price">
            <input type="hidden" id="diff_price_<?php echo $no; ?>" class=" form-control " name="diff_price[]" value="0" class="form-control" placeholder="Price">
            <input type="hidden" id="status_price_<?php echo $no; ?>" class=" form-control " name="status_price[]" value="0" class="form-control" placeholder="Price">
            <input type="hidden" id="volume_<?php echo $no; ?>" class=" form-control " name="volume[]" value="<?php echo $row->equipt_transaction_dt_volume; ?>" class="form-control" placeholder="Price">
            <input type="hidden" id="diff_volume_<?php echo $no; ?>" class=" form-control " name="diff_volume[]" value="0" class="form-control" placeholder="Price">
            <input type="hidden" id="status_volume_<?php echo $no; ?>" class=" form-control " name="status_volume[]" value="0" class="form-control" placeholder="Price">
        <?php } ?>
    </td>
</tr>
<?php } ?>

<script type="text/javascript">
    $("#transaction_total_<?php echo $counter; ?>").val('<?php echo $equipt->equipt_transaction_total; ?>');
    total();
    
    
</script>