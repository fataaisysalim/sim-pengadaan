<link rel="stylesheet" href="<?php echo base_url() ?>/assets/vendor/toastr/toastr.css">
<script src="<?php echo base_url() ?>/assets/vendor/toastr/toastr.min.js"></script>
<div class="row">
    <div class="col-sm-8 col-md-8 col-lg-9">
        <div class="row">
<!--            <section class="row mg-b-sm visible-xs">
                <div class="col-xs-12">
                    <div class="col-xs-9">
                        <select class="form-control" name="yearload_mobile">
                            <option value="<?php echo $now ?>" selected>Sort by : <?php echo $now ?></option>
                            <?php for ($i = 1; $i < 5; $i++) { ?>
                                <option value="<?php echo $now - $i ?>">Sort by : <?php echo $now - $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <button type="button" onclick="loadgraph('mobile')" class="btn btn-primary col-xs-12" title="Search"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </section>
            <div class="col-md-12">
                <section class="panel panel-info" id="graphusage"></section>
            </div>-->
            <div class="">
                <div class="col-md-4 col-sm-4">
                    <div class="panel bg-alert light of-h mb10">
                        <div class="pn pl20 p5">
                            <div class="icon-bg"> <i class="fa fa-users"></i> </div>
                            <h2 class="mt15 lh15"> <b><?php echo $employeeCots ?></b> </h2>
                            <h5 class="text-muted">Pegawai</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="panel bg-info light of-h mb10">
                        <div class="pn pl20 p5">
                            <div class="icon-bg"> <i class="fa fa-gavel"></i> </div>
                            <h2 class="mt15 lh15"> <b><?php echo $projectCots ?></b> </h2>
                            <h5 class="text-muted">Proyek</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="panel bg-warning light of-h mb10">
                        <div class="pn pl20 p5">
                            <div class="icon-bg"> <i class="fa fa-user"></i></div>
                            <h2 class="mt15 lh15"> <b><?php echo $usersCots ?></b> </h2>
                            <h5 class="text-muted">Pengguna</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section>
            <h5><b><i class="fa fa-clock-o mg-r-sm"></i>Latest Activities</b></h5>
            <hr class="divider" style="margin: 0px 0px 20px 0px"/>
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                        <div class="carousel-inner">
                            <?php foreach ($last_activity as $l => $roc) { ?>
                                <div class="item <?php echo $l == 0 ? "active" : null ?>">
                                    <div class="row">
                                        <div class="col-xs-12 text-center visible-xs visible-sm">
                                            <div style="overflow:hidden; width: 70px; height: 70px; background: red;" class="avatar bordered-avatar img-circle">
                                                <img style="min-width: 100%; height: 100%" src="<?php echo base_url() ?>assets/<?php echo!empty($roc->employee_photo) ? "image/$roc->employee_photo" : "folarium/nonuser.png" ?>"  alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-right visible-lg visible-md">
                                            <div style="overflow:hidden; width: 70px; height: 70px; background: red;" class="avatar bordered-avatar img-circle">
                                                <img style="min-width: 100%; height: 100%" src="<?php echo base_url() ?>assets/<?php echo!empty($roc->employee_photo) ? "image/$roc->employee_photo" : "folarium/nonuser.png" ?>"  alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
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
        <hr class="divider visible-xs"/>
    </div>
    <div class="col-sm-4 col-md-4 col-lg-3">
<!--        <section class="row mg-b-sm hidden-xs">
            <div>
                <div class="col-xs-9">
                    <select class="form-control" name="yearload_desktop">
                        <option value="<?php echo $now ?>" selected>Sort by : <?php echo $now ?></option>
                        <?php for ($i = 1; $i < 5; $i++) { ?>
                            <option value="<?php echo $now - $i ?>">Sort by : <?php echo $now - $i ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-xs-3">
                    <button type="button" onclick="loadgraph('desktop')" class="btn btn-primary col-xs-12" title="Search"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </section>-->

<!--        <section class="panel panel-warning hidden-xs">
            <div class="panel-heading">
                <i class="fa fa-sign-in mg-r-sm"></i>Log Access
            </div>
            <ul class="list-group">
                <?php foreach ($log_access as $x => $row) { ?>
                    <li class="list-group-item">
                        <span class="pull-left mg-t-xs mg-r-md">
                            <div style="overflow:hidden; width: 40px; height: 40px" class="avatar avatar-lg bordered-avatar img-circle">
                                <img style="min-width: 100%; height: 100%" src="<?php echo base_url() ?>assets/<?php echo!empty($row->employee_photo) ? "image/$row->employee_photo" : "folarium/nonuser.png" ?>"  alt="">
                            </div>
                        </span>
                        <div class="show no-margin pd-t-xs text-capitalize">
                            <b><?php echo ucwords(shortvar($row->employee_name, 15)) ?></b>
                            <small class="pull-right" style="text-transform: capitalize"><?php echo ucwords($row->users_position_name) ?></small>
                        </div>
                        <small class="text-muted"><?php echo indo_date($row->activity_date, 1, 1); ?> | <?php echo explode(";", $row->activity_agent)[0] ?> | <?php echo $row->activity_action ?></small>
                    </li>
                <?php } ?>
            </ul>
        </section>-->
    </div>
</div>
<script>
    $(document).ready(function () {
        loadgraph('desktop');
        setTimeout(function () {
            toastr.options.closeButton = true;
            toastr.info('You are currently using Enterprise System', 'Welcome to WG System');
        }, 500);
    });
    function loadgraph(param) {
        var param = $('select[name=yearload_' + param + '] option:selected').val();
        $("#graphusage").load('<?php echo base_url() ?>dashboard/dashboard/effectivusage/' + param);
    }
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
<script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url() ?>assets/js/modules/exporting.js"></script>
