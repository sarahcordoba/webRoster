<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominasTable extends Migration
{
    public function up()
    {
        Schema::create('nominas', function (Blueprint $table) {
            $table->integer('idNomina', 10)->unsigned()->primary();
            $table->string('empleado_id', 15); 
            $table->foreign('empleado_id')->references('idEmpleado')->on('empleados');
            $table->string('periodo', 50);
            $table->date('fechaPago');
            $table->decimal('montoBruto', 10, 2);
            $table->decimal('montoNeto', 10, 2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('nominas');
    }
}
 