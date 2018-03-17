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

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout');
    Route::post('register', 'Auth\RegisterController@register');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['prefix' => 'flight'],function () {
            Route::get('/', 'Api\FlightController@index');
            Route::get('/{id}', 'Api\FlightController@show');
            Route::put('/{id}', 'Api\FlightController@update');
            Route::post('/', 'Api\FlightController@store');
            Route::delete('/{id}', 'Api\FlightController@show');
            Route::get('{DEPARTURE_DATE}/{DEPARTURE_CITY_NAME}/{DESTINATION_CITY_NAME}', 'Api\FlightController@getFlight');
        });

        Route::group(['prefix' => 'airline'], function() {
            Route::get('/', 'Api\AirlineController@index');
            Route::get('/{id}', 'Api\AirlineController@show')->where('id', '[0-9]+');
            Route::post('/', 'Api\AirlineController@store');
            Route::put('/{id}', 'Api\AirlineController@update')->where('id', '[0-9]+');
            Route::delete('/{id}', 'Api\AirlineController@destroy')->where('id', '[0-9]+');
        });

        Route::group(['prefix' => 'flight-book'], function () {
            Route::get('/', 'Api\FlightBookController@index');
            Route::get('/{id}', 'Api\FlightBookController@show')->where('id', '[0-9]+');
//            Route::post('/', 'Api\FlightBookController@store');
            Route::put('/{id}', 'Api\FlightBookController@update')->where('id', '[0-9]+');
            Route::delete('/{id}', 'Api\FlightBookController@destroy')->where('id', '[0-9]+');
            Route::post('/', 'Api\FlightBookController@bookAFlight');
            Route::post('search-flight', 'Api\FlightBookController@searchFlight');
        });
        Route::post('transaction/', 'Api\TransactionController@transaction');
    });
});