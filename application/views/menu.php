<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <div class="menu-toggler sidebar-toggler">
                    <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN PAGE ACTIONS -->
            <div class="page-actions">
                <div class="btn-group">
                    <button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="hidden-sm hidden-xs">New&nbsp;</span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="<?php echo base_url('new_sensor')?>">
                                <i class="icon-docs"></i> Data Point / Sensor </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('new_collab')?>">
                                <i class="icon-share"></i>  Collaborative Sensor </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- END PAGE ACTIONS -->
            <!-- BEGIN PAGE TOP -->
            <div class="page-top">
                <!-- BEGIN HEADER SEARCH BOX -->
                <form class="search-form" action="page_general_search_2.html" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" placeholder="Search..." name="query">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <!-- END HEADER SEARCH BOX -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li class="separator hide"> </li>
                        <li class="separator hide"> </li>
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user dropdown-dark">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <span class="username username-hide-on-mobile"> <?php echo $userdata->username ?> </span>
                                <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="<?php echo base_url('profile') ?>">
                                        <i class="icon-user"></i> Profile </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('authentication/logout'); ?>">
                                        <i class="icon-key"></i> Logout </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END PAGE TOP -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
                    <li class="nav-item ">
                        <a href="<?php echo base_url('home') ?>" class="nav-link">
                            <i class="icon-home"></i>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->