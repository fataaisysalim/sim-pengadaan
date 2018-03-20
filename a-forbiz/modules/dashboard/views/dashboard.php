<link rel="stylesheet" href="<?php echo base_url() ?>/assets/vendor/toastr/toastr.css">
<script src="<?php echo base_url() ?>/assets/vendor/toastr/toastr.min.js"></script>
<div class="row">
    <div class="col-sm-8 col-md-8 col-lg-9">
        <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
        <section class="row mg-b-sm alert alert-error">
            <div class="alert alert-error">
            <div class="col-xs-2" style="color:black;">
                Pilih Proyek 
                <?php //echo ucwords($this->session->userdata['project_id']) ?>
            </div>
                <div class="col-xs-5">
                    <select class="form-control" id="project_id" name="projectload" <?php echo count($project) < 2 ? "disabled" : null ?>>
                        <?php foreach ($project as $x => $rx) { ?>
                            <option value="<?php echo $rx->project_id ?>"><?php echo ucwords($rx->project_name) ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class="col-xs-3">
                    <button type="button" onclick="set_session()" class="btn btn-warning col-xs-12" title="Search"><i class="fa fa-save"></i>&nbsp;Proses</button>
                </div>
            </div>
        </section>
        </div>
<!--            <section class="row mg-b-sm visible-xs">
                <div class="col-xs-12">
                    <div class="col-xs-9">
                        <select class="form-control" name="yearload_mobile">
                            <option value="<?php echo $now ?>" selected>Sort by : <?php echo $now ?></option>
                            <?php for ($i = 1; $i < 5; $i++) { ?>
                                <option value="<?php echo $now - $i ?>">Sort by : <?php echo $now - $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <button type="button" onclick="loadgraph('mobile')" class="btn btn-primary col-xs-12" title="Search"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </section>
            <div class="col-md-12">
                <section class="panel panel-info" id="graphusage"></section>
            </div>-->
      
        </div>
        
        <hr class="divider visible-xs"/>
    </div>
    <div class="col-sm-4 col-md-4 col-lg-3">
<!--        <section class="row mg-b-sm hidden-xs">
            <div>
                <div class="col-xs-9">
                    <select class="form-control" name="yearload_desktop">
                        <option value="<?php echo $now ?>" selected>Sort by : <?php echo $now ?></option>
                        <?php for ($i = 1; $i < 5; $i++) { ?>
                            <option value="<?php echo $now - $i ?>">Sort by : <?php echo $now - $i ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-xs-3">
                    <button type="button" onclick="loadgraph('desktop')" class="btn btn-primary col-xs-12" title="Search"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </section>-->

    </div>
</div>
<script>
    $(document).ready(function () {
        loadgraph('desktop');
        setTimeout(function () {
            toastr.options.closeButton = true;
            toastr.info('You are currently using Enterprise System', 'Welcome to WG System');
        }, 500);
    });
    function loadgraph(param) {
        var param = $('select[name=yearload_' + param + '] option:selected').val();
        $("#graphusage").load('<?php echo base_url() ?>dashboard/dashboard/effectivusage/' + param);
    }

    function set_session(){
        var project = $("#project_id").val();
        $.ajax({
            url: "<?php echo base_url() ?>dashboard/set_session_project/" + project,
            //dataType: "JSON",
            success: function(json) {
                bootbox.alert({
                    title: 'Informasi',
                    message: "PILIH PROJEK BERHASIL!",
                    className: 'bb-alternate-modal',
                    size: 'small'
                });
            }
        });

        
    }
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
<script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url() ?>assets/js/modules/exporting.js"></script>
