<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="panel-body">
    <div class="row">
        <?php if (count($menu) > 1) { ?>
            <ul class="nav nav-tabs" style="margin-top: -20px">
                <?php foreach ($menu as $number => $row) { ?>
                    <li <?php echo $number == 1 ? 'class="active"' : null ?>>
                        <a href="#ar<?php echo $number ?>" data-toggle="tab"><?php echo strtoupper($row); ?></a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
        <section>
            <div class="tab-content ">
                <?php foreach ($menu as $numb => $row) { ?>
                    <section class="tab-pane <?php echo $numb == 1 ? 'active' : null ?>" id="ar<?php echo $numb; ?>">
                        <div class="col-xs-12">
                            <?php echo form_open("", array('id' => "formAct_" . $numb)); ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>PROJECT : </label>
                                        <select id="projectAct_<?php echo $numb; ?>" name="projectAct_<?php echo $numb; ?>" class="form-control form-select2 projectAct" data-style="btn-white">
                                            <?php foreach ($project as $i => $pro) : ?>
                                                <option value="<?php echo md5($pro->project_id); ?>"><?php echo strtoupper($pro->project_name); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <br style="margin-bottom: 15px" class="visible-xs"/>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <label>INVOICE STATUS :</label>
                                    <select class="statusAct_<?php echo $numb; ?> form-control" name="status">
                                        <option value="all">ALL</option>
                                        <option value="0">OUTSTANDING</option>
                                        <option value="1">PAID</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <div class="clearfix visible-xs" style="margin-top: 0px;">&nbsp;</div>
                                    <div class="form-group">
                                        <label>SUPPLIER / SUBCON</label>
                                        <select id="actor" class="form-control form-select2 actoras_<?php echo $numb; ?>" name="actorAct_<?php echo $numb; ?>" data-style="btn-white" data-placeholder="Pilih Supplier/Subkon">
                                            <option value="">ALL</option>
                                            <?php foreach ($supplier['ct'] as $nom => $ct) : ?>
                                                <optgroup label="<?php echo $ct->actor_category_name; ?>">
                                                    <?php foreach ($supplier['act'][$nom] as $num => $man) : ?>
                                                        <option value="<?php echo md5($man->actor_id); ?>"><?php echo $man->actor_name; ?></option>
                                                    <?php endforeach; ?>
                                                </optgroup>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mg-t-sm"></div>
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <label>DATE :</label>
                                    <div class="row">
                                        <div class="col-sm-5 col-xs-12">
                                            <div class="input-group input-append date datepickers" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                                <input type="text" class="form-control startAct_<?php echo $numb; ?>" name="start" value="<?php echo date('d-m-Y') ?>">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-white add-on" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="clearfix visible-xs" style="margin-top: 20px;">&nbsp;</div>
                                        <div class="col-sm-2 col-xs-2 hidden-xs" class="text-center"><b style="font-size: 20px; padding-top: 120px"><center class="hidden-xs"> - </center></b></div>
                                        <div class="col-sm-5 col-xs-12">
                                            <div class="input-group input-append date datepickers" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                                <input type="text" class="form-control endAct_<?php echo $numb; ?>" name="end" value="<?php echo date('d-m-Y') ?>">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-white add-on" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="clearfix visible-xs" style="margin-top: 5px;">&nbsp;</div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <div class="mg-t-lg hidden-xs" style="margin-top: 22px;"></div>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <button type="submit" class="btn btn-md btn-block btn-primary" title="SEARCH"><i class="fa fa-search"></i><span class="mg-l-sm hidden-xs"></span> SEARCH</button>
                                        </div>
                                        <div class="col-md-6 hidden-xs">
                                            <a onclick="ExportInv(<?php echo $numb; ?>)" class="btn btn-md btn-block btn-dark pull-right"><i class="fa fa-download"></i> <span class="mg-l-sm hidden-xs"></span> EXCEL</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                            <hr class="divider" style="padding: 0px; margin: 15px 0px 10px 0px"/>
                        </div>
                        <div class="col-xs-12 actData_<?php echo $numb; ?>"></div>
                    </section>
                    <script>

                        load();

                        function load() {
                            var info_projects = $("select[name=projectAct_<?php echo $numb; ?>] option:selected").val();
                            var info_actors = $("select[name=actorAct_<?php echo $numb; ?>] option:selected").val();
                            var info_status = $('.statusAct_<?php echo $numb; ?>').val();
                            var info_starts = $('.startAct_<?php echo $numb; ?>').val();
                            var info_ends = $('.endAct_<?php echo $numb; ?>').val();
                            $(".actData_<?php echo $numb; ?>").load("<?php echo base_url() ?>finance/inv-information/" + '<?php echo $numb; ?>' + '/' + info_projects + '/' + info_starts + '/' + info_ends + '/' + info_status + '/' + info_actors);
                        }
                        $("#formAct_<?php echo $numb; ?>").submit(function () {
                            var info_projects = $("select[name=projectAct_<?php echo $numb; ?>] option:selected").val();
                            var info_actors = $("select[name=actorAct_<?php echo $numb; ?>] option:selected").val();
                            var info_status = $('.statusAct_<?php echo $numb; ?>').val();
                            var info_starts = $('.startAct_<?php echo $numb; ?>').val();
                            var info_ends = $('.endAct_<?php echo $numb; ?>').val();
                            console.log("<?php echo base_url() ?>finance/inv-information/" + '<?php echo $numb; ?>' + '/' + info_projects + '/' + info_starts + '/' + info_ends + '/' + info_status + '/' + info_actors);
                            $(".actData_<?php echo $numb; ?>").load("<?php echo base_url() ?>finance/inv-information/" + '<?php echo $numb; ?>' + '/' + info_projects + '/' + info_starts + '/' + info_ends + '/' + info_status + '/' + info_actors);
                            return false;
                        });
                    </script>
                <?php } ?>
            </div>
        </section>
        <div class="col-md-12">
            <b>Note :</b>
            <div class="row mg-t-md mg-b-sm">
                <div class="col-sm-2 col-xs-6">
                    <i class="fa fa-search mg-r-md btn btn-sm btn-primary mg-b-sm" disabled></i> Detail
                </div>
                <div class="col-sm-3 col-xs-6">
                    <i class="fa fa-print mg-r-md btn btn-sm btn-dark mg-b-sm" disabled></i> Print Invoice
                </div>
                <?php if ($permit->access_update == 1) { ?>
                    <div class="col-sm-2 col-xs-6">
                        <i class="fa fa-pencil mg-r-md btn btn-sm btn-warning mg-b-sm" disabled></i> Edit
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <i class="fa fa-pencil-square mg-r-md btn btn-sm btn-success mg-b-sm" disabled></i> Edit Payment
                    </div>
                <?php } ?>
                <?php if ($permit->access_delete == 1) { ?>
                    <div class="col-sm-2 col-xs-6">
                        <i class="fa fa-trash mg-r-md btn btn-sm btn-danger mg-b-sm" disabled></i> Delete
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i>INFORMATION INVOICE');

    $(".datepickers").datepicker();
    $("select.form-select2").select2();

    function detail(id) {
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url(); ?>finance/inv-information/detail/" + id);
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
    }
    function ExportInv(tab) {
        var info_projects = $("select[name=projectAct_"+tab+"] option:selected").val();
        var info_actors = $("select[name=actorAct_"+tab+"] option:selected").val();
        var info_status = $('.statusAct_'+tab).val();
        var info_starts = $('.startAct_'+tab).val();
        var info_ends = $('.endAct_'+tab).val();
        window.open("<?php echo base_url('finance/report/export/invoice'); ?>" + '/' + info_projects + '/' + info_starts + '/' + info_ends + '/' + info_status + '/' + info_actors);
    }
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>