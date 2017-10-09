<?php

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
Route::get('/chargingStations', 'ChargingStationController@index');

/* Get one charging station by ID */
Route::get('/chargingStations/{id}', 'ChargingStationController@index');


/********************************************
 * Cars
 ********************************************/

/* Get all cars */
Route::get('/cars', 'CarController@index');


/********************************************
 * Users
 ********************************************/

/* Get all users */
Route::get('/users', 'SessionController@index');

/* Get one user by ID */
Route::get('/users/{id}', 'SessionController@oneUser');

/* Try to login an user */
Route::post('/login', 'SessionController@login');

/* Get information about the current user */
Route::get('/me', 'UserController@me');

/********************************************
 * Bookings
 ********************************************/

/* Make a new Booking */
Route::post('/bookings', 'BookingController@store');

/* List all bookings */
Route::get('/bookings', 'BookingController@index');
