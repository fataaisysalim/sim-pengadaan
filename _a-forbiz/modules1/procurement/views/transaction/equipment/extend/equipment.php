<div class="form-group">
    <select id="equipment_data<?php echo $count ?>" onchange="get_unit(this,'<?php echo $count ?>')" name="equipment[]" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Equipment">
        <option value=""></option>
        <?php foreach ($show as $numb => $m) { ?>
            <option value="<?php echo $m->equipment_id; ?>"><?php echo $m->equipment_name; ?> <?php echo $m->equipment_type; ?></option>
        <?php } ?>
    </select>
</div>
<script>
    $('select.form-select2').select2();
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>