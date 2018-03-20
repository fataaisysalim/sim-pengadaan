<select name="users[]" id="users" class="form-control form-select21" data-style="btn-white" data-placeholder="Choose Users">
    <option value=""></option>
    <?php foreach ($proSer as $usr) : ?>
        <option value="<?php echo $usr->users_id; ?>" <?php if (!empty($project_access_dt) && $usr->users_id == $project_access_dt->users_id) echo "selected"; ?> <?php if ($usr->users_id == set_value('users')) echo "selected"; ?>><?php echo $usr->users_username; ?></option>
    <?php endforeach; ?>
</select>
<script type="text/javascript">
        $("select.form-select21").select2();
</script>