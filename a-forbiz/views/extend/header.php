<header class="navbar navbar-fixed-top navbar-shadow">
    <a href="<?php echo base_url($sess['modactive']) ?>">
        <h4 class="pull-left mg-l-md"><b><?php echo $sess['system']->apps_name ?></b><span class="hidden-xs"> | <?php echo ucwords($sess['modactive']) ?></span><span class="visible-xs"><small>| <?php echo ucwords($sess['modactive']) ?></small></span> </h4> 
    </a>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown menu-merge">
            <a role="button" class="topbar-menu-toggle">
                <span class="fa fa-th-large"></span>
            </a>
        </li>
        <li class="menu-divider hidden-xs">
            <i style="border-right: 1px black solid"></i>
        </li>
<!--        <li class="dropdown menu-merge hidden-xs">
            <a role="button" class="ngFolarium" data-toggle="modal" data-target=".bs-modal-sm">
                <i class="fa fa-info-circle"></i>
            </a>
        </li>-->
        <li class="menu-divider">
            <i style="border-right: 1px black solid"></i>
        </li>
        <li class="dropdown menu-merge visible-xs">
            <a role="button" style="cursor: pointer" class="logout animated animated-short fadeInUp">
                <span class="fa fa-power-off"></span>
            </a>
        </li>
        <li class="dropdown menu-merge hidden-xs <?php echo!empty($account_m) ? "active" : null ?>">
            <a role="button" style="cursor: pointer;" class="dropdown-toggle fw600" data-toggle="dropdown"> 
                <div style="overflow:hidden; width: 40px; height: 40px; margin-top: -10px" class="pull-left avatar avatar-sm bordered-avatar img-circle">
                    <img style="min-width: 100%; height: 100%" src="<?php echo base_url() ?>assets/<?php echo!empty($sess['employee']->employee_photo) ? "image/" . $sess['employee']->employee_photo : "folarium/nonuser.png" ?>"> 
                </div>
                <span class="hidden-xs mg-l-sm mg-r-sm" style="padding-bottom: -100px"><?php echo ucwords($sess['employee']->employee_name) ?></span>
                <span class="caret caret-tp pull-right mg-t-sm"></span>
            </a>
            <ul class="dropdown-menu list-group dropdown-persist" role="menu">
                <li class="list-group-item <?php echo!empty($account_sm) ? "active" : null ?>">
                    <a href="<?php echo base_url() ?>dashboard/account" class="animated animated-short fadeInUp">
                        <span class="fa fa-gear"></span> Account</a>
                </li>
                <li class="list-group-item">
                    <a role="button" style="cursor: pointer" class="logout animated animated-short fadeInUp">
                        <span class="fa fa-power-off"></span> Logout 
                    </a>
                </li>
            </ul>
        </li>
        <li id="toggle_sidemenu_t">  
            <span class="fa fa-caret-up"></span>
        </li>
    </ul>
</header>
