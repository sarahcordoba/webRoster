<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; // Asegúrate de importar el facade Auth


class EmpleadoController extends Controller
{
    // Mostrar todos los empleados
    public function index()
    {
        $empleados = Empleado::all(); // Cargar empleados con departamentos
        $totalEmpleados = $empleados->count();

        return view('empleados.index', compact('empleados', 'totalEmpleados'));
    }

    // Mostrar el formulario para crear un nuevo empleado
    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        // Valida los datos
        $user = Auth::user();
        if ($user) {
            $validatedData = $request->validate([
                'idEmpleador' => Auth::user()->id,  // Asumiendo que el 'idEmpleador' es el id del usuario autenticado
                'primer_nombre' => 'required|string|max:255',
                'segundo_nombre' => 'nullable|string|max:255',
                'primer_apellido' => 'required|string|max:255',
                'segundo_apellido' => 'nullable|string|max:255',
                'tipo_identificacion' => 'required|string',
                'numero_identificacion' => 'required|numeric|unique:empleados,numero_identificacion',
                'municipio' => 'required|string',
                'direccion' => 'required|string|max:255',
                'celular' => 'required|numeric',
                'correo' => 'required|email|unique:empleados,correo',
                'tipo_contrato' => 'required|string',
                'fecha_contratacion' => 'required|date',
                'fecha_fin_contrato' => 'nullable|date|after_or_equal:fecha_contratacion',
                'salario' => 'required|numeric|min:0',
                'salario_integral' => 'required|boolean',
                'frecuencia_pago' => 'required|string',
                'tipo_trabajador' => 'required|string',
                'subtipo_trabajador' => 'nullable|string',
                'auxilio_transporte' => 'required|boolean',
                'alto_riesgo' => 'required|boolean',
                'sabado_laboral' => 'required|boolean',
                'nivel_riesgo' => 'required|string',
                'cargo' => 'required|string',
                'area' => 'required|string',
                'dias_vacaciones' => 'required|numeric|min:0',
                'metodo_pago' => 'required|string',
                'banco' => 'nullable|string',
                'numero_cuenta' => 'nullable|string',
                'tipo_cuenta' => 'nullable|string',
                'eps' => 'required|string',
                'caja_compensacion' => 'required|string',
                'fondo_pensiones' => 'required|string',
                'fondo_cesantias' => 'required|string',
            ], [
                'correo.unique' => 'El correo electrónico ya está registrado. Por favor, ingrese otro.'
            ]);

            // Agregar el idEmpleador del usuario autenticado
            $validatedData['idEmpleador'] = Auth::id();  // Asignar el idEmpleador

            // Crear el nuevo empleado con los datos validados
            Empleado::create($validatedData);

            // Redirigir a la página de listado de empleados con un mensaje de éxito
            return redirect()->route('empleados.index') // Cambia a la ruta que desees
                ->with('success', 'Empleado creado correctamente');
        } else {
            return response()->json(['error' => 'Usuario no autenticado.'], 401);
        }
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
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'required|string|max:255',
            'tipo_identificacion' => 'required|string',
            'numero_identificacion' => 'required|numeric|unique:empleados,numero_identificacion',
            'municipio' => 'required|string',
            'direccion' => 'required|string|max:255',
            'celular' => 'required|numeric',
            'correo' => 'required|email|unique:empleados,correo',
            'tipo_contrato' => 'required|string',
            'fecha_contratacion' => 'required|date',
            'fecha_fin_contrato' => 'nullable|date|after_or_equal:fecha_contratacion',
            'salario' => 'required|numeric|min:0',
            'salario_integral' => 'required|boolean',
            'frecuencia_pago' => 'required|string',
            'tipo_trabajador' => 'required|string',
            'subtipo_trabajador' => 'nullable|string',
            'auxilio_transporte' => 'required|boolean',
            'alto_riesgo' => 'required|boolean',
            'sabado_laboral' => 'required|boolean',
            'nivel_riesgo' => 'required|string',
            'cargo' => 'required|string',
            'area' => 'required|string',
            'dias_vacaciones' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string',
            'banco' => 'nullable|string',
            'numero_cuenta' => 'nullable|string',
            'tipo_cuenta' => 'nullable|string',
            'eps' => 'required|string',
            'caja_compensacion' => 'required|string',
            'fondo_pensiones' => 'required|string',
            'fondo_cesantias' => 'required|string',
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
