<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerActivecalendar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            'create or replace function updateactivecalendar()
            returns trigger
            language plpgsql
            as
            $$
            declare
                prev_id integer;
            begin
                if TG_OP=' . "'UPDATE'" . 'AND OLD."estado" = false AND NEW."estado" = true  then
                prev_id = (select ac."current_id" from active_calendarios ac where ac.id = 1);
                insert into active_calendarios(
                    id,current_id,previous_id,previous_date,amount,deleted_at,created_at,updated_at)
                    values(1,NEW."id",prev_id,NEW."fechaFin",NEW."cantidad",NULL,now()::timestamp,now()::timestamp)
                    on conflict (id)
                    do update set
                    current_id = NEW."id",
                    previous_date = NEW."fechaFin",
                    amount = NEW."cantidad";
                end if;
                return NEW;
            end;
            $$'
        );

        DB::unprepared('DROP TRIGGER IF EXISTS activecalendario ON calendarios;
        CREATE TRIGGER activecalendario
        AFTER UPDATE
        ON calendarios
        FOR EACH ROW
        EXECUTE PROCEDURE updateactivecalendar();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared(' DROP FUNCTION IF EXISTS updateactivecalendar() ');
        DB::unprepared(' DROP trigger IF EXISTS activecalendario');
    }
}
