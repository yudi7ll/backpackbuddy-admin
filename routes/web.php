<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'dashboard');

Auth::routes(['register' => false]);

Route::middleware('auth:web')->group(function () {
    Route::get('dashboard', 'AdminController@index')->name('dashboard');
    Route::resource('itinerary', 'ItineraryController');
    Route::resource('category', 'CategoryController')->except('create');
    Route::resource('district', 'DistrictController')->except('create');
    Route::resource('review', 'ReviewController')->except('create', 'edit', 'update');
    Route::resource('customer', 'CustomerController');
    Route::prefix('customer')->group(function () {
        Route::put('{customer}/update-password', 'CustomerController@updatePassword')->name('customer.update-password');
        Route::put('{customer}/update-info', 'CustomerController@updateInfo')->name('customer.update-info');
        // redirect customer show to edit
        Route::get('{customer}', function ($customer) {
            return redirect()->route('customer.edit', $customer);
        });
    });
    Route::resource('media', 'MediaController');
    Route::get('get-media/{filename}/{thumb?}', 'MediaController@getMedia');
    Route::get('order/{filter?}', 'OrderController@index')->name('order');
    Route::resource('order', 'OrderController')->except(['create', 'index']);
});
