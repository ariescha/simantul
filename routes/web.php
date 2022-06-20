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
    return view('index');
});
Route::get('/cso', function () {
    return view('cso.dashboard');
});
Route::get('/command-center', function () {
    return view('command-center.dashboard');
});
Route::get('/rekapitulasi', function () {
    return view('command-center.rekapitulasi');
});
Route::get('/tic-area', function () {
    return view('tic-area.dashboard');
});
Route::get('/admin', function () {
    return view('admin.dashboard');
});
