<?php

namespace App\Http\Controllers;

use App\Models\ComisionNomina;
use Illuminate\Http\Request;

class ComisionNominaController extends Controller
{
    // Mostrar todas las comisiones asignadas a nóminas
    public function index()
    {
        $comisionesNomina = ComisionNomina::all();
        return response()->json($comisionesNomina);
    }

    // Mostrar una relación específica entre nómina y comisión
    public function show($nomina_id, $comision_id)
    {
        $comisionNomina = ComisionNomina::where('nomina_id', $nomina_id)
                                        ->where('comision_id', $comision_id)
                                        ->firstOrFail();
        return response()->json($comisionNomina);
    }

    // Asignar una comisión a una nómina
    public function store(Request $request)
    {
        $comisionNomina = ComisionNomina::create($request->all());
        return response()->json($comisionNomina, 201);
    }

    // Actualizar una comisión asignada a una nómina
    public function update(Request $request, $nomina_id, $comision_id)
    {
        $comisionNomina = ComisionNomina::where('nomina_id', $nomina_id)
                                        ->where('comision_id', $comision_id)
                                        ->firstOrFail();
        $comisionNomina->update($request->all());
        return response()->json($comisionNomina, 200);
    }

    // Eliminar una comisión asignada a una nómina
    public function destroy($nomina_id, $comision_id)
    {
        $comisionNomina = ComisionNomina::where('nomina_id', $nomina_id)
                                        ->where('comision_id', $comision_id)
                                        ->firstOrFail();
        $comisionNomina->delete();
        return response()->json(null, 204);
    }
}
