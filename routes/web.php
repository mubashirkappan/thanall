<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
// Route::get('userlist',@user)
Route::controller(UserController::class)->name('user.')->prefix('user')->group(function(){
    Route::post('list','index')->name('list');
    Route::get('create','create')->name('create');
    Route::post('save','store')->name('save');
    Route::get('list','index')->name('list');
});
