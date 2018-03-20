<div class="row">
    <div class="loadertab col-xs-12"><?php echo $this->session->flashdata('message') ?></div>
</div>
<section class="panel panel-warning">
    <header class="panel-heading lead">
        <i class="fa fa-th-large"></i> DATA PROJECT ACCESS
    </header>
    <div class="panel-body">
        <div style="margin-top: -20px" class="hidden-xs"></div>
        <div style="margin-top: -15px" class="visible-xs"></div>
        <div class="table-responsive no-border">
            <table class="table table-bordered table-striped datatable">
                <thead class="bg-dark" style="color: white;">
                    <tr>
                        <th class="text-center" style="min-width: 60px">NO.</th>
                        <th class="text-center" style="min-width: 250px">PROJECT</th>
                        <th class="text-center" style="min-width: 130px">NUMBER</th>
                        <th class="text-center" style="min-width: 100px">CODE</th>
                        <th class="text-center" style="width: 80px"><li class="fa fa-gear"></li></th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($show as $i => $row) { ?>
                        <tr>
                            <td class="text-center"><?php echo++$i; ?></td>
                            <td><?php echo strtoupper($row->project_name); ?></td>
                            <td><?php echo strtoupper($row->project_number); ?></td>
                            <td class="text-center"><?php echo strtoupper($row->project_code); ?></td>
                            <td>
                                <div class="btn-group btn-group-justified">
                                    <a data-toggle="modal" data-target=".bs-modal-sm" onclick="detail('<?php echo md5($row->project_id); ?>')" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <b>NOTE :</b>
            <div class="row mg-t-md">
                <div class="col-md-3">
                    <i class="fa fa-search mg-r-md btn btn-sm btn-primary" disabled></i> DETAIL
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function detail(id) {
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-content").html('');
        $("#modal-content").load("<?php echo base_url() ?>dashboard/project_access/detail/" + id);
    }

</script>
<script src="<?php echo base_url() ?>assets/js/datatables.js"></script>