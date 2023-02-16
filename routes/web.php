<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::controller(UserController::class)->name('user.')->prefix('user')->group(function(){
    Route::post('list','index')->name('list');
    Route::get('create','create')->name('create');
    Route::post('save','store')->name('save');
    // Route::get('list','index')->name('list');
});
