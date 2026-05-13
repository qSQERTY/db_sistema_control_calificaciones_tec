<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstudianteController;  
use App\Http\Controllers\AnioController;
use App\Http\Controllers\ExamenController;

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
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/anios', [AnioController::class, 'store']);
Route::get('/panel', [AnioController::class, 'index'])
    ->middleware('auth');
Route::get('/panel/{anio}', [AnioController::class, 'show']);
Route::get('/examenes', [ExamenController::class, 'index']);
Route::post('/examenes', [ExamenController::class, 'store']);