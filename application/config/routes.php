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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['Admin'] = 'Admin/login';
$route['Admin/admin_user_log'] = 'Admin/change_content/1/11';
$route['Admin/admin_sum_exec'] = 'Admin/change_content/1/12';
$route['Admin/admin_list_file'] = 'Admin/change_content/1/13';
$route['Admin/admin_dt_mhs'] = 'Admin/change_content/7/72';
$route['Admin/admin_dt_stat_mhs'] = 'Admin/change_content/7/74';
$route['Admin/admin_dt_dosen'] = 'Admin/change_content/8/81';
$route['Admin/admin_dt_mtk'] = 'Admin/change_content/9/91';


$route['Admin/gambarchart'] = 'Admin_menu_dashboard/gambarchart';
$route['Admin/get_lst_file'] = 'Admin_menu_dashboard/get_lst_file';
$route['Admin/delete_selected_file'] = 'Admin_menu_dashboard/delete_selected_file';
$route['Admin/delete_file'] = 'Admin_menu_dashboard/delete_file';
$route['Admin/select_file'] = 'Admin_menu_dashboard/select_file';

$route['Admin/get_dt_mhs'] = 'Admin_menu_mhs/get_dt_mhs';
$route['Admin/frm_dt_mhs'] = 'Admin_menu_mhs/frm_dt_mhs';
$route['Admin/insert_dt_mhs'] = 'Admin_menu_mhs/insert_dt_mhs';
$route['Admin/save_dt_mhs'] = 'Admin_menu_mhs/save_dt_mhs';
$route['Admin/view_dt_mhs'] = 'Admin_menu_mhs/view_dt_mhs';
$route['Admin/delete_dt_mhs'] = 'Admin_menu_mhs/delete_dt_mhs';

$route['Admin/filter_stat_mhs'] = 'Admin_menu_mhs/filter_stat_mhs';
$route['Admin/frm_add'] = 'Admin_menu_mhs/frm_add';
$route['Admin/insert_stat_mhs'] = 'Admin_menu_mhs/insert_stat_mhs';

$route['Admin/get_dt_dosen'] = 'Admin_menu_dsn/get_dt_dosen';
$route['Admin/frm_dt_dosen'] = 'Admin_menu_dsn/frm_dt_dosen';
$route['Admin/insert_dt_dosen'] = 'Admin_menu_dsn/insert_dt_dosen';
$route['Admin/save_dt_dosen'] = 'Admin_menu_dsn/save_dt_dosen';
$route['Admin/view_dt_dosen'] = 'Admin_menu_dsn/view_dt_dosen';
$route['Admin/delete_dt_dosen'] = 'Admin_menu_dsn/delete_dt_dosen';

$route['Admin/get_dt_mtk'] = 'Admin_menu_mtk/get_dt_mtk';
$route['Admin/frm_dt_mtk'] = 'Admin_menu_mtk/frm_dt_mtk';
$route['Admin/insert_dt_mtk'] = 'Admin_menu_mtk/insert_dt_mtk';
$route['Admin/save_dt_mtk'] = 'Admin_menu_mtk/save_dt_mtk';
$route['Admin/view_dt_mtk'] = 'Admin_menu_mtk/view_dt_mtk';
$route['Admin/delete_dt_mtk'] = 'Admin_menu_mtk/delete_dt_mtk';