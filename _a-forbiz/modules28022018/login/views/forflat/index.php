<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title><?php echo ucwords(!empty($external['system']->apps_name) ? $external['system']->apps_name : "FORBIZ") ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <?php if (!empty($external['system']->apps_favicon)) { ?>
            <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/img/apps/<?php echo $external['system']->apps_favicon ?>" />
        <?php } ?>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta content="<?php echo!empty($external['system']->apps_meta_description) ? $external['system']->apps_meta_description : "FORBIZ Enterprise System" ?>" name="description" />
        <meta content="<?php echo!empty($external['system']->apps_meta_keyword) ? $external['system']->apps_meta_keyword : "folarium, forbiz, erp, business, software, manufacture" ?>" name="keyword" />
        <meta content="<?php echo $this->config->item("config_company"); ?>" name="author" />
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/logflat/css/style.css">
        <link href="<?php echo base_url(); ?>assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/pages-icons.css" rel="stylesheet" type="text/css">
        <link class="main-stylesheet" href="<?php echo base_url() ?>assets/plugins/pages.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="fixed-header">
        <div class="login-wrapper ">
            <div class="bg-pic hidden-xs">
                <div>
                    <div id="slides">
                        <ul class="slides-container hidden-xs">
                            <?php if (count($image) == 0) : ?>
                                <li><img class="slides-fullscreen-img hidden-xs" src="<?php echo base_url('assets/folarium/gallery/default.jpg'); ?>" alt=""></li>
                            <?php else: ?>
                                <?php foreach ($image as $index => $row) : ?>
                                    <li><img class="slides-fullscreen-img hidden-xs" src="<?php echo base_url($row->apps_gallery_files); ?>" alt=""></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="bg-caption pull-bottom lg-pull-bottom text-white p-l-50 m-b-30" style="z-index: 1000; margin-bottom: 100px; font-size: 100%">
                    <h2 class="semi-bold text-white"><?php echo ucwords(!empty($external['system']->apps_meta_description) ? $external['system']->apps_meta_description : "FORBIZ Enterprise System") ?></h2>
                    <!--<p class="small">FORBIZ <?php echo date("Y") ?> &COPY; <?php echo ucwords(!empty($external['system']->apps_client) ? $external['system']->apps_client : "Folarium Technomedia") ?>. All Right Reserved. <br/><?php echo ucwords(!empty($external['system']->apps_client) ? 'Supported by <i>Kuncoro Admodjo</i> | Powered by <a href="http://www.folarium.co.id" style="color: white">CV. Folarium Technomedia</a>' : null) ?></p>-->
                </div>
            </div>
            <div class="login-container bg-white" style="z-index: 1000; background: url('<?php echo base_url() ?>assets/folarium/bglogin.png') white">
                <div class=" m-t-30 hidden-xs"></div>
                <div class="p-l-50 p-r-50 p-t-50 sm-p-l-15 sm-p-r-15 sm-p-t-40">
                    <div class="row">
                        <a href="<?php echo base_url() ?>" class="col-xs-12 col-sm-10 col-md-12">
                            <img style="width: 250px; float: left;" src="<?php echo base_url() ?>assets/<?php echo!empty($external['system']->apps_logo) ? "img/apps/" . $external['system']->apps_logo : "folarium/logo.png" ?>" alt="logo" data-src="<?php echo base_url() ?>assets/<?php echo!empty($external['system']->apps_logo) ? "img/apps/" . $external['system']->apps_logo : "folarium/logo.png" ?>" data-src-retina="<?php echo base_url() ?>assets/folarium/logo.png">
                        </a>
                    </div>
                    <div class="clearfix"></div>
                    <hr class="divider"/>
                    <p>Sign into your <?php echo ucwords(!empty($external['system']->apps_name) ? $external['system']->apps_name : "FORBIZ") ?> account</p>
                    <form id="form-login" method="post" class="p-t-15" role="form" action="<?php echo base_url(); ?>login">
                        <?php echo $this->session->flashdata('message'); ?>
                        <div class="form-group form-group-default">
                            <label>Login</label>
                            <div class="controls">
                                <input type="text" name="user_username" placeholder="Username" class="form-control" required>
                            </div>
                            <p class="help-block"><?php echo form_error('user_username'); ?></p>
                        </div>
                        <div class="form-group form-group-default">
                            <label>Password</label>
                            <div class="controls">
                                <input type="password" class="form-control" name="user_password" placeholder="Credentials" required>
                            </div>
                            <p class="help-block"><?php echo form_error('user_password'); ?></p>
                        </div>
                        <button class="btn bnt-sm btn-md btn-info btn-cons m-t-10 col-xs-12 col-sm-12 col-md-5" type="submit"><i class="fa fa-sign-in m-r-10"></i>Sign in</button>
                    </form>
                    <div class="pull-bottom xs-pull-bottom hidden-xs clearfix m-b-30">
                        <div class="m-b-30 sm-m-t-20 sm-p-r-15 sm-p-b-20">
                            <div class="col-xs-2 col-sm-3 col-md-2 col-lg-3 no-padding">
                                <img alt="" class="m-t-5" data-src="<?php echo base_url() ?>assets/folarium/info.png" data-src-retina="<?php echo base_url() ?>assets/folarium/info.png" height="60" src="<?php echo base_url() ?>assets/folarium/info.png" width="60">
                            </div>
                            <div class="col-xs-10 col-sm-9 m-t-10">
                                <small>If there is difficulty access system, please contact Administrator</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/plugins/jquery-validation/js/jquery.validate.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/logflat/js/lib/jquery.fittext.js"></script>
        <script src="<?php echo base_url() ?>assets/logflat/js/lib/jquery.magnific-popup.min.js"></script>
        <script src="<?php echo base_url() ?>assets/logflat/js/lib/jquery.equal.js"></script>
        <script src="<?php echo base_url() ?>assets/logflat/js/lib/jquery.superslides.min.js"></script>
        <script src="<?php echo base_url() ?>assets/logflat/js/lib/jquery.baslider.js"></script>
        <script src="<?php echo base_url() ?>assets/logflat/js/main_1.js"></script>
        <script>
            $(function () {
                $('#form-login').validate()
            });
        </script>
    </body>
</html>