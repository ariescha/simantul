<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.welcome-page');
})->name('welcome-page');

Route::get('login/{id}','UserController@index')->name('login');
Route::get('logout','UserController@logout')->name('logout');
Route::post('loginpost','UserController@loginpost')->name('loginpost');


//dashboard Command Center
Route::get('dashboard-command-center','CommandCenterController@index')->name('dashboard-command-center');
Route::get('LoadLaporan','CommandCenterController@LoadLaporan')->name('LoadLaporan');
Route::get('LoadLaporanSelesai','CommandCenterController@LoadLaporanSelesai')->name('LoadLaporanSelesai');
Route::post('ForwardTIC','CommandCenterController@ForwardTIC')->name('ForwardTIC');

//rekapitulasi Command Center
Route::get('rekapitulasi-command-center','RekapitulasiCCController@index')->name('rekapitulasi-command-center');
Route::get('LoadRekapitulasiCC','RekapitulasiCCController@LoadRekapitulasiCC')->name('LoadRekapitulasiCC');
Route::post('submitDate','RekapitulasiCCController@submitDate')->name('submitDate');
Route::post('rekapitulasi-commandcenter/export_excel','RekapitulasiCCController@ExportExcel')->name('rekap-cc-export');

//Petugas TIC
Route::get('Petugas','PetugasController@index')->name('Petugas');
Route::get('master-petugas','MasterPetugasController@index')->name('master-petugas');
Route::post('update-petugas','PetugasController@insert')->name('update-petugas');
Route::get('LoadPetugas','MasterPetugasController@LoadPetugas')->name('LoadPetugas');
Route::post('EditPetugas','MasterPetugasController@EditPetugas')->name('EditPetugas');
Route::post('tambahPetugas','MasterPetugasController@addPetugas')->name('tambahPetugas');
Route::post('dropPetugas','MasterPetugasController@dropPetugas')->name('dropPetugas');

Route::post('master-kendaraan/grid','MasterKendaraanController@grid');
Route::resource('master-kendaraan','MasterKendaraanController');



Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Routing Admin
Route::get('rekapitulasi-admin','RekapitulasiAdminController@index')->name('rekapitulasi-admin');
Route::get('LoadRekapitulasiAdmin/{id}','RekapitulasiAdminController@LoadRekapitulasi')->name('LoadRekapitulasiAdmin');
Route::get('LoadChart/{id}','RekapitulasiAdminController@LoadChart')->name('LoadChart');
Route::get('PilihRegion','RekapitulasiAdminController@PilihRegion')->name('PilihRegion');
Route::get('dashboard-admin','AdminController@index')->name('dashboard-admin');
Route::get('LoadLaporanAdmin','AdminController@LoadLaporanAdmin')->name('LoadLaporanAdmin');
Route::post('rekapitulasi-admin/export_excel', 'RekapitulasiAdminController@ExportExcel')->name('rekap-admin-export');

//Routing Dashboard CSO
Route::get('dashboard-cso','CsoController@index')->name('dashboard-cso');
Route::get('LoadLaporanCso','CsoController@LoadLaporanCso')->name('LoadLaporanCso');
Route::post('add-laporan','CsoController@addLaporan')->name('add-laporan');
Route::post('edit-laporan','CsoController@editLaporan')->name('edit-laporan');
Route::post('change-priority','CsoController@changePriority')->name('change-priority');

//Dashboard TIC-Area
Route::get('dashboard-tic-area','TicAreaController@index')->name('dashboard-tic-area');
Route::get('LoadLaporanTic','TicAreaController@LoadLaporanTic')->name('LoadLaporanTic');
Route::get('LoadLaporanTicSelesai','TicAreaController@LoadLaporanTicSelesai')->name('LoadLaporanTicSelesai');
Route::get('LoadDataPetugas','TicAreaController@LoadDataPetugas')->name('LoadDataPetugas');
Route::post('AssignPetugas','TicAreaController@AssignPetugas')->name('AssignPetugas');
Route::post('PetugasArrived','TicAreaController@PetugasArrived')->name('PetugasArrived');
Route::post('PetugasDone','TicAreaController@PetugasDone')->name('PetugasDone');