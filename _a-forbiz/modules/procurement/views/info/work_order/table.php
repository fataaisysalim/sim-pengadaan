<div>
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('msg') ?></div>
</div>
<div class="col-xs-12">
    <div class="table-responsive no-border">
        <table class="table table-bordered table-striped datatable">
            <thead class="bg-dark" style="color: white;">
                <tr>
                    <th class="text-center" style="min-width: 50px;">NO</th>
                    <th class="text-center" style="min-width: 130px">SUBCON</th>
                    <th class="text-center" style="min-width: 130px">NUM CONTRACT</th>
                    <th class="text-center" style="min-width: 150px">WORK ORDER</th>
                    <th class="text-center" style="min-width: 130px">TOTAL CONTRACT</th>
                    <!--<th class="text-center" style="min-width: 130px">TOTAL PAID</th>-->
                    <th class="text-center" style="min-width: 20px">PROGRES</th>
                    <th class="text-center" style="min-width: 100px"><i class="fa fa-gear"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($show as $i => $row) { ?>
                    <tr>
                        <td class="text-center"><?php echo++$i; ?></td>
                        <td><?php echo ucwords($row->actor_name); ?></td>
                        <td><?php echo $row->work_order_number; ?></td>
                        <td><?php echo $row->work_order_desc; ?></td>  
                        <td><?php echo 'Rp ' . rupiah($row->work_order_contract); ?></td>
                        <!--<td><?php echo 'Rp ' . rupiah($row->total_paid); ?></td>-->
                        <td><?php echo $row->progres ? $row->progres . '%' : 0 . '%'; ?></td>
                        <td>
                <center>
                    <div class="btn-group btn-group-justified" style="width: 100px">
                        <a role="button" onclick="onExtraWO('<?php echo md5($row->work_order_id); ?>')" class="btn btn-xs btn-warning"><i class="fa fa-plus"></i></a>
                        <a role="button" onclick="onExport('<?php echo md5($row->project_id); ?>', '<?php echo md5($row->work_order_id); ?>')" class="btn btn-xs btn-info"><i class="fa fa-file-excel-o"></i></a>
                    </div>
                </center>
                </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12">
    <b>Note :</b>
    <div class="row mg-t-md">
        <div class="col-sm-3 col-md-3 col-xs-6">
            <i class="fa fa-plus mg-r-md btn btn-sm btn-warning" disabled></i> Extra Work
        </div>
        <div class="col-sm-3 col-md-3 col-xs-6">
            <i class="fa fa-file-excel-o mg-r-md btn btn-sm btn-info" disabled></i> Monitoring
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    function onExport(param, param2) {
        var projects = param;
        var workorder = param2;
        window.open("<?php echo base_url('finance/monitoring/export/detail'); ?>" + '/' + projects + '/' + workorder);

    }
    function onExtraWO(id) {
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-contents").html("");
        $("#modal-contents").load("<?php echo base_url($this->uri->segment(1)) ?>/wo-progress/extra/" + id);
    }
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
