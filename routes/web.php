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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['role:member|admin|kasir|owner']], function () {
    Route::get('/home', 'HomeController@home')->name('home');
});

Route::group(['middleware' => ['role:admin|kasir|owner']], function () {
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
});