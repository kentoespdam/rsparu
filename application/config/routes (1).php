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
$route['default_controller'] = 'Main_C';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//API Master Data
$route['API/provinsi'] = 'API/ProvinsiController/showAll';
$route['API/kabupaten/kdProv/(:any)'] = 'API/KabupatenController/showAll/$1';
$route['API/kecamatan/kdKab/(:any)'] = 'API/KecamatanController/showAll/$1';
$route['API/kecamatan/kdKab'] = 'API/KecamatanController/showAll/null';
$route['API/kelurahan/kdKec/(:any)'] = 'API/KelurahanController/showAll/$1';
$route['API/kelurahan/kdKec'] = 'API/KelurahanController/showAll/null';
$route['API/kelompok'] = 'API/KelompokController/showAll';
$route['API/Agama'] = 'API/AgamaController/showAll';
$route['API/Pendidikan'] = 'API/PendidikanController/showAll';
$route['API/Tujuan'] = 'API/TujuanController/showAll';

//API Pendaftaran
$route['API/daftar/pasien/old'] = 'API/PasienOldController/findData';
$route['API/daftar/pasien/norm/old'] = 'API/PasienOldController/findNorm';
$route['API/daftar/pasien/new'] = 'API/PasienNewController/findData';
$route['API/daftar/pasien/norm/old/new'] = 'API/PasienNewController/findNormOld';
$route['API/daftar/pasien/norm/new'] = 'API/PasienNewController/findNorm';

//Rest Antrian
$route['API/panggil/Loket'] = 'API/AntreanOldController/showLoket';
$route['API/panggil/Suara'] = 'API/AntreanOldController/vSound';

$route['API/panggil/tmp/loket'] = 'API/PanggilController/tmpPanggil';
$route['API/panggil/tmp/addTmp/noAntri/(:num)/loket/(:num)'] = 'API/PanggilController/addTmp/$1/$2';
$route['API/panggil/tmp/updTmp/noAntri/(:num)/loket/(:num)/panggil/(:any)'] = 'API/PanggilController/updTmp/$1/$2/$3';
$route['API/panggil/tmp/rmTmp/noAntri/(:num)'] = 'API/PanggilController/rmTmp/$1';
$route['API/panggil/tmp/gantiHari'] = 'API/PanggilController/gantiHari';
$route['API/panggil/tmp/lewati/(:num)/tanggal/(:any)'] = 'API/PanggilController/lewati/$1/$2';

$route['API/panggil/tmp/Poli'] = 'API/PanggilPoliController/tmpPanggil';

//Display Antrian
$route['Display/(:num)']='Display/Display_c/index/$1';
$route['API/tunggu/pendaftaran']='Display/TungguPendaftaran_c';

$route['Login'] = 'Akun/Login_C';
$route['DoLogin'] = 'Akun/Login_C/do_login';
$route['DoLogout'] = 'Akun/Login_C/do_logout';

//Dasboard
$route['Dasboard']='Dasboard/Dasboard_C';
$route['Grafik/Kunjungan']='Dasboard/DataGrafik_C/g_kunj';

//Pendaftaran
//Form
$route['Pendaftaran'] = 'Form/Pendaftaran_C';
$route['Pendaftaran/Simpan'] = 'Form/Pendaftaran_C/simpan';
$route['Pendaftaran/Update'] = 'Form/Pendaftaran_C/update';
$route['Pendaftaran/Update/Kunjungan'] = 'Form/Pendaftaran_C/updateKunjungan';
$route['Pendaftaran/Delete/Kunjungan'] = 'Form/Pendaftaran_C/deleteKunjungan';

//Cetak RM
$route['Cetak/RM/norm/(:any)'] = 'Cetak/Biodata_C/index/$1';
$route['Cetak/Kartu/norm/(:any)'] = 'Cetak/Biodata_C/kartu/$1';
$route['Cetak/Label/norm/(:any)'] = 'Cetak/Biodata_C/label/$1';

//Tensi
$route['Tensi/DaftarTunggu']='Tensi/DaftarTunggu_C';
$route['Tensi/DaftarTunggu/showData']='Tensi/DaftarTunggu_C/showData';