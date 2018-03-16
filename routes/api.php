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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');

Route::group(['middleware' => ['api']], function () {
    Route::group(['prefix' => 'flight'],function () {
        Route::get('/', 'Api\FlightController@index');
        Route::get('/{id}', 'Api\FlightController@show');
        Route::put('/{id}', 'Api\FlightController@show');
        Route::post('/', 'Api\FlightController@show');
        Route::delete('/{id}', 'Api\FlightController@show');
    });
//    Route::resourse('flight', 'Api\FlightController');
//    Route::resourse('airline', 'AirlineController');
//    Route::resourse('flight-book', 'FlightBookController');
//    Route::resourse('transaction', 'TransactionController');
//    Route::post('logout', 'Auth\LoginController@logout');
});