<div class="row">
    <div class="loadertabs col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-warning">
    <header class="panel-heading lead">
        <i class="fa fa-th-large"></i> Data Document Code
    </header>
    <div class="panel-body">
        <div class="table-responsive no-border" style="margin-top: -20px">
            <table class="table table-bordered table-striped datatable">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="width: 80px">No.</th>
                        <th class="text-center" style="width: 300px">Document Code Name</th>
                        <th class="text-center" style="width: 200px">Document Code Number</th>
                        <th class="text-center" style="width: 100px"><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($show as $i => $row) { ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td><?php echo ucwords($row->doc_control_letcode_name); ?></td>
                            <td class="text-center"><?php echo $row->doc_control_letcode_number; ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified">
                                    <a onclick="edit('<?php echo md5($row->doc_control_letcode_id); ?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                    <a <?php echo $row->child > 0 ? "disabled" : NULL; ?> onclick="erase('<?php echo md5($row->doc_control_letcode_id); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
</section>
<script type="text/javascript">
    $(".loadertab").hide();
    function erase(id) {
        $(this).each(function() {
            bootbox.confirm("Apakah anda akan menghapus Document Code ?", function(result) {
                if (result == true) {
                    $.ajax({
                        url: "<?php echo base_url() ?>secretariat/letcode/delete/" + id,
                        dataType: "JSON",
                        success: function(json) {
                            if (json.status == 1) {
                                $(".load_main_data").load('<?php echo base_url() ?>secretariat/letcode/table');
                                $("#load_sub_form").load('<?php echo base_url() ?>secretariat/letcode/form');
                            }
                        }
                    });
                }
            });
        });
    }
    function edit(id) {
        $("#load_sub_form").load("<?php echo base_url() ?>secretariat/letcode/form/" + id);
    }

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
