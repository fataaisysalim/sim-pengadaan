<select id="equipment" onchange="get_unit(this, <?php echo $counter; ?>)" name="equipment[]" style="margin-top: 5px" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih Equipment" required>
    <option value=""></option>
    <?php foreach($equipment as $eq) { ?>
        <option value="<?php echo $eq->equipment_id; ?>"><?php echo $eq->equipment_name; ?></option>
    <?php } ?>
</select>