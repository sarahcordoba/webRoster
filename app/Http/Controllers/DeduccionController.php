<?php

namespace App\Http\Controllers;

use App\Models\Deduccion;
use App\Models\Nomina;
use Illuminate\Http\Request;

class DeduccionController extends Controller
{
    // Mostrar todas las deducciones
    public function index()
    {
        $deducciones = Deduccion::with('nomina')->get(); // Cargar deducciones con nominas
        return view('deducciones.index', compact('deducciones'));
    }

    // Mostrar el formulario para crear una nueva deduccion
    public function create()
    {
        $nominas = Nomina::all(); // Obtener todas las nominas para la lista desplegable
        return view('deducciones.create', compact('nominas'));
    }

    // Guardar una nueva deduccion
    public function store(Request $request)
    {
        $request->validate([
            'nomina_id' => 'required|integer|exists:nomina,idNomina',
            'tipo' => 'required|string|max:100',
            'monto' => 'required|numeric|min:0',
        ]);

        Deduccion::create($request->all());

        return redirect()->route('deducciones.index')->with('success', 'Deduccion creada con éxito.');
    }

    // Mostrar una deduccion específica
    public function show($id)
    {
        $deduccion = Deduccion::with('nomina')->findOrFail($id); // Cargar deduccion con su nomina
        return view('deducciones.show', compact('deduccion'));
    }

    // Mostrar el formulario para editar una deduccion existente
    public function edit($id)
    {
        $deduccion = Deduccion::findOrFail($id);
        $nominas = Nomina::all(); // Obtener nominas para la lista desplegable
        return view('deducciones.edit', compact('deduccion', 'nominas'));
    }

    // Actualizar una deduccion existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomina_id' => 'required|integer|exists:nomina,idNomina',
            'tipo' => 'required|string|max:100',
            'monto' => 'required|numeric|min:0',
        ]);

        $deduccion = Deduccion::findOrFail($id);
        $deduccion->update($request->all());

        return redirect()->route('deducciones.index')->with('success', 'Deduccion actualizada con éxito.');
    }

    // Eliminar una deduccion existente
    public function destroy($id)
    {
        $deduccion = Deduccion::findOrFail($id);
        $deduccion->delete();

        return redirect()->route('deducciones.index')->with('success', 'Deduccion eliminada con éxito.');
    }
}
