<?php if ($this->session->flashdata('message')) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i> <?php echo $this->session->flashdata('message'); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-8">
        <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>dashboard/system">
            <section class="panel panel-warning">
                <header class="panel-heading lead">
                    <i class="fa fa-desktop mg-r-sm"></i> Profile System
                </header>
                <div class="panel-body" style="padding-top: 0;">
                    <div class="row">
                        <div class="col-sm-5">
                            <input type="hidden" name="seo" value="system"/>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if ($sistem->apps_logo) { ?>
                                        <img src="<?php echo base_url() ?>assets/img/apps/<?php echo $sistem->apps_logo; ?>" class="mg-b-md"/>
                                    <?php } ?>
                                    <label>Upload Logo</label>
                                    <input type="file" style="padding-bottom: 40px" name="foto" class="form-control">
                                    <p class="help-block"><?php echo form_error('sistem_logo'); ?></p>
                                </div>
                                <div class="col-md-12">
                                    <label>Application Name</label>
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon"><i class="fa fa-laptop"></i></span>
                                        <input type="text" name="sistem_name" value="<?php echo ($sistem->apps_name == null) ? set_value("sistem_name") : $sistem->apps_name; ?>" class="form-control" placeholder="Company Name">

                                    </div>
                                    <p class="help-block"><?php echo form_error('sistem_name'); ?></p>
                                </div>
                                <div class="col-md-12">
                                    <label>Company Sites</label>
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                        <input type="text" name="sistem_site" value="<?php echo ($sistem->apps_site == null) ? set_value("sistem_site") : $sistem->apps_site; ?>" class="form-control" placeholder="Company Site">
                                    </div>
                                    <p class="help-block"><?php echo form_error('sistem_site'); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if ($sistem->apps_image) { ?>
                                        <img src="<?php echo base_url() ?>assets/img/apps/<?php echo $sistem->apps_image; ?>" class="mg-b-md"/>
                                    <?php } ?>
                                    <label>Upload Background</label>
                                    <input type="file" style="padding-bottom: 40px" name="sistem_ground" class="form-control">
                                    <p class="help-block"><?php echo form_error('sistem_ground'); ?></p>
                                </div>
                                <div class="col-lg-12 col-md-7">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text" name="sistem_klien" value="<?php echo ($sistem->apps_client == null) ? set_value("sistem_klien") : $sistem->apps_client; ?>" class="form-control" placeholder="Company Name">
                                        <p class="help-block"><?php echo form_error('sistem_klien'); ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Company Phone</label>
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                    <input type="text" name="sistem_phone" value="<?php echo ($sistem->apps_phone == null) ? set_value("sistem_phone") : $sistem->apps_phone; ?>" class="form-control" placeholder="Company Phone">
                                                </div>
                                                <p class="help-block"><?php echo form_error('sistem_phone'); ?></p>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Company Mail</label>
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                <input type="text" name="sistem_mail" value="<?php echo ($sistem->apps_mail == null) ? set_value("sistem_mail") : $sistem->apps_mail; ?>" class="form-control" placeholder="Company Email">
                                            </div>
                                            <p class="help-block"><?php echo form_error('sistem_mail'); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>Company Address</label>
                                        <textarea name="sistem_address" rows="5" placeholder="Company Address" class="form-control"><?php echo ($sistem->apps_address == null) ? set_value("sistem_address") : $sistem->apps_address; ?></textarea>
                                        <p class="help-block"><?php echo form_error('sistem_address'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="subt btn btn-primary col-sm-3 col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
    <div class="col-md-4 col-sm-6">
        <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>dashboard/system">
            <section class="panel panel-dark">
                <header class="panel-heading lead">
                    <i class="fa fa-globe mg-r-sm"></i> SEO Config
                </header>
                <div class="panel-body" style="padding-top: 0;">
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="hidden" name="seo" value="seo"/>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if (!empty($sistem->apps_favicon)) { ?>
                                        <img src="<?php echo base_url() ?>assets/img/apps/<?php echo $sistem->apps_favicon; ?>" class="mg-b-md col-sm-4"/>
                                    <?php } ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Upload favicon</label>
                                            <input type="file" style="padding-bottom: 40px" name="favicon" class="form-control">
                                            <p class="help-block"><?php echo form_error('sistem_favicon'); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Meta Description</label>
                                    <textarea class="form-control" name="sistem_meta_des" placeholder="Meta Description"><?php echo ($sistem->apps_meta_description == null) ? set_value("sistem_meta_des") : $sistem->apps_meta_description; ?></textarea>
                                    <p class="help-block"><?php echo form_error('sistem_meta_des'); ?></p>
                                </div>
                                <div class="col-md-12">
                                    <label>Meta Keyword</label>
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                        <input type="text" name="sistem_meta_key" value="<?php echo ($sistem->apps_meta_keyword == null) ? set_value("sistem_meta_key") : $sistem->apps_meta_keyword; ?>" class="form-control" placeholder="Meta Keyword">
                                    </div>
                                    <p class="help-block"><?php echo form_error('sistem_meta_key'); ?></p>
                                    <div class="col-xs-12">
                                        <div class="row">
                                            <b>Note :</b> <i>Use commas ( , ) to separate the keywords</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="subt btn btn-primary col-xs-12 col-sm-5 col-md-6"><i class="fa fa-check mg-r-sm"></i> Save</button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
</div>
<?php if ($permit->access_update == 0) { ?>
    <script>
        $("input").attr("disabled","disabled");
        $("textarea").attr("disabled","disabled");
        $("button").attr("disabled","disabled");
    </script>
<?php } ?>

