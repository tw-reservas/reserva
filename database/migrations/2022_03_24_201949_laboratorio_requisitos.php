<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaboratorioRequisitos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("laboratorio_requisitos", function (Blueprint $table) {
            $table->id();
            $table->bigInteger('laboratorio_id');
            $table->bigInteger('requisito_id');

            $table->foreign('laboratorio_id')->references('id')->on('laboratorios')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('requisito_id')->references('id')->on('requisitos')->cascadeOnDelete()->cascadeOnUpdate();


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
        //
    }
}
