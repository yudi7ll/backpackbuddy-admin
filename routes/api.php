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

Route::get('itinerary', 'Api\ItineraryController@index');
Route::get('itinerary/{itinerary}', 'Api\ItineraryController@show');
Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');

Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'Api\AuthController@logout');
    Route::get('current-user', 'Api\CustomerController@currentUser');
    Route::resource('user', 'Api\CustomerController')->except(['create', 'store']);
});
