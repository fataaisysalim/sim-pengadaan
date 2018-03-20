<div class="panel-body ">
    <div>
        <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('msg') ?></div>
    </div>
    <div class="col-xs-4 uform"></div>
    <div class="col-xs-8">
        <div class="table-responsive no-border">
            <table class="table table-bordered table-striped datatable">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="width: 90px">No.</th>
                        <th class="text-center" style="width: 170px">Code Ct</th>
                        <th class="text-center" style="width: 90px"><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($show as $i => $row) { ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td><?php echo $row->code_ct_name; ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified">
                                    <a onclick="edit('<?php echo md5($row->code_ct_id); ?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                    <a <?php echo $row->child > 0 ? "disabled" : NULL; ?> onclick="erase('<?php echo md5($row->code_ct_id); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <b>Note :</b>
            <div class="row mg-t-md">
                <div class="col-sm-3 col-md-3">
                    <i class="fa fa-edit mg-r-md btn btn-sm btn-warning" disabled></i> Edit
                </div>
                <div class="col-sm-3 col-md-3">
                    <i class="fa fa-trash-o mg-r-md btn btn-sm btn-danger" disabled></i> Delete
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i>Data Equipment Unit');
    $(".uform").load("<?php echo base_url() . $url_access . 'code_ct/form' ?>");
    function erase(id) {
        $(this).each(function() {
            bootbox.confirm("Apakah anda akan menghapus kategori peralatan ?", function(result) {
                if (result == true) {
                    $.ajax({
                        url: "<?php echo base_url() . $url_access . 'code_ct/delete/' ?>" + id,
                        dataType: "JSON",
                        success: function(json) {
                            if (json.status == 1) {
                                $("#modal-contents").load("<?php echo base_url() . $url_access . 'code_ct' ?>");
                                $(".uform").load("<?php echo base_url() . $url_access . 'code_ct/form' ?>");
                            }
                        }
                    });
                }
            });
        });
    }
    function edit(id) {
        $(".uform").load("<?php echo base_url() . $url_access . 'code_ct/form/' ?>" + id);
    }

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
