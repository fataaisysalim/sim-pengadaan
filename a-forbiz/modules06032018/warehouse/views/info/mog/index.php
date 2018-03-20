<div class="panel-body">
    <div class="row">
        <ul class="nav nav-tabs" style="margin-top: -20px">
            <?php foreach ($show['ct'] as $number => $row) { ?>
                <li <?php echo $number == 0 ? 'class="active"' : null ?>>
                    <a href="#mt<?php echo $row->transaction_ct_id ?>" data-toggle="tab"><?php echo $row->transaction_ct_id == 1 ? "RECEIPT (BAPB)" : "USAGE (BPM)" ?></a>
                </li>
            <?php } ?>
        </ul>
        <section>
            <div class="tab-content ">
                <?php foreach ($show['ct'] as $numb => $rows) { ?>
                    <section class="tab-pane <?php echo $numb == 0 ? 'active' : null ?>" id="mt<?php echo $rows->transaction_ct_id ?>">
                        <div class="col-xs-12">
                            <div class="row">
                                <?php echo form_open("", array('id' => "form_$rows->transaction_ct_id")); ?>
                                <div class="col-sm-2 col-xs-12 mg-b-sm mg-t-md">
                                    <div class="form-group">
                                        <label class="">PROJET :</label>
                                        <select id="project" name="projectm_<?php echo $rows->transaction_ct_id ?>" class="projectm_<?php echo $rows->transaction_ct_id ?> form-control form-select2  mg-t-xs" data-style="btn-white">
                                            <?php foreach ($project as $i => $pro) : ?>
                                                <option value="<?php echo md5($pro->project_id); ?>"><?php echo strtoupper($pro->project_name); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12 mg-t-md">
                                    <label>TRANSACTION DATE :</label>
                                    <div class="row">
                                        <div col-xs-12>
                                            <div class="col-xs-5">
                                                <div class="input-group input-append date datepicker" data-date="<?php echo date('d-m-Y',  strtotime('-10 days')) ?>" data-date-format="dd-mm-yyyy">
                                                    <input type="text" class="form-control start_<?php echo $rows->transaction_ct_id ?>" name="start_<?php echo $rows->transaction_ct_id ?>" value="<?php echo date('d-m-Y',  strtotime('-10 days')) ?>">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-white add-on" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-xs-2 text-center"><b style="font-size: 20px; padding-top: 120px">-</b></div>
                                            <div class="col-xs-5">
                                                <div class="input-group input-append date datepicker" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                                    <input type="text" class="form-control end_<?php echo $rows->transaction_ct_id ?>" name="end_<?php echo $rows->transaction_ct_id ?>" value="<?php echo date('d-m-Y') ?>">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-white add-on" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-xs-12">
                                    <div style="margin-top: 26px" class="hidden-xs"></div>
                                    <button type="submit" class="btn btn-md btn-primary col-xs-12 mg-t-md" ><i class="fa fa-search mg-r-sm "></i> SEARCH</button>
                                </div>
                                <?php echo form_close(); ?>
                                <?php if (!empty($permit)) { ?>
                                    <?php if ($permit->access_special == 1) { ?>
                                        <div class="col-sm-2 col-xs-6 hidden-xs">
                                            <div style="margin-top: 26px" class="hidden-xs"></div>
                                            <a onclick="onExportMog('<?php echo $rows->transaction_ct_id ?>', '<?php echo md5($rows->transaction_ct_id); ?>')" role="button" class="btn btn-block btn-md btn-dark pull-right mg-t-md"><i class="fa fa-download mg-r-sm"></i> EXCEL</a>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <hr class="divider" style="padding: 0px; margin: 15px 0px 10px 0px"/>
                        </div>
                        <div class="col-xs-12 mogData_<?php echo $rows->transaction_ct_id ?>"></div>
                        <div class="col-md-12">
                            <b>NOTE :</b>
                            <div class="row mg-t-md mg-b-sm">
                                <div class=" col-sm-4 col-xs-6">
                                    <i class="fa fa-search mg-r-md btn btn-sm btn-primary" disabled></i> DETAIL
                                </div>
                                <div class="col-sm-4 col-xs-6">
                                    <i class="fa fa-print mg-r-md btn btn-sm btn-danger" disabled></i> PRINT
                                </div>
                            </div>
                        </div>
                    </section>
                    <script>
                        $(".mogData_<?php echo $rows->transaction_ct_id ?>").load("<?php echo base_url() ?>warehouse/bapb-bpm-information/" + $('.start_<?php echo $rows->transaction_ct_id ?>').val() + "/" + $('.end_<?php echo $rows->transaction_ct_id ?>').val() + "/<?php echo md5($rows->transaction_ct_id) ?>/" + $('select[name=projectm_<?php echo $rows->transaction_ct_id ?>] option:selected').val());
                        $("#form_<?php echo $rows->transaction_ct_id ?>").submit(function () {
                            var starts = $('.start_<?php echo $rows->transaction_ct_id ?>').val();
                            var ends = $('.end_<?php echo $rows->transaction_ct_id ?>').val();
                            var projects = $('select[name=projectm_<?php echo $rows->transaction_ct_id ?>] option:selected').val();
                            $(".mogData_<?php echo $rows->transaction_ct_id ?>").load("<?php echo base_url() ?>warehouse/bapb-bpm-information/" + starts + "/" + ends + "/<?php echo md5($rows->transaction_ct_id) ?>" + '/' + projects);
                            return false;
                        });
                    </script>
                <?php } ?>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    $(".datepicker").datepicker();
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i> INFORMATION BAPB & BPM');
    function detail_mog(id) {
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url() ?>warehouse/mog/detail/" + id);
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
    }
<?php if (!empty($permit)) { ?>
    <?php if ($permit->access_delete == 1) { ?>
                function delete_mog(a, ct, ct2) {
                    bootbox.confirm("Are you sure to remove the data ?", function (result) {
                        if (result == true) {
                            $.ajax({
                                url: "<?php echo base_url() . 'warehouse/bapb/delete/' ?>" + a,
                                dataType: "JSON",
                                success: function (json) {
                                    if (json.status == 1) {
                                        $(".mogData_"+ct).load("<?php echo base_url() ?>warehouse/bapb-bpm-information/" + $('.start_'+ct).val() + "/" + $('.end_'+ct).val() + "/"+ct2+"/" + $('select[name=projectm_'+ct+'] option:selected').val());
                                    }
                                }
                            });
                        }
                    });
                }
    <?php } ?>
    <?php if ($permit->access_special == 1) { ?>
                function onExportMog(param, param2) {
                    var ct = param2;
                    var starts = $('.start_' + param).val();
                    var ends = $('.end_' + param).val();
                    var projects = $('.projectm_' + param).val();
                    window.open("<?php echo base_url('warehouse/export/mog'); ?>" + '/' + starts + '/' + ends + '/' + ct + '/' + projects);
                }
    <?php } ?>
<?php } ?>
    function printMog(id, ftr) {
        if (ftr == 1) {
            window.open("<?php echo base_url() ?>warehouse/bapb-print/" + id);
        } else {
            window.open("<?php echo base_url() ?>warehouse/bpm-print/" + id);
        }
        return false;
    }
</script>
