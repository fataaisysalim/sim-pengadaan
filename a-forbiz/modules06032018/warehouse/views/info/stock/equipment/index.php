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
                            <?php echo form_open("", array('id' => "forme_$rows->equipment_ct_id")); ?>
                            <div class="row" style="margin-bottom: 0;">
                                <div class="col-sm-4 col-xs-12 mg-b-sm">
                                    <div class="form-group">
                                        <label class="mg-b-sm">PROJECT :</label>
                                        <select id="project" name="project" class="projectm_<?php echo $rows->equipment_ct_id ?> form-control form-select2" data-style="btn-white">
                                            <?php foreach ($project as $i => $pro) : ?>
                                                <option value="<?php echo md5($pro->project_id); ?>"><?php echo strtoupper($pro->project_name); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 mg-b-sm">
                                    <div class="form-group">
                                        <label class="mg-b-sm">SUPPLIER/SUBKON :</label>
                                        <select id="actor" name="actorAct" class="form-control form-select2 actorm_<?php echo $rows->equipment_ct_id ?>" data-style="btn-white" data-placeholder="Choose Supplier/Subcon">
                                            <option value="">ALL</option>
                                            <?php foreach ($supplier['ct'] as $nom => $ct) : ?>
                                            <optgroup label="<?php echo strtoupper($ct->actor_category_name); ?>">
                                                    <?php foreach ($supplier['act'][$nom] as $num => $man) : ?>
                                                        <option value="<?php echo md5($man->actor_id); ?>"><?php echo $man->actor_name; ?></option>
                                                    <?php endforeach; ?>
                                                </optgroup>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <div style="margin-top: 27px" class="hidden-xs"></div>
                                    <button type="submit" class="btn btn-md btn-block btn-primary"><i class="fa fa-search mg-r-sm"></i> SEARCH</button>
                                </div>
                                <div class="col-md-2 col-xs-6 hidden-xs" >
                                    <div style="margin-top: 27px" class="hidden-xs"></div>
                                    <a onclick="onExport('<?php echo $rows->equipment_ct_id; ?>', '<?php echo md5($rows->equipment_ct_id); ?>')" role="button" class="btn btn-md btn-block btn-dark pull-right"><i class="fa fa-download mg-r-sm"></i> EXCEL</a>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                            <hr class="divider" style="padding: 0px; margin: 15px 0px 10px 0px"/>
                        </div>
                        <div class="col-xs-12 stockEData_<?php echo $rows->equipment_ct_id ?>"></div>
                        <div class="col-md-12">
                            <b>Note :</b>
                            <div class="row mg-t-md mg-b-sm">
                                <div class="col-xs-4">
                                    <i class="fa fa-search mg-r-md btn btn-sm btn-primary" disabled></i> DETAIL
                                </div>
                            </div>
                        </div>
                    </section>
                    <script>
                        $(".stockEData_<?php echo $rows->equipment_ct_id ?>").load("<?php echo base_url() ?>warehouse/eq-stock/<?php echo md5($rows->equipment_ct_id) ?>/" + $('.projectm_<?php echo $rows->equipment_ct_id ?>').val());
                        $("#forme_<?php echo $rows->equipment_ct_id ?>").submit(function () {
                            var projects = $('.projectm_<?php echo $rows->equipment_ct_id ?>').val();
                            var actors = $('.actorm_<?php echo $rows->equipment_ct_id ?>').val();
                            $(".stockEData_<?php echo $rows->equipment_ct_id ?>").load("<?php echo base_url() ?>warehouse/eq-stock/<?php echo md5($rows->equipment_ct_id) ?>/" + projects + '/' + actors);
                            return false;
                        });
                    </script>
                <?php } ?>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    $(".datepicker").datepicker();
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i> INFORMATION EQUIPMENT STOCK');
    function detail_stock_eq(id, ct, actor) {
//        var start = $(".starte_" + ct).val();
//        var end = $(".ende_" + ct).val();
        $("#modal-contents").html(''); 
        $("#modal-contents").load("<?php echo base_url() ?>warehouse/stock/detail/equipment/" + id + '/' + actor);
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
    }

    function onExport(param, param2) {
        var ct = param2;
        var starts = $('.starte_' + param).val();
        var ends = $('.ende_' + param).val();
        var projects = $('.projectm_' + param).val();
        var actors = $('.actorm_' + param).val();
        window.open("<?php echo base_url('warehouse/export/stock_equipment'); ?>/" + ct + '/' + projects + '/' + actors);
    }
</script>
