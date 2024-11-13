<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduccion extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'deduccion';

    // Campos asignables masivamente
    protected $fillable = [
        'tipo',
        'descripcion',
        'monto',
    ];
}
