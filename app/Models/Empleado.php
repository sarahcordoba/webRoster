<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si coincide con el nombre en plural del modelo)
    protected $table = 'empleados';

    // Definir los campos asignables masivamente
    protected $fillable = [
        'idEmpleador',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'tipo_identificacion',
        'municipio',
        'direccion',
        'celular',
        'correo',
        'tipo_contrato',
        'salario',
        'tipo_trabajador',
        'salario_integral',
        'fecha_contratacion',
        'fecha_fin_contrato',
        'frecuencia_pago',
        'subtipo_trabajador',
        'auxilio_transporte',
        'alto_riesgo',
        'sabado_laboral',
        'nivel_riesgo',
        'cargo',
        'dias_vacaciones',
        'area',
        'metodo_pago',
        'banco',
        'numero_cuenta',
        'tipo_cuenta',
        'eps',
        'caja_compensacion',
        'fondo_pensiones',
        'fondo_cesantias',
    ];

    // Relación con el modelo Liquidacion
    public function liquidaciones()
    {
        return $this->hasMany(Liquidacion::class, 'idEmpleado');
    }
}
