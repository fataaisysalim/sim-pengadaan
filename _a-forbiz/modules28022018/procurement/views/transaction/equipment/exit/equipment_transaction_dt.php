<?php $counter = 0; foreach($equipt_trans_dt as $i => $row) { ?>
<?php $no = $i + 1; ?>
<tr class="row_out row_tam">
    <td class="text-center hidden-xs"><p id="nom_<?php echo $no; ?>"><?php echo ++$i; ?></p></td>
    <input type="hidden" name="equipt_transaction_dt[]" value="<?php echo $row->equipt_transaction_dt_id; ?>" class="form-control">
    <input type="hidden" name="action[]" value="edit" class="form-control">
    <input type="hidden" id="data_status_<?php echo $no; ?>" name="data_status[]" value="3" class="form-control">
    <input type="hidden" name="status[]" value="3" class="form-control">
    <td id="equipment_counter_<?php echo $no; ?>">
        <input readonly id="equipment_<?php echo $no; ?>" type="hidden" name="equipment[]" value="<?php echo $row->equipment_id; ?>" class="form-control">
        <?php echo $row->equipment_name; ?>
    </td>
<!--    <td>
        <div class="form-group">
            <select id="code" name="code[]" class="form-control selectpicker" data-style="btn-white" required>
                <option value="">--- Pilih Kode ---</option>
                <?php foreach ($code as $c) : ?>'
                <option value="<?php echo $c->code_id; ?>" <?php echo $sess['position_id'] == 1 ? $row->code_id == $c->code_id ? 'selected' : NULL : NULL; ?>><?php echo $c->code_name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </td>-->
    <td class="hidden-xs">
        <input type="text" id="condition_<?php echo $no; ?>" name="condition[]" value="<?php echo $row->equipt_transaction_dt_condition; ?>" class="form-control" placeholder="Kondisi">
    </td>
    <td>
        <input id="volume_<?php echo $no; ?>" class=" form-control " onkeyup="get_count(this, <?php echo $no; ?>, 'volume')" name="volume[]" value="<?php echo rupiah($row->equipt_transaction_dt_volume); ?>" class="form-control" placeholder="Volume">
    </td>
    <td class="hidden-xs">
        <input type="text" id="unit_<?php echo $no; ?>" name="unit[]" value="<?php echo $row->equipment_unit_name; ?>" class="form-control" placeholder="Satuan" readonly>
    </td>
    <td class="hidden-xs">
        <input type="text" id="note_<?php echo $no; ?>" name="note[]" value="<?php echo $row->equipt_transaction_dt_note; ?>" class="form-control" placeholder="Keterangan">
    </td>
    <td class="text-center">
        <button type="button" class="btn btn-<?php echo $row->equipt_transaction_dt_status != 0 ? 'danger' : 'primary'; ?>" id="btn_status_<?php echo $no; ?>" onclick="change_status(<?php echo $no; ?>, <?php echo $row->equipt_transaction_dt_status != 0 ? 0 : $row->equipt_transaction_dt_status; ?>)"><i class="fa fa-<?php echo $row->equipt_transaction_dt_status != 0 ? 'times' : 'check'; ?>"></i></button>
        <input type="hidden" id="stok_<?php echo $no; ?>" class=" form-control " value="<?php echo $row->equipment_stock_final_rest; ?>" class="form-control" placeholder="Price">
        <?php if($sess['position_id'] == 1) { ?>
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
        var sts = 3;
        var classes = 'btn btn-primary';
        var logo = 'fa fa-check';
        var bg = "background-color: red";
        var line = 'text-decoration:line-through';
    } else {
        var sts = 0;
        var classes = 'btn btn-danger';
        var logo = 'fa fa-times';
        var bg = 'none';
        var line = 'none';
    }
    $("#btn_status_" + i).attr('onclick', 'change_status(' + i + ', ' + sts + ')');
    $("#btn_status_" + i).attr('class', classes);
    $("#btn_status_" + i + " i").attr('class', logo);
    $("#data_status_" + i).attr('value', st);
    $("#nom_" + i).attr('style', line);
    $("#equipment_counter_" + i).attr('style', line);
}
</script>