<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasoDeUsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caso_de_usos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30)->nullable(false);
            $table->string('icon', 20);
            $table->string('url')->nullable(false);
            $table->bigInteger('paquete_id')->unsigned();

            $table->foreign('paquete_id')->references('id')->on('paquetes')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('caso_de_usos');
    }
}
