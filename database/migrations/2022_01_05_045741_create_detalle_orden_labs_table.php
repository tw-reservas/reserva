<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleOrdenLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_orden_labs', function (Blueprint $table) {
            $table->id();

            $table->integer('laboratorio_id')->unsigned();
            $table->bigInteger('ordenlab_id')->unsigned();

            $table->foreign('laboratorio_id')->references('id')->on('laboratorios');
            $table->foreign('ordenlab_id')->references('id')->on('ordenlabs');

            //$table->foreignId('laboratorio_cod')->constrained('laboratorios', "codigo")->cascadeOnUpdate();
            //$table->foreignId('reserva_id')->constrained('reservas')->cascadeOnUpdate();
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
        Schema::dropIfExists('detalle_orden_labs');
    }
}
