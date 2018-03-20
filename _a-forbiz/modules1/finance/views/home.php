<link rel="stylesheet" href="<?php echo base_url() ?>/assets/vendor/toastr/toastr.css">
<script src="<?php echo base_url() ?>/assets/vendor/toastr/toastr.min.js"></script>
<div class="row">
    <div class="col-xs-12 visible-xs visible-sm">
        <div class="row mg-b-sm">
            <div class="col-xs-5">
                <select class="form-control" name="projectload" <?php echo count($project) < 2 ? "disabled" : null ?>>
                    <?php foreach ($project as $x => $rx) { ?>
                        <option value="<?php echo $rx->project_id ?>"><?php echo ucwords($rx->project_name) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-4">
                <select class="form-control" name="yearload">
                    <option value="<?php echo $now ?>"> <?php echo $now ?></option>
                    <?php for ($i = 1; $i < 5; $i++) { ?>
                        <option style="color: black" value="<?php echo $now - $i ?>"><?php echo $now - $i ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-3">
                <button type="button" onclick="loadgraph()" class="btn btn-warning col-xs-12" title="Search"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
    <div class="col-xs-12">

        <div class="col-sm-12 col-md-7">
            <section class="panel panel-info row">
                <div class="panel-heading">
                    <i class="fa fa-signal mg-r-sm"></i>Average Transaction Finance
                    <input type="hidden" name="cond" value="1"/>
                    <div class="btn-group pull-right" style="margin-top: 4px">
                        <button class="btn btn-sm btn-white" id="inv" type="button" disabled>Invoice</button>
                        <button class="btn btn-sm btn-white" id="fee" type="button">Sallary</button>
                    </div>
                </div>
                <div class="panel-body row" id="graphaverage"></div>
            </section>
        </div>
        <div class="col-md-5">
            <div class="row">
                <div>
                    <div class="col-xs-12 hidden-xs hidden-sm">
                        <div class="row">
                            <div class="col-xs-5">
                                <select class="form-control" name="projectload" <?php echo count($project) < 2 ? "disabled" : null ?>>
                                    <?php foreach ($project as $x => $rx) { ?>
                                        <option value="<?php echo $rx->project_id ?>"><?php echo ucwords($rx->project_name) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <select class="form-control" name="yearload">
                                    <option value="<?php echo $now ?>" selected> <?php echo $now ?></option>
                                    <?php for ($i = 1; $i < 5; $i++) { ?>
                                        <option style="color: black" value="<?php echo $now - $i ?>"><?php echo $now - $i ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <button type="button" onclick="loadgraph()" class="btn btn-warning col-xs-12" title="Search"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <hr class="divider"/>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel bg-danger light of-h mb10">
                            <div class="pn pl20 p5">
                                <div class="icon-bg"> <i class="fa fa-inbox"></i> </div>
                                <h2 class="mt15 lh15"> <b><?php echo $outstanding ?></b> </h2>
                                <h5 class="text-muted">Outstanding</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel bg-info light of-h mb10">
                            <div class="pn pl20 p5">
                                <div class="icon-bg"> <i class="fa fa-dollar"></i> </div>
                                <h2 class="mt15 lh15"> <b><?php echo $paid ?></b> </h2>
                                <h5 class="text-muted">Paid</h5>
                            </div>
                        </div>
                    </div>
                    <section class="col-xs-12">
                        <h5><b><i class="fa fa-clock-o mg-r-sm"></i>Finance Activity</b></h5>
                        <hr class="divider" style="margin: 0px 0px 20px 0px"/>
                        <div class="row">
                            <div>
                                <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                                    <div class="carousel-inner">
                                        <?php foreach ($last_activity as $l => $roc) { ?>
                                            <div class="item <?php echo $l == 0 ? "active" : null ?>">
                                                <div class="row">
                                                    <div class="col-xs-12 text-center visible-xs">
                                                        <div style="overflow:hidden; width: 70px; height: 70px; background: red;" class="avatar bordered-avatar img-circle">
                                                            <img style="min-width: 100%; height: 100%" src="<?php echo base_url() ?>assets/<?php echo!empty($roc->employee_photo) ? "image/$roc->employee_photo" : "folarium/nonuser.png" ?>"  alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-2 text-right hidden-xs">
                                                        <div style="overflow:hidden; width: 70px; height: 70px; background: red;" class="avatar bordered-avatar img-circle">
                                                            <img style="min-width: 100%; height: 100%" src="<?php echo base_url() ?>assets/<?php echo!empty($roc->employee_photo) ? "image/$roc->employee_photo" : "folarium/nonuser.png" ?>"  alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9 col-sm-10">
                                                        <p><i class="fa fa-comments mg-r-sm"></i><?php echo $roc->activity_action ?></p>
                                                        <small>
                                                            <i><?php echo indo_date($roc->activity_date, 1, 1) ?> | ip : <?php echo explode(";", $roc->activity_agent)[0] ?> | Browser : <?php echo explode(";", $roc->activity_agent)[1] ?> | Platform : <?php echo explode(";", $roc->activity_agent)[2] ?><hr class="divider" style="margin: 0px 30px 0px 0px"/>Accessed by <b><?php echo ucwords($roc->employee_name) ?></b> - <b><?php echo ucwords($roc->users_position_name) ?></b></i>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <a data-slide="prev" href="#quote-carousel" class="left carousel-control">
                                        <i class="fa fa-chevron-left"></i>
                                    </a>
                                    <a data-slide="next" href="#quote-carousel" class="right carousel-control">
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    setTimeout(function () {
        toastr.options.closeButton = true;
        toastr.info('You are currently access Finance Modul', 'Welcome to WG System');
    }, 500);
    loadgraph();
    $("button#inv").on("click",function(){
        $(this).attr("disabled","disabled");
        $("#fee").removeAttr("disabled","disabled");
        $("input[name=cond]").val(1);
        $("#graphaverage").load('<?php echo base_url() ?>finance/index/transaverage/'+$('select[name=yearload] option:selected').val()+"/"+$('select[name=projectload] option:selected').val());
    });
    $("button#fee").on("click",function(){
        $(this).attr("disabled","disabled");
        $("#inv").removeAttr("disabled","disabled");
        $("input[name=cond]").val(2);
        $("#graphaverage").load('<?php echo base_url() ?>finance/index/transaveragefee/'+$('select[name=yearload] option:selected').val()+"/"+$('select[name=projectload] option:selected').val());
    });
    function loadgraph(){
        if($("input[name=cond]").val() == 1){
            $("#graphaverage").load('<?php echo base_url() ?>finance/index/transaverage/'+$('select[name=yearload] option:selected').val()+"/"+$('select[name=projectload] option:selected').val());
        }else{
            $("#graphaverage").load('<?php echo base_url() ?>finance/index/transaveragefee/'+$('select[name=yearload] option:selected').val()+"/"+$('select[name=projectload] option:selected').val());    
        }
    };
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
<script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url() ?>assets/js/modules/exporting.js"></script>