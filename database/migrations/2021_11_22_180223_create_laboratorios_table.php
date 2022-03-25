<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratorios', function (Blueprint $table) {
            $table->id();
            $table->integer('cod_arancel');

            $table->string('nombre', 100);
            $table->boolean('estado')->default(true);
            $table->integer('area_cod');



            $table->timestamps();

            //$table->foreign('requisito_id')->references('id')->on('requisitos');
            $table->foreign('area_cod')->references('cod_serv')->on('areas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->softDeletes();
            //$table->primary(array('id', 'cod_arancel', 'area_cod'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laboratorios');
    }
}
