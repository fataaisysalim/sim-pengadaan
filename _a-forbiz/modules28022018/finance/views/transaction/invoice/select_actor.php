<select id="actor" name="actor" onchange="getActData()" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih Supplier/Subkon">
    <option value="<?php echo isset($actor_id) ? $actor_id->actor_id : NULL; ?>"><?php echo isset($actor_id) ? $actor_id->actor_name : NULL; ?></option>
    <?php if(!isset($actor_id)) { ?>
    <?php foreach ($actor as $num => $man) : ?>
        <option value="<?php echo $man->actor_id; ?>" <?php if ($man->actor_id == set_value('actor')) echo "selected"; ?>><?php echo $man->actor_name; ?></option>
    <?php endforeach; ?>
    <?php } ?>
</select>
<script type="text/javascript">
    $('select.form-select2').select2();
    <?php if (isset($actor_id)) : ?>
//        check();
//        getActData()
        get_btn();
    <?php endif; ?>
</script>