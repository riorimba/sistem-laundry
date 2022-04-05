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

//start
Route::get('/', function () {
    return view('login');
});
Route::get('/register', function() {
    return view('register');
});


Auth::routes();


Route::group(['middleware' => ['role:admin']], function () {    
    //outlet
    Route::get('/outlet', 'OutletController@show')->name('show-outlet');
    Route::get('/outlet/add', 'OutletController@add')->name('add-outlet');
    Route::post('/outlet/save', 'OutletController@save')->name('save-outlet');
    Route::get('/outlet/edit/{id}', 'OutletController@edit')->name('edit-outlet');
    Route::put('/outlet/edit/{id}', 'OutletController@update')->name('update-outlet');
    Route::delete('/outlet/delete/{id}', 'OutletController@delete')->name('delete-outlet');

    //paket
    Route::get('/paket', 'PaketController@show')->name('show-paket');
    Route::get('/paket/add', 'PaketController@add')->name('add-paket');
    Route::post('/paket/save', 'PaketController@save')->name('save-paket');
    Route::get('/paket/edit/{id}', 'PaketController@edit')->name('edit-paket');
    Route::put('/paket/edit/{id}', 'PaketController@update')->name('update-paket');
    Route::delete('/paket/delete/{id}', 'PaketController@delete')->name('delete-paket');

    //user
    Route::get('/users', 'UserController@show')->name('show-user');
    Route::get('/users/add', 'UserController@add')->name('add-user');
    Route::post('/users/save', 'UserController@save')->name('save-user');
    Route::get('/users/edit/{user}', 'UserController@edit')->name('edit-user');
    Route::put('/users/edit/{user}', 'UserController@update')->name('update-user');
    Route::delete('/users/delete/{id}', 'UserController@delete')->name('delete-user');
});

Route::group(['middleware' => ['role:admin|kasir']], function () {

    //member
    Route::get('/member', 'MemberController@show')->name('show-member');
    Route::get('/member/add', 'MemberController@add')->name('add-member');
    Route::post('/member/save', 'MemberController@save')->name('save-member');
    Route::get('/member/edit/{id}', 'MemberController@edit')->name('edit-member');
    Route::put('/member/edit/{id}', 'MemberController@update')->name('update-member');
    Route::delete('/member/delete/{id}', 'MemberController@delete')->name('delete-member');

    //Transaksi
    Route::get('/transaksi/add', 'TransaksiController@add')->name('add-transaksi');
    Route::post('/transaksi/save', 'TransaksiController@save')->name('save-transaksi');
    Route::get('/transaksi/edit/{id}', 'TransaksiController@edit')->name('edit-transaksi');
    Route::put('/transaksi/edit/{id}', 'TransaksiController@update')->name('update-transaksi');
    Route::delete('/transaksi/delete/{id}', 'TransaksiController@delete')->name('delete-transaksi');
    Route::delete('/transaksi/delete', 'TransaksiController@deleteAll')->name('delete-all');
});


Route::group(['middleware' => ['role:admin|kasir|owner']], function () {

    //dashboard
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    //Transaksi
    Route::get('/transaksi', 'TransaksiController@show')->name('show-transaksi');
    //Detail Transaksi
    // Route::get('/detail-transaksi/add', 'DetailTransaksiController@add')->name('add-detail');
    Route::get('/detail-transaksi/{id}','TransaksiController@detailTransaksi')->name('show-detail');
    //laporan
    Route::get('/laporan', 'LaporanController@show')->name('show-laporan');
    Route::get('/laporan/member', 'LaporanController@memberExport')->name('export-member');
    Route::get('/laporan/outlet', 'LaporanController@outletExport')->name('export-outlet');
    Route::get('/laporan/paket', 'LaporanController@paketExport')->name('export-paket');
    Route::get('/laporan/transaksi', 'LaporanController@transaksiExport')->name('export-transaksi');
    Route::get('/laporan/user', 'LaporanController@userExport')->name('export-user');


});