<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    // Mostrar todos los empleados
    public function index()
    {
        $empleados = Empleado::all();
        return view('empleados.index', compact('empleados'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        return view('empleados.create');
    }

    // Guardar un nuevo empleado en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'primer_nombre' => 'required|string|max:50',
            'primer_apellido' => 'required|string|max:50',
            'tipo_identificacion' => 'required|string|max:50',
            'municipio' => 'required|string|max:100',
            'direccion' => 'required|string|max:500',
            'correo' => 'required|string|email|max:255|unique:empleados',
            'tipo_contrato' => 'required|string|max:50',
            'salario' => 'required|numeric',
            // Agrega las demás validaciones según los campos que necesites
        ]);

        Empleado::create($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado creado exitosamente.');
    }

    // Mostrar un empleado específico
    public function show(Empleado $empleado)
    {
        return view('empleados.show', compact('empleado'));
    }

    // Mostrar el formulario para editar un empleado
    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    // Actualizar un empleado en la base de datos
    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'primer_nombre' => 'required|string|max:50',
            'primer_apellido' => 'required|string|max:50',
            // Agrega las demás validaciones necesarias
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
    }

    // Eliminar un empleado de la base de datos
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente.');
    }
}
