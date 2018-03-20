<div class="panel-body row">

    <div class="row">
        <table class="table table-bordered table-striped" style="margin-bottom: 0px">
            <thead class="bg-dark" style="color: white">
                <tr>
                    <th class="text-center" style="width: 40px; padding: 15px">No.</th>
                    <th class="text-center" style="width: 200px; padding: 15px"><?php echo ucwords($resource); ?></th>
                    <th class="text-center" style="width: 100px; padding: 15px">Unit</th>
                    <th class="text-center" style="width: 90px; padding: 15px">Volume</th>
                </tr>
            </thead>
            <tbody id="show_row">
                <?php
                $nos = 1;
                foreach ($data as $i => $row) {
                    ?>
                    <?php $no = $i + 1; ?>
                    <?php $table = $resource == 'material' ? 'material_sub' : $resource; ?>
                    <?php $id = $resource == 'material' ? 'material_sub_id' : $resource . '_id'; ?>
                    <?php $name = $resource == 'material' ? 'material_sub_name' : $resource . '_name'; ?>
                    <?php $type = $resource == 'material' ? null : $resource . '_type'; ?>
                    <?php $unit = $resource == 'material' ? 'material_unit_name' : $resource . '_unit_name'; ?>
                    <?php $stock = 'stock'; ?>

                    <tr class="row_out row_tam">
                        <td class="text-center" id="nom_<?php echo $no; ?>">
                            <?php echo$nos; ?>
                        </td>
                <input type="hidden" name="action[]" value="<?php echo isset($row->$stock) ? 'edit' : 'add'; ?>" class="form-control">
                <td>
                    <?php echo strtoupper($row->$name); ?> <?php echo!empty($type) ? strtoupper($row->$type) : null; ?>
                    <input type="hidden" id="resource_name_<?php echo $no; ?>" name="resource_name[]" value="<?php echo strtoupper($row->$name); ?> <?php echo!empty($type) ? strtoupper($row->$type) : null; ?>" class="form-control" placeholder="Resource" readonly>
                    <input type="hidden" id="resource_<?php echo $no; ?>" name="resource[]" value="<?php echo $row->$id; ?>" class="form-control" placeholder="Resource" readonly>
                </td>
                <td>
                    <input type="text" id="unit_<?php echo $no; ?>" name="unit[]" value="<?php echo $row->$unit; ?>" class="form-control" placeholder="Satuan" readonly>
                </td>
                <td>
                    <input <?php echo isset($row->child) ? $row->child > 0 ? 'readonly' : NULL  : NULL; ?> id="volume_<?php echo $no; ?>" class=" form-control " onkeyup="format_num(this)" name="volume[]" value="<?php echo isset($row->$stock) ? rupiah($row->$stock) : NULL; ?>" class="form-control" placeholder="Volume">
                </td>
                </tr>
                <?php
                $nos++;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>