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
});
Route::get('/login-cso', function () {
    return view('auth.login.login-cso');
});


//dashboard Command Center
Route::get('dashboard-command-center','CommandCenterController@index')->name('dashboard-command-center');
Route::get('LoadLaporan','CommandCenterController@LoadLaporan')->name('LoadLaporan');
Route::post('ForwardTIC','CommandCenterController@ForwardTIC')->name('ForwardTIC');

//rekapitulasi Command Center
Route::get('rekapitulasi-command-center','RekapitulasiCCController@index')->name('rekapitulasi-command-center');
Route::get('LoadRekapitulasi','RekapitulasiCCController@LoadRekapitulasi')->name('LoadRekapitulasi');

//Petugas TIC
Route::get('Petugas','PetugasController@index')->name('Petugas');
Route::post('update-petugas','PetugasController@insert')->name('update-petugas');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Routing Admin
Route::get('rekapitulasi-admin','RekapitulasiAdminController@index')->name('rekapitulasi-admin');
Route::get('dashboard-admin','AdminController@index')->name('dashboard-admin');



//Routing Dashboard CSO
Route::get('dashboard-cso','CsoController@index')->name('dashboard-cso');
Route::get('LoadLaporanCso','CsoController@LoadLaporanCso')->name('LoadLaporanCso');
Route::post('add-laporan','CsoController@addLaporan')->name('add-laporan');
Route::post('edit-laporan','CsoController@editLaporan')->name('edit-laporan');
Route::post('change-priority','CsoController@changePriority')->name('change-priority');

//Dashboard TIC-Area
Route::get('dashboard-tic','TicAreaController@index')->name('dashboard-tic');
Route::get('LoadLaporanTic','TicAreaController@LoadLaporanTic')->name('LoadLaporanTic');