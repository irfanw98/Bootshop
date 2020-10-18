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

//Cek Cart
Route::get('cek-cart', function () {
    $cek = \Cart::getContent();
    dd($cek);
});

//Logout
Route::get('/keluar', function () {
    \Auth::logout();
    return redirect('/login');
});

Route::get('/', 'BerandaController@index');
Route::prefix('front')->group(function () {
    Route::get('kategori/{id}', 'KategoriController@index');

    //Pencarian Produk
    Route::get('produk/search', 'ProdukController@search');

    //Detail Produk
    Route::get('produk/{id}', 'ProdukController@detail');

    //Keranjang 
    Route::get('add-cart/{id}', 'CartController@add');
    Route::get('detail-cart', 'CartController@detail');
    Route::get('hapus-cart/{id}', 'CartController@hapus');

    Route::get('get-kota/{provinsi}', 'CartController@getKotaAjax');
    Route::get('cekongkir/{asal}/{tujuan}/{kurir}/{berat}', 'CartController@getOngkir');
});

//Mengakses route untuk yang sudah login(Bagian Admin)
Route::group(['middleware' => 'auth'], function () {
    Route::resource('/admin', 'Admin\BerandaController');

    //Kategori
    Route::resource('kategori', 'Kategori\KategoriController');
    //Produk
    Route::resource('produk', 'Produk\ProdukController');
    //Featured Produk
    Route::get('featured-produk', 'Produk\ProdukController@featured');
    Route::put('featured-produk', 'Produk\ProdukController@featured_update');

    Route::get('alamat', 'Admin\AlamatController@index');
    Route::get('alamat/get-kota/{id_provinsi}', 'Admin\AlamatController@getKotaAjax');
    Route::post('alamat', 'Admin\AlamatController@store');
});

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', function () {
    return redirect('/admin');
})->middleware('verified');
