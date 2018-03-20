<div class="row">
    <div class="col-xs-12 msgDoc"><?php echo $this->session->flashdata('messageDoc') ?></div>
</div>
<div class="table-responsive no-border mg-t-md">
    <table class="table table-bordered table-striped datatable">
        <thead class="bg-dark" style="color: white;">
            <tr>
                <th class="text-center" style="min-width:50px">No.</th>
                <th class="text-center" style="min-width:170px">Doc Number</th>
                <th class="text-center" style="min-width:150px">Send to</th>
                <th class="text-center" style="min-width:230px">Subject</th>
                <th class="text-center" style="min-width:120px">Date</th>
                <th class="text-center" style="min-width:140px"><i class="fa fa-gear"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($doc as $i => $rox) { ?>
                <tr>
                    <td class="text-center"><?php echo++$i; ?></td>
                    <td><?php echo $rox->doc_control_number ?></td>
                    <td><?php echo ucwords($rox->actor_name) ?></td>
                    <td><?php echo ucwords($rox->doc_control_case) ?></td>
                    <td class="text-center"><?php echo indo_date($rox->doc_control_date, 1) ?></td>
                    <td class="text-center">
                        <div class=" btn-group btn-group-justified">
                            <a role="button" title="Detail" onclick="detailDocE('<?php echo md5($rox->doc_control_id); ?>')" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></a>
                            <a role="button" title="Print Receipt" onclick="receipt('<?php echo md5($rox->doc_control_id); ?>')" class="btn btn-xs btn-dark"><i class="fa fa-print"></i></a>
                            <?php if ($permit->access_update == 1) { ?>
                                <a <?php echo date("Y-m-d", strtotime($rox->doc_control_date)) != date("Y-m-d") ? "disabled" : null ?> href="<?php echo base_url() ?>secretariat/doc-control/<?php echo md5($rox->doc_control_id); ?>" title="Edit" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                            <?php } ?>
                            <?php if ($permit->access_delete == 1) { ?>
                                <a <?php echo date("Y-m-d", strtotime($rox->doc_control_date)) != date("Y-m-d") ? "disabled" : null ?> role="button" title="Delete" onclick="deleteDoc('<?php echo md5($rox->doc_control_id); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
    function receipt(id){
        window.open("<?php echo base_url() ?>secretariat/doc-control/receipt/"+id);
    }
    $(".startDoc").val("<?php echo $starts ?>");
    $(".endDoc").val("<?php echo $ends ?>");
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>