<div class="panel-body">
    <div class="table-responsive no-border col-md-6">
        <table class="table">
            <tr>
                <td style="width: 150px;"><b>Total Kontrak</b></td>
                <td style="font-weight: bold">
                    <input readonly class="form-control" type="text" style="font-weight: bold" value="<?php echo rupiah($termin->invoice_total) ?>"/>
                </td>
            </tr>
            <tr>
                <td><b>Angsuran UM</b></td>
                <td style="font-weight: bold">
                    <div class="row">
                        <div class="col-xs-8">
                            <input readonly class="form-control" type="text" style="font-weight: bold" value="<?php echo rupiah($termin->invoice_wo_dp); ?>"/>
                        </div>
                        <div class="col-xs-4" id="um_percent">
                            <input readonly class="form-control" type="text" style="font-weight: bold" value="<?php echo rupiah($termin->work_order_dp) ?>%"/>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
            $tot = 0;
            foreach ($pot_termin as $ii => $tt) {
                ?>
                <tr>
                    <td style="width: 130px;"><b>Pot Termin <?php echo $tt->invoice_wo_sequence; ?> : </b></td>
                    <td style="font-weight: bold">
                        <div class="row">
                            <div class="col-xs-8">
                                <input readonly class="form-control" type="text" style="font-weight: bold" value="<?php echo rupiah($tt->invoice_netto); ?>"/>
                            </div>

                            <div class="col-xs-4">
                                <input readonly class="form-control" value="<?php echo rupiah($tt->invoice_wo_percent) . ' %'; ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <?php $tot = $tot + $tt->invoice_netto; ?>
            <?php } ?>

            <tr>
                <td style="width: 130px;"><b>Total Sudah Dibayar</b></td>
                <td style="font-weight: bold">
                    <input readonly class="form-control" type="text" style="font-weight: bold" value="<?php echo rupiah($tot); ?>"/>
                </td>
            </tr>


            <tr>
                <td style="width: 130px;"><b>Sisa Tagihan</b></td>
                <td style="font-weight: bold">
                    <input readonly class="form-control" type="text" style="font-weight: bold" value="<?php echo rupiah($termin->invoice_wo_nominal); ?>"/>
                </td>
            </tr>


            <tr>

        </table>
    </div>
    <div class="table-responsive no-border col-md-6">
        <table class="table">
            
<tr>
                <td  style="width: 130px;"><b id="input_name">Nilai Progres : </b></td>
                <td style="font-weight: bold">
                    <div class="row">
                        <div class="col-xs-4">
                            <input readonly class="form-control" style="font-weight: bold" value="<?php echo rupiah($termin->invoice_wo_percent) . '%' ?>"/>
                        </div>
                        <div class="col-xs-8">
                            <input readonly class="form-control" style="font-weight: bold" value="<?php echo rupiah(($termin->invoice_wo_percent / 100) * $termin->invoice_total); ?>"/>
                        </div>
                    </div>

                </td>
            </tr>
            <tr>
                <td><b>Retensi</b></td>
                <td style="font-weight: bold">
                    <div class="row">
                        <div class="col-xs-8">
                            <input readonly class="form-control" type="text" style="font-weight: bold" value="<?php echo rupiah($termin->invoice_wo_retensi); ?>"/>
                        </div>
                        <div class="col-xs-4" id="retensi_percent">
                            <input readonly class="form-control" type="text" style="font-weight: bold" value="<?php echo rupiah($termin->work_order_retensi) ?>%"/>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 130px;"><b>Netto : </b></td>
                <td style="font-weight: bold">
                    <input readonly class="form-control" type="text" style="font-weight: bold" value="<?php echo rupiah($termin->invoice_netto); ?>"/>
                </td>
            </tr>

            <tr>
                <td style="width: 130px;"><b>PPN : </b></td>
                <td style="font-weight: bold">
                    <?php
                    $tax['ppn'] = 0;
                    foreach ($invoice_tax as $it) :
                        ?>
                        <?php if ($it->tax_name == 'PPN') { ?>
                            <?php $tax['ppn'] = $tax['ppn'] + $it->invoice_tax_nominal; ?>
                        <?php } ?>
                    <?php endforeach; ?>
                    <input class="form-control" type="text" style="font-weight: bold" value="<?php echo rupiah($tax['ppn']); ?>" readonly/>
                </td>
            </tr>

            <tr>
                <td style="width: 130px;"><b>Bruto : </b></td>
                <td style="font-weight: bold">
                    <input readonly class="form-control" type="text" style="font-weight: bold" value="<?php echo rupiah($termin->invoice_bruto); ?>"/>
                </td>
            </tr>

            <tr>
                <td style="width: 130px;"><b>Potongan PPH : </b></td>
                <td style="font-weight: bold">
                    <?php
                    $tax['pph'] = 0;
                    foreach ($invoice_tax as $it) :
                        ?>
                        <?php if ($it->tax_name != 'PPN') { ?>
                            <?php $tax['pph'] = $tax['pph'] + $it->invoice_tax_nominal; ?>
                        <?php } ?>
                    <?php endforeach; ?>
                    <input class="form-control" type="text" style="font-weight: bold" value="<?php echo rupiah($tax['pph']); ?>" readonly/>
                </td>
            </tr>

            <tr>
                <td style="width: 130px;"><b>Total Tagihan : </b></td>
                <td style="font-weight: bold">
                    <input class="form-control" type="text" style="font-weight: bold" name="total" value="<?php echo rupiah($termin->invoice_total_final); ?>" readonly/>
                </td>
            </tr>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i>Detail Termin');
</script>
