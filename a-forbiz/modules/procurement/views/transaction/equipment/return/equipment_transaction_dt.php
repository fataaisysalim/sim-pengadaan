<?php $counter = 0; foreach($equipt_trans as $i => $row) { ?>
<?php $no = $i + 1; ?>
<tr class="row_out row_tam">
    <td class="text-center hidden-xs"><p id="nom_<?php echo $no; ?>"><?php echo ++$i; ?></p></td>
    <input type="hidden" name="equipt_transaction" value="<?php echo $row->equipt_transaction_id; ?>" class="form-control">
    <input type="hidden" name="project" value="<?php echo $row->project_id; ?>" class="form-control">
    <input type="hidden" name="actor" value="<?php echo $row->actor_id; ?>" class="form-control">
    <input type="hidden" name="equipment_transaction_number" value="<?php echo $row->equipt_transaction_number; ?>" class="form-control">
    <input type="hidden" name="action[]" value="add" class="form-control">
    <td id="equipment_counter">
<!--        <div class="form-group">
            <select id="equipment_counter" onchange="get_unit(this, counter)" name="equipment[]" class="form-control selectpicker" data-style="btn-white" required>
                <option value="">--- Pilih Equipment ---</option>
                <?php foreach ($equipment as $eq) : ?>'
                <option value="<?php echo $eq->equipment_id; ?>" <?php if (!empty($equip_trans_dt) && $eq->materia_sub_id == $equip_trans_dt->equipment_id) echo "selected"; ?> <?php if ($eq->equipment_id == set_value("material")) echo "selected"; ?>><?php echo $eq->equipment_name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>-->
        <input readonly id="equipment_<?php echo $no; ?>" type="hidden" name="equipment[]" value="<?php echo $row->equipment_id; ?>" class="form-control">
        <?php echo $row->equipment_name; ?>
    </td>
    <td class="hidden-xs">
        <input type="text" id="unit_<?php echo $no; ?>" name="unit[]" value="<?php echo $row->equipment_unit_name; ?>" class="form-control" placeholder="Satuan" readonly>
    </td>
    <td class="hidden-xs">
        <input type="text" id="condition_<?php echo $no; ?>" name="condition[]" value="" class="form-control" placeholder="Kondisi">
    </td>
    <td>
        <input id="volume_<?php echo $no; ?>" class=" form-control " onkeyup="get_count(this, + counter +)" name="volume[]" value="<?php echo rupiah($row->equipt_transaction_dt_volume); ?>" class="form-control" placeholder="Volume" readonly>
    </td>
    <td>
        <input id="price_<?php echo $no; ?>" class=" form-control " onkeyup="get_count(this, + counter +)" name="price[]" value="<?php echo rupiah($row->equipt_transaction_dt_price); ?>" class="form-control" placeholder="Price" required readonly>
    </td>
    <td class="hidden-xs total_sub" id="total_sub_<?php echo $no; ?>">
        <?php echo rupiah($row->equipt_transaction_dt_volume * $row->equipt_transaction_dt_price); ?>
    </td>
    <td class="text-center"><button type="button" class="btn btn-danger" id="btn_counter" onclick="cut(this,  + counter +)"><i class="fa fa-times"></i></button></td>
</tr>
<?php } ?>

<script type="text/javascript">
get_count();    
</script>