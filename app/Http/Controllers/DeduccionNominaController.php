<?php

namespace App\Http\Controllers;

use App\Models\DeduccionNomina;
use Illuminate\Http\Request;

class DeduccionNominaController extends Controller
{
    // Mostrar todas las deducciones asignadas a nóminas
    public function index()
    {
        $deduccionesNomina = DeduccionNomina::all();
        return response()->json($deduccionesNomina);
    }

    // Mostrar una deducción específica asignada a una nómina
    public function show($nomina_id, $deduccion_id)
    {
        $deduccionNomina = DeduccionNomina::where('nomina_id', $nomina_id)
                                          ->where('deduccion_id', $deduccion_id)
                                          ->firstOrFail();
        return response()->json($deduccionNomina);
    }

    // Asignar una deducción a una nómina
    public function store(Request $request)
    {
        $deduccionNomina = DeduccionNomina::create($request->all());
        return response()->json($deduccionNomina, 201);
    }

    // Actualizar una deducción asignada a una nómina
    public function update(Request $request, $nomina_id, $deduccion_id)
    {
        $deduccionNomina = DeduccionNomina::where('nomina_id', $nomina_id)
                                          ->where('deduccion_id', $deduccion_id)
                                          ->firstOrFail();
        $deduccionNomina->update($request->all());
        return response()->json($deduccionNomina, 200);
    }

    // Eliminar una deducción asignada a una nómina
    public function destroy($nomina_id, $deduccion_id)
    {
        $deduccionNomina = DeduccionNomina::where('nomina_id', $nomina_id)
                                          ->where('deduccion_id', $deduccion_id)
                                          ->firstOrFail();
        $deduccionNomina->delete();
        return response()->json(null, 204);
    }
}
