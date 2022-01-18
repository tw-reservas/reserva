<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesCalendariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_calendarios', function (Blueprint $table) {
            $table->id();
            $table->integer('cupoMaximo')->length(3);
            $table->integer('cupoOcupado')->length(3);
            $table->date('fecha')->useCurrent();
            $table->boolean('estado')->default(true);

            $table->foreignId('cupo_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('grupo_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('calendario_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_calendarios');
    }
}
