<?php

?>

<div id="page-wrapper"<?php if ($template['page_preloader']) { echo ' class="page-loading"'; } ?>>

    <div class="preloader themed-background">
        <h1 class="push-top-bottom text-light text-center"><strong><?=$template['title']?></strong></h1>
        <div class="inner">
            <h3 class="text-light visible-lt-ie9 visible-lt-ie10"><strong>Loading..</strong></h3>
            <div class="preloader-spinner hidden-lt-ie9 hidden-lt-ie10"></div>
        </div>
    </div>
    
    <?php
        $page_classes = '';

        if ($template['header'] == 'navbar-fixed-top') {
            $page_classes = 'header-fixed-top';
        } else if ($template['header'] == 'navbar-fixed-bottom') {
            $page_classes = 'header-fixed-bottom';
        }

        if ($template['sidebar']) {
            $page_classes .= (($page_classes == '') ? '' : ' ') . $template['sidebar'];
        }

        if ($template['main_style'] == 'style-alt')  {
            $page_classes .= (($page_classes == '') ? '' : ' ') . 'style-alt';
        }

        if ($template['footer'] == 'footer-fixed')  {
            $page_classes .= (($page_classes == '') ? '' : ' ') . 'footer-fixed';
        }

        if (!$template['menu_scroll'])  {
            $page_classes .= (($page_classes == '') ? '' : ' ') . 'disable-menu-autoscroll';
        }

        if ($template['cookies'] === 'enable-cookies') {
            $page_classes .= (($page_classes == '') ? '' : ' ') . 'enable-cookies';
        }
    ?>
    <div id="page-container"<?php if ($page_classes) { echo ' class="' . $page_classes . '"'; } ?>>
        

        <!-- Main Sidebar -->
        <div id="sidebar">
            <!-- Wrapper for scrolling functionality -->
            <div id="sidebar-scroll">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Brand -->
                    <a href="<?=base_url() ?>" class="sidebar-brand">
                        <i class="gi gi-home"></i><span class="sidebar-nav-mini-hide"><strong><?= $template['name'] ?></strong></span>
                    </a>
                    <!-- END Brand -->

                    <!-- User Info -->
                    <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                        <div class="sidebar-user-avatar">
                            <a href="#">
                                <img src="<?= base_url() ?>public/img/placeholders/avatars/<?php if(!empty($this->session->userdata('avatar'))){ echo $this->session->userdata('avatar');}else{ echo "TEAM TINTAN.png";} ?>" alt="<?= $this->session->userdata('User');?>">
                            </a>
                        </div>
                        <div class="sidebar-user-name" title="<?= $this->session->userdata('User');?>"><?= $this->session->userdata('User');?></div>
                        <div class="sidebar-user-links">
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="<?= $this->session->userdata('User');?>"><i class="gi gi-user"></i></a>
                            <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.php in PHP version) -->
                            <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="Settings" onclick="$('#modal-user-settings').modal('show');"><i class="gi gi-cogwheel"></i></a>
                            <a href="<?= base_url() ?>logout" data-toggle="tooltip" data-placement="bottom" title="Đăng xuất"><i class="gi gi-exit"></i></a>
                        </div>
                    </div>
                    <!-- END User Info -->
					<!-- Theme Colors -->
					<!-- Change Color Theme functionality can be found in js/app.js - templateOptions() -->
					<ul class="sidebar-section sidebar-themes clearfix sidebar-nav-mini-hide">
						<!-- You can also add the default color theme
						<li class="active">
							<a href="javascript:void(0)" class="themed-background-dark-default themed-border-default" data-theme="default" data-toggle="tooltip" title="Default Blue"></a>
						</li>
						-->
						<li>
							<a href="javascript:void(0)" class="themed-background-dark-night themed-border-night" data-theme="css/themes/night.css" data-toggle="tooltip" title="Night"></a>
						</li>
						<li>
							<a href="javascript:void(0)" class="themed-background-dark-amethyst themed-border-amethyst" data-theme="css/themes/amethyst.css" data-toggle="tooltip" title="Amethyst"></a>
						</li>
						<li>
							<a href="javascript:void(0)" class="themed-background-dark-modern themed-border-modern" data-theme="css/themes/modern.css" data-toggle="tooltip" title="Modern"></a>
						</li>
						<li>
							<a href="javascript:void(0)" class="themed-background-dark-autumn themed-border-autumn" data-theme="css/themes/autumn.css" data-toggle="tooltip" title="Autumn"></a>
						</li>
						<li>
							<a href="javascript:void(0)" class="themed-background-dark-flatie themed-border-flatie" data-theme="css/themes/flatie.css" data-toggle="tooltip" title="Flatie"></a>
						</li>
						<li>
							<a href="javascript:void(0)" class="themed-background-dark-spring themed-border-spring" data-theme="css/themes/spring.css" data-toggle="tooltip" title="Spring"></a>
						</li>
						<li>
							<a href="javascript:void(0)" class="themed-background-dark-fancy themed-border-fancy" data-theme="css/themes/fancy.css" data-toggle="tooltip" title="Fancy"></a>
						</li>
						<li>
							<a href="javascript:void(0)" class="themed-background-dark-fire themed-border-fire" data-theme="css/themes/fire.css" data-toggle="tooltip" title="Fire"></a>
						</li>
						<li>
							<a href="javascript:void(0)" class="themed-background-dark-coral themed-border-coral" data-theme="css/themes/coral.css" data-toggle="tooltip" title="Coral"></a>
						</li>
						<li>
							<a href="javascript:void(0)" class="themed-background-dark-lake themed-border-lake" data-theme="css/themes/lake.css" data-toggle="tooltip" title="Lake"></a>
						</li>
						<li>
							<a href="javascript:void(0)" class="themed-background-dark-forest themed-border-forest" data-theme="css/themes/forest.css" data-toggle="tooltip" title="Forest"></a>
						</li>
						<li>
							<a href="javascript:void(0)" class="themed-background-dark-waterlily themed-border-waterlily" data-theme="css/themes/waterlily.css" data-toggle="tooltip" title="Waterlily"></a>
						</li>
						<li>
							<a href="javascript:void(0)" class="themed-background-dark-emerald themed-border-emerald" data-theme="css/themes/emerald.css" data-toggle="tooltip" title="Emerald"></a>
						</li>
						<li>
							<a href="javascript:void(0)" class="themed-background-dark-blackberry themed-border-blackberry" data-theme="css/themes/blackberry.css" data-toggle="tooltip" title="Blackberry"></a>
						</li>
					</ul>
					<!-- END Theme Colors -->
                    <?php if ($primary_nav) { ?>
                    <!-- Sidebar Navigation -->
                    <?php $acc_type = $this->session->userdata('role')  ?>
                    <ul class="sidebar-nav">
                        <?php foreach( $primary_nav as $key => $link ) {
                            $link_class = '';
                            $li_active  = '';
                            $menu_link  = '';
                            // Get 1st level link's vital info
                            if (isset($link['url']) and $link['url']) {
                                if ($link['url'] == 'header') {
                                    $url = 'header';
                                }else{
                                    $url = base_url().$link['url'];
                                }
                            }else{
                                $url = '';
                            }
                            $active     = (isset($link['url']) && ($template['active_page'] == $link['url'])) ? ' active' : '';
                            $icon       = (isset($link['icon']) && $link['icon']) ? '<i class="' . $link['icon'] . ' sidebar-nav-icon"></i>' : '';

                            // Check if the link has a submenu
                            if (isset($link['sub']) && $link['sub']) {
                                // Since it has a submenu, we need to check if we have to add the class active
                                // to its parent li element (only if a 2nd or 3rd level link is active)
                                foreach ($link['sub'] as $sub_link) {
                                    if (in_array($template['active_page'], $sub_link)) {
                                        $li_active = ' class="active"';
                                        break;
                                    }

                                    // 3rd level links
                                    if (isset($sub_link['sub']) && $sub_link['sub']) {
                                        foreach ($sub_link['sub'] as $sub2_link) {
                                            if (in_array($template['active_page'], $sub2_link)) {
                                                $li_active = ' class="active"';
                                                break;
                                            }
                                        }
                                    }
                                }

                                $menu_link = 'sidebar-nav-menu';
                            }

                            // Create the class attribute for our link
                            if ($menu_link || $active) {
                                $link_class = ' class="'. $menu_link . $active .'"';
                            }
                        ?>
                        <?php if ($url == 'header') { // if it is a header and not a link ?>
                            <?php if( in_array( $acc_type, $link['type_user'])){ ?>
                                <li class="sidebar-header">
                                    <?php if (isset($link['opt']) && $link['opt']) { // If the header has options set ?>
                                        <span class="sidebar-header-options clearfix"><?php echo $link['opt']; ?></span>
                                    <?php } ?>
                                    <span class="sidebar-header-title"><?php echo $link['name']; ?></span>
                                </li>
                            <?php } ?>
                        <?php } else { // If it is a link ?>
                            <?php if(in_array( $acc_type, $link['type_user'])){ //permission permission first menu here?>
                                <li<?php echo $li_active; ?>>
                                    <a href="<?php echo $url; ?>"<?php echo $link_class; ?>><?php if (isset($link['sub']) && $link['sub']) { // if the link has a submenu ?><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><?php } echo $icon; ?><span class="sidebar-nav-mini-hide"><?php echo $link['name']; ?></span></a>
                                    <?php if (isset($link['sub']) && $link['sub']) { // if the link has a submenu ?>
                                    <ul>
                                        <?php foreach ($link['sub'] as $sub_link) {
                                            $link_class = '';
                                            $li_active = '';
                                            $submenu_link = '';

                                            // Get 2nd level link's vital info
                                            $url        = (isset($sub_link['url']) && $sub_link['url']) ? base_url().$sub_link['url'] : '#';
                                            $active     = (isset($sub_link['url']) && ($template['active_page'] == $sub_link['url'])) ? ' active' : '';

                                            // Check if the link has a submenu
                                            if (isset($sub_link['sub']) && $sub_link['sub']) {
                                                // Since it has a submenu, we need to check if we have to add the class active
                                                // to its parent li element (only if a 3rd level link is active)
                                                foreach ($sub_link['sub'] as $sub2_link) {
                                                    if (in_array($template['active_page'], $sub2_link)) {
                                                        $li_active = ' class="active"';
                                                        break;
                                                    }
                                                }

                                                $submenu_link = 'sidebar-nav-submenu';
                                            }

                                            if ($submenu_link || $active) {
                                                $link_class = ' class="'. $submenu_link . $active .'"';
                                            }
                                        ?>
                                        <?php if(in_array( $acc_type, $sub_link['type_user'])){ //permission permission 2nd menu here?>
                                            <li<?php echo $li_active; ?>>
                                                <a href="<?php echo $url; ?>"<?php echo $link_class; ?>><?php if (isset($sub_link['sub']) && $sub_link['sub']) { ?><i class="fa fa-angle-left sidebar-nav-indicator"></i><?php } echo $sub_link['name']; ?></a>
                                                <?php if (isset($sub_link['sub']) && $sub_link['sub']) { ?>
                                                    <ul>
                                                        <?php foreach ($sub_link['sub'] as $sub2_link) {
                                                            // Get 3rd level link's vital info
                                                            $url    = (isset($sub2_link['url']) && $sub2_link['url']) ? base_url().$sub2_link['url'] : '#';
                                                            $active = (isset($sub2_link['url']) && ($template['active_page'] == $sub2_link['url'])) ? ' class="active"' : '';
                                                        ?>
                                                            <?php if(in_array( $acc_type, $sub2_link['type_user'])){ //permission permission 3rd menu here?>
                                                                <li>
                                                                    <a href="<?php echo $url; ?>"<?php echo $active ?>><?php echo $sub2_link['name']; ?></a>
                                                                </li>
                                                            <?php } //end permission 3rd menu here?>
                                                        <?php } ?>
                                                    </ul>
                                                <?php } ?>
                                            </li>
                                        <?php } //end permission 2nd menu here?>
                                        <?php } ?>
                                    </ul>
                                    <?php } ?>
                                </li>
                            <?php } //end permission first menu here?>
                        <?php } ?>
                        <?php } ?>
                    </ul>
                    <!-- END Sidebar Navigation -->
                    <?php } ?>

                    
                    <!-- END Sidebar Notifications -->
                </div>
                <!-- END Sidebar Content -->
            </div>
            <!-- END Wrapper for scrolling functionality -->
        </div>
        <!-- END Main Sidebar -->

        <!-- Main Container -->
        <div id="main-container">
          
            <header class="navbar<?php if ($template['header_navbar']) { echo ' ' . $template['header_navbar']; } ?><?php if ($template['header']) { echo ' '. $template['header']; } ?>">
                <?php if ( $template['header_content'] == 'horizontal-menu' ) { // Horizontal Menu Header Content ?>
                <!-- Navbar Header -->
                <div class="navbar-header">
                    <!-- Horizontal Menu Toggle + Alternative Sidebar Toggle Button, Visible only in small screens (< 768px) -->
                    <ul class="nav navbar-nav-custom pull-right visible-xs">
                        <li>
                            <a href="javascript:void(0)" data-toggle="collapse" data-target="#horizontal-menu-collapse">Menu</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');">
                                <i class="gi gi-share_alt"></i>
                                <span class="label label-primary label-indicator animation-floating">4</span>
                            </a>
                        </li>
                    </ul>
                    <!-- END Horizontal Menu Toggle + Alternative Sidebar Toggle Button -->

                    <!-- Main Sidebar Toggle Button -->
                    <ul class="nav navbar-nav-custom">
                        <li>
                            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                                <i class="fa fa-bars fa-fw"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- END Main Sidebar Toggle Button -->
                </div>
                <!-- END Navbar Header -->

                <!-- Alternative Sidebar Toggle Button, Visible only in large screens (> 767px) -->
                <ul class="nav navbar-nav-custom pull-right hidden-xs">
                    <li>
                        <!-- If you do not want the main sidebar to open when the alternative sidebar is closed, just remove the second parameter: App.sidebar('toggle-sidebar-alt'); -->
                        <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt', 'toggle-other');this.blur();">
                            <i class="gi gi-share_alt"></i>
                            <span class="label label-primary label-indicator animation-floating">4</span>
                        </a>
                    </li>
                </ul>
                <!-- END Alternative Sidebar Toggle Button -->

                <!-- Horizontal Menu + Search -->
                <div id="horizontal-menu-collapse" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="javascript:void(0)">Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Profile</a>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Settings <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)"><i class="fa fa-asterisk fa-fw pull-right"></i> General</a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-lock fa-fw pull-right"></i> Security</a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-user fa-fw pull-right"></i> Account</a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-magnet fa-fw pull-right"></i> Subscription</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-submenu">
                                    <a href="javascript:void(0)" tabindex="-1"><i class="fa fa-chevron-right fa-fw pull-right"></i> More Settings</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)" tabindex="-1">Second level</a></li>
                                        <li><a href="javascript:void(0)">Second level</a></li>
                                        <li><a href="javascript:void(0)">Second level</a></li>
                                        <li class="divider"></li>
                                        <li class="dropdown-submenu">
                                            <a href="javascript:void(0)" tabindex="-1"><i class="fa fa-chevron-right fa-fw pull-right"></i> More Settings</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:void(0)">Third level</a></li>
                                                <li><a href="javascript:void(0)">Third level</a></li>
                                                <li><a href="javascript:void(0)">Third level</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Contact <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)"><i class="fa fa-envelope-o fa-fw pull-right"></i> By Email</a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-phone fa-fw pull-right"></i> By Phone</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-left">
                        <div class="form-group">
                            <input type="text" disabled="" class="form-control" placeholder="...">
                        </div>
                    </form>
                </div>
                <!-- END Horizontal Menu + Search -->
                <?php } else { // Default Header Content  ?>
                <!-- Left Header Navigation -->
                <ul class="nav navbar-nav-custom">
                    <!-- Main Sidebar Toggle Button -->
                    <li>
                        <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                            <i class="fa fa-bars fa-fw"></i>
                        </a>
                    </li>
                    <!-- END Main Sidebar Toggle Button -->

                    <!-- Template Options -->
                    <!-- Change Options functionality can be found in js/app.js - templateOptions() -->
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="gi gi-settings"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-custom dropdown-options">
                            <li class="dropdown-header text-center">Header Style</li>
                            <li>
                                <div class="btn-group btn-group-justified btn-group-sm">
                                    <a href="javascript:void(0)" class="btn btn-primary" id="options-header-default">Light</a>
                                    <a href="javascript:void(0)" class="btn btn-primary" id="options-header-inverse">Dark</a>
                                </div>
                            </li>
                            <li class="dropdown-header text-center">Page Style</li>
                            <li>
                                <div class="btn-group btn-group-justified btn-group-sm">
                                    <a href="javascript:void(0)" class="btn btn-primary" id="options-main-style">Default</a>
                                    <a href="javascript:void(0)" class="btn btn-primary" id="options-main-style-alt">Alternative</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- END Template Options -->
                </ul>
                <!-- END Left Header Navigation -->
                <style type="text/css">
                    .show-time{
                        padding: 0;
                        float: left;
                        height: 50px;
                        line-height: 0;
                    }
                </style>
                <!-- Search Form -->
                <div class="show-time">
                    <h4 class="text-success" id="clock"></h4>
                     <span class="text-muted" id="date"></span>
                </div>
                <form action="#" method="post" class="navbar-form-custom">
        
                </form>
                <!-- END Search Form -->

                <!-- Right Header Navigation -->
                <ul class="nav navbar-nav-custom pull-right">
                    <!-- Alternative Sidebar Toggle Button -->
                    
                    <!-- END Alternative Sidebar Toggle Button -->

                    <!-- User Dropdown -->
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= base_url() ?>public/img/placeholders/avatars/<?php if(!empty($this->session->userdata('avatar'))){ echo $this->session->userdata('avatar');}else{ echo "TEAM TINTAN.png";} ?>" alt="avatar"> <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                            <li class="dropdown-header text-center"><?= $this->session->userdata('user');?></li>
                            
                            <li class="divider"></li>
                            <li>
                                <a href="<?= base_url()?>logout"><i class="gi gi-exit"></i> Đăng xuất</a>
                            </li>
                            
                        </ul>
                    </li>
                    <!-- END User Dropdown -->
                </ul>
                <!-- END Right Header Navigation -->
                <?php } ?>
            </header>
            <!-- END Header -->
