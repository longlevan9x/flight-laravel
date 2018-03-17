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

Route::get('/', 'HomeController@index');

Route::get('login', 'Auth\LoginController@login');
Route::get('login', 'Auth\LoginController@login');
Route::post('set-session', 'HomeController@setSession');
Route::get('flight', 'FlightController@index');
Route::get('flight/list', 'FlightController@listFlight');
Auth::routes();
Route::get('register', 'Auth\RegisterController@register');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('flight/run', 'FlightController@run');
Route::get('airline/run', 'AirlineController@run');
Route::get('flight-book/run', 'FlightBookController@run');