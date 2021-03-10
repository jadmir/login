<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesos', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('id_modulo')->nullable();
          $table->boolean('is_apoderado')->nullable();
          $table->unsignedBigInteger('id_cargo')->nullable();
          $table->timestamps();
          $table->softDeletes();

          $table->foreign('id_modulo')->references('id')->on('modulos');
          $table->foreign('id_cargo')->references('id')->on('cargos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesos');
    }
}
