<?php

use App\Http\Controllers\EntryController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::controller(UserController::class)->name('user.')->prefix('user')->group(function () {
    Route::post('login', 'index')->name('list');
    Route::get('create', 'create')->name('create');
    Route::post('save', 'store')->name('save');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/entry/{id}/edit', [EntryController::class, 'edit'])->name('entry.edit');
    Route::delete('/entry/{id}', [EntryController::class, 'destroy'])->name('entry.delete');
    Route::put('/entry/{id}', [EntryController::class, 'update'])->name('entry.update');

    Route::controller(UserController::class)->name('user.')->prefix('user')->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('view/{id?}', 'view')->name('view');
        Route::get('entry/{id?}', 'entry')->name('entry');

    });
    Route::controller(EntryController::class)->name('entry.')->prefix('entry')->group(function () {
        Route::post('save', 'store')->name('save');
    });
    Route::post('/logout', function () {
        Auth::logout();

        return redirect()->route('home');
    })->name('logout');
    Route::prefix('type')->name('type.')->controller(TypeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{type}', 'edit')->name('edit');
        Route::post('/update/{type}', 'update')->name('update');
        Route::get('/delete/{type}', 'delete')->name('delete');
    });
    Route::prefix('payment-method')->name('payment.')->controller(PaymentMethodController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::controller(UserController::class)->name('user.')->prefix('user')->group(function () {
        Route::get('list', 'show')->name('show');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::get('update/{id}', 'update')->name('update');
        Route::get('delete/{id}', 'delete')->name('delete');
    });
});
