<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('caso_de_uso_id')->unsigned();
            $table->bigInteger('rol_id')->unsigned();

            $table->foreign('caso_de_uso_id')->references('id')->on('caso_de_usos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('rol_id')->references('id')->on('rols')->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('menus');
    }
}
