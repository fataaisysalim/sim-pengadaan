<div class="panel-body">
    <div class="row">
        <ul class="nav nav-tabs" style="margin-top: -20px">
            <?php for ($x = 0; $x < 2; $x++) { ?>
                <li <?php echo $x == 0 ? 'class="active"' : null ?>>
                    <a href="#<?php echo $x == 0 ? "bapb" : "bapp" ?>" data-toggle="tab"><?php echo $x == 0 ? "BAPB Material" : "BPP Equipment" ?></a>
                </li>
            <?php } ?>
        </ul>
        <section>
            <div class="tab-content ">
                <?php for ($xy = 0; $xy < 2; $xy++) { ?>
                    <section class="tab-pane <?php echo $xy == 0 ? 'active' : null ?>" id="<?php echo $xy == 0 ? "bapb" : "bapp" ?>">
                        <div class="col-xs-12">
                            <div class="row">
                                <?php echo form_open("", array('id' => "form_$xy")); ?>
                                <div class="col-sm-4 col-xs-12 mg-b-sm mg-t-md">
                                    <div class="form-group">
                                        <label class="">PROJET :</label>
                                        <select id="project" name="projectm_<?php echo $xy ?>" class="projectm_<?php echo $xy ?> form-control form-select2  mg-t-xs" data-style="btn-white">
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
                                                    <input type="text" class="form-control start_<?php echo $xy ?>" name="start_<?php echo $xy ?>" value="<?php echo date('d-m-Y',  strtotime('-10 days')) ?>">
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
                                                    <input type="text" class="form-control end_<?php echo $xy ?>" name="end_<?php echo $xy ?>" value="<?php echo date('d-m-Y') ?>">
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
                            </div>
                            <hr class="divider" style="padding: 0px; margin: 15px 0px 10px 0px"/>
                        </div>
                        <div class="col-xs-12 entryData<?php echo $xy ?>"></div>
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
                        $(".entryData<?php echo $xy ?>").load("<?php echo base_url() ?>procurement/bapb-bapp-process/<?php echo $xy == 0 ? "bapb" : "bapp" ?>/" +$('select[name=projectm_<?php echo $xy ?>] option:selected').val() +"/"+ $('.start_<?php echo $xy ?>').val() + "/" + $('.end_<?php echo $xy ?>').val());
                        $("#form_<?php echo $xy ?>").submit(function () {
                            var starts = $('.start_<?php echo $xy ?>').val();
                            var ends = $('.end_<?php echo $xy ?>').val();
                            var projects = $('select[name=projectm_<?php echo $xy ?>] option:selected').val();
                            $(".entryData<?php echo $xy ?>").load("<?php echo base_url() ?>procurement/bapb-bapp-process/<?php echo $xy == 0 ? "bapb" : "bapp" ?>/" +$('select[name=projectm_<?php echo $xy ?>] option:selected').val() +"/"+ $('.start_<?php echo $xy ?>').val() + "/" + $('.end_<?php echo $xy ?>').val());
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
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i> INFORMATION BAPB & BPP');
    function detailEntry(feature, id) {
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url() ?>procurement/bapb-bapp-process/"+feature+"/detail/" + id);
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
    }
    function printEntry(feature, id) {
        if (feature == 'bapb') {
            window.open("<?php echo base_url() ?>procurement/bapb-print/" + id);
        } else {
            window.open("<?php echo base_url() ?>procurement/bapp-print/" + id);
        }
        return false;
    }
</script>
