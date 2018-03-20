<div class="panel-body">
    <div class="row">
        <div class="col-sm-7">
            <table class="table">
                <tr>
                    <td><?php echo $mog->transaction_ct_id == 1 ? "BAPB" : "BPM"; ?> NUMBER</td>
                    <td>:</td>
                    <td><?php echo $mog->mog_number; ?></td>
                </tr>
                <tr>
                    <td><?php echo $mog->transaction_ct_id == 1 ? "SUPPLIER/SUBCON" : "FOREMAN/SUBCON"; ?></td>
                    <td>:</td>
                    <td><?php echo strtoupper($mog->actor_name); ?></td>
                </tr>
                <?php if ($mog->transaction_ct_id == 1) { ?>
                    <tr>
                        <td>LETTER NUMBER</td>
                        <td>:</td>
                        <td><?php echo strtoupper($mog->mog_number_letter); ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td>INPUT BY WAREHOUSE</td>
                    <td>:</td>
                    <td><?php echo strtoupper(indo_date($mog->mog_date, 1, 1)); ?></td>
                </tr>
                <?php if ($mog->transaction_ct_id == 1) { ?>
                    <tr>
                        <td>VERIFY BY PROCUREMENT</td>
                        <td>:</td>
                        <td><?php echo!empty($mog->mog_date_verify) ? strtoupper(indo_date($mog->mog_date_verify, 1, 1)) : "-"; ?> <?php echo!empty($mog->mog_date_verify) ? "<i class='fa fa-check text-success mg-l-md'></i>" : null; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="col-sm-5">
            <p class="pull-right mg-r-lg mg-t-md"><i class="fa fa-pencil mg-r-sm"></i>POSTED BY <b><?php echo strtoupper($mog->employee_name); ?></b></p>
        </div>
        <div class="col-xs-12">
            <div class="table-responsive no-border">
                <table class="table table-bordered table-striped" style="min-width: 450px;">
                    <thead class="bg-dark" style="color: white;">
                        <tr>
                            <th class="text-center">NO.</th>
                            <?php if (!empty($permit)) { ?>
                                <?php if ($permit->access_special == 1) { ?>
                                    <?php if ($mog->transaction_ct_id == 1) { ?>
                                        <th class="text-center">RESOURCE CODE</th>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            <th class="text-center">MATERIAL</th>
                            <th class="text-center">UNIT</th>
                            <?php if ($mog->transaction_ct_id == 1) { ?>
                                <th class="text-center">CONVERTION</th>
                            <?php } ?>
                            <th class="text-center">VOLUME</th>
                            <?php if (!empty($permit)) { ?>
                                <?php if ($permit->access_special == 1) { ?>
                                    <?php if ($mog->transaction_ct_id == 1) { ?>
                                        <th class="text-center">PRICE</th>
                                        <th class="text-center">TOTAL</th>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            <th class="text-center">NOTE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($mog_dt as $number => $row) {
                            ?>
                            <tr>
                                <td class="text-center"><?php echo rupiah($number + 1) ?></td>
                                <?php if (!empty($permit)) { ?>
                                    <?php if ($permit->access_special == 1) { ?>
                                        <?php if ($mog->transaction_ct_id == 1) { ?>
                                            <td><?php echo strtoupper($row->code_name); ?></td>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                                <td><?php echo strtoupper($row->material_sub_name) ?></td>
                                <td class="text-center"><?php echo $row->material_unit_name ?></td>
                                <?php if ($mog->transaction_ct_id == 1) { ?>
                                    <td class="text-center"><?php echo!empty($row->mog_dt_convertion) ? str_replace('.', ',', $row->mog_dt_convertion) : "<center>-</center>" ?></td>
                                <?php } ?>
                                <td class="text-center"><?php echo rupiah($row->mog_dt_volume) ?></td>
                                <?php if (!empty($permit)) { ?>
                                    <?php if ($permit->access_special == 1) { ?>
                                        <?php if ($mog->transaction_ct_id == 1) { ?>
                                            <td><?php echo rupiah($row->mog_dt_price) ?></td>
                                            <td><?php
                            $convert = $row->mog_dt_convertion ? $row->mog_dt_convertion : 1;
                            echo rupiah($row->mog_dt_volume * $convert * $row->mog_dt_price)
                                            ?></td>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                                <td><?php echo!empty($row->mog_dt_note) ? ucwords($row->mog_dt_note) : "<center>-</center>" ?></td>
                            </tr>
                            <?php if ($mog->transaction_ct_id == 1) { ?>
                                <?php
                                $cvt = !empty($convert) ? $convert : 1;
                                $total += ($row->mog_dt_volume * ($cvt * $row->mog_dt_price));
                                ?> 
                            <?php } ?>
                        <?php } ?>
                        <?php if (!empty($permit)) { ?>
                            <?php if ($permit->access_special == 1) { ?>
                                <?php if ($mog->transaction_ct_id == 1) { ?>
                                    <tr>
                                        <th colspan="7" class="text-right"> TOTAL <?php echo $mog->transaction_ct_id == 1 ? "BAPB" : "BPM" ?></th>
                                        <th colspan="2"><?php echo rupiah($total) ?></th>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<a role="button" onclick="back_mog()" class="pull-left btn btn-sm btn-danger" style="margin-top:-5px"><i class="fa fa-reply"></i></a><i class="fa fa-search mg-r-md"></i> DETAIL <b><?php echo $mog->transaction_ct_id == 1 ? "MATERIAL RECEIPT (BAPB)" : "MATERIAL USAGE (BPM)" ?></b>');
    function back_mog() {
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url() ?>procurement/bapb-bapp-process");
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
    }
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>