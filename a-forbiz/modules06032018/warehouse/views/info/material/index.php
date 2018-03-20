<div class="panel-body">
    <div class="row">
        <ul class="nav nav-tabs" style="margin-top: -20px">
            <?php foreach ($material['ct'] as $number => $row) { ?>
                <li <?php echo $number == 0 ? 'class="active"' : null ?>>
                    <a href="#mt<?php echo $row->material_category_id ?>" data-toggle="tab"><?php echo strtoupper($row->material_category_name) ?></a>
                </li>
            <?php } ?>
        </ul>
        <section>
            <div class="tab-content ">
                <?php foreach ($material['ct'] as $numb => $rows) { ?>
                    <section class="tab-pane <?php echo $numb == 0 ? 'active' : null ?>" id="mt<?php echo $rows->material_category_id; ?>">
                        <div class="col-xs-12 mg-t-md">
                            <div class="row">
                                <?php echo form_open("", array('id' => "formm_$rows->material_category_id")); ?>
                                <div class="col-md-4 col-sm-4 col-xs-12 mg-b-sm">
                                    <label>MATERIAL STATUS :</label>
                                    <select class="statusm_<?php echo $rows->material_category_id ?> form-control">
                                        <option value="all">ALL</option>
                                        <option value="active">ACTIVE</option>
                                        <option value="nonactive">NONACTIVE</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12 mg-b-sm">
                                    <label>MATERIAL TYPE :</label>
                                    <select class="typem_<?php echo $rows->material_category_id ?> form-control">
                                        <option value="all">ALL</option>
                                        <?php foreach ($material['type'][$numb] as $x => $rel) { ?>
                                            <option value="<?php echo $rel->material_id ?>"><?php echo strtoupper($rel->material_name); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12 mg-b-sm">
                                    <label>MATERIAL UNIT :</label>
                                    <select class="unitm_<?php echo $rows->material_category_id ?> form-control">
                                        <option value="all">ALL</option>
                                        <?php foreach ($material['unit'][$numb] as $x => $rels) { ?>
                                            <option value="<?php echo $rels->material_unit_id ?>"><?php echo strtoupper($rels->material_unit_name) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <a onclick="onExport('<?php echo $rows->material_category_id; ?>','<?php echo md5($rows->material_category_id); ?>')" role="button" class="btn btn-md btn-dark pull-right hidden-xs mg-l-md"><i class="fa fa-download mg-r-sm"></i> EXCEL</a>
                                    <button type="submit" class="btn btn-md btn-primary pull-right"><i class="fa fa-search mg-r-sm"></i> SEARCH</button>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                            <hr class="divider" style="padding: 0px; margin: 15px 0px 10px 0px"/>
                        </div>
                        <div class="col-xs-12 mtData_<?php echo $rows->material_category_id ?>"></div>
                        <?php if ($permit->access_special == 1) { ?>
                            <div class="col-md-12">
                                <b>Note :</b>
                                <div class="row mg-t-md mg-b-sm">
                                    <div class="col-xs-6">
                                        <i class="fa fa-check mg-r-md text-success"></i> ACTIVE
                                    </div>
                                    <div class="col-xs-6">
                                        <i class="fa fa-times mg-r-md text-danger"></i> NONACTIVE
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </section>
                    <script>
                        $(".mtData_<?php echo $rows->material_category_id ?>").load("<?php echo base_url() ?>warehouse/mt-information/<?php echo md5($rows->material_category_id) ?>");
                        $("#formm_<?php echo $rows->material_category_id ?>").submit(function () {
                            var status = $('.statusm_<?php echo $rows->material_category_id ?>').val();
                            var unit = $('.unitm_<?php echo $rows->material_category_id ?>').val();
                            var type = $('.typem_<?php echo $rows->material_category_id ?>').val();
                            $(".mtData_<?php echo $rows->material_category_id ?>").load("<?php echo base_url() ?>warehouse/mt-information/<?php echo md5($rows->material_category_id) ?>/" + status + "/" + unit + "/" + type);
                            return false;
                        });

                    </script>
                <?php } ?>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i> INFORMATION MATERIAL');
    function statusMt(ctt, ct, id, status) {
        var msg = status == 1 ? "Whether the material you choose will be activated ?" : "Whether the material you choose will be deactivated ?";
        bootbox.confirm(msg, function (result) {
            if (result == true) {
                $.ajax({
                    url: "<?php echo base_url() ?>warehouse/material/status/" + id + "/" + status,
                    dataType: "JSON",
                    success: function (json) {
                        if (json.status == 1) {
                            var status = $('.statusm_' + ctt).val();
                            var unit = $('.unitm_' + ctt).val();
                            var type = $('.typem_' + ctt).val();
                            $(".mtData_" + ctt).load("<?php echo base_url() ?>warehouse/mt-information/" + ct + "/" + status + "/" + unit + "/" + type);
                        }
                    }
                });
            }
        });
    }

    function onExport(param, param2) {
        var ct = param2;
        var status = $('.statusm_' + param).val();
        var unit = $('.unitm_' + param).val();
        var type = $('.typem_' + param).val();
        
        window.open("<?php echo base_url('warehouse/export/material'); ?>" + '/' + ct + '/' + type + '/' + unit + '/' + status);
    }
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>