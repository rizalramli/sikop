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
$route['anggota'] = 'anggota/tabel_anggota';
$route['input_anggota'] = 'anggota/input_anggota';

$route['rekap'] = 'rekap/tabel_rekap';
$route['chart'] = 'rekap/chart';

$route['user'] = 'user/tabel_user';
$route['input_user'] = 'user/input_user';

$route['pinjaman'] = 'pinjaman/tabel_pinjaman';
$route['input_pinjaman'] = 'pinjaman/input_pinjaman';

$route['simpanan_pokok'] = 'simpanan/tabel_simpanan_pokok';
$route['simpanan_wajib'] = 'simpanan/tabel_simpanan_wajib';
$route['simpanan_sukarela'] = 'simpanan/tabel_simpanan_sukarela';
$route['input_simpanan_wajib'] = 'simpanan/input_simpanan_wajib';
$route['input_simpanan_sukarela'] = 'simpanan/input_simpanan_sukarela';
$route['print_sukarela'] = 'simpanan/print_sukarela';
$route['ambil_sukarela'] = 'simpanan/ambil_sukarela';

$route['print_angsuran'] = 'pinjaman/angsuran';

$route['kategori_simpanan'] = 'kategori_simpanan/tabel_kategori_simpanan';
$route['input_kategori_simpanan'] = 'kategori_simpanan/input_kategori_simpanan';

$route['kategori_pinjaman'] = 'kategori_pinjaman/tabel_kategori_pinjaman';
$route['input_kategori_pinjaman'] = 'kategori_pinjaman/input_kategori_pinjaman';

$route['dashboard'] = 'login/dashboard';

$route['print'] = 'welcome';

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
