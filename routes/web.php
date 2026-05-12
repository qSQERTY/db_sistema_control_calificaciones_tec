<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstudianteController;  
use App\Http\Controllers\AnioController;

Route::get('/', function () {
    return view('login');
});

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth');
    Route::get('/panel', function () {
    return view('panel');
})->middleware('auth');


Route::resource('estudiantes', EstudianteController::class);
Route::get('/dashboard', [AniosController::class, 'index']);
Route::post('/años', [AnioController::class, 'store']);