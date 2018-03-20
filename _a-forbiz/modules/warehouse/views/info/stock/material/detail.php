<div class="panel-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive no-border">
                <table class="table table-bordered table-striped datatable" style="min-width: 450px;">
                    <thead class="bg-dark" style="color: white;">
                        <tr>
                            <th class="text-center" style="width: 80px">NO.</th>
                            <th class="text-center" style="min-width: 200px">DATE</th>
                            <th class="text-center" style="min-width: 150px">DESCRIPTION</th>
                            <th class="text-center" style="min-width: 100px">ENTRY</th>
                            <th class="text-center" style="min-width: 100px">EXIT</th>
                            <th class="text-center" style="min-width: 100px">REST</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($material as $number => $row) { ?>
                            <tr>
                                <td class="text-center"><?php echo $number + 1 ?></td>
                                <td class="text-center"><?php echo strtoupper(indo_date($row->stock_date, 1, 1)); ?></td>
                                <td><?php echo!empty($row->actor_name) ? strtoupper($row->actor_name) : "<center>-</center>" ?></td>
                                <td class="text-center"><?php echo!empty($row->stock_entry) ? $row->stock_entry : "-" ?></td>
                                <td class="text-center"><?php echo!empty($row->stock_exit) ? $row->stock_exit : "-" ?></td>
                                <td class="text-center"><?php echo!empty($row->stock_rest) ? $row->stock_rest : 0 ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".datepicker").datepicker();
    $(".modal-title").html('<a role="button" onclick="back_stock()" class="pull-left btn btn-sm btn-danger" style="margin-top:-5px"><i class="fa fa-reply"></i></a><a onclick="onExport()" role="button" class="btn btn-sm btn-dark pull-left mg-l-sm" style="margin-top:-5px"><i class="fa fa-download mg-r-sm"></i> EXCEL</a><i class="fa fa-search mg-r-md"></i> MATERIAL STOCK OF <b><?php echo strtoupper($mt->material_sub_name) ?></b>');
    $("#forme").submit(function() {
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url() ?>warehouse/stock/detail/material/<?php echo $item ?>");
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
    });
    function back_stock(id) {
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url() ?>warehouse/mt-stock");
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
    }

    function onExport() {
        var item = "<?php echo $item; ?>";

        window.open("<?php echo base_url('warehouse/export/stock_detail/material'); ?>" + '/' + item);
    }
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>