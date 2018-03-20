<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="panel-body">
    <div class="row">
        <div class="col-xs-12 mg-t-md">
            <?php echo form_open("", array('id' => "formAct")); ?>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Project</label>
                        <select id="projectAct" name="projectAct" class="form-control form-select2 projectAct" data-style="btn-white">
                            <?php foreach ($project as $i => $pro) : ?>
                                <option value="<?php echo md5($pro->project_id); ?>"><?php echo ucwords($pro->project_name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br style="margin-bottom: 15px" class="visible-xs"/>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Supplier / Subcon</label>
                        <select id="actor" name="actorAct" class="form-control form-select2 actoras" data-style="btn-white" data-placeholder="Pilih Supplier/Subkon">
                            <option value="">All</option>
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
                <div class="col-sm-6 col-xs-12">
                    <div class="clearfix visible-xs" style="margin-top: 0px;">&nbsp;</div>
                    <label>Date :</label>
                    <div class="row">
                        <div class="col-sm-5 col-xs-12">
                            <div class="input-group input-append date datepickers" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                <input type="text" class="form-control startAct" name="start" value="<?php echo date('d-m-Y') ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-white add-on" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="clearfix visible-xs" style="margin-top: 0px;">&nbsp;</div>
                        <div class="col-sm-2 hidden-xs" class="text-center"><b style="font-size: 20px; padding-top: 120px"><center> - </center></b></div>
                        <div class="col-sm-5 col-xs-12">
                            <div class="input-group input-append date datepickers" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                <input type="text" class="form-control endAct" name="end" value="<?php echo date('d-m-Y') ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-white add-on" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-8 text-right">
                    <div class="mg-t-md"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-md btn-primary" title="Search"><i class="fa fa-search"></i><span class="mg-l-sm hidden-xs"></span> Search</button>
                        </div>
                        <div class="col-md-6 hidden-xs">
                            <a onclick="onExport()" id="btnExport" class="btn btn-block btn-md btn-dark"><i class="fa fa-download"></i> <span class="mg-l-sm hidden-xs"></span> Excel</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
            <hr class="divider" style="padding: 0px; margin: 15px 0px 10px 0px"/>
        </div>
        <div class="col-xs-12 actData"></div>
    </div>
</div>
<script type="text/javascript">
    $(".datepicker").datepicker();
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i> Monitoring Equipment');
    $(".datepickers").datepicker();
    $("select.form-select2").select2();

    load();

    $("#formAct").submit(function () {
        load();
        return false;
    });
    function load() {
        var info_projects = $("select[name=projectAct] option:selected").val();
        var info_actors = $("select[name=actorAct] option:selected").val();
        var info_starts = $('.startAct').val();
        var info_ends = $('.endAct').val();
        $(".actData").load("<?php echo base_url() ?>warehouse/eq-monitoring/" + info_projects + '/' + info_starts + '/' + info_ends + '/' + info_actors);
    }
    function onExport() {
        var info_actors = $("select[name=actorAct] option:selected").val();
        if (info_actors !== '') {
            var info_projects = $("select[name=projectAct] option:selected").val();
            var info_actors = $("select[name=actorAct] option:selected").val();
            var info_starts = $('.startAct').val();
            var info_ends = $('.endAct').val();
            window.open("<?php echo base_url() ?>warehouse/export/monitoring_equipment/" + info_projects + '/' + info_actors);
        } else {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> Please select supplier/subkon to export data monitoring equipment");
        }
    }
</script>
