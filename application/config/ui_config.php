<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * config.php
 *
 * Author: pixelcave
 *
 * Configuration file. It contains variables used in the template as well as the primary navigation array from which the navigation is created
 *
 */

/* Template variables */
$config['template'] = array(
	'name' => !empty($_ENV['APP_NAME']) ? $_ENV['APP_NAME'] : "Hao Nguyen",
	'version' => !empty($_ENV['APP_VERSION']) ? $_ENV['APP_VERSION'] : "1.0",
	'author' => !empty($_ENV['APP_AUTHOR']) ? $_ENV['APP_AUTHOR'] : "hao.nguyen",
	'robots' => 'noindex, nofollow',
	'title' => !empty($_ENV['APP_TITLE']) ? $_ENV['APP_TITLE'] : "hao.nguyen developer",
	'description' => !empty($_ENV['APP_DESC']) ? $_ENV['APP_DESC'] : "hao.nguyen developer",
	// true                     enable page preloader
	// false                    disable page preloader
	'page_preloader' => true,
	// true                     enable main menu auto scrolling when opening a submenu
	// false                    disable main menu auto scrolling when opening a submenu
	'menu_scroll' => true,
	// 'navbar-default'         for a light header
	// 'navbar-inverse'         for a dark header
	'header_navbar' => 'navbar-default',
	// ''                       empty for a static layout
	// 'navbar-fixed-top'       for a top fixed header / fixed sidebars
	// 'navbar-fixed-bottom'    for a bottom fixed header / fixed sidebars
	'header' => '',
	// ''                                               for a full main and alternative sidebar hidden by default (> 991px)
	// 'sidebar-visible-lg'                             for a full main sidebar visible by default (> 991px)
	// 'sidebar-partial'                                for a partial main sidebar which opens on mouse hover, hidden by default (> 991px)
	// 'sidebar-partial sidebar-visible-lg'             for a partial main sidebar which opens on mouse hover, visible by default (> 991px)
	// 'sidebar-mini sidebar-visible-lg-mini'           for a mini main sidebar with a flyout menu, enabled by default (> 991px + Best with static layout)
	// 'sidebar-mini sidebar-visible-lg'                for a mini main sidebar with a flyout menu, disabled by default (> 991px + Best with static layout)
	// 'sidebar-alt-visible-lg'                         for a full alternative sidebar visible by default (> 991px)
	// 'sidebar-alt-partial'                            for a partial alternative sidebar which opens on mouse hover, hidden by default (> 991px)
	// 'sidebar-alt-partial sidebar-alt-visible-lg'     for a partial alternative sidebar which opens on mouse hover, visible by default (> 991px)
	// 'sidebar-partial sidebar-alt-partial'            for both sidebars partial which open on mouse hover, hidden by default (> 991px)
	// 'sidebar-no-animations'                          add this as extra for disabling sidebar animations on large screens (> 991px) - Better performance with heavy pages!
	'sidebar' => 'sidebar-partial sidebar-visible-lg',
	// ''                       empty for a static footer
	// 'footer-fixed'           for a fixed footer
	'footer' => 'footer-fixed',
	// ''                       empty for default style
	// 'style-alt'              for an alternative main style (affects main page background as well as blocks style)
	'main_style' => 'style-alt',
	// ''                           Disable cookies (best for setting an active color theme from the next variable)
	// 'enable-cookies'             Enables cookies for remembering active color theme when changed from the sidebar links (the next color theme variable will be ignored)
	'cookies' => 'enable-cookies',
	// 'night', 'amethyst', 'modern', 'autumn', 'flatie', 'spring', 'fancy', 'fire', 'coral', 'lake',
	// 'forest', 'waterlily', 'emerald', 'blackberry' or '' leave empty for the Default Blue theme
	'theme' => 'flatie',
	// ''                       for default content in header
	// 'horizontal-menu'        for a horizontal menu in header
	// This option is just used for feature demostration and you can remove it if you like. You can keep or alter header's content in page_head.php
	'header_content' => '',
	// 'active_page' => substr(empty(uri_string()) ? uri_string() : '/', 1),
);

/* Primary navigation array (the primary navigation will be created automatically based on this array, up to 3 levels deep) */
$config['primary_nav'] = array(
	array(
		'name' => 'Trang chủ',
		'url' => 'home',
		'type_user' => [0, 1, 2],
		'icon' => 'gi gi-home',
		'description' => 'Trang chủ'
	),

	array(
		'name' => 'Utils',
		'opt' => '',
		'type_user' => [0, 1, 2],
		'url' => 'header',
		'description' => 'Utils'
	),
	array(
		'name' => 'Urls download',
		'url' => 'urls-download.html',
		'type_user' => [0, 1, 2],
		'icon' => 'fad fa-link',
		'description' => 'Urls download'
	),
	array(
		'name' => 'Test Số',
		'url' => 'test-isdn.html',
		'type_user' => [ 1, 2],
		'icon' => 'fad fa-link',
		'description' => 'Test Số'
	),
	array(
		'name' => 'Reports',
		'opt' => '',
		'type_user' => [0, 1, 2],
		'url' => 'header',
		'description' => 'Reports'
	),
	array(
		'name' => 'OTP statistics',
		'url' => 'otp-statistics.html',
		'type_user' => [0, 1, 2],
		'icon' => 'fas fa-chart-line',
		'description' => 'OTP statistics'
	),
	array(
		'name' => 'SMS report (all)',
		'url' => 'sms-report-detail.html',
		'type_user' => [0, 1, 2],
		'icon' => 'far fa-list-alt',
		'description' => 'SMS Report detail'
	),
	array(
		'name' => 'OTP statistics V2',
		'url' => 'otp-statistics-v2.html',
		'type_user' => [0, 1, 2],
		'icon' => 'fas fa-chart-line',
		'description' => 'OTP statistics V2'
	),
	array(
		'name' => 'SMS report V2',
		'url' => 'sms-report-detail-v2.html',
		'type_user' => [0, 1, 2],
		'icon' => 'far fa-list-alt',
		'description' => 'SMS Report detail version 2'
	)
);
