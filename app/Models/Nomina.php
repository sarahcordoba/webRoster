<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    protected $table = 'nominas'; // Nombre de la tabla
    protected $primaryKey = 'idNomina'; // Clave primaria

    protected $fillable = ['empleado_id', 'periodo', 'fechaPago', 'montoBruto', 'montoNeto']; // Campos rellenables

    public $timestamps = false; // Si no tienes timestamps

    // Relacion con el modelo Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'idEmpleado');
    }
}

