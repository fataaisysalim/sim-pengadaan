<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-warning">
    <header class="panel-heading lead">
        <i class="fa fa-th-large mg-r-sm"></i> <?php echo strtoupper("Inventories Warehouse Administration (APG)"); ?>
    </header>
    <div class="panel-body">
        <div class="table-responsive no-border" style="margin-top: -10px">
            <table class="table table-bordered table-striped datatable" style="min-width: 450px;">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="min-width: 50px">NO.</th>
                        <th class="text-center" style="min-width: 150px">PROJECT CODE</th>
                        <th class="text-center" style="min-width: 200px">MATERIAL</th>
                        <th class="text-center" style="min-width: 130px">REST STOCK</th>
                        <th class="text-center" style="min-width: 140px">UPDATED</th>
                        <th class="text-center" style="min-width: 140px"><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($show as $i => $row) { ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td class="text-center"><?php echo strtoupper($row->project_code); ?></td>
                            <td><?php echo strtoupper($row->material_sub_name); ?></td>
                            <td class="text-center"><?php echo rupiah($row->stock_final_rest); ?></td>
                            <td><?php echo indo_date($row->stock_final_date, 1, 1); ?></td>
                            <td class="text-center" style="width: 160px;">
                                <div class="btn-group btn-group-justified">
                                    <a onclick="onExportDet('<?php echo md5($row->material_sub_id); ?>')" class="btn btn-xs btn-dark hidden-xs" title="EXCEL"><i class="fa fa-download"></i> <span class="mg-l-sm hidden-xs"> EXCEL</span></a>
                                    <a onclick="onPdf('<?php echo md5($row->material_sub_id); ?>')" class="btn btn-xs btn-warning" title="PRINT"><i class="fa fa-print"></i><span class="mg-l-sm hidden-xs"> PRINT</span></a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 mg-t-md">
            <b>NOTE : </b>( <i>TO SEE APG EACH MATERIAL, USE THE EXCEL / PRINT BUTTON</i> )
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
</section>
<script type="text/javascript">
    function detail(id) {
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url() ?>warehouse/report/apg/pdf_apg/" + id);
    }
    function onPdf(material) {
        var starts = $('.startas').val();
        var ends = $('.endas').val();
        var project = $('select[name=projectapg] option:selected').val();
        window.open("<?php echo base_url('warehouse/apg/pdf_apg'); ?>/" + material + "/" + project + '/' + starts + '/' + ends);
    }
    function onExportDet(param_material) {
        var starts = $('.startas').val();
        var ends = $('.endas').val();
        var project = $('select[name=projectapg] option:selected').val();
        window.open("<?php echo base_url('warehouse/export/apg_det'); ?>" + '/' + project + '/' + param_material + '/' + starts + '/' + ends);
    }
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
