<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeduccionNomina extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'deducciones_nomina';

    // Deshabilitar timestamps
    public $timestamps = false;

    // Campos asignables masivamente
    protected $fillable = [
        'nomina_id',
        'deduccion_id',
        'esporcentaje',
        'monto',
    ];

    // Relación con el modelo Nomina
    public function nomina()
    {
        return $this->belongsTo(Nomina::class, 'nomina_id');
    }

    // Relación con el modelo Deduccion
    public function deduccion()
    {
        return $this->belongsTo(Deduccion::class, 'deduccion_id');
    }
}
