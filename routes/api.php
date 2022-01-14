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
        Route::put('users/{id}', 'UserController@update')->name('users');
    });

    Route::name('plans.')->group(function() {
        Route::get('plans', 'PlanController@index')->name('plans');
        Route::post('plans', 'PlanController@store')->name('plans');
        Route::get('plans/{id}', 'PlanController@show')->name('plans');
        Route::put('plans/{id}', 'PlanController@update')->name('plans');
    });

    Route::name('form-payment.')->group(function() {
        Route::get('form-payment', 'FormPaymentController@index')->name('form-payment');
        Route::post('form-payment', 'FormPaymentController@store')->name('form-payment');
        Route::get('form-payment/{id}', 'FormPaymentController@show')->name('form-payment');
        Route::put('form-payment/{id}', 'FormPaymentController@update')->name('form-payment');
    });

    Route::name('registration.')->group(function() {
        Route::get('registration', 'RegistrationController@index')->name('registration');
        Route::post('registration', 'RegistrationController@store')->name('registration');
        Route::get('registration/{id}', 'RegistrationController@show')->name('registration');
    });

    Route::name('physical-evaluation-form.')->group(function() {
        Route::get('physical-evaluation-form', 'PhysicalEvaluationFormController@index')->name('physical-evaluation-form');
        Route::post('physical-evaluation-form', 'PhysicalEvaluationFormController@store')->name('physical-evaluation-form');
        Route::get('physical-evaluation-form/{id}', 'PhysicalEvaluationFormController@show')->name('physical-evaluation-form');
        Route::put('physical-evaluation-form/{id}', 'PhysicalEvaluationFormController@update')->name('physical-evaluation-form');
    });

    Route::name('training-sheets.')->group(function() {
        Route::get('training-sheets', 'TrainingSheetsController@index')->name('training-sheets');
        Route::post('training-sheets', 'TrainingSheetsController@store')->name('training-sheets');
        Route::get('training-sheets/{id}', 'TrainingSheetsController@show')->name('training-sheets');
    });

    Route::name('group-exercises.')->group(function() {
        Route::get('group-exercises', 'GroupExerciseController@index')->name('group-exercisess');
        Route::post('group-exercises', 'GroupExerciseController@store')->name('group-exercises');
        Route::get('group-exercises/{id}', 'GroupExerciseController@show')->name('group-exercises');
        Route::put('group-exercises/{id}', 'GroupExerciseController@update')->name('group-exercises');
    });

    Route::name('exercises.')->group(function() {
        Route::get('exercises', 'ExerciseController@index')->name('exercisess');
        Route::post('exercises', 'ExerciseController@store')->name('exercises');
        Route::get('exercises/{id}', 'ExerciseController@show')->name('exercises');
        Route::put('exercises/{id}', 'ExerciseController@update')->name('exercises');
    });

    Route::name('day-week-training.')->group(function() {
        Route::get('day-week-training', 'DayWeekTrainingController@index')->name('day-week-training');
        Route::post('day-week-training', 'DayWeekTrainingController@store')->name('day-week-training');
        Route::post('day-week-exercise', 'DayWeekTrainingController@create')->name('day-week-exercise');
        Route::get('day-week-training/{id}', 'DayWeekTrainingController@show')->name('day-week-training');
    });


});
