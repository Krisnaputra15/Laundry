<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//petugas
Route::post('register','petugas@register');
Route::post('login','petugas@login');
Route::put('update/{id}','petugas@update')->middleware('jwt.verify');
//pelanggan
Route::post('regpelanggan','pelangganc@register')->middleware('jwt.verify');
Route::put('uppelanggan/{id}','pelangganc@update')->middleware('jwt.verify');
Route::delete('delpelanggan/{id}','pelangganc@delete')->middleware('jwt.verify');
Route::post('getpelanggan','pelangganc@get')->middleware('jwt.verify');
//jenis cuci
Route::post('addjenis','jenis_cucic@insert')->middleware('jwt.verify');
Route::put('upjenis/{id}','jenis_cucic@update')->middleware('jwt.verify');
Route::delete('deljenis/{id}','jenis_cucic@destroy')->middleware('jwt.verify');
//transaksi
Route::post('addtrans','transaksic@insert')->middleware('jwt.verify');
Route::post('gettrans','transaksic@get')->middleware('jwt.verify');
Route::put('uptrans','transaksi@update')->middleware('jwt.verify');