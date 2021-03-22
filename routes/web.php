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

Route::get('/', 'PemesananCustomer@daftarmenu')->name('menu');
Route::get('/daftarpromo', 'PemesananCustomer@getPromo')->name('getPromo');
Route::get('/sortharga', 'PemesananCustomer@sortharga')->name('sortharga');
Route::get('/sortrating', 'PemesananCustomer@sortrating')->name('sortrating');
Route::get('/makanan', 'PemesananCustomer@ismakanan')->name('ismakanan');
Route::get('/minuman', 'PemesananCustomer@isminuman')->name('isminuman');
Route::post('/cari', 'PemesananCustomer@cari');
Route::get('/keranjang/cek/{id}', 'PemesananCustomer@setPesanan')->name('cek');
Route::get('/keranjang', 'PemesananCustomer@keranjang')->name('keranjang');
Route::get('/keranjang/hapus/{id}', 'PemesananCustomer@hapus')->name('hapus');
Route::get('/keranjang/chapus/{id}', 'PemesananCustomer@chapus')->name('chapus');
Route::post('/keranjang/selesai/', 'PemesananCustomer@selesai')->name('selesai');
Route::post('/keranjang/tambahjumlah/', 'PemesananCustomer@tambahjumlah')->name('tambahjumlah');
Route::get('/ulasan', 'PemesananCustomer@ulasan')->name('ulasan');
Route::post('/ulasan/tambah', 'RatingController@setRatingdanReview')->name('setRatingdanReview');
Route::get('/reset', 'PemesananCustomer@reset')->name('reset');


Auth::routes();

Route::get('/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/kasir', 'Auth\LoginController@showKasirLoginForm');
Route::get('/login/kasir', 'Auth\LoginController@showKasirLoginForm');


Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/kasir', 'Auth\LoginController@kasirLogin');


Route::middleware('auth:admin')->group(function(){
    Route::get('/home', 'HomeController@beranda')->name('beranda');
    Route::get('/beranda', 'HomeController@beranda')->name('beranda');

    Route::resource('menu', 'MenuController');
    Route::get('/menu', 'MenuController@getMenuRestoran')->name('getMenuRestoran');
    Route::post('/menu/store','MenuController@setDataMenuRestoran')->name('setDataMenuRestoran');
    Route::get('/menu/hapus/{id}', 'MenuController@hapus');
    Route::post('/menu/cari','MenuController@cari');
    Route::post('/menu/update','MenuController@update');    
    
    Route::get('/promo', 'PromoController@getPromo')->name('getPromo');
    Route::get('/promo/riwayat', 'PromoController@getRiwayatPromo')->name('getRiwayatPromo');
    Route::post('/promo/dataharga', 'PromoController@dataharga')->name('datahargapromo');
    Route::post('/promo/tambah', 'PromoController@setDataPromo')->name('setDataPromo');
    Route::post('/promo/update', 'PromoController@update')->name('editpromo');
    Route::get('/promo/hapus/{id}', 'PromoController@hapus')->name('hapuspromo');;

    
    Route::get('/laporan', 'LaporanController@getLaporan')->name('datalaporan');
    Route::post('/laporan/tanggal', 'LaporanController@tanggal')->name('datalaporantanggal');

    Route::get('/datauser', 'HomeController@getDataKasir')->name('datauser');
    Route::post('/datauser/tambah', 'HomeController@setDataKasir')->name('tambahkasir');
    Route::post('/datauser/edit', 'HomeController@editKasir')->name('editkasir');
    Route::get('/datauser/hapus/{id}', 'HomeController@hapusDataKasir');    
});

Route::middleware('auth:kasir')->group(function(){    
    Route::get('/pesanan', 'PesananController@getPesanan')->name('getPesanan');
    Route::post('/pesanan/cari', 'PesananController@cariPesanan')->name('cariPesanan');
    Route::get('/pesanan/hapus/{id}', 'PesananController@hapuspesanan')->name('hapus');
    Route::post('/pesanan/proses/{id}', 'PesananController@proses')->name('proses');
    Route::get('/pesanan/print/{id}', 'PesananController@print')->name('print');
    Route::post('/pesanan/cek', 'PesananController@cek')->name('cek');
});

