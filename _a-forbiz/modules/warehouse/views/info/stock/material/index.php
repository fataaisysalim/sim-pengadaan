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
                    <section class="tab-pane <?php echo $numb == 0 ? 'active' : null ?>" id="mt<?php echo $rows->material_category_id ?>">
                        <div class="col-xs-12 mg-t-md">
                            <?php echo form_open("", array('id' => "form_$rows->material_category_id")); ?>
                            <div class="row">
                                <div class="col-sm-3 col-xs-12 mg-b-sm">
                                    <div class="form-group">
                                        <label>PROJECT :</label>
                                        <select id="project" name="project" class="projectm_<?php echo $rows->material_category_id ?> form-control form-select2  mg-t-xs" data-style="btn-white">
                                            <?php foreach ($project as $i => $pro) : ?>
                                                <option value="<?php echo md5($pro->project_id); ?>"><?php echo strtoupper($pro->project_name); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-12 mg-b-sm">
                                    <label>MATERIAL TYPE :</label>
                                    <select name='type' class='type_<?php echo $rows->material_category_id ?> form-control mg-t-xs'>
                                        <option value=''>ALL</option>
                                        <?php foreach ($material['type'][$numb] as $no => $roz) { ?>
                                            <option value='<?php echo md5($roz->material_id) ?>'><?php echo strtoupper($roz->material_name) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-2 col-xs-12">
                                    <div style="margin-top: 27px" class="hidden-xs"></div>
                                    <button type="submit" class="btn btn-md btn-block btn-primary" style="width: 100%"><i class="fa fa-search mg-r-sm"></i> SEARCH</button>
                                </div>
                                <div class="col-sm-2 col-xs-6 hidden-xs">
                                    <div style="margin-top: 27px" class="hidden-xs"></div>
                                    <a onclick="onExport('<?php echo $rows->material_category_id; ?>', '<?php echo md5($rows->material_category_id); ?>')" role="button" class="btn btn-block btn-md btn-dark pull-right"><i class="fa fa-download mg-r-sm"></i> EXCEL</a>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                            <hr class="divider" style="padding: 0px; margin: 15px 0px 10px 0px"/>
                        </div>
                        <div class="col-xs-12 stockMData_<?php echo $rows->material_category_id ?>"></div>
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
                        $(".stockMData_<?php echo $rows->material_category_id ?>").load("<?php echo base_url() ?>warehouse/mt-stock/<?php echo md5($rows->material_category_id) ?>/" + $('.projectm_<?php echo $rows->material_category_id ?>').val());
                        $("#form_<?php echo $rows->material_category_id ?>").submit(function() {
//                            var starts = $('.startm_<?php echo $rows->material_category_id ?>').val();
//                            var ends = $('.endm_<?php echo $rows->material_category_id ?>').val();
                            var projects = $('.projectm_<?php echo $rows->material_category_id ?>').val();
                            var types = $('.type_<?php echo $rows->material_category_id ?>').val();
                            $(".stockMData_<?php echo $rows->material_category_id ?>").load("<?php echo base_url() ?>warehouse/mt-stock/<?php echo md5($rows->material_category_id) ?>/" + projects + '/' + types);
                            return false;
                        });
                    </script>
                <?php } ?>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i> INFORMATION MATERIAL STOCK');
    $(".datepicker").datepicker();
    function detail_stock(id) {
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url() ?>warehouse/stock/detail/material/" + id);
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
    }

    function onExport(param, param2) {
        var ct = param2;
        var projects = $('.projectm_' + param).val();
        var types = $('.type_' + param).val();

        window.open("<?php echo base_url('warehouse/export/stock_material'); ?>/" + ct + '/' + projects + '/' + types);
    }
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>