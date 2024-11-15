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
          DECLARE num_nominas INT;
          DECLARE ttotal_salario DECIMAL(10,2) DEFAULT 0;
          DECLARE ttotal_deducciones DECIMAL(10,2) DEFAULT 0;
          DECLARE ttotal_comisiones DECIMAL(10,2) DEFAULT 0;

          -- Verifica cuántas nóminas quedan asociadas a la liquidación después de la eliminación
          SELECT COUNT(*) INTO num_nominas
          FROM nominas
          WHERE idLiquidacion = OLD.idLiquidacion;
    
          -- Solo realiza operaciones adicionales si todavía existen nóminas para esta liquidación
          IF num_nominas > 0 THEN
        
            SELECT SUM(salario_base), SUM(total_deducciones), SUM(total_comisiones)
            INTO ttotal_salario, ttotal_deducciones, ttotal_comisiones
            FROM nominas
            WHERE idLiquidacion = OLD.idLiquidacion;
        
            UPDATE liquidaciones
            SET
              salario = ttotal_salario,
              total_deducciones = ttotal_deducciones,
              total_comisiones = ttotal_comisiones,
              total = ttotal_salario + ttotal_comisiones - ttotal_deducciones
            WHERE id = OLD.idLiquidacion;
          ELSE
            UPDATE liquidaciones
            SET
              salario = 0,
              total_deducciones = 0,
              total_comisiones = 0,
              total = salario + total_comisiones - total_deducciones
            WHERE id = OLD.idLiquidacion;
          END IF;
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
