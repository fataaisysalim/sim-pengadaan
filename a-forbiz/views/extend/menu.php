<aside id="sidebar_left" class="">
    <div class="sidebar-left-content nano-content">
        <ul class="nav sidebar-menu">
            <li class="<?php echo $active == null ? "active" : null ?> hidden-xs">
                <a href="<?php echo base_url($sess['modactive']) ?>">
                    <span class="fa fa-home"></span> <span class="sidebar-title">Home</span>
                </a>
            </li>
             <li class="<?php //echo $active == null ? "active" : null ?> hidden-xs">
                <a href="<?php echo base_url('dashboard/home') ?>">
                    <span class="sidebar-title">Dashboard</span>
                </a>
            </li>
            <?php foreach ($sess['menusys']['parent'] as $x => $row) { ?>
                <?php if ($row->mod_menu_production == 1) { ?>
                    <?php if ($row->mod_menu_production == $sess['development']) { ?>
                        <li class="<?php echo $active == $row->mod_menu_id ? "active" : null ?>">
                            <a <?php echo count($sess['menusys']['child'][$x]) > 0 ? 'class="accordion-toggle" role="button" style="cursor: pointer"' : "href='" . base_url($row->mod_menu_url) . "'" ?>>
                                <span class="<?php echo $row->mod_menu_icon ?>"></span> 
                                <span class="sidebar-title"><?php echo $row->mod_menu_name ?></span>
                                <?php if (count($sess['menusys']['child'][$x]) > 0) { ?>
                                    <span class="caret"></span>
                                <?php } ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <li class="<?php echo count($sess['menusys']['child'][$x]) < 1?$active == $row->mod_menu_id ? "active" : null:in_array($active,$sess['menusys']['crod'][$x])?"active":null; ?>">
                        <a <?php echo count($sess['menusys']['child'][$x]) > 0 ? 'class="accordion-toggle" role="button" style="cursor: pointer"' : "href='" . base_url($row->mod_menu_url) . "'" ?>>
                            <span class="<?php echo $row->mod_menu_icon ?>"></span> 
                            <span class="sidebar-title"><?php echo $row->mod_menu_name ?></span>
                            <?php if (count($sess['menusys']['child'][$x]) > 0) { ?>
                                <span class="caret"></span>
                            <?php }?>
                        </a>
                        <?php if (count($sess['menusys']['child'][$x]) > 0) { ?>
                            <ul class="nav sub-nav col-md-12" style="width: 250px">
                                <?php foreach ($sess['menusys']['child'][$x] as $xi => $roz) { ?>
                                    <li class="<?php echo $active == $roz->mod_menu_id ? "active" : null ?>">
                                        <?php if ($roz->mod_menu_display == "modal") { ?>
                                            <a role="button" onclick="loadModul('<?php echo $roz->mod_menu_url ?>')" data-toggle="modal" data-target=".bs-modal-lg">
                                                <span class="fa fa-chevron-right"></span> <span class="sidebar-title"><?php echo ucwords($roz->mod_menu_name) ?></span>
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url($roz->mod_menu_url) ?>">
                                                <span class="fa fa-chevron-right"></span> <span class="sidebar-title"><?php echo ucwords($roz->mod_menu_name) ?></span>
                                            </a>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</aside>
