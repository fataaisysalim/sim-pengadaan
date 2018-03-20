<b>Tax</b>
<table>
    <?php foreach ($tax as $i =>  $t) { ?>
    <?php $ct = $i + 1; ?>
    <tr>
        <td>
            <input <?php if (isset($invoice_tax[$i])) : echo $invoice_tax[$i] > 0 ? 'checked' : NULL; endif; ?> type="checkbox" cut="<?php echo $t->tax_cuts; ?>" class="tax" id="tax_<?php echo $ct; ?>" data="<?php echo $t->tax_name; ?>" onchange="tax(<?php echo $ct; ?>)" name="tax[]" value="<?php echo $t->tax_id; ?>" /> <?php echo $t->tax_name . ' ' . $t->tax_cuts . '%'; ?>
            <input type="hidden" id="cuts_<?php echo $ct; ?>" value="<?php echo $t->tax_cuts; ?>" />
        </td>
    </tr>    
        <?php if (isset($invoice_tax[$i])) { ?>
            <script type="text/javascript">
                tax(<?php echo $ct; ?>);
            </script>
        <?php } ?>
    <?php } ?>
</table>