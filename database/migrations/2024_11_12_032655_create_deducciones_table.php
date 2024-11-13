<?php

// database/migrations/xxxx_xx_xx_create_deduccion_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeduccionTable extends Migration
{
    public function up()
    {
        Schema::create('deduccion', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 50);
            $table->string('descripcion', 255);
            $table->decimal('monto', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deduccion');
    }
}

