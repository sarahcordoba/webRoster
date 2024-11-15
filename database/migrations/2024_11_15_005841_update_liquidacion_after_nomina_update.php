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
    // Trigger para AFTER UPDATE en nominas
    DB::unprepared('
        CREATE TRIGGER UpdateLiquidacionAfterNominaUpdate
        AFTER UPDATE ON nominas
        FOR EACH ROW
        BEGIN
            DECLARE ttotal_salario DECIMAL(10,2) DEFAULT 0;
            DECLARE ttotal_deducciones DECIMAL(10,2) DEFAULT 0;
            DECLARE ttotal_comisiones DECIMAL(10,2) DEFAULT 0;

            -- Calcula los totales de las nóminas asociadas a la liquidación actualizada
            SELECT SUM(salario_base), SUM(total_deducciones), SUM(total_comisiones)
            INTO ttotal_salario, ttotal_deducciones, ttotal_comisiones
            FROM nominas
            WHERE idLiquidacion = NEW.idLiquidacion;

            -- Actualiza la liquidación con los nuevos totales calculados
            UPDATE liquidaciones
            SET
                salario = ttotal_salario,
                total_deducciones = ttotal_deducciones,
                total_comisiones = ttotal_comisiones,
                total = ttotal_salario + ttotal_comisiones - ttotal_deducciones
            WHERE id = NEW.idLiquidacion;
        END
    ');
}


  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    // Eliminar el trigger
    DB::unprepared('DROP TRIGGER IF EXISTS UpdateLiquidacionAfterNominaUpdate');
  }
};
