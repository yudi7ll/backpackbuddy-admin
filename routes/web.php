<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'dashboard');

Auth::routes([ 'register' => false ]);

Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', 'AdminController@index')->name('dashboard');
});

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
