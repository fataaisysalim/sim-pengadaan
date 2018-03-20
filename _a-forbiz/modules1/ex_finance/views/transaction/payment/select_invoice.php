<div class="form-group" style="margin: 10px 0;">
    <label>No. Invoice</label>
    <select id="invoice" onchange="get_invoice_payment(this)" name="invoice" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Invoice">
        <option value=""></option>
        <?php $resource = array(1 => "Invoice Material", 2 => "Invoice Equipment", 4 => "Invoice Subcon"); ?>
        <?php foreach ($invoice as $in) : ?>
        <option value="<?php echo md5($in->invoice_id); ?>" <?php if (isset($invoice_id) && $in->invoice_id == $invoice_id->invoice_id) echo "selected"; ?>><?php echo ucwords($in->invoice_number) . ' ' . ucwords($in->actor_name) . ' ( ' . $resource[$in->invoice_resource_code] . ' ' . $in->wo_ct . ' '; echo $in->sequence != 0 ? $in->sequence : NULL; echo ')'; ?></option>
        <?php endforeach; ?>
    </select>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("select.form-select2").select2();
    });
</script>