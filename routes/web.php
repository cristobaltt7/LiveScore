<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FootballController;

Route::get('/', [FootballController::class, 'home'])->name('home');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
Route::get('/settings', function () {
    return view('settings');
})->name('settings');
    
Route::get('/equipos', function () {
    return view('equipos.index');
})->name('equipos.index')->middleware('auth');

Route::get('/football', function () {
    return view('football');
})->name('football');

Route::get('/sports', function () {
    return view('sports');
})->name('sports');

Route::get('/news', function () {
    return view('news');
})->middleware('auth');

Route::get('/followed-team', function () {
    return view('followed-team');
})->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});