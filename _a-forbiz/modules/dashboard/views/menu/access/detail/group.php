<div class="panel-body">
    <div class="row">
        <?php foreach ($show['modul'] as $x => $row) { ?>
            <?php if (count($show['menu'][$x]) > 0) { ?>
                <div class="col-sm-6">
                    <div class="table-responsive no-border">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-dark" style="color: white;">
                                <tr>
                                    <th class="text-center" style="min-width: 60px">POSITION</th>
                                    <th class="text-center" style="min-width: 150px"><i class="fa fa-th-large mg-r-sm"></i>MODUL <?php echo strtoupper($row->modul_name) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($show['menu'][$x] as $xy => $roz) {
                                    ?>
                                    <tr>
                                        <td class="text-left"><?php echo $roz->mod_menu_position ?></td>
                                        <td><?php echo $roz->mod_menu_name ?></td>
                                    </tr>
                                    <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-th-large mg-r-md"></i> Privilege <b><?php echo strtoupper($detail->users_position_name) ?></b>');
</script>
