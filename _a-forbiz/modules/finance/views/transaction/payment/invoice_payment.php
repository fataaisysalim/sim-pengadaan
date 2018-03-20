<div class="depay" style="margin: 0 0;">
    <div class="row">
        <div class="col-lg-12">
            <label style="margin: 5px 0;">Detail Pembayaran</label>
            <table class="table" width="100%" style="margin-left: -5px; margin-right: -5px;">
                <tbody>
                    <?php if(isset($inv_wo)) { ?>
                        <tr>
                            <td>Total Kontrak</td>
                            <td>:</td>
                            <td class='text-right'><?php echo rupiah($invoice->invoice_total); ?></td>
                        </tr>
                        <?php if($inv_wo->invoice_wo_ct_id == 1) { ?>
                        <tr>
                            <td>Nilai Uang Muka</td>
                            <td>:</td>
                            <td class='text-right'>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <?php echo rupiah(($inv_wo->invoice_wo_nominal / $inv_wo->invoice_total) * 100) . '%'; ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php echo rupiah($inv_wo->invoice_wo_nominal); ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if($inv_wo->invoice_wo_ct_id == 2) { ?>
                        <tr>
                            <td>Nilai Progres</td>
                            <td>:</td>
                            <td class='text-right'>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <?php echo $inv_wo->invoice_wo_percent . '%'; ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php echo rupiah($inv_wo->invoice_wo_percent * $inv_wo->invoice_total / 100) ; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                            <?php if(isset($pot_termin)) { ?>
                            <?php $paid = 0; foreach($pot_termin as $t) { ?>
                            <tr>
                                <td>Pot Termin <?php echo $t->invoice_wo_sequence; ?></td>
                                <td>:</td>
                                <td class='text-right'>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <?php echo $t->invoice_wo_percent . '%'; ?>
                                        </div>
                                        <div class="col-xs-6">
                                            <?php echo rupiah($t->invoice_netto) ; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $paid = $paid + $t->invoice_netto; ?>
                            <?php } ?>
                            <tr>
                                <td>Total Sudah Dibayar</td>
                                <td>:</td>
                                <td class='text-right'><?php echo rupiah($paid); ?></td>
                            </tr>
                            <tr>
                                <td>Tagihan Saat Ini</td>
                                <td>:</td>
                                <td class='text-right'><?php echo rupiah($inv_wo->invoice_wo_nominal); ?></td>
                            </tr>
                            <tr>
                                <td>Angsuran Uang Muka</td>
                                <td>:</td>
                                <td class='text-right'>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <?php echo $inv_wo->work_order_dp . '%'; ?>
                                        </div>
                                        <div class="col-xs-6">
                                            <?php echo rupiah($inv_wo->invoice_wo_dp); ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Retensi</td>
                                <td>:</td>
                                <td class='text-right'>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <?php echo $inv_wo->work_order_retensi . '%'; ?>
                                        </div>
                                        <div class="col-xs-6">
                                            <?php echo rupiah($inv_wo->invoice_wo_retensi); ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        <?php } ?>
                        <?php if($inv_wo->invoice_wo_ct_id == 3) { ?>
                            <tr>
                                <td>Nilai Progres</td>
                                <td>:</td>
                                <td class='text-right'>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <?php echo '100%'; ?>
                                        </div>
                                        <div class="col-xs-6">
                                            <?php echo rupiah($inv_wo->invoice_total) ; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    <tr>
                        <td>Netto</td>
                        <td>:</td>
                        <td class='text-right'><?php echo rupiah($invoice->invoice_netto); ?></td>
                    </tr>
                    <?php foreach ($invoice_tax as $it) { ?>
                        <?php if ($it->tax_name == 'PPN') { ?>
                            <tr>
                                <td>PPN</td>
                                <td>:</td>
                                <td class='text-right'><?php echo rupiah($it->tax); ?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    <tr>
                        <td>Bruto</td>
                        <td>:</td>
                        <td class='text-right'><?php echo rupiah($invoice->invoice_bruto); ?></td>
                    </tr>
                    <?php foreach ($invoice_tax as $it) { ?>
                        <?php if ($it->tax_name != 'PPN') { ?>
                            <tr>
                                <td><?php echo $it->tax_name; ?></td>
                                <td>:</td>
                                <td class='text-right'><?php echo rupiah($it->tax); ?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
                <tfoot>

                    <tr>
                        <th>Total Tagihan</th>
                        <th>:</th>
                        <th class='text-right'><?php echo rupiah($invoice->invoice_total_final); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>