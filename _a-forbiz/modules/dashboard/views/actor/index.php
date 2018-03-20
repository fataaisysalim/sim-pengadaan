<div class="panel-body">
    <div class="row">
        <?php if (count($show['ct']) > 1) { ?>
            <ul class="nav nav-tabs" style="margin-top: -20px">
                <?php foreach ($show['ct'] as $number => $row) { ?>
                    <li <?php echo $number == 0 ? 'class="active"' : null ?>>
                        <a href="#ar<?php echo $row->actor_category_id ?>" data-toggle="tab"><?php echo strtoupper($row->actor_category_name) ?></a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
        <section>
            <div class="tab-content ">
                <?php foreach ($show['ct'] as $numb => $rows) { ?>
                    <section class="tab-pane <?php echo $numb == 0 ? 'active' : null ?>" id="ar<?php echo $rows->actor_category_id; ?>">
                        <div class="col-xs-12">
                            <div class="row">
                                <?php echo form_open("", array('id' => "foratr_$rows->actor_category_id")); ?>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <label><?php echo strtoupper($rows->actor_category_name) ?> STATUS :</label>
                                    <select class="statusm_<?php echo $rows->actor_category_id ?> form-control">
                                        <option value="all">ALL</option>
                                        <option value="active">ACTIVE</option>
                                        <option value="nonactive">NONACTIVE</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 mg-t-md">
                                    <button type="submit" class="btn btn-md btn-primary pull-left mg-t-sm"><i class="fa fa-search mg-r-sm"></i> SEARCH</button>
                                </div>
                                <div class="col-sm-4 mg-t-md">
                                    <a onclick="onExport('<?php echo $rows->actor_category_id; ?>','<?php echo md5($rows->actor_category_id); ?>')" role="button" class="btn btn-md btn-dark pull-right mg-l-md mg-t-sm"><i class="fa fa-download mg-r-sm"></i> EXCEL</a>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                            <hr class="divider" style="padding: 0px; margin: 15px 0px 10px 0px"/>
                        </div>
                        <div class="col-xs-12 arData_<?php echo $rows->actor_category_id ?>"></div>
                        <?php if ($permit->access_special == 1) { ?>
                            <div class="col-md-12">
                                <b>NOTE :</b>
                                <div class="row mg-t-md mg-b-sm">
                                    <div class="col-xs-6">
                                        <i class="fa fa-check mg-r-md text-success"></i> ACTIVE
                                    </div>
                                    <div class="col-xs-6">
                                        <i class="fa fa-times mg-r-md text-danger"></i> NONACTIVE
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </section>
                    <script>
                        $(".arData_<?php echo $rows->actor_category_id ?>").load("<?php echo base_url($url) ?>/<?php echo md5($rows->actor_category_id) ?>");
                        $("#foratr_<?php echo $rows->actor_category_id ?>").submit(function () {
                            var status = $('.statusm_<?php echo $rows->actor_category_id ?> option:selected').val();
                            $(".arData_<?php echo $rows->actor_category_id ?>").load("<?php echo base_url($url) ?>/<?php echo md5($rows->actor_category_id) ?>/" + status);
                            return false;
                        });
                    </script>
                <?php } ?>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i> <?php echo $header ?>');
    function detailAtr(id) {
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url($url) ?>/detail/" + id);
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
    }
<?php if ($permit->access_special == 1) { ?>
        function statusAct(idss, ct, id, ids, status){
            var msg = status == 1 ? "Are "+ct+" that you choose will be activated ?" : "Are "+ct+" that you choose will be deactivated ?";
            bootbox.confirm(msg, function(result) {
                if (result == true) {
                    $.ajax({
                        url: "<?php echo base_url($url) ?>/status/" +id+"/"+status,
                        dataType: "JSON",
                        success: function(json) {
                            if (json.status == 1) {
                                $(".arData_"+idss).load("<?php echo base_url($url) ?>/"+ids);
                            }
                        }
                    });
                }
            });
        }
<?php } ?>
    function onExport(id, ids) {
        var status = $(".statusm_"+id+" option:selected").val();
        window.open("<?php echo base_url(); ?>warehouse/export/actor/"+ id + '/' + status);
    }
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
