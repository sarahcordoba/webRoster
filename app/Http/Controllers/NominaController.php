<?php

namespace App\Http\Controllers;

use App\Models\Nomina;
use App\Models\Empleado;
use Illuminate\Http\Request;

class NominaController extends Controller
{
    // Mostrar todas las nominas
    public function index()
    {
        $nominas = Nomina::with('empleado')->get(); // Cargar nominas con empleados
        return view('nominas.index', compact('nominas'));
    }

    // Mostrar el formulario para crear una nueva nomina
    public function create()
    {
        $empleados = Empleado::all(); // Obtener todos los empleados para la lista desplegable
        return view('nominas.create', compact('empleados'));
    }

    // Guardar una nueva nomina
    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|integer|exists:empleado,idEmpleado',
            'periodo' => 'required|string|max:50',
            'fechaPago' => 'required|date',
            'montoBruto' => 'required|numeric|min:0',
            'montoNeto' => 'required|numeric|min:0',
        ]);

        Nomina::create($request->all());

        return redirect()->route('nominas.index')->with('success', 'Nomina creada con éxito.');
    }

    // Mostrar una nomina específica
    public function show($id)
    {
        $nomina = Nomina::with('empleado')->findOrFail($id); // Cargar nomina con su empleado
        return view('nominas.show', compact('nomina'));
    }

    // Mostrar el formulario para editar una nomina existente
    public function edit($id)
    {
        $nomina = Nomina::findOrFail($id);
        $empleados = Empleado::all(); // Obtener empleados para la lista desplegable
        return view('nominas.edit', compact('nomina', 'empleados'));
    }

    // Actualizar una nomina existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'empleado_id' => 'required|integer|exists:empleado,idEmpleado',
            'periodo' => 'required|string|max:50',
            'fechaPago' => 'required|date',
            'montoBruto' => 'required|numeric|min:0',
            'montoNeto' => 'required|numeric|min:0',
        ]);

        $nomina = Nomina::findOrFail($id);
        $nomina->update($request->all());

        return redirect()->route('nominas.index')->with('success', 'Nomina actualizada con éxito.');
    }

    // Eliminar una nomina existente
    public function destroy($id)
    {
        $nomina = Nomina::findOrFail($id);
        $nomina->delete();

        return redirect()->route('nominas.index')->with('success', 'Nomina eliminada con éxito.');
    }
}
