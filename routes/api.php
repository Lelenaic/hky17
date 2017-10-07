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

/********************************************
 * Charging Station
 ********************************************/

/* Get all charging stations */
Route::get('/charging_stations', 'ChargingStationController@index');

/* Get one charging station by ID */
Route::get('/charging_stations/{id}', 'ChargingStationController@index');


/********************************************
 * Cars
 ********************************************/

/* Get all cars */
Route::get('/cars', function(){
    echo json_encode([['name'=>"Zoe"], ['name'=>"Leaf"], ['name'=>"Etron"]]);
});


/********************************************
 * Users
 ********************************************/

/* Get all users */
Route::get('/users', 'SessionController@index');

/* Get one user by ID */
Route::get('/users/{id}', 'SessionController@oneUser');

/* Get id of one user */
Route::get('/users/id/{id}', 'SessionController@oneUserId');
