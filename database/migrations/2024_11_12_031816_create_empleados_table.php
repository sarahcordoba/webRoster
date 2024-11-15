<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id()->primary(); //numero de identificación
            $table->unsignedBigInteger('idEmpleador'); //numero de identificación
            $table->foreign('idEmpleador')->references('id')->on('users');

            $table->string('primer_nombre', 50);
            $table->string('segundo_nombre', 50)->nullable();
            $table->string('primer_apellido', 50);
            $table->string('segundo_apellido',50)->nullable();
            $table->string('tipo_identificacion', 50);
            $table->string('municipio', 100);
            $table->string('direccion', 500);
            $table->string('celular', 15)->nullable();
            $table->string('correo', 255)->unique();
            $table->string('tipo_contrato', 50);
            $table->decimal('salario', 20, 2);
            $table->string('tipo_trabajador', 255);
            $table->boolean('salario_integral')->default(false);
            $table->date('fecha_contratacion');
            $table->string('frecuencia_pago', 50);
            $table->string('subtipo_trabajador', 50);
            $table->boolean('auxilio_transporte')->default(false);
            $table->boolean('alto_riesgo')->default(false);
            $table->boolean('sabado_laboral')->default(false);
            $table->string('nivel_riesgo', 50);
            $table->string('cargo', 255);
            $table->integer('dias_vacaciones');
            $table->string('area', 255);
            //$table->integer('departamento_id')->unsigned();
            $table->string('metodo_pago', 255);
            $table->string('eps', 255);
            $table->string('caja_compensacion', 255);
            $table->string('fondo_pensiones', 255);
            $table->string('fondo_cesantias', 255);
            //$table->foreign('departamento_id')->references('idDepartamento')->on('departamentos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
