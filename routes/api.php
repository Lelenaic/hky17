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

/***
 * Charging Station
 ***/

/* Get all charging station */
Route::get('/charging_station', 'ChargingStationController@index');

/* Get one charging station by ID */
Route::get('/charging_station/{id}', 'ChargingStationController@index');



/***
 * Cars
 ***/
Route::get('/cars', function(){
    echo json_encode([['name'=>"Zoe"], ['name'=>"Leaf"], ['name'=>"Etron"]]);
});
