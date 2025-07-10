<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'home';
$route['404_override'] = 'Errors/P_404';
$route['404.html'] = 'Errors/P_404';
$route['translate_uri_dashes'] = FALSE;

$route['otp-statistics.html'] = 'report/statistic';
$route['otp-statistics/get-grid.html'] = 'report/statistic/getgrid';
$route['otp-statistics/get-one.html'] = 'report/statistic/getone';
$route['otp-statistics/update.html'] = 'report/statistic/update';
$route['otp-statistics/delete.html'] = 'report/statistic/delete';
$route['otp-statistics/insert.html'] = 'report/statistic/insert';

$route['sms-report-detail.html'] = 'report/detail';
$route['sms-report-detail/get-grid.html'] = 'report/detail/getgrid';
$route['sms-report-detail/delete.html'] = 'report/detail/delete';

$route['otp-statistics-v2.html'] = 'report/statistic_v2';
$route['otp-statistics-v2/get-grid.html'] = 'report/statistic_v2/getgrid';
$route['otp-statistics-v2/get-one.html'] = 'report/statistic_v2/getone';
$route['otp-statistics-v2/update.html'] = 'report/statistic_v2/update';
$route['otp-statistics-v2/delete.html'] = 'report/statistic_v2/delete';
$route['otp-statistics-v2/insert.html'] = 'report/statistic_v2/insert';


$route['sms-report-detail-v2.html'] = 'report/detail_v2';
$route['sms-report-detail-v2/get-grid.html'] = 'report/detail_v2/getgrid';
$route['sms-report-detail-v2/delete.html'] = 'report/detail_v2/delete';
$route['sms-report-detail-v2/get-server.html'] = 'report/detail_v2/getDistinctServer';


//$route['report-detail-clone-ig.html'] = 'report/clone_ig';
//$route['report-detail-clone-ig/get-grid.html'] = 'report/clone_ig/getgrid';

$route['create-clone-table.html'] = 'settings/clone_table';
$route['create-clone-table/get-grid.html'] = 'settings/clone_table/getgrid';
$route['create-clone-table/add.html'] = 'settings/clone_table/add';
$route['create-clone-table/drop-data.html'] = 'settings/clone_table/drop';
$route['create-clone-table/delete-table.html'] = 'settings/clone_table/delete_all';
$route['create-clone-table/download-table.html'] = 'settings/clone_table/download_all';
$route['create-clone-table/download-table-buffer.html'] = 'settings/clone_table/download_all_buffer';

$route['clone/(:any)/report-detail.html'] = 'report/clonetb/detail';
$route['clone/(:any)/report-statistic.html'] = 'report/clonetb/statistic';
$route['clone/(:any)/report-statistic/get-grid.html'] = 'report/clonetb/getgrid_statistic';
$route['clone/(:any)/report-detail/get-grid.html'] = 'report/clonetb/getgrid_detail';
$route['clone/(:any)/report-detail/insert.html'] = 'report/clonetb/insert';

$route['serial.html'] = 'settings/insert_serial';
$route['serial/get-grid.html'] = 'settings/insert_serial/getgrid';
$route['serial/insert.html'] = 'settings/insert_serial/insert';
$route['serial/delete.html'] = 'settings/insert_serial/delete';
$route['serial/delete-all.html'] = 'settings/insert_serial/delete_all';

$route['user/get-data-dropdown.html'] = 'account/getDataDropdown';
$route['user/value-mapper.html'] = 'account/valueMapper';


$route['urls-download.html'] = 'utils/urls';
$route['urls-download/get-grid.html'] = 'utils/urls/getgrid';
$route['urls-download/add.html'] = 'utils/urls/add';
$route['urls-download/delete.html'] = 'utils/urls/delete';
$route['urls-download/get-one.html'] = 'utils/urls/getone';
$route['urls-download/update.html'] = 'utils/urls/update';
$route['test-isdn.html'] = 'utils/isdn/index';
$route['test-isdn/get-grid.html'] = 'utils/isdn/getgrid';
$route['test-isdn/get-rand-isdn.html'] = 'utils/isdn/getRandIsdn';
$route['test-isdn/check-update.html'] = 'utils/isdn/checkUpdate';

$route['management-link-test.html'] = 'link-test/management';
$route['management-link-test/get-grid.html'] = 'link-test/management/getgrid';
$route['management-link-test/add.html'] = 'link-test/management/add';
$route['management-link-test/delete.html'] = 'link-test/management/delete';
$route['management-link-test/get-one.html'] = 'link-test/management/getone';
$route['management-link-test/update.html'] = 'link-test/management/update';

//file backup route
$route['file-backup.html'] = 'File_backup/index';
$route['file-backup/get-grid.html'] = 'File_backup/getgrid';
$route['file-backup/download/(:any)'] = 'File_backup/download/$1';
$route['file-backup/view/(:any)'] = 'File_backup/view/$1';

