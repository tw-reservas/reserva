<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddIconToCasoDeUsos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('caso_de_usos', function (Blueprint $table) {
            DB::statement('ALTER TABLE caso_de_usos ALTER COLUMN icon TYPE VARCHAR(50)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('caso_de_usos', function (Blueprint $table) {
            //
        });
    }
}
