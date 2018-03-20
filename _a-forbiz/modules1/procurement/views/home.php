<div class="row">
    <div class="col-md-12 mg-b-md">
        <section class="panel no-border  position-relative ">
            <div class="panel-body" style="color: white; background:url('<?php echo base_url() ?>assets/img/<?php echo!empty($sess['system']->apps_image) ? "apps/" . $sess['system']->apps_image : "background.jpg" ?>') center center no-repeat; padding: 30px; min-height: 300px">
                <div class="col-lg-12 row">
                    <div class="row">
                        <div class="col-lg-10 col-md-9">
                            <br class="mg-t hidden-lg hidden-md">
                            <span style="font-size: 20px; font-weight: bold" class="homepage"><span class="pull-left">Welcome to </span> <span class="visible-xs pull-left mg-l-xs">Procurement System</span><span class="hidden-xs mg-l-xs"> <?php echo $sess['system']->apps_name ?> ( <i>Procurement System</i> )</span> </span><br/>
                            <div class="clearfix"></div>
                            <i>All control procurement can be done in this system. Happy working !</i>
                        </div>
                        <div class="loadorer_info col-md-12 mg-t mg-b "></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <br class="mg-b-sm">
                        <small style="font-size: 85%;">FORBIZ <?php echo date('Y') ?> &COPY; <?php echo $sess['system']->apps_client ?>. All Rights Reserved<br/>Supported by <i>Kuncoro Admodjo</i> | Powered by <?php echo anchor('http://www.folarium.org', 'Folarium Technomedia', 'target="_blank" style="color: white; font-style: italic;"') ?>.</small>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--    <div class="">
            <div class="col-sm-6">
                <div class="panel bg-danger light of-h mb10">
                    <div class="pn pl20 p5">
                        <div class="icon-bg"> <i class="fa fa-inbox"></i> </div>
                        <h2 class="mt15 lh15"> <b><?php echo $inCots ?></b> </h2>
                        <h5 class="text-muted">Document In</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel bg-info light of-h mb10">
                    <div class="pn pl20 p5">
                        <div class="icon-bg"> <i class="fa fa-envelope"></i> </div>
                        <h2 class="mt15 lh15"> <b><?php echo $outCots ?></b> </h2>
                        <h5 class="text-muted">Document Out</h5>
                    </div>
                </div>
            </div>
        </div>-->
</div>