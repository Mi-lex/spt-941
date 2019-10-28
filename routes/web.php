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

Route::get('/', 'MainController@home');

Route::get('/devices', 'DeviceController@show');

Route::post('/devices', 'DeviceController@store');

Route::delete('/devices/{device}', 'DeviceController@delete');

Route::get('/monitoring/{device}', 'DeviceController@monitoringSavedDevice');

Route::post('/monitoring', 'DeviceController@monitoring');

Route::post('/params', 'DeviceController@device_params');

Route::get('test/{device}', 'DeviceController@test_params');