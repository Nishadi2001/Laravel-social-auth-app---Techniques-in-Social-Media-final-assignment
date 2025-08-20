<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/redirect/google', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/callback/google', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/dashboard', function () {
    return view('dashboard', ['user' => Auth::user()]);
})->middleware('auth');
