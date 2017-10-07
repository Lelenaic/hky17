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


Route::get('/charging_station', 'ChargingStationController@index');
Route::get('/charging_station/{id}', 'ChargingStationController@index');

Route::get('/cars', function(){
    echo json_encode([['name'=>"Zoe"], ['name'=>"Leaf"], ['name'=>"Etron"]]);
});
