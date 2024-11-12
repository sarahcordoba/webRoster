<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeduccionesTable extends Migration
{
    public function up()
    {
        Schema::create('deducciones', function (Blueprint $table) {
            $table->integer('idDeduccion', 10)->unsigned()->primary();
            $table->integer('nomina_id')->unsigned(); 
            $table->foreign('nomina_id')->references('idNomina')->on('nominas');
            $table->string('tipo', 100);
            $table->decimal('monto', 10, 2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('deducciones');
    }
}
