<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-warning">
    <header class="panel-heading lead">
        <i class="fa fa-th-large"></i> Data Sender
    </header>
    <div class="panel-body">
        <div class="table-responsive no-border" style="margin-top: -20px">
            <table class="table table-bordered table-striped datatable" style="min-width: 450px;">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="width: 80px">No.</th>
                        <th class="text-center" style="width: 200px">Sender</th>
                        <th class="text-center" style="width: 90px">Code</th>
                        <th class="text-center" style="width: 100px">NPWP</th>
                        <th class="text-center" style="width: 100px">Telp</th>
                        <th class="text-center" style="width: 100px"><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($show as $i => $row) { ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td><?php echo ucwords($row->actor_name); ?></td>
                            <td><?php echo!empty($row->actor_code) ? $row->actor_code : "<center>-</center>"; ?></td>
                            <td><?php echo!empty($row->actor_identity) ? $row->actor_identity : "<center>-</center>"; ?></td>
                            <td><?php echo $row->actor_phone; ?></td>
                            <td class="text-center" style="width: 90px">
                                <div class="btn-group btn-group-justified">
                                    <a data-toggle="modal" data-target=".bs-modal-lg" onclick="detail('<?php echo md5($row->actor_id); ?>')" class="btn btn-xs btn-primary" title="Detail"><i class="fa fa-search"></i></a>
                                    <?php if ($sess['position_id'] == 1) { ?>
                                        <a onclick="edit('<?php echo md5($row->actor_id); ?>')" class="btn btn-xs btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a <?php echo $row->child > 0 ? "disabled" : NULL; ?> onclick="erase('<?php echo md5($row->actor_id); ?>')" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                    <?php } ?>
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
                    <i class="fa fa-search mg-r-md btn btn-sm btn-primary" disabled></i> Detail
                </div>
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
    function erase(id) {
        $(this).each(function() {
            bootbox.confirm("Apakah anda akan menghapus Sender ?", function(result) {
                if (result == true) {
                    $.ajax({
                        url: "<?php echo base_url() ?>secretariat/mkowneretc/delete/" + id,
                        dataType: "JSON",
                        success: function(json) {
                            if (json.status == 1) {
                                $(".load_main_data").load('<?php echo base_url() ?>secretariat/mkowneretc/table');
                            }
                        }
                    });
                }
            });
        });

    }
    function edit(id) {
        $("#load_sub_form").load("<?php echo base_url() ?>secretariat/mkowneretc/form/" + id);
    }

    function detail(id) {
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-contents").html('');
        $("#modal-contents").load("<?php echo base_url() ?>secretariat/mkowneretc/detail/" + id);
    }

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>
