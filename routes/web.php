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

Route::get('/','LoginController@index')->name('login');
Route::post('/postlogin','LoginController@postlogin');
Route::get('/logout','LoginController@logout');

Route::group(['middleware' => ['auth','checkRole:Admin']], function () {  
    Route::get('/dashboard','DashboardController@index');
    Route::resource('pegawai','PegawaiController');
    Route::get('/pegawai/{id}/delete','PegawaiController@delete');
    Route::get('/pegawai/{id}/reset','PegawaiController@reset');
    Route::get('/profile','ProfileController@index');
    Route::POST('/profile/{id}','ProfileController@updateprofile');
    Route::resource('suplier','SuplierController');
    Route::get('/suplier/{id}/delete','SuplierController@delete');
    Route::resource('pelanggan','PelangganController');
    Route::get('/pelanggan/{id}/delete','PelangganController@delete');
    Route::resource('obat','ObatController');
    Route::get('/obat/{id}/delete','ObatController@delete');
    Route::get('/riwayat-transaksi','TransaksiController@adminRiwayat');
    Route::post('/laporan-penjualan','TransaksiController@laporanpdf');
    Route::get('/obt-keluar','TransaksiController@obatkeluar');
    Route::post('/pdfobatkeluar','TransaksiController@pdfobatkeluar');
    Route::post('/transaksi/export','TransaksiController@excel_penjualan');
    Route::post('/obatkeluar/export','TransaksiController@excel_obatkeluar');
    Route::get('obatmasuk',['as' => 'obatmasuk','uses' => 'ObatController@obatMasuk']);
    Route::get('pendapatan',['as' => 'pendapatan','uses' => 'TransaksiController@pendapatan']);
    Route::get('satuan',['as' => 'satuan','uses' => 'ObatController@satuan']);
    Route::post('satuan/store',['as' => 'satuan.store','uses' => 'ObatController@satuanStore']);
    Route::get('satuan/edit',['as' => 'satuan.edit','uses' => 'ObatController@satuanEdit']);
    Route::get('satuan/{id}/destroy',['as' => 'satuan.destroy','uses' => 'ObatController@satuanDestroy']);
});


Route::group(['middleware' => ['auth','checkRole:Admin,Kasir']], function () {  
    Route::get('/kasirpage','KasirController@index');
    Route::get('/kasir/profile','KasirController@profile');
    Route::POST('/kasir/profile/{id}','KasirController@updateprofile');
    Route::resource('pelanggan','PelangganController');
    Route::get('/select2json','KasirController@select2json');
    Route::post('/addTemp','TransaksiController@addTemp');
    Route::get('temp/{id}/delete','TransaksiController@deleteTemp');
    Route::post('/transaksi/simpan','TransaksiController@simpantrans');
    Route::get('/riwayat-penjualan','KasirController@riwayatP');
    Route::get('/info-obat','KasirController@infoObat');
    Route::get('/info-pelanggan','KasirController@infoPelanggan');
    Route::get('/transaksi/{id}/detail','KasirController@detailOrder');
    Route::get('/transaksi/cetakstruk/{id}','KasirController@cetakStruk');
    Route::get('/kasir/laporanpdf','KasirController@laporanpdf');
    Route::get('/kasir/laporanexcel','KasirController@laporanexcel');
    
    Route::get('/kasir/{id}/viewUbahHarga','KasirController@indexUbahHarga');
    Route::put('/kasir/ubahharga/{id}','KasirController@ubahHarga');

});
Route::group(['middleware' => ['auth','checkRole:Admin,Apoteker']], function () {  
    Route::get('/dashboard','DashboardController@index');
    Route::get('/profile','ProfileController@index');
    Route::POST('/profile/{id}','ProfileController@updateprofile');
});

