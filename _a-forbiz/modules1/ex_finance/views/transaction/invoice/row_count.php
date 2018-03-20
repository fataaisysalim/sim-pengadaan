<?php if($resource == 4) { ?>
    <table class='table' style="margin-bottom: 0;">
        <tr>
            <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Total Kontrak</b></td>
            <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
            <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
                <input readonly class="form-control" type="text" style="font-weight: bold" name="work_order_contract" id="work_order_contract2" value="<?php echo isset($invoice_wo) ? rupiah($invoice_wo->invoice_total) : NULL; ?>"/>
                <input readonly class="form-control" type="hidden" style="font-weight: bold" id="work_order_contract" value=""/>
            </td>
        </tr>
    </table>
<div id="kategori">
    <?php if(isset($invoice_wo)) { ?>
        <?php if($invoice_wo->invoice_wo_ct_id == 1) {?>
        <table class='table'>
            <tr>
                <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Nilai Uang Muka</b></td>
                <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
                <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
                    <div class="row">
                        <div class="col-xs-7">
                            <input readonly class="form-control" onkeyup="get_pre_netto(this)" type="text" style="font-weight: bold" name="pre_netto" id="pre_netto" value="<?php echo rupiah($invoice_wo->invoice_wo_nominal); ?>"/>
                        </div>
                        <div class="col-xs-3">
                            <input readonly class="form-control" onkeyup="" type="text" style="font-weight: bold" name="wo_dp" id="wo_dp" value="<?php echo $invoice_wo->work_order_dp . '%'; ?>"/>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <?php } ?>
    
        <?php if($invoice_wo->invoice_wo_ct_id == 2) { ?>
        <table class='table'>
            <tr>
                <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Nilai Progress</b></td>
                <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
                <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
                    <div class="row">
                        <div class="col-xs-4">
                            <input class="form-control" onkeyup="get_pre_netto(this)" type="text" style="font-weight: bold" name="percent_netto" id="percent_netto" value="<?php echo rupiah($invoice_wo->invoice_wo_percent); ?>"/>
                        </div>
                        <div class="col-xs-8">
                            <input readonly class="form-control" onkeyup="get_pre_netto(this)" type="text" style="font-weight: bold" name="pre_netto" id="pre_netto" value="<?php echo rupiah($invoice_wo->invoice_total * ($invoice_wo->invoice_wo_percent / 100)); ?>"/>
                        </div>
                    </div>
                    <div id="nominal">
                    </div>
                </td>
            </tr>
        </table>
        <div id="termin_history"></div>
        <table class='table'>
            <tr>
                <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Angsuran Uang Muka</b></td>
                <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
                <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
                    <div class="row">
                        <div class="col-xs-10">
                            <input readonly class="form-control" type="text" style="font-weight: bold" name="angsuran_um" id="angsuran_um" value="<?php echo isset($invoice_wo) ? rupiah($invoice_wo->invoice_wo_dp) : NULL; ?>"/>
                            <input class="form-control" type="hidden" style="font-weight: bold" id="angsuran_um2" value="<?php echo isset($invoice_wo) ?rupiah($invoice_wo->work_order_dp) : NULL; ?>"/>
                        </div>
                        <div class="col-xs-2" id="um_percent">
                            <p style="padding: 5px 0;"><?php echo isset($invoice_wo) ? rupiah($invoice_wo->work_order_dp) . '%' : NULL; ?></p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Retensi</b></td>
                <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
                <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
                    <div class="row">
                        <div class="col-xs-10">
                            <input readonly class="form-control" type="text" style="font-weight: bold" name="retensi" id="retensi" value="<?php echo isset($invoice_wo) ? rupiah($invoice_wo->invoice_wo_retensi) : NULL; ?>"/>
                            <input class="form-control" type="hidden" style="font-weight: bold" id="retensi2" value="<?php echo isset($invoice_wo) ? rupiah($invoice_wo->work_order_retensi) : NULL; ?>"/>
                        </div>
                        <div id="retensi_percent" class="col-xs-2">
                             <p style="padding: 5px 0;"><?php echo isset($invoice_wo) ? rupiah($invoice_wo->work_order_retensi) . '%' : NULL; ?></p>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <?php } ?>
    
        <?php if($invoice_wo->invoice_wo_ct_id == 3) {?>
            <table>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td  style="width: 130px;"><b id="input_name">Nilai Progres (%) : </b></td>
                    <td style="font-weight: bold">
                    <div class="row">
                    <div class="col-xs-4">
                    <!--<input readonly class="form-control" onkeyup="get_pre_netto(this)" type="text" style="font-weight: bold" name="percent_netto" id="percent_netto" value="<?php echo isset($invoice_wo) ? rupiah($invoice_wo->work_order_retensi) : NULL; ?>"/>-->
                    <input readonly class="form-control" onkeyup="get_pre_netto(this)" type="text" style="font-weight: bold" name="percent_netto" id="percent_netto" value="<?php echo isset($invoice_wo) ? '100%' : NULL; ?>"/>
                    </div>
                    <div class="col-xs-8">
                    <input readonly class="form-control" type="text" style="font-weight: bold" name="pre_netto" id="pre_netto" value="<?php echo isset($invoice_wo) ? rupiah($invoice_wo->invoice_wo_nominal) : NULL; ?>"/>
                    <input class="form-control" type="hidden" name="retensi" id="retensi" value=""/>
                    </div>
                    </div>
                    <div id="nominal">
                    </div>
                </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
             </table>
        <?php } ?>
    
    <?php } ?>
    <div id="termin_history">
    
    </div>
    <?php if(!isset($invoice_wo)) { ?>
<!--    <table>
        <tr>
        <tr>
            <td><b>Angsuran UM : </b></td>
            <td style="font-weight: bold">
                <input readonly class="form-control" type="text" style="font-weight: bold" name="angsuran_um" id="angsuran_um" value=""/>
                <input class="form-control" type="hidden" style="font-weight: bold" id="angsuran_um2" value=""/>
            </td>
            <td id="um_percent">
                
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><b>Retensi : </b></td>
            <td style="font-weight: bold">
                <input readonly class="form-control" type="text" style="font-weight: bold" name="retensi" id="retensi" value=""/>
                <input class="form-control" type="hidden" style="font-weight: bold" id="retensi2" value=""/>
            </td>
            <td id="retensi_percent">
                
            </td>
        </tr>
    <tr><td>&nbsp;</td></tr>
</table> -->
<?php } ?> 
</div>
<?php } ?> 
<table class='table'>    
    <?php if($resource == 1) { ?>
        <tr>
            <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Total</b></td>
            <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
            <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
                <input readonly class="form-control text-right" type="text" style="font-weight: bold" name="invoice_total" id="invoice_total" value=""/>
            </td>
        </tr>
    <?php } ?>
    
    <tr>
        <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Netto</b></td>
        <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
        <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
            <?php if($resource == 2) { ?>
                <input class="form-control text-right" type="hidden" style="font-weight: bold" name="invoice_total" id="invoice_total" value=""/>
            <?php } ?>
            <input <?php echo $resource == 4 ? 'readonly' : NULL; ?> class="form-control text-right" onkeyup="netto_bruto(this)" type="text" style="font-weight: bold" name="invoice_netto" id="invoice_netto" value="<?php echo isset($invoice_id) ? rupiah($invoice->invoice_netto) : NULL; ?>"/>
        </td>
    </tr>
    
    <tr>
        <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>PPN</b></td>
        <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
        <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
            <?php if(isset($invoice_id)) { ?>
            <?php $tax['ppn'] = 0; foreach($invoice_tax as $t) : ?>
                <?php if($t->tax_name == 'PPN') { ?>
                <?php $tax['ppn'] = $tax['ppn'] + $t->invoice_tax_nominal; ?>
                <?php } ?>
            <?php endforeach; ?>
            <input class="form-control text-right" type="text" style="font-weight: bold" name="ppn" id="ppn" value="<?php echo rupiah($tax['ppn']); ?>" readonly/>
            <?php } else { ?>
            <input class="form-control text-right" type="text" style="font-weight: bold" name="ppn" id="ppn" value="" readonly/>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Bruto</b></td>
        <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
        <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
            <input readonly class="form-control text-right" type="text" style="font-weight: bold" name="invoice_bruto" id="invoice_bruto" value=""/>
        </td>
    </tr>
    <tr>
        <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Potongan PPH</b></td>
        <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
        <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
            <?php if(isset($invoice_id)) { ?>
            <?php $tax['pph'] = 0; foreach($invoice_tax as $t) : ?>
                <?php if($t->tax_name != 'PPN') { ?>
                <?php $tax['pph'] = $tax['pph'] + $t->invoice_tax_nominal; ?>
                <?php } ?>
            <?php endforeach; ?>
            <input class="form-control text-right" type="text" style="font-weight: bold" name="pph" id="pph" value="<?php echo rupiah($tax['pph']); ?>" readonly/>
            <?php } else { ?>
            <input class="form-control text-right" type="text" style="font-weight: bold" name="pph" id="pph" value="" readonly/>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td style="padding: 0 0 10px 0; border: none;" width="30%"><b>Potongan PPH</b></td>
        <td style="padding: 0 0 10px 0; border: none;" width="05%"><b> : </b></td>
        <td style="padding: 0 0 10px 0; border: none; font-weight: bold">
            <input class="form-control text-right" type="text" style="font-weight: bold" name="total" id="total" value="" readonly/>
        </td>
    </tr>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        <?php if($resource == 4) { ?>
            <?php if(isset($invoice_wo)) { ?>    
                <?php if($invoice_wo->invoice_wo_ct_id == 2) { ?>    
                $("#termin_history").load("<?php echo base_url() . $url_access . 'get_invoice_history/' ?><?php echo isset($invoice_wo) ? $invoice_wo->work_order_id . '/' . md5($invoice_wo->invoice_id) : NULL ?>");
                <?php } ?>
            <?php } else { ?>
                $("#termin_history").load("<?php echo base_url() . $url_access . 'get_invoice_history/' ?>" + $("#work_order").val());
            <?php } ?>
        <?php } ?>
        if($("input[name=invoice_resource_code]:checked").val() == 2) {
            
        }
        
        <?php if(isset($invoice)) { ?>
            netto_bruto();
        <?php } ?>
    });
</script>