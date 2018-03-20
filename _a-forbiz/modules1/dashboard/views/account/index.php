<section id="content" class="pn animated fadeIn row" style="margin-top: -23px">
    <div class="pv30 ph40 bg-white dark br-b br-grey posr row" style="color: white; background:url('<?php echo base_url() ?>assets/img/background.jpg') center center no-repeat; padding: 30px">
        <div class="table-layout">
            <div class="w200 text-center pr30 hidden-xs">
                <div style="overflow: hidden; height: 170px; width: 170px" class="img-circle bordered-avatar">
                    <img style="min-width: 100%; min-height: 100%" src="<?php echo base_url() ?>assets/<?php echo!empty($sess['employee']->employee_photo) ? "image/" . $sess['employee']->employee_photo : "folarium/nonuser.png" ?>" class="responsive">
                </div>
            </div>
            <div class="va-t m30">
                <h2 class=""> <?php echo $sess['employee']->employee_name ?> <small> <i>Profile</i> </small></h2>
                <p class="fs15 mb20">Welcome to <b><?php echo $sess['system']->apps_name ?></b>. You can manage your account at here.</p>
                <div>
                    <a role="button" class="password_us btn btn-danger" style="cursor: pointer"><i class="fa fa-key mg-r-sm"></i>Password</a>
                    <a role="button" class="profile_us btn btn-success" style="cursor: pointer"><i class="fa fa-clipboard mg-r-sm"></i>Profile</a>
                    <a role="button" class="photo_us btn btn-warning" style="cursor: pointer"><i class="fa fa-camera mg-r-sm"></i>Photo</a>
                </div>
            </div>
        </div>
    </div>
    <div class="p25 pt35 row" style="background:url('<?php echo base_url() ?>assets/folarium/bglogin.png') repeat-y right">
        <div class="row">
            <div class="col-md-4">
                <div class="proform row"></div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <span class="panel-icon"><i class="fa fa-user"></i>
                        </span>
                        <span class="panel-title"> About Me</span>
                    </div>
                    <div class="panel-body pn">
                        <table class="table mbn tc-icon-1 tc-med-2 tc-bold-last">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="fa fa-barcode text-warning"></span>
                                    </td>
                                    <td>NIK</td>
                                    <td><?php echo $sess['employee']->employee_nik ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fa fa-users text-warning"></span>
                                    </td>
                                    <td>Username</td>
                                    <td><?php echo $sess['users']->users_username ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fa fa-envelope text-warning"></span>
                                    </td>
                                    <td>Email</td>
                                    <td><?php echo!empty($sess['employee']->employee_email) ? $sess['employee']->employee_email : "-" ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fa fa-phone text-warning"></span>
                                    </td>
                                    <td>Phone</td>
                                    <td><?php echo!empty($sess['employee']->employee_phone) ? $sess['employee']->employee_phone : "-" ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fa fa-home text-warning"></span>
                                    </td>
                                    <td>Address</td>
                                    <td><?php echo!empty($sess['employee']->employee_address) ? $sess['employee']->employee_address : "-" ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fa fa-calendar text-warning"></span>
                                    </td>
                                    <td>Registered</td>
                                    <td><?php echo indo_date($sess['users']->users_registered, 1, 1) ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fa fa-check text-warning"></span>
                                    </td>
                                    <td>Status</td>
                                    <td><?php echo $sess['users']->users_status == 1 ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>' ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="timeline">
                    <div class="timeline-heading">
                        My Last Activity
                    </div>
                    <?php foreach ($my_activity as $i => $rox) { ?>
                        <div class="timeline-panel">
                            <div class="timeline-content">
                                <div class="timeline-date"><?php echo timeToReal($rox->activity_date) ?></div>
                                <section class="panel">
                                    <div class="panel-body">
                                        <?php echo $rox->activity_action ?>
                                        <hr style="margin: 7px 0px 0px 0px"/>
                                        <i><small>Access on <b><?php echo indo_date($rox->activity_date, 1) ?></b> | ip : <b><?php echo explode(";", $rox->activity_agent)[0] ?></b> | Browser : <?php echo explode(";", $rox->activity_agent)[1] ?></small></i>
                                    </div>
                                </section>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $(".password_us").click(function() {
            $('.proform').load("<?php echo base_url() ?>dashboard/account/password");
        });
        $(".profile_us").click(function() {
            $('.proform').load("<?php echo base_url() ?>dashboard/account/profile");
        });
        $(".photo_us").click(function() {
            $('.proform').load("<?php echo base_url() ?>dashboard/account/photo");
        });
    });
</script>