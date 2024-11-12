<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deduccion extends Model
{
    protected $table = 'deducciones'; // Nombre de la tabla
    protected $primaryKey = 'idDeduccion'; // Clave primaria

    protected $fillable = ['nomina_id', 'tipo', 'monto']; // Campos rellenables

    public $timestamps = false; // Si no tienes timestamps

    // Relacion con el modelo Nomina
    public function nomina()
    {
        return $this->belongsTo(Nomina::class, 'nomina_id', 'idNomina');
    }
}
