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


$route['Admin'] = 'Admin/Admin/login';
$route['Admin/login'] = 'Admin/Admin/login';
$route['Admin/logout'] = 'Admin/Admin/logout';
$route['Admin/cek_login'] = 'Admin/Admin/cek_login';

$route['Admin/user_log'] = 'Admin/Admin/change_content/1/11';
$route['Admin/sum_exec'] = 'Admin/Admin/change_content/1/12';
$route['Admin/list_file'] = 'Admin/Admin/change_content/1/13';
$route['Admin/dt_mhs'] = 'Admin/Admin/change_content/7/72';
$route['Admin/dt_konversi'] = 'Admin/Admin/change_content/7/73';
$route['Admin/dt_stat_mhs'] = 'Admin/Admin/change_content/7/74';
$route['Admin/dt_khs_mhs'] = 'Admin/Admin/change_content/7/75';
$route['Admin/dt_trans_mhs'] = 'Admin/Admin/change_content/7/76';

$route['Admin/dt_dosen'] = 'Admin/Admin/change_content/8/81';
$route['Admin/dt_mtk'] = 'Admin/Admin/change_content/9/91';

$route['Admin/gambarchart'] = 'Admin/Sum_exec/gambarchart';
$route['Admin/filter_log'] = 'Admin/Lst_lgn/filter_log';

$route['Admin/get_lst_file'] = 'Admin/Lst_file/get_lst_file';
$route['Admin/delete_selected_file'] = 'Admin/Lst_file/delete_selected_file';
$route['Admin/delete_file'] = 'Admin/Lst_file/delete_file';
$route['Admin/select_file'] = 'Admin/Lst_file/select_file';
$route['Admin/download_file/(:any)'] = 'Admin/Lst_file/download_file/$1';

$route['Admin/get_dt_mhs'] = 'Admin/Mahasiswa/Mahasiswa/get_dt_mhs';
$route['Admin/frm_dt_mhs'] = 'Admin/Mahasiswa/Mahasiswa/frm_dt_mhs';
$route['Admin/insert_dt_mhs'] = 'Admin/Mahasiswa/Mahasiswa/insert_dt_mhs';
$route['Admin/save_dt_mhs'] = 'Admin/Mahasiswa/Mahasiswa/save_dt_mhs';
$route['Admin/view_dt_mhs'] = 'Admin/Mahasiswa/Mahasiswa/view_dt_mhs';
$route['Admin/delete_dt_mhs'] = 'Admin/Mahasiswa/Mahasiswa/delete_dt_mhs';

$route['Admin/get_dt_konversi'] = 'Admin/Mahasiswa/Konversi/get_dt_konversi';
$route['Admin/edt_dt_pindahan'] = 'Admin/Mahasiswa/Konversi/edt_dt_pindahan';
$route['Admin/add_mtk_konversi'] = 'Admin/Mahasiswa/Konversi/add_mtk_konversi';
$route['Admin/edit_mtk_konversi'] = 'Admin/Mahasiswa/Konversi/edit_mtk_konversi';
$route['Admin/del_mtk_konversi'] = 'Admin/Mahasiswa/Konversi/del_mtk_konversi';
$route['Admin/pilih_mtk_konversi'] = 'Admin/Mahasiswa/Konversi/pilih_mtk_konversi';
$route['Admin/nilai_mtk_konversi'] = 'Admin/Mahasiswa/Konversi/nilai_mtk_konversi';
$route['Admin/insert_mtk_konversi'] = 'Admin/Mahasiswa/Konversi/insert_mtk_konversi';
$route['Admin/update_mtk_konversi'] = 'Admin/Mahasiswa/Konversi/update_mtk_konversi';
$route['Admin/delete_mtk_konversi'] = 'Admin/Mahasiswa/Konversi/delete_mtk_konversi';
$route['Admin/export_mtk_konversi'] = 'Admin/Mahasiswa/Konversi/export_mtk_konversi';

$route['Admin/filter_stat_mhs'] = 'Admin/Mahasiswa/Stat_mhs/filter_stat_mhs';
$route['Admin/frm_add'] = 'Admin/Mahasiswa/Stat_mhs/frm_add';
$route['Admin/insert_stat_mhs'] = 'Admin/Mahasiswa/Stat_mhs/insert_stat_mhs';
$route['Admin/frm_edit'] = 'Admin/Mahasiswa/Stat_mhs/frm_edit';
$route['Admin/save_stat_mhs'] = 'Admin/Mahasiswa/Stat_mhs/save_stat_mhs';
$route['Admin/frm_del'] = 'Admin/Mahasiswa/Stat_mhs/frm_del';
$route['Admin/delete_stat_mhs'] = 'Admin/Mahasiswa/Stat_mhs/delete_stat_mhs';
$route['Admin/import'] = 'Admin/Mahasiswa/Stat_mhs/import';
$route['Admin/cetak/(:any)'] = 'Admin/Mahasiswa/Stat_mhs/ctk_excel/$1';

$route['Admin/hsl_studi'] = 'Admin/Mahasiswa/Khs_mhs/hsl_studi';
$route['Admin/ambilkelas'] = 'Admin/Mahasiswa/Khs_mhs/ambilkelas';
$route['Admin/ambilnm'] = 'Admin/Mahasiswa/Khs_mhs/ambilnm';

$route['Admin/transkrip'] = 'Admin/Mahasiswa/Trans_mhs/transkrip';
$route['Admin/transambilkelas'] = 'Admin/Mahasiswa/Trans_mhs/ambilkelas';
$route['Admin/transambilnm'] = 'Admin/Mahasiswa/Trans_mhs/ambilnm';
$route['Admin/trans_ctk_excel/(:any)'] = 'Admin/Mahasiswa/Trans_mhs/ctk_excel/$1';
$route['Admin/trans_ctk_pdf'] = 'Admin/Mahasiswa/Trans_mhs/ctk_pdf';


$route['Admin/get_dt_dosen'] = 'Admin/Dosen/Dosen/get_dt_dosen';
$route['Admin/frm_dt_dosen'] = 'Admin/Dosen/Dosen/frm_dt_dosen';
$route['Admin/insert_dt_dosen'] = 'Admin/Dosen/Dosen/insert_dt_dosen';
$route['Admin/save_dt_dosen'] = 'Admin/Dosen/Dosen/save_dt_dosen';
$route['Admin/view_dt_dosen'] = 'Admin/Dosen/Dosen/view_dt_dosen';
$route['Admin/delete_dt_dosen'] = 'Admin/Dosen/Dosen/delete_dt_dosen';


$route['Admin/get_dt_mtk'] = 'Admin/Kurikulum/Matakuliah/get_dt_mtk';
$route['Admin/frm_dt_mtk'] = 'Admin/Kurikulum/Matakuliah/frm_dt_mtk';
$route['Admin/insert_dt_mtk'] = 'Admin/Kurikulum/Matakuliah/insert_dt_mtk';
$route['Admin/save_dt_mtk'] = 'Admin/Kurikulum/Matakuliah/save_dt_mtk';
$route['Admin/view_dt_mtk'] = 'Admin/Kurikulum/Matakuliah/view_dt_mtk';
$route['Admin/delete_dt_mtk'] = 'Admin/Kurikulum/Matakuliah/delete_dt_mtk';