<div class="panel-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-6">
                    <table class="table">
                        <tr>
                            <td style="width: 120px">Doc Number</td>
                            <td>:</td>
                            <td><b><?php echo $doc['control']->doc_control_number; ?></b></td>
                        </tr>
                        <tr>
                            <td>Receive from</td>
                            <td>:</td>
                            <td><?php echo $doc['control']->actor_name; ?></td>
                        </tr>
                        <tr>
                            <td>Subject</td>
                            <td>:</td>
                            <td><?php echo ucwords($doc['control']->doc_control_case); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-6">
                    <table class="table">
                        <tr>
                            <td>Date</td>
                            <td>:</td>
                            <td><?php echo indo_date($doc['control']->doc_control_date, 1, 1); ?></td>
                        </tr>
                        <tr>
                            <td>Project</td>
                            <td>:</td>
                            <td><?php echo ucwords($doc['control']->project_name); ?></td>
                        </tr>
                        <tr>
                            <td>Operator</td>
                            <td>:</td>
                            <td><b><?php echo ucwords($doc['control']->employee_name); ?></b></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>:</td>
                            <td><?php echo $doc['control']->doc_control_desc; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <b><i class="fa fa-clipboard mg-r-sm"></i>Doc Attachments</b>
                    <a role="button" onclick="receipt()" class="pull-right hidden-xs btn btn-sm mg-l-sm btn-warning" style="margin-top:-5px"><i class="fa fa-print mg-r-sm"></i> Print Receipt</a>
                    <a href="<?php echo base_url() ?>secretariat/doc-control/download/<?php echo md5($doc['control']->doc_control_id); ?>" class="pull-right hidden-xs btn btn-sm mg-l-sm btn-info" style="margin-top:-5px"><i class="fa fa-download mg-r-sm"></i> Download All</a>
                    <hr/>
                    <div class="row">
                        <?php foreach ($doc['attach'] as $i => $row) { ?>
                            <div class="col-xs-3 mg-b-md ">
                                <div class="btn btn-default col-xs-12">
                                    <div style="width: 100%; overflow: hidden; height: 130px">
                                        <a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo base_url() ?>assets/files/doc_control/<?php echo $row->doc_attach_files ?>">
                                            <img style="width: 100%;" src="<?php echo base_url() ?>assets/files/doc_control/<?php echo $row->doc_attach_files ?>"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>                    
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<a role="button" onclick="backDocEx()" class="pull-left btn btn-sm btn-danger" style="margin-top:-5px"><i class="fa fa-reply"></i></a><i class="fa fa-search mg-r-md"></i>Detail Document Out');
    function receipt(){
        window.open("<?php echo base_url() ?>secretariat/doc-control/receipt/<?php echo md5($doc['control']->doc_control_id); ?>");
    }
    function backDocEx() {
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url() ?>secretariat/doc_exits");

    }
</script>