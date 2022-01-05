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

Route::prefix('v1')->namespace('Api')->group(function() {

    Route::name('users.')->group(function() {
        Route::get('users', 'UserController@index')->name('users');
        Route::post('users', 'UserController@store')->name('users');
        Route::get('users/{id}', 'UserController@show')->name('users');
    });

    Route::name('plans.')->group(function() {
        Route::get('plans', 'PlanController@index')->name('plans');
        Route::post('plans', 'PlanController@store')->name('plans');
        Route::get('plans/{id}', 'PlanController@show')->name('plans');
    });

});
