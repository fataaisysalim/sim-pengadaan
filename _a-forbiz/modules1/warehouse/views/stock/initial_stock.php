<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div>
    <div class="col-lg-8 col-md-8 col-sm-12 load_main_data">
        <div class="saving_m"></div>
        <div class="row">
            <div class="loadertab"><?php echo $this->session->flashdata('msg') ?></div>
        </div>
        <section class="panel panel-dark row">
            <header class="panel-heading lead">
                <i class='fa fa-edit mg-r-sm'></i> Stock Opname
            </header>
            <div class="panel-body">
                <div style="margin-top: -20px" class="hidden-xs"></div>
                <?php echo form_open($url_action, array('id' => 'formIS')); ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="row">
                            <div class="col-sm-12 mg-b-md">
                                <div class="form-group" id="equipment_trans">
                                    <label>Project</label>
                                    <select onchange="get_resource(this)" id="project" name="project" style="margin-top: 5px" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Project" required>
                                        <option value=""></option>
                                        <?php foreach ($project as $pj) { ?>
                                            <option value="<?php echo $pj->project_id; ?>"><?php echo $pj->project_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 mg-b-md">
                                <div class="form-group" id="equipment_trans">
                                    <label>Resource</label>
                                    <select disabled onchange="get_table(this)" id="resource_ct" name="resource_ct" style="margin-top: 5px" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Resource" required>
                                        <option value=""></option>
                                        <option value="1">Material</option>
                                        <option value="2">Equipment</option>
                                    </select>
                                </div>
                            </div>
                            <div id="material_search" class="hidden">
                                <div class="col-sm-12 mg-b-md">
                                    <div class="form-group">
                                        <label>Cari Nama Material</label>
                                        <div class="input-group mg-b-md">
                                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                            <input type="text" onkeyup="get_material()" placeholder="Cari nama material" class="form-control" name="material_search"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="acts" class="hidden">
                                <div class="col-sm-12 mg-b-md">
                                    <div class="form-group" id="equipment_trans">
                                        <label>Supplier/Subcon</label>
                                        <select onchange="get_table1(this)" id="actor" name="actor" style="margin-top: 5px" class="form-control form-select2" data-style="btn-white" data-placeholder="Choose Supplier/Subcon">
                                            <option value=""></option>
                                            <?php foreach ($actor as $acts) { ?>
                                                <option value="<?php echo ucwords($acts->actor_id) ?>"><?php echo ucwords($acts->actor_name) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label class="col-xs-6 text-right">Operator</label>
                                <div class="col-xs-6">
                                    <?php echo ucwords(explode(" ", $sess['employee']->employee_name)[0]) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label class="col-xs-6 text-right">Position</label>
                                <div class="col-xs-6">
                                    <?php echo ucwords($sess['users']->users_position_name) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="panel" id="table_data"></section>
                <div class="row">
                    <?php if (!empty($equip_trans_dt)) { ?>
                        <div class="<?php echo!empty($equip_trans_dt) ? 'col-xs-6' : null ?> pull-right">
                            <a role="button" style="cursor: pointer" class="cancel_m btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                        </div>
                    <?php } ?>
                    <div class="<?php echo!empty($equip_trans_dt) ? 'col-xs-6' : 'col-sm-12 col-xs-12' ?> pull-right">
                        <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </section>
    </div>
    <div class="col-xs-4 hidden-xs">
        <h4><i class="fa fa-info-circle mg-r-sm"></i>Perhatian :</h4>
        <div class="col-xs-11 col-sm-offset-1" style="border-top: 1px solid grey; padding-top: 15px">
            <div class="row">
                <ul class="ul">
                <li class="mg-b-sm"><i class="fa fa-chevron-right mg-r-sm"></i>Lakukan stock opname sebelum melakukan transaksi, apabila material sudah mempunyai riwayat transaksi maka tidak dapat dilakukan stock opname</li>
                <li class="mg-b-sm"><i class="fa fa-chevron-right mg-r-sm"></i>Untuk memudahkan pencarian material, silahkan gunakan pencarian nama material</li>
                <li><i class="fa fa-chevron-right mg-r-sm"></i>Mohon teliti dalah melakukan stock opname sebelum disimpan</li>
            </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("select.form-select2").select2();
        $(".datepicker").datepicker();
        $("select[name=project]").removeAttr("selected", "selected");
        $("select[name=resource_ct]").removeAttr("selected", "selected");
        if ($("#project").val() == '') {
            $("#add_btn").attr('disabled', 'disabled');
        }
    });

    function get_resource(el) {
        $("#resource_ct").attr('disabled', false);
        $("#table_data").html('');
        if ($("select[name=resource_ct] option:selected").val() != '') {
            $("#table_data").load("<?php echo base_url() . $url_access . 'table/'; ?>" + $("select[name=resource_ct] option:selected").val() + "/" + $("select[name=project] option:selected").val());
        }
    }
    function get_material() {
        var param_search = $("input[name=material_search]").val();
        $("#table_data").load("<?php echo base_url() . $url_access . 'table/'; ?>" + $("select[name=resource_ct] option:selected").val() + "/" + $("select[name=project] option:selected").val() + (param_search != '' ? '/' + param_search : ''));
    }
    function get_table(el, i) {
        $("#table_data").html('<div class="col-xs-12 text-dafault"><i class="fa fa-refresh fa-spin mg-r-sm"></i><i> Loading data. Please wait...</i></div>');
        if ($("select[name=resource_ct] option:selected").val() == 1) {
            $("#acts").attr("class", "hidden");
            $("#material_search").removeAttr('class', 'hidden');
            $("#table_data").load("<?php echo base_url() . $url_access . 'table/'; ?>" + $("select[name=resource_ct] option:selected").val() + "/" + $("select[name=project] option:selected").val());
        } else {
            $("#material_search").attr('class', 'hidden');
            $("select[name=actor]").val("");
            $("#table_data").html('');
            $("#acts").removeAttr("class");
        }
    }
    function get_table1(el, i) {
        $("#table_data").html('<div class="col-xs-12 text-dafault"><i class="fa fa-refresh fa-spin mg-r-sm"></i><i> Loading data. Please wait...</i></div>');
        $("#table_data").load("<?php echo base_url() . $url_access . 'table/'; ?>" + $("select[name=resource_ct] option:selected").val() + "/" + $("select[name=project] option:selected").val() + "/" + $("select[name=actor] option:selected").val());
    }
    $("#formIS").submit(function () {
        var err = 0;
        if (err > 0) {
            return false;
        }
        $("input").attr("readonly", "readonly");
        $("button[type=submit]").attr("disabled", "disabled");
        if ($("select[name=resource_ct]").val() == "") {
            bootbox.alert("Resource can not be empty");
            $("select[name=actor]").focus();
            return false;
        }
        if ($("select[name=project]").val() == "") {
            bootbox.alert("Project can not be empty");
            $("select[name=project]").focus();
            return false;
        }
    });
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
