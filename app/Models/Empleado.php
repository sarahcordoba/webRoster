<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados'; // Nombre de la tabla
    protected $primaryKey = 'idEmpleado'; // Clave primaria

    protected $fillable = [
        'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido',
        'tipo_identificacion', 'municipio', 'direccion',
        'celular', 'correo', 'tipo_contrato', 'salario', 'tipo_trabajador',
        'salario_integral', 'fecha_contratacion', 'frecuencia_pago', 
        'subtipo_trabajador', 'auxilio_transporte', 'alto_riesgo', 
        'sabado_laboral', 'nivel_riesgo', 'cargo', 'dias_vacaciones', 
        'area', 'departamento', 'metodo_pago', 'eps', 'caja_compensacion', 
        'fondo_pensiones', 'fondo_cesantias'
    ];

    public $timestamps = false; // Si no tienes timestamps

    // Relación con el modelo Departamento
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'idDepartamento');
    }
}
