<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si coincide con el nombre en plural del modelo)
    protected $table = 'liquidaciones';

    // Definir los campos asignables masivamente
    protected $fillable = [
        'idEmpleado',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'empleados',
        'salario',
        'total_deducciones',
        'total_comisiones',
        'total',
    ];

    // Relación con el modelo Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado');
    }
}
