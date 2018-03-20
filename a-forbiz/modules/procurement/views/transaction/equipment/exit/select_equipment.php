<div class="form-group">
    <select id="equipment_data<?php echo $counter ?>" onchange="get_unit(this,'<?php echo $counter ?>')" name="equipment[]" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Equipment">
        <option value=""></option>
        <?php foreach ($equipment as $eq) : ?>
            <option value="<?php echo $eq->equipment_id; ?>" <?php if (!empty($equip_trans_dt) && $eq->equipment_id == $equip_trans_dt->equipment_id) echo "selected"; ?> <?php if ($eq->equipment_id == set_value('equipment')) echo "selected"; ?>><?php
        echo $eq->equipment_name;
        echo $eq->equipment_type ? ' ' . $eq->equipment_type : NULL;
            ?></option>
        <?php endforeach; ?>
    </select>
</div>
<script>
    $('select.form-select2').select2();
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>