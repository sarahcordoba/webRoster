<?php
// database/migrations/xxxx_xx_xx_create_comisiones_nomina_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComisionesNominaTable extends Migration
{
    public function up()
    {
        Schema::create('comisiones_nomina', function (Blueprint $table) {
            $table->unsignedBigInteger('nomina_id');
            $table->unsignedBigInteger('comision_id');
            $table->decimal('monto', 10, 2); // Monto específico de la comisión

            $table->primary(['nomina_id', 'comision_id']);
            $table->foreign('nomina_id')->references('id')->on('nomina')->onDelete('cascade');
            $table->foreign('comision_id')->references('id')->on('comision')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comisiones_nomina');
    }
}
