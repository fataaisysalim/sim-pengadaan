<div class="panel-body row">
    <div class="row">
        <table class="table table-bordered table-striped" style="margin-top: -13px">
            <thead class="bg-dark" style="color: white">
                <tr>
                    <th class="text-center hidden-xs" style="width: 30px; padding: 15px">No.</th>
                    <th class="text-center" style="width: 250px; padding: 15px">Material</th>
                    <th class="text-center" style="width: 250px; padding: 15px">Code</th>
                    <th class="text-center" style="width: 250px; padding: 15px">Unit</th>
                    <th class="text-center" style="width: 100px; padding: 15px">Convertion</th>
                    <th class="text-center" style="width: 100px; padding: 15px">Volume</th>
                    <th class="text-center" style="width: 100px; padding: 15px">Price</th>
                    <th class="text-center" style="width: 170px; padding: 15px">Subtotal</th>
                </tr>
            </thead>
            <tbody id="show_row">
                <?php foreach($invoice_dt as $i => $row) { ?>
                <tr>
                    <td><?php echo ++$i; ?></td>
                    <td><?php echo $row->material_sub_name; ?></td>
                    <td><?php echo $row->code_name; ?></td>
                    <td><?php echo $row->material_unit_name; ?></td>
                    <td><?php echo $row->mog_dt_convertion; ?></td>
                    <td><?php echo rupiah($row->mog_dt_volume); ?></td>
                    <td><?php echo rupiah($row->mog_dt_price); ?></td>
                    <td><?php $convert = $row->mog_dt_convertion != 0 ? $row->mog_dt_convertion : 1; echo rupiah($row->mog_dt_price * $convert * $row->mog_dt_volume); ?></td>
                </tr>
                <?php } ?>
            </tbody>
            <tr>
                <th class="text-right" colspan="7">Total (Rp.)</th>
                <th><input type="text" class="form-control" value="<?php echo rupiah($total_invoice); ?>" name="payment_total" id="payment_total" readonly/></th>
            </tr>
        </table> 
    </div>
</div>