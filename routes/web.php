<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/pesan/{id}', 'PesananController@index');
Route::post('/pesan/{id}', 'PesananController@pesanan');
Route::get('/check-out', 'PesananController@checkOut');
Route::delete('/check-out/{id}', 'PesananController@delete');
Route::get('check-out-konfirmasi', 'PesananController@konfirmasi');

Route::get('/profile', 'ProfileController@index');
Route::post('/profile', 'ProfileController@update');

Route::get('/history', 'HistoryController@index');
Route::get('/history/{id}', 'HistoryController@detail');