<div class="panel-body">
    <div class="row">
        <ul class="nav nav-tabs" style="margin-top: -20px">
            <?php foreach ($show['ct'] as $number => $row) { ?>
                <li <?php echo $number == 0 ? 'class="active"' : null ?>>
                    <a href="#mt<?php echo $row->equipment_ct_id ?>" data-toggle="tab"><?php echo strtoupper($row->equipment_ct_name) ?></a>
                </li>
            <?php } ?>
        </ul>
        <section>
            <div class="tab-content ">
                <?php foreach ($show['ct'] as $numb => $rows) { ?>
                    <section class="tab-pane <?php echo $numb == 0 ? 'active' : null ?>" id="mt<?php echo $rows->equipment_ct_id ?>">
                        <div class="col-xs-12 mg-t-md">
                            <div class="row">
                                <?php echo form_open("", array('id' => "formEq_$rows->equipment_ct_id")); ?>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <label>EQIPMENT STATUS :</label>
                                    <select class="statusEq_<?php echo $rows->equipment_ct_id ?> form-control">
                                        <option value="all">ALL</option>
                                        <option value="active">ACTIVE</option>
                                        <option value="nonactive">NONACTIVE</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <label>EQUIPMENT UNIT :</label>
                                    <select class="unitEq_<?php echo $rows->equipment_ct_id ?> form-control">
                                        <option value="all">ALL</option>
                                        <?php foreach ($show['unit'][$numb] as $x => $rel) { ?>
                                            <option value="<?php echo $rel->equipment_unit_id ?>"><?php echo strtoupper($rel->equipment_unit_name) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <button type="submit" class="btn btn-md btn-primary col-xs-12" style="margin-top: 23px;"><i class="fa fa-search mg-r-sm"></i> SEARCH</button>
                                </div>
                                <?php echo form_close(); ?>
                                <div class="col-sm-3 col-xs-6 hidden-xs">
                                    <a onclick="onExport('<?php echo $rows->equipment_ct_id ?>','<?php echo md5($rows->equipment_ct_id); ?>')" role="button" class="btn btn-md btn-dark pull-right col-xs-12" style="margin-top: 22px"><i class="fa fa-download mg-r-sm"></i> EXCEL</a>
                                </div>
                            </div>
                            <hr class="divider" style="padding: 0px; margin: 15px 0px 10px 0px"/>
                        </div>
                        <div class="col-xs-12 eqData_<?php echo $rows->equipment_ct_id ?>"></div>
                        <?php if ($permit->access_special == 1) { ?>
                            <div class="col-xs-12">
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
                        $(".eqData_<?php echo $rows->equipment_ct_id ?>").load("<?php echo base_url() ?>warehouse/eq-information/<?php echo md5($rows->equipment_ct_id) ?>");
                        $("#formEq_<?php echo $rows->equipment_ct_id ?>").submit(function () {
                            var status = $('.statusEq_<?php echo $rows->equipment_ct_id ?>').val();
                            var unit = $('.unitEq_<?php echo $rows->equipment_ct_id ?>').val();
                            $(".eqData_<?php echo $rows->equipment_ct_id ?>").load("<?php echo base_url() ?>warehouse/eq-information/<?php echo md5($rows->equipment_ct_id) ?>/" + status + "/" + unit);
                            return false;
                        });
                    </script>
                <?php } ?>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i> INFORMATION EQUIPMENT');
<?php if ($permit->access_special == 1) { ?>
        function statusEq(ctt, ct, id, status) {
            var msg = status == 1 ? "Equipment that you choose will be activated ?" : "Equipment that you choose will be deactivated ?";
            bootbox.confirm(msg, function (result) {
                if (result == true) {
                    $.ajax({
                        url: "<?php echo base_url() ?>warehouse/equipment/status/" + id + "/" + status,
                        dataType: "JSON",
                        success: function (json) {
                            if (json.status == 1) {
                                var status = $('.statusEq_' + ctt).val();
                                var unit = $('.unitEq_' + ctt).val();
                                $(".eqData_" + ctt).load("<?php echo base_url() ?>warehouse/eq-information/" + ct + "/" + status + "/" + unit);
                            }
                        }
                    });
                }
            });
        }
<?php } ?>
    function onExport(param, param2) {
        var ct = param2;
        var status = $('.statusEq_' + param).val();
        var unit = $('.unitEq_' + param).val();
        
        window.open("<?php echo base_url('warehouse/export/equipment'); ?>" + '/' + ct + '/' + unit + '/' + status);
    }
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>