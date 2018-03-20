<div class="form-group">
    <select id="transaction_<?php echo $counter ?>" onchange="get_transaction_detail(this, '<?php echo $counter ?>', '<?php echo $resource; ?>')" name="transaction[]" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih BAPB">
        <option value=""></option>
        <?php if(isset($mog)) { ?>
            <?php foreach ($mog as $m) { ?>
            <option value="<?php echo $m->mog_id; ?>"><?php echo $m->mog_number; ?></option>
            <?php } ?>
        <?php } else if(isset($equipt)) { ?>
            <?php foreach ($equipt as $e) { ?>
            <option value="<?php echo $e->equipt_transaction_id; ?>"><?php echo $e->equipt_transaction_number; ?></option>
            <?php } ?>
        <?php } ?>
    </select>
</div>
<script>$('select.form-select2').select2();</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>