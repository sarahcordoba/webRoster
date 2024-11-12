<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\NominaController;
use App\Http\Controllers\DeduccionController;
use App\Http\Controllers\BonificacionController;
use App\Http\Controllers\HomeController;


// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index']);

Route::resource('departamentos', DepartamentoController::class);
Route::resource('empleados', EmpleadoController::class);
Route::resource('nominas', NominaController::class);
Route::resource('deducciones', DeduccionController::class);
Route::resource('bonificaciones', BonificacionController::class);

