<?php foreach($mog_dt as $i => $row) { ?>
<?php $no = $i + 1; ?>
<tr class="row_out row_tam">
    <td class="text-center hidden-xs"><p <?php echo $row->mog_dt_status == 1 ? NULL : "style='background-color: red'"; ?> id="nom_<?php echo $no; ?>"><?php echo ++$i; ?></p></td>
    <input type="hidden" name="mog_dt[]" value="<?php echo $row->mog_dt_id; ?>" class="form-control">
    <input type="hidden" name="action[]" value="edit" class="form-control">
    <input type="hidden" id="mog_dt_status_<?php echo $no; ?>" name="mog_dt_status[]" value="<?php echo $row->mog_dt_status; ?>" class="form-control">
    <?php //if($mog_status != 0 || $sess['position_id'] == 5) { ?>
    <td>
        <div class="form-group">
            <!-- <select id="code_<?php echo $no; ?>" name="code[]" class="form-control selectpicker" data-style="btn-white">
                <option value="">Resource</option>
                <?php foreach ($code as $c) : ?>'
                <option value="<?php echo $c->code_id; ?>" <?php echo $sess['position_id'] == 1 ? $row->code_id == $c->code_id ? 'selected' : NULL : NULL; ?>><?php echo $c->code_name; ?></option>
                <?php endforeach; ?>
            </select> -->
             <input readonly id="code_<?php echo $no; ?>" type="text" name="uraian[]" value="<?php echo $row->code_id; ?>" class="form-control">
        </div>
    </td>
    <?php //} ?>
    <td id="material_counter_<?php echo $no; ?>">
        <input id="material_<?php echo $no; ?>" type="hidden" name="material[]" value="<?php echo $row->material_sub_id; ?>" class="form-control masterial">
        <?php echo $row->material_sub_name; ?>
    </td>
    <td class="hidden-xs">
        <input type="text" id="mog_dt_unit_<?php echo $no; ?>" name="unit[]" value="<?php echo $row->material_unit_name; ?>" class="form-control" placeholder="Satuan" readonly>
    </td>
    <td class="hidden-xs">
        <input readonly type="text" id="mog_dt_convertion_<?php echo $no; ?>" name="mog_dt_convertion[]" value="<?php echo isset($row->mog_dt_convertion) ? str_replace('.', ',', $row->mog_dt_convertion) : 0; ?>" class="form-control" placeholder="">
    </td>
    <td>
        <input id="mog_dt_volume_<?php echo $no; ?>" class=" form-control " onkeyup="get_count(this, <?php echo $no; ?>, 'volume')" name="mog_dt_volume[]" value="<?php echo rupiah($row->mog_dt_volume); ?>" class="form-control" placeholder="Volume" readonly>
    </td>
	<?php if($role_id!=15) { ?>
    <?php //if($mog_status != 0 || $sess['position_id'] == 5) { ?>
    <td>
        <input id="mog_dt_price_<?php echo $no; ?>" class=" form-control " onkeyup="get_count(this, <?php echo $no; ?>, 'price')" name="mog_dt_price[]" value="<?php echo isset($row->mog_dt_price) ? rupiah($row->mog_dt_price) : NULL; ?>" class="form-control" placeholder="Price" required readonly>
    </td>
    <td class="hidden-xs total_sub" id="total_sub_<?php echo $no; ?>">
        <?php $convert = $row->mog_dt_convertion == 0 ? 1 : $row->mog_dt_convertion; echo isset($row->mog_dt_price) ? rupiah($row->mog_dt_price * $row->mog_dt_volume * $convert) : NULL; ?>
    </td>
    <?php } ?>
	<?php if($role_id!=15) { ?>
    <td class="text-center">
	<?php } ?>
        <?php if(($sess['position_id'] == 1 && $aksi=="edit") || ($sess['users']->users_divisi == 16 && $aksi=="view")) { ?>
            <button type="button" class="btn btn-<?php echo $row->mog_dt_status == 1 ? 'danger' : 'primary'; ?>" id="btn_status_<?php echo $no; ?>" onclick="change_status(<?php echo $no; ?>, <?php echo $row->mog_dt_status == 1 ? 0 : 1; ?>)"><i class="fa fa-<?php echo $row->mog_dt_status == 1 ? 'times' : 'check'; ?>"></i></button>
        <?php } ?>
		<?php if($role_id!=15) { ?>
            <input type="hidden" id="price_<?php echo $no; ?>" class=" form-control " name="price[]" value="<?php echo $row->mog_dt_price; ?>" class="form-control" placeholder="Price">
            <input type="hidden" id="diff_price_<?php echo $no; ?>" class=" form-control " name="diff_price[]" value="0" class="form-control" placeholder="Price">
            <input type="hidden" id="status_price_<?php echo $no; ?>" class=" form-control " name="status_price[]" value="0" class="form-control" placeholder="Price">
            <input type="hidden" id="volume_<?php echo $no; ?>" class=" form-control " name="volume[]" value="<?php echo $row->mog_dt_volume; ?>" class="form-control" placeholder="Price">
            <input type="hidden" id="diff_volume_<?php echo $no; ?>" class=" form-control " name="diff_volume[]" value="0" class="form-control" placeholder="Price">
            <input type="hidden" id="status_volume_<?php echo $no; ?>" class=" form-control " name="status_volume[]" value="0" class="form-control" placeholder="Price">
   
    </td>
	<?php } ?>
</tr>
<tr class="note_row_<?php echo $no; ?>">
<td class="hidden-xs" colspan="7">
    <input disabled type="text" id="mog_dt_note_<?php echo $no; ?>" name="mog_dt_note[]" value="<?php echo $row->mog_dt_note; ?>" class="form-control" placeholder="Keterangan">
</td>
</tr>
<?php } ?>

<script type="text/javascript">
    get_count();    
    function change_status(i, st) {
        if(confirm('Anda Yakin akan menghapus Item ini?')){
            if(st == '1') {
                var sts = '0';
                var classes = 'btn btn-danger';
                var logo = 'fa fa-times';
                var bg = 'none';
                var line = 'none';
                <?php if($mog_status == 1 || $sess['position_id'] == 5) { ?>
                    var subtotal = numberToCurrency(currencyToNumber($("#mog_dt_price_" + i).val()) * currencyToNumber($("#mog_dt_volume_" + i).val()));
                <?php } ?>
            } else {
                var sts = '1';
                var classes = 'btn btn-primary';
                var logo = 'fa fa-check';
                var bg = "background-color: red";
                var line = 'text-decoration:line-through';
                <?php if($mog_status == 1 || $sess['position_id'] == 5) { ?>
                    var subtotal = 0;
                <?php } ?>
            }
            $("#btn_status_" + i).attr('onclick', 'change_status(' + i + ', ' + sts + ')');
            $("#btn_status_" + i).attr('class', classes);
            $("#btn_status_" + i + " i").attr('class', logo);
            $("#mog_dt_status_" + i).attr('value', st);
            $("#nom_" + i).attr('style', line);
            $("#material_counter_" + i).attr('style', line);
            <?php if($mog_status == 1 || $sess['position_id'] == 5) { ?>
                $("#total_sub_" + i).html(subtotal);
            
                get_count();
            <?php } ?>
        }else{
            return false;
        }
    }
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>