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

Route::get('/', 'DashboardController@index');


Route::get('/login', 'SessionController@index')->name('login');
Route::get('/test/{name}', 'SessionController@index')->name('test');
Route::post('login', 'SessionController@login')->name('loginPost');
