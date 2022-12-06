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


Route::group(['prefix' => 'barang','middleware'    => 'auth'],function(){
    Route::get('/','BarangController@index');
    Route::get('/get_data','BarangController@get_data');
    Route::get('/cari_barang','BarangController@cari_barang');
    Route::get('/get_barang','BarangController@get_barang');
    Route::get('/delete_data','BarangController@delete_data');
    Route::get('/create','BarangController@create');
    Route::get('/modal','BarangController@modal');
    Route::post('/','BarangController@store');
    Route::post('/import','BarangController@import');
});
Route::group(['prefix' => 'supplier','middleware'    => 'auth'],function(){
    Route::get('/','SupplierController@index');
    Route::get('/get_data','SupplierController@get_data');
    Route::get('/delete_data','SupplierController@delete_data');
    Route::get('/create','SupplierController@create');
    Route::get('/modal','SupplierController@modal');
    Route::post('/','SupplierController@store');
    Route::post('/import','SupplierController@import');
});
Route::group(['prefix' => 'setting','middleware'    => 'auth'],function(){
    Route::get('/','SettingController@index');
    Route::get('/get_data','SettingController@get_data');
    Route::get('/delete_data','SettingController@delete_data');
    Route::get('/create','SettingController@create');
    Route::get('/modal','SettingController@modal');
    Route::post('/','SettingController@store');
    Route::post('/import','SettingController@import');
});
Route::group(['prefix' => 'stokorder','middleware'    => 'auth'],function(){
    Route::get('/','StokorderController@index');
    Route::get('/get_data','StokorderController@get_data');
    Route::get('/delete_data','StokorderController@delete_data');
    Route::get('/create','StokorderController@create');
    Route::get('/modal','StokorderController@modal');
    Route::get('/tentukan_provit','StokorderController@tentukan_provit');
    Route::post('/','StokorderController@store');
    Route::post('/import','StokorderController@import');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
