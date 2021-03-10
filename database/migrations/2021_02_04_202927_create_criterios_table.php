<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterios', function (Blueprint $table) {
          $table->id();
          $table->string('criterio', 100)->nullable();
          $table->string('porcentaje', 100)->nullable(); //nose si es string o otro
          $table->unsignedBigInteger('id_asignatura')->nullable();
          $table->timestamps();
          $table->softDeletes();

          $table->foreign('id_asignatura')->references('id')->on('asignaturas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criterios');
    }
}
