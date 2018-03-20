<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>

<section class="panel panel-warning">
    <header class="panel-heading lead">
        <i class="fa fa-th-large mg-r-sm"></i> BAPB MONITORING SUPPLIER
    </header>
    <div class="panel-body">
        <div style="margin-top: -20px" class="hidden-xs"></div>
        <div class="table-responsive no-border">
            <table class="table table-bordered table-striped datatable" style="min-width: 450px;">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="min-width: 50px">NO</th>
                        <th class="text-center" style="min-width: 130px">PROJECT CODE</th>
                        <th class="text-center" style="min-width: 190px">SUPPLIER/SUBCON CODE</th>
                        <th class="text-center" style="min-width: 200px">SUPPLIER/SUBCON</th>
                        <th class="text-center" style="min-width: 90px">BAPB</th>
                        <th class="text-center" style="min-width: 140px">INVOICE TOTAL</th>
                        <th class="text-center" style="min-width: 160px"><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($show as $i => $row) { ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td class="text-center"><?php echo $row->project_code; ?></td>
                            <td><?php echo!empty($row->actor_code) ? $row->actor_code : "<center>-</center>"; ?></td>
                            <td><?php echo strtoupper($row->actor_name); ?></td>
                            <td class="text-center"><?php echo rupiah($row->count_mog); ?></td>
                            <td><?php echo rupiah($row->invoice); ?></td>
                            <td class="text-center" style="width: 140px;">
                                <div class="btn-group btn-group-justified">
                                    <a role="button" onclick="onExcel('<?php echo md5($row->actor_id) ?>')" class="btn btn-xs btn-dark hidden-xs" title="Excel"><i class="fa fa-download"></i> <span class="mg-l-xs hidden-xs"> EXCEL</span></a>
                                    <a role="button" onclick="onPDF('<?php echo md5($row->actor_id) ?>')" class="btn btn-xs btn-warning" title="Print"><i class="fa fa-print"></i> <span class="mg-l-xs hidden-xs"> PRINT</span></a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 mg-t-md">
            <b>Note :</b> ( <i>TO SEE BAPB / SUPPLIER CAN USE EXCEL FEATURES / PRINT BUTTON</i> )
            <div class="col-xs-12 mg-t-md">
                <div class="col-sm-4 col-md-4 col-xs-6 hidden-xs">
                    <i class="fa fa-download mg-r-md btn btn-sm btn-dark" disabled></i> EXCEL
                </div>
                <div class="col-sm-4 col-md-4 col-xs-6">
                    <i class="fa fa-print mg-r-md btn btn-sm btn-warning" disabled></i> PRINT
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<script type="text/javascript">
    function detail(id) {
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url() ?>warehouse/report/apg/pdf_apg/" + id);
    }
    function onPDF(id) {
        var project = $('select[name=project] option:selected').val();
        window.open("<?php echo base_url('warehouse/asm/pdf_asm'); ?>" + '/' + project + '/' + id);
    }
    function onExcel(id) {
        var project = $('select[name=project] option:selected').val();
        window.open("<?php echo base_url('warehouse/export/asm_det'); ?>" + '/' + project + '/' + id);
    }
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
