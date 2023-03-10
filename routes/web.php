<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::controller(UserController::class)->name('user.')->prefix('user')->group(function(){
    Route::post('login','index')->name('list');
    Route::get('create','create')->name('create');
    Route::post('save','store')->name('save');
    Route::get('list','show')->name('show');
    Route::get('edit/{id}','edit')->name('edit');
    Route::get('delete/{id}','delete')->name('delete');
    Route::get('update/{id}','update')->name('update');
    Route::get('view/{id}','view')->name('view');
    Route::get('entry/{id}','entry')->name('entry');
});
Route::controller(UserController::class)->name('entry.')->prefix('entry')->group(function(){
    Route::post('save','store')->name('save');
});
