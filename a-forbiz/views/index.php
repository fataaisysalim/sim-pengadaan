<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo ucwords($this->config->item("config_client")); ?> <?php echo!empty($title) ? "| $title" : null ?></title>
        <meta name="description" content="Management Information System of WIKA">
        <meta name="author" content="<?php echo ucwords($this->config->item("config_company")); ?>">
        <meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1, maximum-scale=1">
        <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/apps/<?php echo $sess['external']->apps_favicon ?>">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/skin/default_skin/css/theme.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/min/main.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap-select/bootstrap-select.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap-datepicker/datepicker.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/js/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/folarium/formine.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin-tools/admin-forms/css/admin-forms.css">
        <script src="<?php echo base_url() ?>assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url() ?>vendor/jquery/jquery_ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url() ?>assets/vendor/modernizr.js"></script>
    </head>
    <body class="sb-top sb-top-sm">
        <div id="main">
            <?php $this->load->view("extend/header") ?>
            <?php echo $this->load->view("extend/menu") ?>
            <section id="content_wrapper">
                <div id="topbar-dropmenu">
                    <div class="topbar-menu row">
                        <?php foreach ($sess['modulsys'] as $x => $row) { ?>
                            <div class="col-xs-6 col-sm-2">
                                <a href="<?php echo base_url($row->modul_url) ?>" class="metro-tile">
                                    <span class="metro-icon <?php echo $row->modul_icon ?>"></span>
                                    <p class="text-center"><?php echo ucwords($row->modul_name) ?></p>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <section id="content" class="animated fadeIn">
                    <div>
                        <?php $this->load->view($content) ?>
                    </div>
                </section>
            </section>
        </div>
        <div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title text-center" id="myModalLabel">Loading please wait...</h5>
                    </div>
                    <div id="modal-content"></div>
                </div>
            </div>
        </div>
        <div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                        <h5 class="modal-title text-center" id="myModalLabel">Loading please wait...</h5>
                    </div>
                    <div id="modal-contents"></div>
                </div>
            </div>
        </div>
        <?php !empty($js_load) ? $this->load->view($js_load) : null ?>
        <script type="text/javascript">
            var now = "<?php echo date("d-m-Y"); ?>";
            var baseUrl = "<?php echo base_url(); ?>";
        </script>
        <script src="<?php echo base_url() ?>assets/folarium/for.menu.min.js"></script>
        <script src="<?php echo base_url() ?>assets/folarium/for.library.min.js"></script>
        <script src="<?php echo base_url() ?>assets/vendor/bootbox/bootbox.min.js"></script>
        <script src="<?php echo base_url() ?>assets/plugins/jquery-validation/js/jquery.validate.js"></script>
        <script src="<?php echo base_url() ?>assets/vendor/datatables/jquery.dataTables.js"></script>
        <script src="<?php echo base_url() ?>assets/vendor/bootstrap-select/bootstrap-select.js"></script>
        <script src="<?php echo base_url() ?>assets/vendor/slider/bootstrap-slider.js"></script>
        <script src="<?php echo base_url() ?>assets/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url() ?>assets/js/utility/utility.js"></script>
        <script src="<?php echo base_url() ?>assets/folarium/jquery.formatCurrency-1.4.0.js"></script>
        <script src="<?php echo base_url() ?>assets/js/main.js"></script>
        <script type="text/javascript">
            Core.init();
        </script>
        <script type="text/javascript">
        $(document).ready(function(){
          
        })
    </script>
    </body>
</html>
