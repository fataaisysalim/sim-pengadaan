<div class="panel-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <?php echo form_open("", array('id' => "formDocE")); ?>
                <div class="col-sm-3 col-xs-12">
                    <div class="form-group mg-b-sm">
                        <label class="">Project :</label>
                        <select name="projectsDoc" class="form-control mg-t-xs" data-style="btn-white" data-placeholder="Project">
                            <?php foreach ($project as $i => $pro) : ?>
                                <option value="<?php echo md5($pro->project_id); ?>"><?php echo ucwords($pro->project_name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2 col-xs-12">
                    <div class="form-group mg-b-sm">
                        <label class="">Code :</label>
                        <select name="docode" class="form-control mg-t-xs" data-style="btn-white" data-placeholder="Doc Code" title="Choose Code">
                            <option value="all">All</option>
                            <?php foreach ($code as $x => $docc) : ?>
                                <option value="<?php echo md5($docc->doc_control_letcode_id); ?>"><?php echo ucwords($docc->doc_control_letcode_name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <label>Document Date :</label>
                    <div>
                        <div>
                            <div class="col-xs-5">
                                <div class="input-group input-append date datepicker row" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control startDoc" name="startDoc" value="<?php echo date('d-m-Y') ?>">
                                    <span class="input-group-btn">
                                        <button class="btn btn-white add-on" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-1"><b style="font-size: 20px; padding-top: 120px">-</b></div>
                            <div class="col-xs-5">
                                <div class="input-group input-append date datepicker row" data-date="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control endDoc" name="endDoc" value="<?php echo date('d-m-Y') ?>">
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
                    <div style="margin-top: 28px" class="hidden-xs"></div>
                    <div class="mg-t-md visible-xs"></div>
                    <button type="submit" class="btn btn-md btn-primary col-xs-12"><i class="fa fa-search mg-r-sm"></i>Search</button>
                </div>
                <?php echo form_close(); ?>
            </div>
            <hr class="divider" style="padding: 0px; margin: 15px 0px 10px 0px"/>
        </div>
        <div class="col-xs-12 docData"></div>
        <div class="col-md-12">
            <b>Note :</b>
            <div class="row mg-t-md mg-b-sm">
                <div class="col-sm-3 col-xs-6">
                    <i class="fa fa-search mg-r-md btn btn-sm btn-primary mg-b-sm" disabled></i> Detail
                </div>
                <div class="col-sm-3 col-xs-6">
                    <i class="fa fa-print mg-r-md btn btn-sm btn-dark mg-b-sm" disabled></i> Print Receipt
                </div>
                <?php if ($permit->access_update == 1) { ?>
                    <div class="col-sm-3 col-xs-6">
                        <i class="fa fa-edit mg-r-md btn btn-sm btn-warning mg-b-sm" disabled></i> Edit
                    </div>
                <?php } ?>
                <?php if ($permit->access_delete == 1) { ?>
                    <div class="col-sm-3 col-xs-6">
                        <i class="fa fa-trash mg-r-md btn btn-sm btn-danger mg-b-sm" disabled></i> Delete
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".datepicker").datepicker();
    $(".modal-title").html('<a onclick="exportDoc()" role="button" class="btn btn-sm btn-dark pull-left" style="margin-top: -3px"><i class="fa fa-download mg-r-sm"></i>Excel</a><i class="fa fa-th-large mg-r-md"></i>Document OUT Information');
    $(".docData").load("<?php echo base_url() ?>secretariat/doc_exits/data/" + $('select[name=projectsDoc] option:selected').val() + "/" + $('.startDoc').val() + "/" + $('.endDoc').val()+ "/" + $('select[name=docode] option:selected').val());
    $("#formDocE").submit(function () {
        $(".docData").load("<?php echo base_url() ?>secretariat/doc_exits/data/" + $('select[name=projectsDoc] option:selected').val() + "/" + $('.startDoc').val() + "/" + $('.endDoc').val()+ "/" + $('select[name=docode] option:selected').val());
        return false;
    });
    function detailDocE(id) {
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url() ?>secretariat/doc_exits/detail/"+id+ "/" + $('.startDoc').val() + "/" + $('.endDoc').val());
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
    }
    function exportDoc(){
        window.open("<?php echo base_url() ?>secretariat/doc_exits/export/" + $('select[name=projectsDoc] option:selected').val() + "/" + $('.startDoc').val() + "/" + $('.endDoc').val()+ "/" + $('select[name=docode] option:selected').val());
    }
<?php if ($permit->access_delete == 1) { ?>
        function deleteDoc(id){
            $(this).each(function() {
                bootbox.confirm("Are you going to remove document ?", function(result) {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo base_url(); ?>secretariat/doc-control/delete/" + id,
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    $(".docData").load("<?php echo base_url() ?>secretariat/doc_exits/data/" + $('select[name=projectsDoc] option:selected').val() + "/" + $('.startDoc').val() + "/" + $('.endDoc').val()+ "/" + $('select[name=docode] option:selected').val());
                                }else{
                                    $(".msgDoc").html(json.msg);
                                }
                            }
                        });
                    }
                });
            });
        }
<?php } ?>
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>