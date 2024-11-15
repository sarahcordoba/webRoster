<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComisionNomina extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'comisiones_nomina';

    // Deshabilitar timestamps
    public $timestamps = false;

    // Campos asignables masivamente
    protected $fillable = [
        'nomina_id',
        'comision_id',
        'esporcentaje',
        'monto',
    ];

    // Relación con el modelo Nomina
    public function nomina()
    {
        return $this->belongsTo(Nomina::class, 'nomina_id');
    }

    // Relación con el modelo Comision
    public function comision()
    {
        return $this->belongsTo(Comision::class, 'comision_id');
    }
}
