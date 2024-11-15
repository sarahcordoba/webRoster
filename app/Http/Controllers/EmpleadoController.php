<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Departamento;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    // Mostrar todos los empleados
    public function index()
    {
        $empleados = Empleado::all();
        return view('empleados.index', compact('empleados'));
    }

    // Mostrar el formulario para crear un nuevo empleado
    public function create()
    {
        return view('empleados.create');
    }

    // Guardar un nuevo empleado
    public function store(Request $request)
    {

        dd($request->all());

        $request->validate([
            // 'idEmpleador' => 'required|exists:users,id',
            'primer_nombre' => 'required|string|max:50',
            'primer_apellido' => 'required|string|max:50',
            'tipo_identificacion' => 'required|string|max:50',
            'numero_identificacion' => 'required|string|max:10|unique:empleados,numero_identificacion',
            'municipio' => 'required|string|max:100',
            'direccion' => 'required|string|max:500',
            'celular' => 'nullable|string|max:15',
            'correo' => 'required|string|email|max:255|unique:empleados,correo',
            'tipo_contrato' => 'required|string|max:50',
            'salario' => 'required|decimal:0,2',
            'tipo_trabajador' => 'required|string|max:50',
            'fecha_contratacion' => 'required|date',
            'fecha_fin_contrato' => 'required|date',
            'frecuencia_pago' => 'required|string|max:50',
            'cargo' => 'required|string|max:255',
            'dias_vacaciones' => 'nullable|integer',
            'area' => 'required|string|max:255',
            'metodo_pago' => 'required|string|max:255',
            'banco' => 'nullable|string|max:255',
            'numero_cuenta' => 'nullable|string|max:24',
            'tipo_cuenta' => 'nullable|string|max:50',
            'eps' => 'required|string|max:255',
            'caja_compensacion' => 'required|string|max:255',
            'fondo_pensiones' => 'required|string|max:255',
            'fondo_cesantias' => 'required|string|max:255',
        ]);

        Empleado::create($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado creado con éxito.');
    }

    // Mostrar un empleado específico
    public function show($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleados.show', compact('empleado'));
    }

    // Mostrar el formulario para editar un empleado existente
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleados.edit', compact('empleado'));
    }

    // Actualizar un empleado existente
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'idEmpleado' => 'required|string|unique:empleados,idEmpleado',
            'primer_nombre' => 'required|string|max:50',
            'primer_apellido' => 'required|string|max:50',
            'tipo_identificacion' => 'required|string|max:50',
            'numero_identificacion' => 'required|string|max:10|unique:empleados,numero_identificacion',
            'municipio' => 'required|string|max:100',
            'direccion' => 'required|string|max:500',
            'celular' => 'nullable|string|max:15',
            'correo' => 'required|string|email|max:255|unique:empleados,correo',
            'tipo_contrato' => 'required|string|max:50',
            'salario' => 'required|decimal:0,2',
            'tipo_trabajador' => 'required|string|max:50',
            'fecha_contratacion' => 'required|date',
            'fecha_fin_contrato' => 'required|date',
            'frecuencia_pago' => 'required|string|max:50',
            'cargo' => 'required|string|max:255',
            'dias_vacaciones' => 'nullable|integer',
            'area' => 'required|string|max:255',
            'metodo_pago' => 'required|string|max:255',
            'banco' => 'nullable|string|max:255',
            'numero_cuenta' => 'nullable|string|max:24',
            'tipo_cuenta' => 'nullable|string|max:50',
            'eps' => 'required|string|max:255',
            'caja_compensacion' => 'required|string|max:255',
            'fondo_pensiones' => 'required|string|max:255',
            'fondo_cesantias' => 'required|string|max:255',
        ]);

        $empleado = Empleado::findOrFail($id);
        $empleado->update($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado con éxito.');
    }

    // Eliminar un empleado existente
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado con éxito.');
    }
}