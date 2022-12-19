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
    Route::get('/hapus','BarangController@index_hapus');
    Route::get('/get_data','BarangController@get_data');
    Route::get('/restore_data','BarangController@restore_data');
    Route::get('/get_data_hapus','BarangController@get_data_hapus');
    Route::get('/cari_barang','BarangController@cari_barang');
    Route::get('/cari_harga_barang','BarangController@cari_harga_barang');
    Route::get('/cari_barang_jual','BarangController@cari_barang_jual');
    Route::get('/get_barang','BarangController@get_barang');
    Route::get('/get_data_barang','BarangController@get_data_barang');
    Route::get('/delete_data','BarangController@delete_data');
    Route::get('/create','BarangController@create');
    Route::get('/modal','BarangController@modal');
    Route::post('/','BarangController@store');
    Route::post('/import','BarangController@import');
    Route::post('/delete_data_all','BarangController@delete_data_all');
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
Route::group(['prefix' => 'employe','middleware'    => 'auth'],function(){
    Route::get('/','EmployeController@index');
    Route::get('/get_data','EmployeController@get_data');
    Route::get('/delete_data','EmployeController@delete_data');
    Route::get('/create','EmployeController@create');
    Route::get('/modal','EmployeController@modal');
    Route::post('/','EmployeController@store');
    Route::post('/import','EmployeController@import');
});
Route::group(['prefix' => 'keuangan','middleware'    => 'auth'],function(){
    Route::get('/','KeuanganController@index');
    Route::get('/get_data','KeuanganController@get_data');
    Route::get('/cetak','KeuanganController@cetak');
    Route::get('/delete_data','KeuanganController@delete_data');
    Route::get('/delete_data_bayar','KeuanganController@delete_data_bayar');
    Route::get('/delete_data_bayar_header','KeuanganController@delete_data_bayar_header');
    Route::get('/tentukan_status','KeuanganController@tentukan_status');
    Route::get('/create','KeuanganController@create');
    Route::get('/modal','KeuanganController@modal');
    Route::get('/modal_bayar','KeuanganController@modal_bayar');
    Route::post('/','KeuanganController@store');
    Route::post('/store_bayar','KeuanganController@store_bayar');
    Route::post('/import','KeuanganController@import');
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
    Route::get('/retur','StokorderController@index_retur'); 
    Route::get('/tukar','StokorderController@index_tukar'); 
    Route::get('/get_data','StokorderController@get_data');
    Route::get('/get_order','StokorderController@get_order');
    Route::get('/get_data_retur','StokorderController@get_data_retur');
    Route::get('/get_data_tukar','StokorderController@get_data_tukar');
    Route::get('/delete_data','StokorderController@delete_data');
    Route::get('/delete_data_barang','StokorderController@delete_data_barang');
    Route::get('/delete_retur','StokorderController@delete_retur');
    Route::get('/delete_tukar','StokorderController@delete_tukar');
    Route::get('/proses_retur','StokorderController@proses_retur');
    Route::get('/proses_tukar','StokorderController@proses_tukar');
    Route::get('/create','StokorderController@create');
    Route::get('/cetak','StokorderController@cetak');
    Route::get('/print','StokorderController@print');
    Route::get('/modal','StokorderController@modal');
    Route::get('/modal_retur','StokorderController@modal_retur');
    Route::get('/modal_tukar','StokorderController@modal_tukar');
    Route::get('/modal_ubah','StokorderController@modal_ubah');
    Route::get('/cari_stok','StokorderController@cari_stok');
    Route::get('/cari_stok_tukar','StokorderController@cari_stok_tukar');
    Route::get('/modal_terima','StokorderController@modal_terima');
    Route::get('/modal_cetak','StokorderController@modal_cetak');
    Route::get('/tentukan_provit','StokorderController@tentukan_provit');
    Route::post('/','StokorderController@store');
    Route::post('/store_stok','StokorderController@store_stok');
    Route::post('/store_retur','StokorderController@store_retur');
    Route::post('/store_ubah','StokorderController@store_ubah');
    Route::post('/store_tukar','StokorderController@store_tukar');
    Route::post('/store_selesai','StokorderController@store_selesai');
    Route::post('/import','StokorderController@import');
});
Route::group(['prefix' => 'kasir','middleware'    => 'auth'],function(){
    Route::get('/','KasirController@index'); 
    Route::get('/retur','KasirController@index_retur'); 
    Route::get('/tukar','KasirController@index_tukar'); 
    Route::get('/get_data','KasirController@get_data');
    Route::get('/get_order','KasirController@get_order');
    Route::get('/get_data_retur','KasirController@get_data_retur');
    Route::get('/get_data_tukar','KasirController@get_data_tukar');
    Route::get('/delete_data','KasirController@delete_data');
    Route::get('/ulangi_data','KasirController@ulangi_data');
    Route::get('/delete_data_stok','KasirController@delete_data_stok');
    Route::get('/delete_retur','KasirController@delete_retur');
    Route::get('/delete_tukar','KasirController@delete_tukar');
    Route::get('/proses_retur','KasirController@proses_retur');
    Route::get('/proses_tukar','KasirController@proses_tukar');
    Route::get('/create','KasirController@create');
    Route::get('/cetak','KasirController@cetak');
    Route::get('/print','KasirController@print');
    Route::get('/modal','KasirController@modal');
    Route::get('/modal_retur','KasirController@modal_retur');
    Route::get('/modal_tukar','KasirController@modal_tukar');
    Route::get('/cari_stok','KasirController@cari_stok');
    Route::get('/cari_stok_tukar','KasirController@cari_stok_tukar');
    Route::get('/modal_terima','KasirController@modal_terima');
    Route::get('/modal_cetak','KasirController@modal_cetak');
    Route::get('/tentukan_provit','KasirController@tentukan_provit');
    Route::post('/','KasirController@store');
    Route::post('/store_stok','KasirController@store_stok');
    Route::post('/store_retur','KasirController@store_retur');
    Route::post('/store_tukar','KasirController@store_tukar');
    Route::post('/store_selesai','KasirController@store_selesai');
    Route::post('/import','KasirController@import');
});
Route::group(['prefix' => 'stok','middleware'    => 'auth'],function(){
    Route::get('/','StokorderController@index_stok');
    Route::get('/get_data','StokorderController@get_data_stok');
    Route::get('/get_data_even','StokorderController@get_data_even');
    Route::get('/get_data_tersedia','StokorderController@get_data_tersedia');
    Route::get('/view','StokorderController@view_stok');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
