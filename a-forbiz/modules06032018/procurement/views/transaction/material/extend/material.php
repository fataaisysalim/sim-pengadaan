<div class="form-group">
    <select id="material_<?php echo $count ?>" onchange="get_unit('<?php echo $count ?>')" name="material[]" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Material">
        <option id="kosong" value=""></option>
        <?php foreach ($show["ct"] as $numberio => $ct) { ?>
            <?php if (count($show["mt"][$numberio]) > 0) { ?>
        <optgroup label="<?php echo strtoupper($ct->material_category_name); ?>">
                    <?php foreach ($show["mt"][$numberio] as $numb => $m) { ?>
            <option value="<?php echo $m->material_sub_id; ?>"><?php echo strtoupper($m->material_sub_name); ?></option>
                    <?php } ?>
                </optgroup>
            <?php } ?>
        <?php } ?>
    </select>
</div>
<script>
    $('select.form-select2').select2();
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>