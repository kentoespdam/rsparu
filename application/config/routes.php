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
$route['API/Tujuan/Det/(:num)'] = 'API/TujuanController/showDet/$1';
$route['API/Petugas/uname/(:any)'] = 'API/PetugasController/listPetugasBy/$1';
$route['API/Diagnosa/showAll'] = 'API/DiagnosaController/showAll';
$route['API/Rontgen/Foto'] = 'API/RontgenController/listFotoRontgen';
$route['API/Rontgen/Kondisi'] = 'API/RontgenController/listKondisiRontgen';
$route['API/Rontgen/Film'] = 'API/RontgenController/listFilmRontgen';
$route['API/Rontgen/Mesin'] = 'API/RontgenController/listMesinRontgen';
$route['API/Menu'] = 'API/MenuController/listMenu';
$route['API/Kominfo'] = 'API/Kominfo/getDataPendaftaranKominfo';
$route['API/PasienKominfo'] = 'API/Kominfo/getDataPasienKominfo';

//API Pendaftaran
$route['API/daftar/pasien/old'] = 'API/PasienOldController/findData';
$route['API/daftar/pasien/norm/old'] = 'API/PasienOldController/findNorm';
$route['API/daftar/pasien/new'] = 'API/PasienNewController/findData';
$route['API/daftar/pasien/norm/old/new'] = 'API/PasienNewController/findNormOld';
$route['API/daftar/pasien/norm/new'] = 'API/PasienNewController/findNorm';
$route['API/daftar/pasienTB'] = 'API/PasienNewController/checkTb';

$route['API/riwayat/kunjungan/pasien'] = 'API/RiwayatController/findDataKunj';
$route['API/riwayat/kunjungan/pasien/norm'] = 'API/RiwayatController/findNormKunj';

//Rest Antrian
$route['API/panggil/Loket'] = 'API/AntreanOldController/showLoket';
$route['API/panggil/Suara'] = 'API/AntreanOldController/vSound';
//Antrian Pendaftaran
$route['API/panggil/tmp/loket'] = 'API/PanggilController/tmpPanggil';
$route['API/panggil/tmp/addTmp/noAntri/(:num)/loket/(:num)'] = 'API/PanggilController/addTmp/$1/$2';
$route['API/panggil/tmp/updTmp/noAntri/(:num)/loket/(:num)/panggil/(:any)'] = 'API/PanggilController/updTmp/$1/$2/$3';
$route['API/panggil/tmp/rmTmp/noAntri/(:num)'] = 'API/PanggilController/rmTmp/$1';
$route['API/panggil/tmp/gantiHari'] = 'API/PanggilController/gantiHari';
$route['API/panggil/tmp/lewati/(:num)/tanggal/(:any)'] = 'API/PanggilController/lewati/$1/$2';

//Antrian Poli
$route['API/panggil/tmp/Poli'] = 'API/PanggilPoliController/tmpPanggil';
$route['API/panggil/tmp/Poli/poli/(:any)'] = 'API/PanggilPoliController/getTmp/$1';
$route['API/panggil/tmp/Poli/addTmp/poli/(:any)'] = 'API/PanggilPoliController/addTmp/$1';
$route['API/tunggu/poli/(:any)'] = 'API/AntreanOldController/showPoli/$1';

//Display Antrian
$route['Display/(:any)'] = 'Display/Display_c/index/$1';
$route['API/tunggu/pendaftaran'] = 'Display/TungguPendaftaran_c';
$route['Login'] = 'Akun/Login_C';
$route['DoLogin'] = 'Akun/Login_C/do_login';
$route['DoLogout'] = 'Akun/Login_C/do_logout';

//Dasboard
$route['Dasboard'] = 'Dasboard/Dasboard_C';
$route['Grafik/Kunjungan'] = 'Dasboard/DataGrafik_C/g_kunj';

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
$route['Tensi'] = 'Tensi/Tensi_C';
$route['Tensi/DaftarTunggu'] = 'Tensi/DaftarTunggu_C';
$route['Tensi/DaftarTunggu/showData'] = 'Tensi/DaftarTunggu_C/showData';
$route['Tensi/DaftarTunggu/poli/(:any)'] = 'Tensi/DaftarTunggu_C/showDataPoli/$1';
$route['Tensi/DaftarSelesai/poli/(:any)'] = 'Tensi/DaftarTunggu_C/showSelesaiDataPoli/$1';
$route['Tensi/DaftarTunggu/detail/(:any)'] = 'Tensi/DaftarTunggu_C/showDataDet/$1';
$route['Tensi/Simpan'] = 'Tensi/Tensi_C/Simpan';
$route['Tensi/ShowData/norm/(:any)'] = 'Tensi/Tensi_C/Show_data/$1';
$route['Tensi/Pindah'] = 'Tensi/Tensi_C/Pindah';

//Riwayat
$route['Riwayat/norm/(:any)'] = 'Tensi/Riwayat_C/index/$1';
$route['Riwayat/Simpan'] = 'Tensi/Riwayat_C/Simpan';

//Poli
$route['Poli'] = 'Poli/Poli_C';
$route['Poli/Riwayat/norm/(:any)'] = 'Poli/Poli_C/AmbilRiwayat/$1';
$route['Poli/Simpan'] = 'Poli/Poli_C/Simpan';
$route['Poli/ShowData/norm/(:any)'] = 'Poli/Poli_C/ShowData/$1';

//Rontgen
$route['Rontgen'] = 'Rontgen/Rontgen_C';
$route['Rontgen/DaftarTunggu/showData'] = 'Rontgen/Rontgen_C/ShowTunggu';
$route['Rontgen/DaftarTunggu/showOther'] = 'Rontgen/Rontgen_C/ShowOther';
$route['Rontgen/Add'] = 'Rontgen/Rontgen_C/addRontgen';
$route['Rontgen/Simpan'] = 'Rontgen/Rontgen_C/Simpan';
$route['Rontgen/Delete'] = 'Rontgen/Rontgen_C/Hapus';
$route['Rontgen/ShowData/norm/(:any)'] = 'Rontgen/Rontgen_C/ShowData/$1';
$route['Rontgen/ShowDet/detail/(:any)'] = 'Rontgen/Rontgen_C/ShowDet/$1';

//DOT Center
$route['DOT'] = 'DOT/DOT_C';
$route['DOT/ShowData/norm/(:num)'] = 'DOT/DOT_C/showData/$1';








//Report
$route['Report/Pendaftaran/Kunjungan'] = 'Form/Pendaftaran_C/ReportKunjungan';
$route['Report/Pendaftaran/showKunjungan/(:any)'] = 'Form/Pendaftaran_C/showReportKunjungan/$1';
$route['Report/Rontgen/Kunjungan'] = 'Rontgen/Rontgen_C/ReportKunjungan';
$route['Report/Rontgen/showKunjungan/cetak/(:any)'] = 'Rontgen/Rontgen_C/showReportKunjungan/$1';

$route['Report/Petugas'] = 'Report/Petugas_C';
$route['Report/Petugas/showData'] = 'Report/Petugas_C/showData';
