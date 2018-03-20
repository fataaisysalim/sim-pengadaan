<!doctype html>
<!--
COPYRIGHT by HighHay/Mivfx
Before using this theme, you should accept themeforest licenses terms.
http://themeforest.net/licenses
-->

<html class="no-js" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title><?php echo ucwords(!empty($external['system']->apps_name) ? $external['system']->apps_name : "FORBIZ") ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <?php if (!empty($external['system']->apps_favicon)) { ?>
            <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/img/apps/<?php echo $external['system']->apps_favicon ?>" />
        <?php } ?>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, user-scalable=0">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/logtimexsoon/fonts/opensans/stylesheet.css">
        <!-- Vendor CSS style -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/logtimexsoon/css/foundation.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/logtimexsoon/js/vendor/jquery.fullPage.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/logtimexsoon/js/vegas/vegas.min.css">
        <!-- Main CSS files -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/logtimexsoon/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/logtimexsoon/css/main_responsive.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/logtimexsoon/css/style-color1.css">
        <link href="<?php echo base_url(); ?>assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    </head>
    <body id="menu" class="alt-bg">
        <!--[if lt IE 8]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="page-cover">
            <div class="cover-bg pos-abs full-size slide-show">
                <?php if (count($image) == 0) : ?>
                    <li class='img' data-src='<?php echo base_url('assets/folarium/gallery/default.jpg'); ?>'></li>
                <?php else: ?>
                    <?php foreach ($image as $index => $row) : ?>
                        <li class='img' data-src='<?php echo base_url($row->apps_gallery_files); ?>'></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="cover-bg-mask pos-abs full-size bg-color" data-bgcolor="rgba(0, 0, 0, 0.61)"></div>
        </div>
        <div class="pane-when " id="s-when">
            <div class="content">
                <div class="clock clock-countdown">
                    <div class="site-config" data-date="10/30/2016 00:00:00" data-date-timezone="+0" ></div>
                    <div class="logo">
                        <a href="<?php echo base_url() ?>">
                            <img src="<?php echo base_url() ?>assets/<?php echo!empty($external['system']->apps_logo) ? "img/apps/" . $external['system']->apps_logo : "folarium/logo.png" ?>">
                        </a>
                    </div>
                    <div class="elem-bottom">
                        <div class="deco"></div>
                        <span><i>Enterprise System</i></span>
                    </div>
                </div> 
                <footer style="color: white; text-align: right">
                    <small><?php echo date("Y") ?> &COPY; <?php echo ucwords(!empty($external['system']->apps_client) ? $external['system']->apps_client : "Folarium Technomedia") ?>. All Right Reserved. <br/><?php echo ucwords(!empty($external['system']->apps_client) ? 'Supported by <i>Kuncoro Admodjo</i> | Powered by <a href="http://www.folarium.org" style="color: white">Folarium Technomedia</a>' : null) ?></small>
                </footer>                
            </div> 
        </div>
    <main class="page-main" id="mainpage">             
        <div class="section page-home page page-cent" id="s-home">
            <section class="content">
                <header class="header">
                    <div class="wrapper">
                        <div>
                            <?php if ($this->session->flashdata('message')) { ?>
                                <small><i class="fa fa-warning m-r-10" style="color: red"></i><i><b style="color: red">Sorry !</b> Your account not valid. Please try again...</i></small>
                            <?php } ?>
                            <form class="message form" method="post" action="<?php echo base_url(); ?>login">
                                <div class="fields clearfix">
                                    <div class="input">
                                        <label for="mes-name">Login</label>
                                        <input id="mes-name" name="user_username" type="text" placeholder="Username">
                                    </div>
                                </div>
                                <?php if (form_error('user_username')) { ?>
                                    <div class="clearfix text-right" style="color: red;"><i><small><b>Username</b> can not empty</small></i></div>
                                <?php } ?>
                                <div class="fields clearfix">
                                    <div class="input">
                                        <label for="mes-email">Password</label>
                                        <input id="mes-email" type="password" placeholder="Credentials" name="user_password">
                                    </div>
                                </div>
                                <?php if (form_error('user_password')) { ?>
                                    <div class="clearfix text-right" style="color: red;"><i><small><b>Password</b> can not empty</small></i></div>
                                <?php } ?>
                                <button class="btn bnt-sm btn-md btn-primary btn-cons m-t-10 col-xs-12 col-sm-12 col-md-5" type="submit"><i class="fa fa-sign-in m-r-10"></i>Sign in</button>
                            </form>
                        </div>
                    </div>
                </header>
            </section>
        </div>
    </main>
    <script src="<?php echo base_url() ?>assets/logtimexsoon/js/vendor/jquery-1.11.2.min.js"></script>
    <script src="<?php echo base_url() ?>assets/logtimexsoon/js/vendor/all.js"></script>
    <script src="<?php echo base_url() ?>assets/logtimexsoon/js/jquery.downCount.js"></script>
    <script src="<?php echo base_url() ?>assets/logtimexsoon/js/main.js"></script>
</body>
</html>
