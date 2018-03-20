<table class='table' style="margin-bottom: 0;">
    <?php $paid= 0; foreach($termin as $i => $t) { ?>
    
    <tr>
        <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Pot Termin <?php echo $t->invoice_wo_sequence; ?></b></td>
        <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
        <td style="padding: 0 0 10px 0; border: none; font-weight: bold;">
            <div class='row'>
                <div class="col-md-8">
                    <input readonly class="form-control termin_history" type="text" style="font-weight: bold" name="termin[]" id="termin_<?php echo $t->invoice_wo_sequence; ?>" value="<?php echo rupiah($t->invoice_netto); ?>"/>    
                </div>
                <div class="col-md-2">
                    <p style="padding: 5px 0;"><?php echo rupiah($t->invoice_wo_percent) . ' %'; ?></p>
                </div>
                <div class="col-md-2">
                    <a role="button" onclick="detail_termin('<?php echo md5($t->invoice_id); ?>')" class="btn btn-md btn-block btn-warning" data-toggle="modal" data-target=".bs-modal-lg" title="Detail"><i class="fa fa-search"></i></a>
                </div>
            </div>
        </td>
    </tr>
    <?php $paid = $paid + $t->invoice_netto; ?>
    <?php } ?>
    
    <tr>
        <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Total Sudah Dibayar</b></td>
        <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
        <td style="padding: 0 0 10px 0; border: none; font-weight: bold;">
            <input readonly class="form-control" type="text" style="font-weight: bold" name="total_paid" id="total_paid" value="<?php echo rupiah($paid); ?>"/>
        </td>
    </tr>
    <tr>
        <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Tagihan Saat Ini</b></td>
        <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
        <td style="padding: 0 0 10px 0; border: none; font-weight: bold;">
            <input readonly class="form-control" type="text" style="font-weight: bold" name="new_termin" id="new_termin" value="<?php echo isset($invoice) ? rupiah($invoice->invoice_wo_nominal) : NULL; ?>"/>
        </td>
    </tr>
</table>
<div><input type="hidden" value="<?php echo $max_progres; ?>" id="invoice_wo_percent"/></div>
<script type="text/javascript">
    function detail_termin(id) {
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-contents").html("");
        $("#modal-contents").load("<?php echo base_url() . $url_access . 'show_detail_termin/'; ?>" + id);
    }
</script>