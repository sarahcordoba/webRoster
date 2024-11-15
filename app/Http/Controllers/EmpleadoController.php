<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmpleadoController extends Controller
{
    // Mostrar todos los empleados
    public function index()
    {
        $empleados = Empleado::all();
        // return view('empleados.index', compact('empleados'));
        $totalEmpleados = $empleados->count();
        return view('empleados.index', compact('empleados', 'totalEmpleados'));
    }

    // Mostrar el formulario para crear un nuevo empleado
    public function create()
    {
        return view('empleados.create');
    }

    // Guardar un nuevo empleado
    // public function store(Request $request)
    // {

    //     dd($request->all());
    //     $empleadoData = $request->all();  // Captura todos los datos del formulario

    //     dd($empleadoData['tipo_cuenta']);  // Verifica que se haya enviado el valor de tipo_cuenta


    //     $validated = $request->validate([
    //         // 'idEmpleador' => 'required|exists:users,id',
    //         'primer_nombre' => 'required|string|max:50',
    //         'primer_apellido' => 'required|string|max:50',
    //         'tipo_identificacion' => 'required|string|max:50',
    //         'numero_identificacion' => 'required|string|max:10|unique:empleados,numero_identificacion',
    //         'municipio' => 'required|string|max:100',
    //         'direccion' => 'required|string|max:500',
    //         'celular' => 'nullable|string|max:15',
    //         'correo' => 'required|string|email|max:255|unique:empleados,correo',
    //         'tipo_contrato' => 'required|string|max:50',
    //         'salario' => 'required|decimal:0,2',
    //         'tipo_trabajador' => 'required|string|max:50',
    //         'fecha_contratacion' => 'required|date',
    //         'fecha_fin_contrato' => 'required|date',
    //         'frecuencia_pago' => 'required|string|max:50',
    //         'cargo' => 'required|string|max:255',
    //         'dias_vacaciones' => 'nullable|integer',
    //         'area' => 'required|string|max:255',
    //         'metodo_pago' => 'required|string|max:255',
    //         'banco' => 'nullable|string|max:255',
    //         'numero_cuenta' => 'nullable|string|max:24',
    //         'tipo_cuenta' => 'nullable|string|max:50',
    //         'eps' => 'required|string|max:255',
    //         'caja_compensacion' => 'required|string|max:255',
    //         'fondo_pensiones' => 'required|string|max:255',
    //         'fondo_cesantias' => 'required|string|max:255',
    //     ]);

    //     Empleado::create($validated);

    //     return redirect()->route('empleados.index')->with('success', 'Empleado creado con éxito.');
    // }


    public function store(Request $request)
{
        // Validación de los datos
        $validated = $request->validate([
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
            'subtipo_trabajador' => 'nullable|string|max:50',  // Se valida que el campo sea un string
            'fecha_contratacion' => 'required|date',
            'fecha_fin_contrato' => 'required|date',
            'frecuencia_pago' => 'required|string|max:50',
            'alto_riesgo' => 'required|boolean',  // Validación para 'alto_riesgo'
            'sabado_laboral' => 'required|boolean',  // Validación para 'sabado_laboral'
            'nivel_riesgo' => 'nullable|string|max:50',  // Validación para 'nivel_riesgo'
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

        // Crear el nuevo empleado
        Empleado::create($validated);

        // Redireccionar con mensaje de éxito
        return redirect()->route('empleados.index')->with('success', 'Empleado creado con éxito.');
        
}

    // Mostrar un empleado específico
    public function show($id)
    {
        // $empleado = Empleado::findOrFail($id);
        // return view('empleados.show', data: compact('empleado'));


        // Obtén el empleado
        $empleado = Empleado::findOrFail($id);
        
        // Fecha de contratación
        $fechaContratacion = Carbon::parse($empleado->fecha_contratacion)->startOfDay(); // Eliminar horas
        
        // Fecha actual (hoy)
        $currentDate = Carbon::now()->startOfDay(); // Eliminar horas
        
        // Si la fecha de contratación es hoy mismo, el empleado ya está trabajando
        if ($fechaContratacion->isToday()) {
            $diasTrabajados = 1;
        } else {
            // Calcular la diferencia en días completos
            $diasTrabajados = $fechaContratacion->diffInDays($currentDate);
        }
        
        // Pasar los datos a la vista
        return view('empleados.show', compact('empleado', 'diasTrabajados'));
        
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
            'subtipo_trabajador' => 'nullable|string|max:50',  // Se valida que el campo sea un string
            'fecha_contratacion' => 'required|date',
            'fecha_fin_contrato' => 'required|date',
            'frecuencia_pago' => 'required|string|max:50',
            'cargo' => 'required|string|max:255',
            'alto_riesgo' => 'required|boolean',  // Validación para 'alto_riesgo'
            'sabado_laboral' => 'required|boolean',  // Validación para 'sabado_laboral'
            'nivel_riesgo' => 'nullable|string|max:50',  // Validación para 'nivel_riesgo'
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
