<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    // Trigger para AFTER DELETE en nominas
    DB::unprepared('
        CREATE TRIGGER UpdateLiquidacionAfterNominaDelete
        AFTER DELETE ON nominas
        FOR EACH ROW
        BEGIN
          DECLARE total_salario DECIMAL(10,2) DEFAULT 0;
          DECLARE total_deducciones DECIMAL(10,2) DEFAULT 0;
          DECLARE total_comisiones DECIMAL(10,2) DEFAULT 0;
        
          SELECT SUM(salario_base), SUM(total_deducciones), SUM(total_comisiones)
          INTO total_salario, total_deducciones, total_comisiones
          FROM nominas
          WHERE idLiquidacion = OLD.idLiquidacion;
        
          UPDATE liquidaciones
          SET
            salario = total_salario,
            total_deducciones = total_deducciones,
            total_comisiones = total_comisiones,
            total = total_salario + total_comisiones - total_deducciones
          WHERE id = OLD.idLiquidacion;
        END
        ');
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    // Eliminar el trigger
    DB::unprepared('DROP TRIGGER IF EXISTS UpdateLiquidacionAfterNominaDelete');
  }
};
