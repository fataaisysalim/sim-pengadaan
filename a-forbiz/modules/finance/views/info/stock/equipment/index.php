<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="panel-body">
    <div class="row">
        <div class="col-xs-12">
            <?php echo form_open("", array('id' => "formAct")); ?>
            <div class="row">
                <div class="col-sm-4">
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
                            <option value="all">All</option>
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
                <div class="col-sm-5">
                    <div class="hidden-xs" style="margin-top: 23px"></div>
                    <div class="visible-xs" style="margin-top: 15px"></div>
                    <div class="row">
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-block btn-md btn-primary col-xs-12" title="Search"><i class="fa fa-search"></i><span class="mg-l-sm hidden-xs"></span> Search</button>
                        </div>
                        <div class="col-xs-6">
                            <a onclick="onExport()" id="btnExport" class="btn btn-block btn-md btn-dark col-xs-12"><i class="fa fa-download"></i> <span class="mg-l-sm hidden-xs"></span> Excel</a>
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
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i>Monitoring Equipment');
    $(".datepickers").datepicker();
    $("select.form-select2").select2();
    load();
    $("#formAct").submit(function() {
        load();
        return false;
    });
    function load() {
        var info_projects = $("select[name=projectAct] option:selected").val();
        var info_actors = $("select[name=actorAct] option:selected").val();
        $(".actData").load("<?php echo base_url() ?>finance/eq-monitoring/" + info_projects + '/' + info_actors);
    }
    function onExport() {
        var info_actors = $("select[name=actorAct] option:selected").val();
        if (info_actors !== '') {
            if (info_actors !== 'all') {
                var info_projects = $("select[name=projectAct] option:selected").val();
                var info_actors = $("select[name=actorAct] option:selected").val();
                var info_starts = $('.startAct').val();
                var info_ends = $('.endAct').val();
                window.open("<?php echo base_url() ?>finance/monitoring/export/monitoring_equipment/" + info_projects + '/' + info_actors);
            } else {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> Please select supplier/subkon to export data monitoring equipment");
            }
        } else {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> Please select supplier/subkon to export data monitoring equipment");
        }
    }
</script>
