<?php

namespace App\Http\Controllers;

use App\Models\Liquidacion;
use App\Models\Empleado;
use Illuminate\Http\Request;

class LiquidacionController extends Controller
{
    // Mostrar todas las liquidaciones
    public function index()
    {
        $liquidaciones = Liquidacion::all();
        return view('liquidaciones.index', compact('liquidaciones'));
    }

    // Mostrar el formulario para crear una nueva liquidación
    public function create()
    {
        $empleados = Empleado::all(); // Asumiendo que tienes el modelo Empleado
        return view('liquidaciones.create', compact('empleados'));
    }

    // Guardar una nueva liquidación en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'idEmpleado' => 'required|exists:empleados,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado' => 'required|string|max:15',
            'salario' => 'required|numeric',
            'total_deducciones' => 'nullable|numeric',
            'total_comisiones' => 'nullable|numeric',
            'total' => 'required|numeric',
        ]);

        Liquidacion::create($request->all());
        return redirect()->route('liquidaciones.index')->with('success', 'Liquidación creada exitosamente.');
    }

    // Mostrar una liquidación específica
    public function show($id)
    {
        $liquidacion = Liquidacion::findOrFail($id);
        return view('liquidaciones.show', compact('liquidacion'));
    }

    // Mostrar el formulario para editar una liquidación
    public function edit($id)
    {
        $liquidacion = Liquidacion::findOrFail($id);
        $empleados = Empleado::all();
        return view('liquidaciones.edit', compact('liquidacion', 'empleados'));
    }

    // Actualizar una liquidación en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'idEmpleado' => 'required|exists:empleados,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado' => 'required|string|max:15',
            'salario' => 'required|numeric',
            'total_deducciones' => 'nullable|numeric',
            'total_comisiones' => 'nullable|numeric',
            'total' => 'required|numeric',
        ]);

        $liquidacion = Liquidacion::findOrFail($id);
        $liquidacion->update($request->all());

        return redirect()->route('liquidaciones.index')->with('success', 'Liquidación actualizada exitosamente.');
    }

    // Eliminar una liquidación de la base de datos
    public function destroy($id)
    {
        $liquidacion = Liquidacion::findOrFail($id);
        $liquidacion->delete();

        return redirect()->route('liquidaciones.index')->with('success', 'Liquidación eliminada exitosamente.');
    }
}
