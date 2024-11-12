<?php

namespace App\Http\Controllers;

use App\Models\Bonificacion;
use App\Models\Nomina;
use Illuminate\Http\Request;

class BonificacionController extends Controller
{
    // Mostrar todas las bonificaciones
    public function index()
    {
        $bonificaciones = Bonificacion::with('nomina')->get(); // Cargar bonificaciones con nominas
        return view('bonificaciones.index', compact('bonificaciones'));
    }

    // Mostrar el formulario para crear una nueva bonificacion
    public function create()
    {
        $nominas = Nomina::all(); // Obtener todas las nominas para la lista desplegable
        return view('bonificaciones.create', compact('nominas'));
    }

    // Guardar una nueva bonificacion
    public function store(Request $request)
    {
        $request->validate([
            'nomina_id' => 'required|integer|exists:nomina,idNomina',
            'tipo' => 'required|string|max:100',
            'monto' => 'required|numeric|min:0',
        ]);

        Bonificacion::create($request->all());

        return redirect()->route('bonificaciones.index')->with('success', 'Bonificacion creada con éxito.');
    }

    // Mostrar una bonificacion específica
    public function show($id)
    {
        $bonificacion = Bonificacion::with('nomina')->findOrFail($id); // Cargar bonificacion con su nomina
        return view('bonificaciones.show', compact('bonificacion'));
    }

    // Mostrar el formulario para editar una bonificacion existente
    public function edit($id)
    {
        $bonificacion = Bonificacion::findOrFail($id);
        $nominas = Nomina::all(); // Obtener nominas para la lista desplegable
        return view('bonificaciones.edit', compact('bonificacion', 'nominas'));
    }

    // Actualizar una bonificacion existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomina_id' => 'required|integer|exists:nomina,idNomina',
            'tipo' => 'required|string|max:100',
            'monto' => 'required|numeric|min:0',
        ]);

        $bonificacion = Bonificacion::findOrFail($id);
        $bonificacion->update($request->all());

        return redirect()->route('bonificaciones.index')->with('success', 'Bonificacion actualizada con éxito.');
    }

    // Eliminar una bonificacion existente
    public function destroy($id)
    {
        $bonificacion = Bonificacion::findOrFail($id);
        $bonificacion->delete();

        return redirect()->route('bonificaciones.index')->with('success', 'Bonificacion eliminada con éxito.');
    }
}
