<div>
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('msg') ?></div>
</div>
<div class="col-xs-12">
    <div class="table-responsive no-border">
        <table class="table table-bordered table-striped datatable">
            <thead class="bg-dark" style="color: white;">
                <tr>
                    <th class="text-center" style="width: 90px">No.</th>
                    <th class="text-center" style="width: 170px">Subcon</th>
                    <th class="text-center" style="width: 120px">No.WO  </th>
                    <th class="text-center" style="width: 170px">Work Order</th>
                    <th class="text-center" style="width: 120px"><i class="fa fa-gear"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($show as $i => $row) { ?>
                    <tr>
                        <td class="text-center"><?php echo++$i; ?></td>
                        <td><?php echo ucwords($row->actor_name); ?></td>
                        <td><?php echo $row->work_order_number; ?></td>
                        <td><?php echo $row->work_order_desc; ?></td>  
                        <td class="text-center">
                            <div class="btn-group btn-group-justified">
                                <a role="button" onclick="detailWO('<?php echo md5($row->work_order_id); ?>')" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".bs-modal-sm"><i class="fa fa-search"></i></a>
                                <?php if ($permit->access_update == 1) { ?>
                                    <a role="button" onclick="editWO('<?php echo md5($row->work_order_id); ?>')" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                <?php } ?>
                                <?php if ($permit->access_delete == 1) { ?>
                                    <a  role="button" onclick="removeWO('<?php echo md5($row->work_order_id); ?>')" class="btn btn-xs btn-danger" <?php echo $row->child != 0 ? "disabled" : null ?>><i class="fa fa-trash-o"></i></a>
                                <?php } ?>
                            </div>
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
        <?php if ($permit->access_update == 1) { ?>
            <div class="col-sm-3 col-md-3">
                <i class="fa fa-edit mg-r-md btn btn-sm btn-warning" disabled></i> Edit
            </div>
        <?php } ?>
        <?php if ($permit->access_delete == 1) { ?>
            <div class="col-sm-3 col-md-3">
                <i class="fa fa-trash-o mg-r-md btn btn-sm btn-danger" disabled></i> Delete
            </div>
        <?php } ?>
    </div>
</div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i>Data Equipment Unit');
<?php if ($permit->access_delete == 1) { ?>
        function removeWO(id) {
            $(this).each(function() {
                bootbox.confirm("<i class='fa fa-warning mg-r-sm'></i>Are you going to remove work order  ?", function(result) {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo base_url() ?>procurement/work-order/delete/" + id,
                            dataType: "JSON",
                            success: function(json) {
                                if (json.status == 1) {
                                    $(".load_main_form").load("<?php echo base_url() ?>procurement/work-order/form");
                                    $(".load_main_data").load('<?php echo base_url() ?>procurement/work-order/table/'+$('input[name=start]').val()+"/"+$('input[name=end]').val()+"/"+$('select[name=projectm] option:selected').val());
                                }
                            }
                        });
                    }
                });
            });
        }
<?php } ?>
<?php if ($permit->access_update == 1) { ?>
        function editWO(id) {
            $(".load_main_form").load("<?php echo base_url() ?>procurement/work-order/form/"+id);
        }
<?php } ?>
    function detailWO(id){
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-content").html("");
        $("#modal-content").load("<?php echo base_url() ?>procurement/work-order/detail/"+id);
    }
</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
