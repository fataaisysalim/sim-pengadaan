<label>Pajak</label>
<div class="input-group mg-b-md">
<!--<select id="tax" onchange="" name="tax" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih Pajak">
    <option value=""></option>
    <?php foreach ($tax as $t) : ?>
        <option value="<?php echo $t->tax_id; ?>" <?php if (isset($salary_id) && $t->tax_id == $salary_id->tax_id) echo "selected"; ?>><?php echo $t->tax_name . ' ' . $t->tax_cuts . '%'; ?></option>
    <?php endforeach; ?>
</select>-->
    <table>
        <?php foreach ($tax as $i => $t) { ?>
        <?php $ct = $i + 1; ?>
        <tr>
            <td>
                <input class="tax" id="tax_<?php echo ++$i; ?>" type="checkbox" onchange="tax(<?php echo $ct; ?>)" name="tax[]" value="<?php echo $t->tax_id; ?>" /> <?php echo $t->tax_name . ' ' . $t->tax_cuts . '%'; ?>
                <input type="hidden" class="cuts" id="cuts_<?php echo $ct; ?>" value="<?php echo $t->tax_cuts; ?>" />
            </td>
        </tr>    
        <?php } ?>
    </table>
</div>