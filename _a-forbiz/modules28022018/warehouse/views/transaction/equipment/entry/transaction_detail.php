<?php foreach($trans_dt as $i => $row) { ?>
<?php $no = $i + 1; ?>
<tr class="row_out row_tam">
    <td class="text-center hidden-xs"><p id="nom_<?php echo $no; ?>"><?php echo ++$i; ?></p></td>
    <input type="hidden" name="equipt_transaction_dt[]" value="<?php echo $row->equipt_transaction_dt_id; ?>" class="form-control">
    <input type="hidden" name="action[]" value="edit" class="form-control">
    <input type="hidden" id="data_status_<?php echo $no; ?>" name="data_status[]" value="<?php echo $row->equipt_transaction_dt_status; ?>" class="form-control">
    <?php if ($permit->access_special == 1) { ?>
    <td>
        <div class="form-group">
            <select id="code" name="code[]" class="form-control selectpicker" data-style="btn-white">
                <option value="">Resource</option>
                <?php foreach ($code as $c) : ?>'
                <option value="<?php echo $c->code_id; ?>" <?php echo $row->code_id == $c->code_id ? 'selected' : NULL; ?>><?php echo $c->code_name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </td>
    <?php } ?>
    <td id="equipment_counter_<?php echo $no; ?>">
        <input id="equipment_<?php echo $no; ?>" type="hidden" name="equipment[]" value="<?php echo $row->equipment_id; ?>" class="form-control">
        <?php echo $row->equipment_name; ?>
    </td>
    
    <td class="hidden-xs">
        <input type="text" id="equipt_transaction_dt_unit_<?php echo $no; ?>" name="unit[]" value="<?php echo $row->equipment_unit_name; ?>" class="form-control" placeholder="Satuan" readonly>
    </td>
    <td class="hidden-xs">
        <div class="form-group">
        <select id="status_<?php echo $no; ?>" name="status[]" class="form-control selectpicker" data-style="btn-white" required>
            <option value="">--- Pilih Status ---</option>
            <option value="1" <?php echo $row->equipt_transaction_dt_status == 1 ? 'selected' : NULL; ?>>Beli</option>
            <option value="2" <?php echo $row->equipt_transaction_dt_status == 2 ? 'selected' : NULL; ?>>Sewa</option>
        </select>
        </div>
    </td>
    <td class="hidden-xs">
        <input type="text" id="condition_<?php echo $no; ?>" name="condition[]" value="<?php echo $row->equipt_transaction_dt_condition; ?>" class="form-control" placeholder="Kondisi">
    </td>
    <td>
        <input id="volume_<?php echo $no; ?>" class=" form-control " onkeyup="get_count(this, <?php echo $no; ?>, 'volume')" name="volume[]" value="<?php echo isset($row->equipt_transaction_dt_volume) ? rupiah($row->equipt_transaction_dt_volume) : NULL; ?>" class="form-control" placeholder="Volume" >
    </td>
    <?php if ($permit->access_special == 1) { ?>
    <td>
        <input id="price_<?php echo $no; ?>" class=" form-control " onkeyup="get_count(this, <?php echo $no; ?>, 'price')" name="price[]" value="<?php echo isset($row->equipt_transaction_dt_price) ? rupiah($row->equipt_transaction_dt_price) : NULL; ?>" class="form-control" placeholder="Price" required>
    </td>
    <td class="hidden-xs total_sub" id="total_sub_<?php echo $no; ?>">
        <?php echo $permit->access_special == 1 ? rupiah($row->equipt_transaction_dt_price * $row->equipt_transaction_dt_volume) : NULL; ?>
    </td>
    <?php } ?>
    <td class="text-center">
        <?php if ($permit->access_special == 1) { ?>
        <button type="button" class="btn btn-<?php echo $row->equipt_transaction_dt_status != 0 ? 'danger' : 'primary'; ?>" id="btn_status_<?php echo $no; ?>" onclick="change_status(<?php echo $no; ?>, <?php echo $row->equipt_transaction_dt_status != 0 ? 0 : $row->equipt_transaction_dt_status; ?>)"><i class="fa fa-<?php echo $row->equipt_transaction_dt_status != 0 ? 'times' : 'check'; ?>"></i></button>
            <input type="hidden" id="e_price_<?php echo $no; ?>" class=" form-control " value="<?php echo $row->equipt_transaction_dt_price; ?>" class="form-control" placeholder="Price">
            <input type="hidden" id="diff_price_<?php echo $no; ?>" class=" form-control " name="diff_price[]" value="0" class="form-control" placeholder="Price">
            <input type="hidden" id="status_price_<?php echo $no; ?>" class=" form-control " name="status_price[]" value="0" class="form-control" placeholder="Price">
            <input type="hidden" id="e_volume_<?php echo $no; ?>" class=" form-control " value="<?php echo $row->equipt_transaction_dt_volume; ?>" class="form-control" placeholder="Price">
            <input type="hidden" id="diff_volume_<?php echo $no; ?>" class=" form-control " name="diff_volume[]" value="0" class="form-control" placeholder="Price">
            <input type="hidden" id="status_volume_<?php echo $no; ?>" class=" form-control " name="status_volume[]" value="0" class="form-control" placeholder="Price">
        <?php } ?>
    </td>
</tr>
<?php } ?>

<script type="text/javascript">
get_count();  

function change_status(i, st) {
    if(st == 0) {
        var sts = $("#data_status_" + i).val();
        var classes = 'btn btn-primary';
        var logo = 'fa fa-check';
        var bg = "background-color: red";
        var line = 'text-decoration:line-through';
        <?php if($equipt_transaction_status == 1 || $permit->access_special == 1) { ?>
        var subtotal = 0;
        <?php } ?>
    } else {
        var sts = 0;
        var classes = 'btn btn-danger';
        var logo = 'fa fa-times';
        var bg = 'none';
        var line = 'none';
        <?php if($equipt_transaction_status == 1 || $permit->access_special == 1) { ?>
        var subtotal = numberToCurrency(currencyToNumber($("#price_" + i).val()) * currencyToNumber($("#volume_" + i).val()));
        <?php } ?>
    }
    $("#btn_status_" + i).attr('onclick', 'change_status(' + i + ', ' + sts + ')');
    $("#btn_status_" + i).attr('class', classes);
    $("#btn_status_" + i + " i").attr('class', logo);
    $("#data_status_" + i).attr('value', st);
    $("#nom_" + i).attr('style', line);
    $("#equipment_counter_" + i).attr('style', line);
    <?php if($equipt_transaction_status == 1 || $permit->access_special == 1) { ?>
    $("#total_sub_" + i).html(subtotal);
    
    get_count();    
    <?php } ?>
}
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>