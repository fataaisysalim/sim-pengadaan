<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="panel-body">
    <div class="row">
        <div class="col-xs-12">
            <?php echo form_open("", array('id' => "formAct")); ?>
            <div class="row">
                <div class="col-sm-6">
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

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Foreman</label>
                        <select id="actor" name="actorAct" class="form-control form-select2 actoras" data-style="btn-white" data-placeholder="Choose Foreman">
                            <option value="">All</option>
                            <?php foreach ($mandor['ct'] as $nom => $ct) : ?>
                                <optgroup label="<?php echo $ct->actor_category_name; ?>">
                                    <?php foreach ($mandor['act'][$nom] as $num => $man) : ?>
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
                        <div class="clearfix visible-xs" style="margin-top: 20px;">&nbsp;</div>
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
                <div class="col-sm-4 col-xs-12">
                    <div class="mg-t-lg"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-md btn-block btn-primary" title="Search"><i class="fa fa-search"></i><span class="mg-l-sm hidden-xs"></span> Search</button>
                        </div>
                        <div class="col-md-6 hidden-xs">
                            <a onclick="ExportFee()" class="btn btn-md btn-block btn-dark"><i class="fa fa-download"></i> <span class="mg-l-sm hidden-xs"></span> Excel</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
            <hr class="divider" style="padding: 0px; margin: 15px 0px 10px 0px"/>
        </div>
        <div class="col-xs-12 actData"></div>
        <div class="col-md-12">
            <b>Note :</b>
            <div class="row mg-t-md mg-b-sm">
                <div class="col-sm-3 col-xs-6">
                    <i class="fa fa-search mg-r-md btn btn-sm btn-primary mg-b-sm" disabled></i> Detail
                </div>
                <div class="col-sm-3 col-xs-6">
                    <i class="fa fa-print mg-r-md btn btn-sm btn-dark mg-b-sm" disabled></i> Print Bukti Tagihan
                </div>
                <?php if ($permit->access_update == 1) { ?>
                    <div class="col-sm-3 col-xs-6">
                        <i class="fa fa-pencil mg-r-md btn btn-sm btn-warning mg-b-sm" disabled></i> Edit
                    </div>
                <?php } ?>
                <?php if ($permit->access_delete == 1) { ?>
                    <div class="col-sm-3 col-xs-6">
                        <i class="fa fa-trash mg-r-md btn btn-sm btn-danger mg-b-sm" disabled></i> Delete
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i>Information Foreman Fee');
    $(document).ready(function () {
        $(".datepickers").datepicker();
        $("select.form-select2").select2();
        load();
    });
    function load() {
        var info_projects = $("select[name=projectAct] option:selected").val();
        var info_actors = $("select[name=actorAct] option:selected").val();
        var info_starts = $('.startAct').val();
        var info_ends = $('.endAct').val();
        $(".actData").load("<?php echo base_url() ?>finance/foreman-fee/" + info_projects + '/' + info_starts + '/' + info_ends + '/' + 'monitoring' + '/' + info_actors);

    }
    $("#formAct").submit(function () {
        load();
        return false;
    });
    function detail(id) {
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url('finance/foreman-fee/detail'); ?>" + '/' + id);
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
    }
    function ExportFee() {
        var info_projects = $("select[name=projectAct] option:selected").val();
        var info_actors = $("select[name=actorAct] option:selected").val();
        var info_starts = $('.startAct').val();
        var info_ends = $('.endAct').val();
        window.open("<?php echo base_url('finance/report/export/salary'); ?>" + '/' + info_projects + '/' + info_starts + '/' + info_ends + '/' + 'monitoring' + '/' + info_actors);
    }
</script>
