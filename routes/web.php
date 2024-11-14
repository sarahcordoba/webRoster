<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\NominaController;
use App\Http\Controllers\DeduccionController;
use App\Http\Controllers\ComisionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LiquidacionController;
use App\Models\Comision;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index']);

Route::resource('departamentos', DepartamentoController::class);
Route::resource('empleados', EmpleadoController::class);
Route::resource('nominas', NominaController::class);
Route::resource('deducciones', DeduccionController::class);
Route::resource('bonificaciones', ComisionController::class);
Route::resource('liquidacion', LiquidacionController::class);
Route::get('/liquidacion/{id}', [LiquidacionController::class, 'show'])->name('liquidaciones.show');



Route::post('api/add/liquidacion', [LiquidacionController::class, 'store']);
Route::get('/api/getall/liquidaciones', [LiquidacionController::class, 'getLiquidaciones']);

// Route::get('/liquidacion', function () {
//     return view('liquidacion/index');
// });
