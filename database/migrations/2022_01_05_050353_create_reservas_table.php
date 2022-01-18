<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->boolean('estado');
            $table->bigInteger('ordenlab_id')->unsigned();
            $table->bigInteger('paciente_id')->unsigned();
            $table->bigInteger('detallecalendario_id')->unsigned();

            $table->foreign('ordenlab_id')->references('id')->on('ordenlabs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('detallecalendario_id')->references('id')->on('detalles_calendarios')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('paciente_id')->references('id')->on('pacientes')->cascadeOnDelete()->cascadeOnUpdate();
            //$table->foreignId('paciente_id')->constrained();

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
        Schema::dropIfExists('reservas');
    }
}
