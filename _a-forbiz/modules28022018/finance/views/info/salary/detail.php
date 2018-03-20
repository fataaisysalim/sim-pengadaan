<div class="panel-body">
    <div class="row">
        <?php
        $variable = array(
            'pay' => 0,
            'fare' => 0,
            'pph_cuts' => 0,
            'pph_nominal' => 0,
        );
        $total = array(
            'pay' => 0,
            'fare' => 0,
            'pph_cuts' => 0,
            'pph_nominal' => 0,
        );
        ?>
        <?php
        $variable['pay'] = $show->salary_pay;
//        $variable['fare'] = $show->salary_fare;

        foreach ($tax as $rowtax):
            $variable['pph_cuts'] = $rowtax->salary_tax_cuts;
            $variable['pph_nominal'] = $rowtax->salary_tax_nominal;
        endforeach;
        ?>
        <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-8">

                    <div class="table-responsive no-border">
                        <table class="table table-striped datatable">
                            <tr>
                                <td><?php echo ucwords('No. SP3'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td><?php echo $show->salary_number; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo ucwords('Foreman'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td><?php echo $show->actor_name; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo ucwords('Date'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td><?php echo indo_date($show->salary_date, 1); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo ucwords('Project'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td><?php echo strtoupper($show->project_name); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo ucwords('No. Evidence'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td><?php echo $show->salary_evidence; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo ucwords('Note'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td><?php echo $show->salary_note; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="table-responsive no-border">
                        <table class="table table-striped datatable">
                            <tr>
                                <td><?php echo ucwords('Foreman Fee'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td class="text-right"><?php echo rupiah($show->salary_pay); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo ucwords('Fee Opname'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td class="text-right"><?php echo rupiah($show->salary_opname); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo ucwords('Income Tax'); ?></td>
                                <td style="width: 10px;"> : </td>
                                <td class="text-right"><?php echo rupiah($show->salary_pkp); ?></td>
                            </tr>
                            <?php foreach ($tax as $rowtax): ?>
                                <tr>
                                    <td><?php echo $rowtax->tax_name . ' (' . $rowtax->salary_tax_cuts . ' %)'; ?></td>
                                    <td style="width: 10px;"> : </td>
                                    <td class="text-right"><?php echo rupiah(number_format($rowtax->salary_tax_nominal, 0, '', '.')); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<a role="button" onclick="back()" class="pull-left btn btn-sm btn-danger" style="margin-top:-5px"><i class="fa fa-reply"></i></a> <i class="fa fa-search mg-r-md"></i> Foreman Fee Detail');
    function back() {
        $(".modal-title").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
        $("#modal-contents").html("");
        $("#modal-contents").load("<?php echo base_url(); ?>finance/foreman-fee");
    }
</script>