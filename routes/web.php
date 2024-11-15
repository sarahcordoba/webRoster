<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\NominaController;
use App\Http\Controllers\DeduccionController;
use App\Http\Controllers\ComisionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LiquidacionController;
use App\Models\Comision;


Route::get('/', [HomeController::class, 'index']);

Route::resource('departamentos', DepartamentoController::class);
Route::resource('empleados', EmpleadoController::class);
Route::resource('nominas', NominaController::class);
Route::resource('deducciones', DeduccionController::class);
Route::resource('bonificaciones', ComisionController::class);
Route::resource('liquidaciones', LiquidacionController::class);
//Route::get('/liquidaciones/{id}', [LiquidacionController::class, 'show'])->name('liquidaciones.show');
//Route::get('/nominas/{id}', [NominaController::class, 'show'])->name('nominas.show');

use App\Models\Nomina;

Route::get('edit/nominas/{id}', function ($id) {
    $nomina = Nomina::findOrFail($id);
    return view('nominas.edit', compact('nomina'));
})->name('nominas.edit');





Route::delete('api/delete/liquidacion/{id}', [LiquidacionController::class, 'destroy']);

Route::post('api/add/liquidacion', [LiquidacionController::class, 'store']);
Route::get('api/getall/liquidaciones', [LiquidacionController::class, 'getLiquidaciones']);
Route::post('api/add/nomina', [NominaController::class, 'store']);



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboardb', function () {
    return view('dashboardb');
})->middleware(['auth', 'verified'])->name('dashboardb');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
