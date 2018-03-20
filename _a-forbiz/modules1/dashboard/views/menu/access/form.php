<div class="col-lg-12">
    <div class="saving"></div>
    <section class="panel panel-info">
        <header class="panel-heading lead">
            <i class='fa fa-plus mg-r-sm'></i> <?php echo $act . ' ' . $header; ?>
        </header>
        <div class="panel-body">
            <?php echo form_open($url_action, array('id' => 'formACS')); ?>
            <div class="hidden-xs" style="margin-top: -20px"></div>
            <div class="visible-xs" style="margin-top: -15px"></div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Position name</label>
                        <input type="text" name="position" value="<?php echo empty($detail) ? set_value('position') : $detail->users_position_name; ?>" class="form-control" placeholder="Position name">
                    </div>
                </div>
            </div>
            <hr/>
            <div class="col-xs-12">
                <?php
                $index = 0;
                foreach ($mod_menu['modul'] as $x => $row) {
                    ?>
                    <?php if (count($mod_menu['menu'][$x]) > 0) { ?>
                        <?php echo ($index + 1) % 3 == 1 ? "<div class='row'>" : null; ?>
                        <div class="col-xs-4 mg-t-sm">
                            <h5>
                                <b><i class="fa fa-th-large mg-r-sm"></i><?php echo strtoupper($row->modul_name) ?></b>
                            </h5>
                            <hr/>
                            <div class="row">
                                <?php
                                $rox = 1;
                                foreach ($mod_menu['menu'][$x] as $xi => $rows) {
                                    ?>
                                    <div class="col-xs-12 mg-t-sm">
                                        <b><?php echo $rows->mod_menu_position ?>. <?php echo ucwords($rows->mod_menu_name) ?></b>
                                        <input type="hidden" name="menu[]" value="<?php echo $rows->mod_menu_id ?>";
                                               <hr>
                                        <div class="row">
                                            <div class="col-md-2 text-center">
                                                <input type="checkbox" value="1" name="create[<?php echo $rows->mod_menu_id ?>]" <?php echo $rows->mod_menu_create != 1 ? "disabled" : null ?> <?php echo!empty($detail) ? !empty($mod_menu['permission'][$x][$xi]->access_create) ? $mod_menu['permission'][$x][$xi]->access_create == 1 ? "checked" : null  : null  : null; ?>/> Create
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <input type="checkbox" value="1" name="read[<?php echo $rows->mod_menu_id ?>]" <?php echo $rows->mod_menu_read != 1 ? "disabled" : null ?> <?php echo!empty($detail) ? !empty($mod_menu['permission'][$x][$xi]->access_read) ? $mod_menu['permission'][$x][$xi]->access_read == 1 ? "checked" : null  : null  : null; ?>/> Read
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <input type="checkbox" value="1" name="update[<?php echo $rows->mod_menu_id ?>]" <?php echo $rows->mod_menu_update != 1 ? "disabled" : null ?> <?php echo!empty($detail) ? !empty($mod_menu['permission'][$x][$xi]->access_update) ? $mod_menu['permission'][$x][$xi]->access_update == 1 ? "checked" : null  : null  : null; ?>/> Edit
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <input type="checkbox" value="1" name="delete[<?php echo $rows->mod_menu_id ?>]" <?php echo $rows->mod_menu_delete != 1 ? "disabled" : null ?> <?php echo!empty($detail) ? !empty($mod_menu['permission'][$x][$xi]->access_delete) ? $mod_menu['permission'][$x][$xi]->access_delete == 1 ? "checked" : null  : null  : null; ?>/> Delete
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <input type="checkbox" value="1" name="special[<?php echo $rows->mod_menu_id ?>]" <?php echo $rows->mod_menu_special != 1 ? "disabled" : null ?> <?php echo!empty($detail) ? !empty($mod_menu['permission'][$x][$xi]->access_special) ? $mod_menu['permission'][$x][$xi]->access_special == 1 ? "checked" : null  : null  : null; ?>/> Special
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <?php
                                    $rox++;
                                }
                                ?>
                            </div>
                        </div>
                        <?php echo ($index + 1) % 3 == 0 ? "</div>" : null; ?>
                    <?php } ?>
                    <?php
                    $index++;
                }
                ?>
                <?php echo ($index) % 3 != 0 ? "</div>" : null; ?>
            </div>
            <hr/>
            <div class="row">
                <div class="col-xs-6">
                    <a role="button" style="cursor: pointer" class="cancelMod btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                </div>
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
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
            $(".load_access_data").load("<?php echo base_url() ?>dashboard/menu_access/table");
        });
        $("#formACS").submit(function() {
            if ($("input[name=position").val() == '') {
                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Menu position can not be empty");
                $("input[name=position").focus();
                return false;
            }
            $("input").attr("readonly","readonly");
            $("button[type=submit]").attr("disabled","disabled");
            $.ajax({
                url: $("#formACS").attr('action'),
                data: $("#formACS").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 0) {
                        $(".saving").html(json.msg);
                        $("input").attr("readonly",false);
                        $("button[type=submit]").attr("disabled",false);
                    } else {
                        $(".load_access_data").load("<?php echo base_url() ?>dashboard/menu_access/table");
                    }
                }
            });
            return false;
        });
    });

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>