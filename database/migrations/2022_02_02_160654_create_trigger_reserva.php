<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerReserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(' CREATE OR REPLACE FUNCTION RESERVACUPO()
        RETURNS TRIGGER
        LANGUAGE PLPGSQL
        AS
      $$
      DECLARE
          stock integer;
          ocupado integer;
      BEGIN
          stock = (SELECT dc."cupoMaximo" FROM detalles_calendarios dc where dc.id = NEW."detallecalendario_id");
          ocupado = (SELECT dc."cupoOcupado" FROM detalles_calendarios dc where dc.id = NEW."detallecalendario_id");
          IF stock <= ocupado AND TG_OP=' . "'INSERT'" . ' THEN
              RAISE EXCEPTION ' . "'¡ESTE GRUPO YA NO TIENE CUPO,INTENTE CON OTRO GRUPO!.'" . ' using ERRCODE = ' . "'20808'" . ';
          END IF;
          IF NEW."deleted_at" is not null THEN
              update detalles_calendarios set "cupoOcupado" = "cupoOcupado" - 1
              where detalles_calendarios."id" = NEW."detallecalendario_id"
              AND detalles_calendarios."cupoOcupado" > 0;
          ELSE
              update detalles_calendarios set "cupoOcupado" = "cupoOcupado" + 1
              where detalles_calendarios."id" = NEW."detallecalendario_id"
              AND detalles_calendarios."cupoOcupado" + 1  <= detalles_calendarios."cupoMaximo";
          END IF;
          RETURN NEW;
      END;
      $$
        ');
        DB::unprepared(' CREATE OR REPLACE TRIGGER RESERVATRIGGER
        BEFORE INSERT OR UPDATE
        ON reservas
        FOR EACH ROW
        EXECUTE PROCEDURE RESERVACUPO();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared(' DROP FUNCTION IF EXISTS RESERVACUPO() ');
        DB::unprepared(' DROP trigger IF EXISTS RESERVATRIGGER');
    }
}
