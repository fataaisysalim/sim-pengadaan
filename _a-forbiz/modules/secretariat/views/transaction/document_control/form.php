<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<section class="panel panel-info">
    <header class="panel-heading lead">
        <i class='fa fa-edit mg-r-sm'></i> <?php echo $header; ?>
    </header>
    <div class="panel-body">
        <?php echo form_open_multipart(!empty($doc['control']) ? "$url_access/save/" . md5($doc['control']->doc_control_id) : "$url_access/save", array('id' => 'form')); ?>
        <div class="row">
            <div style="margin-top: -20px" class="hidden-xs"></div>
            <div class="col-sm-5">
                <div class="col-sm-7 mg-b-sm">
                    <div class="form-group">
                        <label>Project</label>
                        <select name="project" onchange="getProData()" class="form-control form-select2" data-style="btn-white" data-placeholder="Pilih Proyek" <?php echo!empty($doc['control']) ? "disabled" : null ?>>
                            <?php foreach ($project as $pro) : ?>
                                <option value="<?php echo $pro->project_id; ?>" <?php if (isset($doc['control']) && $pro->project_id == $doc['control']->project_id) echo "selected"; ?> <?php if ($pro->project_id == set_value('project')) echo "selected"; ?>><?php echo ucwords($pro->project_name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-5 mg-b-sm hidden-xs">
                    <div class="form-group">
                        <label>Project Code</label>
                        <div class="input-group mg-b-md">
                            <span class="input-group-addon"><i class="fa fa-gavel"></i></span>
                            <input type="text" name="project_code" value="<?php echo isset($doc['control']) ? $doc['control']->project_code : NULL; ?>" class="proCode form-control" placeholder="Project Code" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 mg-b-sm">
                    <div class="form-group">
                        <label>Doc Type</label>
                        <select name="type_doc" onchange="TypeCode()" class="form-control form-select2" data-style="btn-white" data-placeholder="Document Type" <?php echo!empty($doc['control']) ? "disabled" : null ?>>
                            <option value=""></option>
                            <option value="<?php echo md5(1) ?>" <?php echo!empty($doc['control']) ? $doc['control']->doc_control_ct_id == 1 ? "selected" : null  : null ?>>Document In</option>
                            <option value="<?php echo md5(2) ?>" <?php echo!empty($doc['control']) ? $doc['control']->doc_control_ct_id == 2 ? "selected" : null  : null ?>>Document Out</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 mg-b-sm">
                    <div class="form-group">
                        <label>Doc Code</label>
                        <select name="letter_code" onchange="getLetCode()" class="form-control form-select2" data-style="btn-white" data-placeholder="Document Code">
                            <option value=""></option>
                            <?php foreach ($letcode as $i => $code) : ?>
                                <option value="<?php echo $code->doc_control_letcode_id; ?>" <?php echo!empty($doc['control']) ? $doc['control']->doc_control_letcode_id == $code->doc_control_letcode_id ? "selected" : null  : null ?> ><?php echo $code->doc_control_letcode_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <label>Doc Number</label>
                        <div class="input-group mg-b-sm">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="hidden" name="letnumber" value="<?php echo isset($doc['control']) ? serialDoc($doc['control']->doc_control_id) : !empty($new->doc_control_id) ? serialDoc($new->doc_control_id) : "0001"; ?>">
                            <input type="text" name="letter_number" value="<?php echo isset($doc['control']) ? $doc['control']->doc_control_number : null; ?>" class="form-control" placeholder="Document Number">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 mg-b-sm">
                    <div class="form-group">
                        <label class="actor">Receive from</label>
                        <div class="chooseActor">
                            <select name="actor" class="form-control form-select2" data-style="btn-white" data-placeholder="Receive from">
                                <option value=""></option>
                                <?php foreach ($actor['ct'] as $nom => $ct) : ?>
                                    <?php foreach ($actor['act'][$nom] as $num => $man) : ?>
                                        <option value="<?php echo $man->actor_id; ?>" <?php if (!empty($doc['control']) && $man->actor_id == $doc['control']->actor_id) echo "selected"; ?> <?php if ($man->actor_id == set_value('actor')) echo "selected"; ?>><?php echo $man->actor_name; ?></option>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>Subject</label>
                            <div class="input-group mg-b-sm">
                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                <input type="text" name="doc_case" class="form-control" value="<?php echo isset($doc['control']) ? $doc['control']->doc_control_case : NULL; ?>" placeholder="Subject"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 mg-b-sm">
                        <div class="form-group">
                            <label>Doc Note</label>
                            <textarea class="form-control" maxlength="350" name="doc_desc" placeholder="Document Note (Maximum length of 350 characters)"><?php echo isset($doc['control']) ? $doc['control']->doc_control_desc : NULL; ?></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-sm-7 col-xs-12">
                <div class="col-xs-12 mg-t-lg hidden-xs">
                    <div class="form-group">
                        <label class="col-xs-6 text-right">Doc Date</label>
                        <div class="col-xs-6">
                            <?php echo indo_date(date('Y-m-d')) ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 hidden-xs">
                    <div class="form-group">
                        <label class="col-xs-6 text-right">Operator</label>
                        <div class="col-xs-6">
                            <?php echo ucwords($sess['employee']->employee_name) ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 mg-b-lg hidden-xs">
                    <div class="form-group">
                        <label class="col-xs-6 text-right">Position</label>
                        <div class="col-xs-6">
                            <?php echo ucwords($sess['users']->users_position_name) ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <hr/>
                    <label><i class="fa fa-clipboard mg-r-sm"></i>Doc Attachments</label>
                    <hr/>
                    <table class="table">
                        <thead id="docAttach">
                            <?php if (!empty($doc['attach'])) { ?>
                                <?php
                                $no = 1;
                                foreach ($doc['attach'] as $x => $row) {
                                    ?>
                                    <tr class="rowDoc rowDocE">
                                        <td class="text-center"><p id="nom_<?php echo $no ?>"><?php echo $no ?></p></td>
                                        <td>
                                            <input type="hidden" value="<?php echo $row->doc_attach_id ?>" name="attachID[]"/>
                                            <input class="form-control" value="<?php echo $row->doc_attach_files ?>" type="text" readonly/>
                                        </td>
                                        <td>
                                            <a class="fancybox-buttons btn btn-sm btn-primary" data-fancybox-group="button" href="<?php echo base_url() ?>assets/files/doc_control/<?php echo $row->doc_attach_files ?>">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                }
                                ?>
                            <?php } ?>
                        </thead>
                        <tr style="border: 0px">
                            <td></td>
                            <td colspan="2"><button type="button" onclick="attachRow()" class="btn btn-sm btn-dark col-xs-4"><i class="fa fa-plus"></i></button></td>
                        </tr>
                    </table>
                </div>
                <div class="col-xs-12">
                    <b>Note :</b>
                    <small><i>Attachments are allowed <b>jpg & png</b></i></small>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-6 col-xs-12">
                <?php if (!empty($doc['control'])) { ?>
                    <div class="<?php echo!empty($doc['control']) ? 'col-xs-6' : null ?>">
                        <a href="<?php echo base_url() ?>secretariat/doc-control" class="cancel_m btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i> Cancel </a>
                    </div>
                <?php } ?>
                <div class="<?php echo!empty($doc['control']) ? 'col-xs-6' : 'col-md-6 col-sm-12 col-xs-12' ?> pull-right">
                    <button type="submit" class="btn btn-primary col-xs-12"><i class="fa fa-check mg-r-sm"></i> Save</button>
                </div>
            </div>

        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $("select.form-select2").select2();
        attachRow();
        $.ajax({
            url: "<?php echo base_url('secretariat/get-project'); ?>/" + $('select[name=project] option:selected').val() + '/1',
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $(".proCode").attr('value', json.data.project_code);
                }
            }
        });
    });

    function attachRow() {
        var counters = $('.rowDoc').length + 1;
        var counter = $('.rowDoc').length + 1;
        //        if (counter == 5) {
        //            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Jumlah Lampiran maksimal 4");
        //            return false;
        //        }
        var rows = '<tr class="rowDoc rowDocAdd">'
            + '<td class="text-center"><p id="nom_' + counter + '">' + counters + '</p></td>'
            + '<td >'
            + '<input class="form-control" id="attach_' + counter + '" style="padding-bottom: 40px" type="file" name="attach[]"/>'
            + '</td>'
            + '<td>'
            + '<button type="button" class="btn btn-sm btn-danger" id="btn_' + counter + '" onclick="cut(this, ' + counter + ')"><i class="fa fa-times"></i></button>'
            + '</td></tr>';
        $('#docAttach').append(rows);
    }
    function TypeCode() {
        var typeDoc = $("select[name=type_doc] option:selected").val();
        if (typeDoc == "<?php echo md5(1) ?>") {
            $(".chooseActor #select2-chosen-8").html("Receive from");
            $("input[name=letter_number]").val('');
            $(".actor").html("Receive from");
        } else {
            $(".chooseActor #select2-chosen-8").html("Send to");
            $(".actor").html("Send to");
            $.ajax({
                url: "<?php echo base_url('secretariat/doc-code/data'); ?>/" + $('select[name=letter_code] option:selected').val(),
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 1) {
                        $("input[name=letter_number]").val(json.code + $("input[name=letnumber]").val() + "/<?php echo number_format_romawi(date('m')) ?>/<?php echo date('Y') ?>");
                    }
                }

            });
        }
    }
    function getLetCode() {
        if ($("select[name=type_doc] option:selected").val() == "<?php echo md5(2) ?>") {
            $.ajax({
                url: "<?php echo base_url('secretariat/doc-code/data'); ?>/" + $('select[name=letter_code] option:selected').val(),
                dataType: "JSON",
                success: function(json) {
                    if (json.status == 1) {

                        $("input[name=letter_number]").val(json.code + $("input[name=letnumber]").val() + "/<?php echo number_format_romawi(date('m')) ?>/<?php echo date('Y') ?>");
                    }
                }

            });
        }
        return false;
    }
    function getProData() {
        $.ajax({
            url: "<?php echo base_url('secretariat/get-project'); ?>/" + $('select[name=project] option:selected').val() + '/1',
            dataType: "JSON",
            success: function(json) {
                if (json.status == 1) {
                    $(".proCode").attr('value', json.data.project_code);
                }
            }
        });
        return false;
    }
    function cut(el, i) {
        var rowx = $('.rowDoc').length;
        for (var a = i; a < rowx; a++) {
            var rz = a + 1;
            $("#nom_" + rz).html(a);
            $("#nom_" + rz).attr('id', "nom_" + a);
            $("#attach_" + rz).attr('id', "attach_" + a);
            $("#btn_" + rz).attr('onclick', "cut(this, " + a + ")");
            $("#btn_" + rz).attr('id', "btn_" + a);
        }
        var parent = el.parentNode.parentNode;
        parent.parentNode.removeChild(parent);
    }

    $("#form").submit(function() {
        var err = 0;
        if (err > 0) {
            return false;
        }
        if ($("select[name=project] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Project can not empty");
            $("select[name=project]").focus();
            return false;
        }
        if ($("select[name=type_doc] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i> The document type can not empty");
            $("select[name=type_doc]").focus();
            return false;
        }
        if ($("select[name=letter_code] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Document code can not empty");
            $("select[name=letter_code]").focus();
            return false;
        }
        if ($("input[name=letter_number]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Document number can not empty");
            $("input[name=letter_number]").focus();
            return false;
        }
        //        if ($("select[name=type_doc] option:selected").val() == "<?php echo md5(1) ?>") {
        //            if ($("input[name=reference_number]").val() == "") {
        //                bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Nomor Referensi tidak boleh kosong");
        //                $("input[name=reference_number]").focus();
        //                return false;
        //            }
        //        }
        if ($("select[name=actor] option:selected").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>The sender can not empty");
            $("select[name=actor]").focus();
            return false;
        }
        if ($("input[name=doc_case]").val() == "") {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Subject should not empty");
            $("input[name=doc_case]").focus();
            return false;
        }

        var jmlTransME = $('.rowDocE').length;
        var jmlTransM = $('.rowDocAdd').length;
        var total = <?php echo!empty($doc['attach']) ? 1 : 0 ?>;
        for (var e = <?php echo!empty($doc['attach']) ? (count($doc['attach']) + 1) : 1 ?>; e <= (jmlTransM + jmlTransME); e++) {
            var attach = $("#attach_" + e).val();
            var extmg = attach.split('.').pop();
            if (attach != '') {
                if (extmg != 'jpg' && extmg != 'png') {
                    bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Attachment row " + e + ". Format not allowed");
                    return false;
                }
                total += 1;
            }

        }
        if (total < 1) {
            bootbox.alert("<i class='fa fa-warning mg-r-sm'></i>Document attachments least 1");
            return false;
        }
    });
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
