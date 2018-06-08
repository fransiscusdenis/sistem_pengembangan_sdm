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
Route::get('view/{id}', 'pegawaiController@viewPegawai')->name('pegawai.view');
Route::get('api/pegawai', 'PegawaiController@apiPegawai')->name('api.pegawai');
Route::get('api/riwayatpendidikanpegawai/{id}', 'PegawaiController@apiRiwayatPendidikan')->name('api.riwayatpendidikanpegawai');
Route::get('api/riwayatjabatanpegawai/{id}', 'PegawaiController@apiRiwayatJabatan')->name('api.riwayatjabatanpegawai');
Route::get('api/riwayatpangkatpegawai/{id}', 'PegawaiController@apiRiwayatPangkat')->name('api.riwayatpangkatpegawai');

Route::resource('riwayatpendidikan', 'RiwayatPendidikanController');
Route::get('api/riwayatpendidikan', 'RiwayatPendidikanController@apiRiwayatPendidikan')->name('api.riwayatpendidikan');

Route::resource('riwayatpangkat', 'RiwayatPangkatController');
Route::get('api/riwayatpangkat', 'RiwayatPangkatController@apiRiwayatPangkat')->name('api.riwayatpangkat');

Route::resource('riwayatjabatan', 'RiwayatJabatanController');
Route::get('api/riwayatjabatan', 'RiwayatJabatanController@apiRiwayatJabatan')->name('api.riwayatjabatan');

Route::resource('riwayatdiklat', 'RiwayatDiklatController');
Route::get('api/riwayatdiklat', 'RiwayatDiklatController@apiRiwayatDiklat')->name('api.riwayatdiklat');
