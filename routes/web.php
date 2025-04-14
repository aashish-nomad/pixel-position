<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use App\Http\Middleware\PasswordProtect;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => [PasswordProtect::class]], function () {
    Route::get('/', [JobController::class, 'index']);

    Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
    Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');

    Route::get('/search', SearchController::class);
    Route::get('/tags/{tag:name}', TagController::class);

    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', [RegisteredController::class, 'create']);
        Route::post('/register', [RegisteredController::class, 'store']);
        Route::get('login', [SessionController::class, 'create'])->name('login');
        Route::post('login', [SessionController::class, 'store']);
    });

    Route::delete('logout', [SessionController::class, 'destroy'])->middleware('auth');
});


