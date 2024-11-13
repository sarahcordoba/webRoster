<?php

namespace App\Http\Controllers;

use App\Models\Nomina;
use Illuminate\Http\Request;

class NominaController extends Controller
{
    // Mostrar todas las nóminas
    public function index()
    {
        $nominas = Nomina::all();
        return response()->json($nominas);
    }

    // Mostrar una nómina específica
    public function show($id)
    {
        $nomina = Nomina::findOrFail($id);
        return response()->json($nomina);
    }

    // Crear una nueva nómina
    public function store(Request $request)
    {
        $nomina = Nomina::create($request->all());
        return response()->json($nomina, 201);
    }

    // Actualizar una nómina
    public function update(Request $request, $id)
    {
        $nomina = Nomina::findOrFail($id);
        $nomina->update($request->all());
        return response()->json($nomina, 200);
    }

    // Eliminar una nómina
    public function destroy($id)
    {
        $nomina = Nomina::findOrFail($id);
        $nomina->delete();
        return response()->json(null, 204);
    }
}
