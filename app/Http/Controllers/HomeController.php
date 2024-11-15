<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $menuItems = [
            ['name' => 'Inicio', 'url' => '/', 'icon' => 'bi bi-house-door'],
            ['name' => 'Asistente Habilitación', 'url' => '/asistente', 'icon' => 'bi bi-person-check'],
            ['name' => 'Empleados', 'url' => '/empleados', 'icon' => 'bi bi-person-lines-fill'],
            ['name' => 'Liquidación', 'url' => '/liquidaciones', 'icon' => 'bi bi-cash'],
            ['name' => 'Colilla de Pago', 'url' => '/colilla-pago', 'icon' => 'bi bi-file-earmark-text'],
            ['name' => 'Eliminación', 'url' => '/eliminacion', 'icon' => 'bi bi-trash'],
            ['name' => 'Configuración', 'url' => '/configuracion', 'icon' => 'bi bi-gear'],
        ];

        // Pasar a todas las vistas (layout app.blade.php y otras vistas como dashboard)
        return view('dashboard', compact('menuItems'));
    }
}
