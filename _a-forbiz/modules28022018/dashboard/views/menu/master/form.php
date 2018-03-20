<div class="col-lg-4 col-md-4 col-sm-6">
    <div class="saving"></div>
    <section class="panel panel-info">
        <header class="panel-heading lead">
            <i class='fa fa-plus mg-r-sm'></i> <?php echo $act . ' ' . $header; ?>
        </header>
        <div class="panel-body">
            <?php echo form_open($url_action, array('id' => 'formMOD')); ?>
            <div class="hidden-xs" style="margin-top: -20px"></div>
            <div class="visible-xs" style="margin-top: -15px"></div>
            <div class="row">
                <div class="col-lg-12 mg-b-sm">
                    <div class="form-group">
                        <label>Modul</label>
                        <select name="modul" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Modul to display">
                            <?php foreach ($modul as $x => $mod) { ?>
                                <option value="<?php echo $mod->modul_id; ?>" <?php echo!empty($detail) ? $detail->modul_id == $mod->modul_id ? "selected" : null  : null ?>><?php echo strtoupper($mod->modul_name); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-8">
                    <div class="form-group">
                        <label>Menu name</label>
                        <input type="text" name="menu" value="<?php echo empty($detail) ? set_value('menu') : $detail->mod_menu_name; ?>" class="form-control" placeholder="Menu name">
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label>Position</label>
                        <input type="text" name="position" value="<?php echo empty($detail) ? set_value('position') : $detail->mod_menu_position; ?>" class="form-control" placeholder="Position">
                    </div>
                </div>
                <div class="col-xs-12 mg-t-sm">
                    <div class="form-group">
                        <label>Menu URL</label>
                        <input type="text" name="url" value="<?php echo empty($detail) ? set_value('url') : $detail->mod_menu_url; ?>" class="form-control" placeholder="Menu URL">
                    </div>
                </div>
                <div class="col-xs-6 mg-t-sm">
                    <div class="form-group">
                        <label>Menu Display</label>
                        <select name="display" class="form-control">
                            <option value="redirect" <?php echo !empty($detail) ? $detail->mod_menu_display == 'redirect' ? "selected" : null  : null; ?>>Redirect</option>
                            <option value="modal" <?php echo !empty($detail) ? $detail->mod_menu_display == 'modal' ? "selected" : null  : null; ?>>Modal</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 mg-t-sm">
                    <div class="form-group">
                        <label>Menu Icon</label>
                        <input type="text" name="icon" value="<?php echo empty($detail) ? set_value('url') : $detail->mod_menu_icon; ?>" class="form-control" placeholder="Menu Icon">
                    </div>
                </div>
                <div class="col-xs-12 mg-t-sm">
                    <div class="form-group">
                        <label>Permission</label>
                        <div class="row">
                            <div class="col-xs-4 mg-t-sm">
                                <input type="checkbox" value="1" name="create" class="mg-r-sm" <?php echo!empty($detail) ? $detail->mod_menu_create != 0 ? "checked" : null  : null ?>/> Create
                            </div>
                            <div class="col-xs-4 mg-t-sm">
                                <input type="checkbox" value="1" name="read" class="mg-r-sm" <?php echo!empty($detail) ? $detail->mod_menu_read != 0 ? "checked" : null  : null ?>/> Read
                            </div>
                            <div class="col-xs-4 mg-t-sm">
                                <input type="checkbox" value="1" name="update" class="mg-r-sm" <?php echo!empty($detail) ? $detail->mod_menu_update != 0 ? "checked" : null  : null ?>/> Update
                            </div>
                            <div class="col-xs-4 mg-t-sm">
                                <input type="checkbox" value="1" name="delete" class="mg-r-sm" <?php echo!empty($detail) ? $detail->mod_menu_delete != 0 ? "checked" : null  : null ?>/> Delete
                            </div>
                            <div class="col-xs-4 mg-t-sm">
                                <input type="checkbox" value="1" name="special" class="mg-r-sm" <?php echo!empty($detail) ? $detail->mod_menu_special != 0 ? "checked" : null  : null ?>/> Special
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
                </div>
                <div class="col-xs-6">
                    <a role="button" style="cursor: pointer" class="cancelMod btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("select.form-select2").select2();
        $(".cancelMod").click(function() {
            $("#neForm").attr("class","col-md-6");
            $("#dataMod").attr("class","col-sm-12");
            $("#load_mod_form").attr("class","hidden");
            $("#load_mod_form").html("");
        });
        $("#formMOD").submit(function() {
            if ($("input[name=menu").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Menu name can not be empty");
                $("input[name=menu").focus();
                return false;
            }
            if ($("input[name=position").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Menu position can not be empty");
                $("input[name=position").focus();
                return false;
            }
            $("select[name=modul]").attr("readonly","readonly");
            $("input").attr("readonly","readonly");
            $.ajax({
                url: $("#formMOD").attr('action'),
                data: $("#formMOD").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 0) {
                        $(".saving").html(json.msg);
                    } else {
                        $("#neForm").attr("class","col-md-6");
                        $("#dataMod").attr("class","col-sm-12");
                        $("#load_mod_form").attr("class","hidden");
                        $("#load_mod_form").html("");
                        $(".load_mod_data").load("<?php echo base_url() ?>dashboard/menu/table/"+ json.modul);    
                    }
                }
            });
            return false;
        });
    });

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>