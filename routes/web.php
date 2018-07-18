<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/unit/coba', function () {
//     return view('unit.coba');
// })->name('unit.coba');

//Coba
Route::get('/coba', 'cobaController@index');

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');

Route::resource('unit', 'UnitController');
Route::get('api/unit', 'UnitController@apiUnit')->name('api.unit');

Route::resource('agama', 'AgamaController');
Route::get('api/agama', 'AgamaController@apiAgama')->name('api.agama');

Route::resource('jeniskelamin', 'JenisKelaminController');
Route::get('api/jeniskelamin', 'JenisKelaminController@apiJenisKelamin')->name('api.jeniskelamin');

Route::resource('statusperkawinan', 'StatusPerkawinanController');
Route::get('api/statusperkawinan', 'StatusPerkawinanController@apiStatusPerkawinan')->name('api.statusperkawinan');

Route::resource('statushukum', 'StatusHukumController');
Route::get('api/statushukum', 'StatusHukumController@apiStatusHukum')->name('api.statushukum');

Route::resource('statuspegawai', 'StatusPegawaiController');
Route::get('api/statuspegawai', 'StatusPegawaiController@apiStatusPegawai')->name('api.statuspegawai');

Route::resource('jabatan', 'JabatanController');
Route::get('api/jabatan', 'JabatanController@apiJabatan')->name('api.jabatan');

Route::resource('jenisjabatan', 'JenisJabatanController');
Route::get('api/jenisjabatan', 'JenisJabatanController@apiJenisJabatan')->name('api.jenisjabatan');

Route::resource('pangkat', 'PangkatController');
Route::get('api/pangkat', 'PangkatController@apiPangkat')->name('api.pangkat');

Route::resource('eselon', 'EselonController');
Route::get('api/eselon', 'EselonController@apiEselon')->name('api.eselon');

Route::resource('jenjang', 'JenjangController');
Route::get('api/jenjang', 'JenjangController@apiJenjang')->name('api.jenjang');

Route::resource('pegawai', 'PegawaiController');
Route::get('view/{id}', 'PegawaiController@viewPegawai')->name('pegawai.view');
Route::get('api/pegawai/{id?}', 'PegawaiController@apiPegawai')->name('api.pegawai');
Route::get('api/datapegawai/{id}', 'PegawaiController@apiDataPegawai')->name('api.datapegawai');
Route::get('api/riwayatpendidikanpegawai/{id}', 'PegawaiController@apiRiwayatPendidikan')->name('api.riwayatpendidikanpegawai');
Route::get('api/riwayatjabatanpegawai/{id}', 'PegawaiController@apiRiwayatJabatan')->name('api.riwayatjabatanpegawai');
Route::get('api/riwayatpangkatpegawai/{id}', 'PegawaiController@apiRiwayatPangkat')->name('api.riwayatpangkatpegawai');
Route::get('api/riwayateselonpegawai/{id}', 'PegawaiController@apiRiwayatEselon')->name('api.riwayateselonpegawai');
Route::get('api/riwayatdiklatpegawai/{id}', 'PegawaiController@apiRiwayatDiklat')->name('api.riwayatdiklatpegawai');
Route::get('api/riwayatdiklatpegawai/{id?}', 'PegawaiController@apiRiwayatDiklat')->name('api.riwayatdiklatpegawai');

Route::resource('riwayatpendidikan', 'RiwayatPendidikanController');
Route::get('api/riwayatpendidikan', 'RiwayatPendidikanController@apiRiwayatPendidikan')->name('api.riwayatpendidikan');

Route::resource('riwayatpangkat', 'RiwayatPangkatController');
Route::get('api/riwayatpangkat', 'RiwayatPangkatController@apiRiwayatPangkat')->name('api.riwayatpangkat');

Route::resource('riwayateselon', 'RiwayatEselonController');
Route::get('api/riwayateselon', 'RiwayatEselonController@apiRiwayatEselon')->name('api.riwayateselon');

Route::resource('riwayatjabatan', 'RiwayatJabatanController');
Route::get('api/riwayatjabatan', 'RiwayatJabatanController@apiRiwayatJabatan')->name('api.riwayatjabatan');

Route::resource('riwayatdiklat', 'RiwayatDiklatController');
Route::get('api/riwayatdiklat', 'RiwayatDiklatController@apiRiwayatDiklat')->name('api.riwayatdiklat');

Route::get('filterpegawai', 'RiwayatJabatanController@filterpegawai')->name('filterpegawai');
Route::get('api/filterpegawai/{id_pangkat?}/{id_jenis_jabatan?}/{id_unit?}', 'RiwayatJabatanController@apiFilterPegawai')->name('api.filterpegawai');

// Route::get('/rekomendasidiklat', function () {
//     return view('rekomendasidiklat.index');
// });

Route::resource('rekomendasidiklat', 'RekomendasiDiklatController');
Route::get('api/rekomendasidiklat', 'RekomendasiDiklatController@apiRekomendasiDiklat')->name('api.rekomendasidiklat');
Route::get('pilihpegawai', 'RekomendasiDiklatController@viewPilihPegawai')->name('rekomendasidiklat.pilihpegawai');
Route::get('usulanpegawai/{id}', 'RekomendasiDiklatController@viewUsulanPegawai')->name('rekomendasidiklat.usulanpegawai');
Route::get('api/pilihpegawai/{id_pangkat?}/{id_jenis_jabatan?}/{id_unit?}/{id_jenjang?}', 'RekomendasiDiklatController@apiPilihPegawai')->name('api.pilihpegawai');
Route::get('api/usulandiklat/{id}', 'RekomendasiDiklatController@apiUsulanDiklat')->name('api.usulandiklat');

Route::get('usulandiklatpim2', 'PegawaiController@usulanDiklatPim2')->name('pegawai.usulandiklatpim2');
Route::get('usulandiklatpim3', 'PegawaiController@usulanDiklatPim3')->name('pegawai.usulandiklatpim3');
// Route::get('usulandiklatpim4', 'PegawaiController@usulanDiklatPim4')->name('pegawai.usulandiklatpim4');
Route::get('/usulandiklatpim4', function () {
    return view('usulandiklat.pim4');
})->name('usulandiklatpim4');

Route::get('api/usulandiklatpim2', 'PegawaiController@apiUsulanDiklatPim2')->name('api.usulandiklatpim2');
Route::get('api/usulandiklatpim3', 'PegawaiController@apiUsulanDiklatPim3')->name('api.usulandiklatpim3');
Route::get('api/usulandiklatpim4', 'PegawaiController@apiUsulanDiklatPim4')->name('api.usulandiklatpim4');
