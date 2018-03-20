<div class="panel-body">
    <div class="row">
        <div class="col-xs-12">
            <p class="" style="font-weight: bold; font-size:14px;">EQUIPMENT : <span style="font-weight: normal;"><?php echo strtoupper($eq->equipment_name); ?> <?php echo strtoupper($eq->equipment_type); ?></span></p>
            <p class="mg-b-sm" style="font-weight: bold; font-size:14px;">SUPPLIER/SUBKON : <span style="font-weight: normal;"><?php echo $actor->actor_name; ?></span></p>
            
            <div class="table-responsive no-border">
                <table class="table table-bordered table-striped datatable" style="min-width: 450px;">
                    <thead class="bg-dark" style="color: white;">
                        <tr>
                            <th class="text-center" style="width: 100px">NO.</th>
                            <th class="text-center" style="min-width: 120px">DATE</th>
                            <!--<th class="text-center" style="min-width: 150px">DESCRIPTION</th>-->
                            <th class="text-center" style="min-width: 80px">ENTRY</th>
                            <th class="text-center" style="min-width: 80px">OUT</th>
                            <th class="text-center" style="min-width: 80px">REST</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($equipment as $number => $row) { ?>
                            <tr>
                                <td class="text-center"><?php echo $number + 1 ?></td>
                                <td class="text-center"><?php echo strtoupper(indo_date($row->equipment_stock_date, 1, 1)); ?></td>
                                <!--<td><?php echo!empty($row->actor_name) ? strtoupper($row->actor_name) : "<center>-</center>" ?></td>-->
                                <td class="text-center"><?php echo!empty($row->equipment_stock_entry) ? $row->equipment_stock_entry : "-" ?></td>
                                <td class="text-center"><?php echo!empty($row->equipment_stock_exit) ? $row->equipment_stock_exit : "-" ?></td>
                                <td class="text-center"><?php echo!empty($row->equipment_stock_rest) ? $row->equipment_stock_rest : 0 ?></td>
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
    $(".modal-title").html('<a role="button" onclick="back_stock_eq()" class="pull-left btn btn-sm btn-danger" style="margin-top:-5px"><i class="fa fa-reply"></i></a><a onclick="onExport()" role="button" class="btn btn-sm btn-dark pull-left mg-l-sm" style="margin-top:-5px"><i class="fa fa-download mg-r-sm"></i>Excel</a><i class="fa fa-search mg-r-md"></i> EQUIPMENT STOCK DETAIL');;
    $("#forme").submit(function() {
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url() ?>warehouse/stock/detail/equipment/<?php echo $item ?>");
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        return false;
    });
    function back_stock_eq() {
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url() ?>warehouse/eq-stock");
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
    }
    
    function onExport() {
        var item = "<?php echo $item; ?>";
        var actors = "<?php echo $actors; ?>";
        window.open("<?php echo base_url('warehouse/export/stock_detail/equipment'); ?>" + '/' + item + '/' + actors);
    }
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>