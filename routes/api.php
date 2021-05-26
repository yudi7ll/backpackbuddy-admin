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

Route::get('itineraries/search/{search}', 'Api\ItineraryController@search');
Route::get('itineraries/{offset?}/{limit?}', 'Api\ItineraryController@index');
Route::get('itinerary/{itinerary}', 'Api\ItineraryController@show');
Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');

Route::middleware('auth:api-customers')->group(function () {
    Route::post('logout', 'Api\AuthController@logout');
    Route::get('get-media/{fullpath}/{thumb?}', 'Api\MediaController@getMedia');
    Route::prefix('customer')->group(function () {
        Route::put('/', 'Api\CustomerController@update');
        Route::put('/info', 'Api\CustomerController@updateInfo');
        Route::put('/password', 'Api\CustomerController@updatePassword');
        Route::get('/', 'Api\CustomerController@index');
        Route::get('/me', 'Api\CustomerController@show');
        Route::get('/me/info', 'Api\CustomerController@showInfo');
    });
    Route::prefix('order')->group(function () {
        Route::get('/exist/{itineraryId}', 'Api\OrderController@isExist');
        Route::get('/{filter}', 'Api\OrderController@index');
        Route::post('/', 'Api\OrderController@store');
    });
    Route::get('review/{itineraryId}', 'Api\ReviewController@index');
    Route::post('review/{itineraryId}', 'Api\ReviewController@store');
});
