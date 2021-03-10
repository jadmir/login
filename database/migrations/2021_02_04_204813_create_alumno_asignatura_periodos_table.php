<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnoAsignaturaPeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_asignatura_periodos', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('periodo_id')->nullable();
          $table->unsignedBigInteger('asignatura_id')->nullable();
          $table->timestamps();
          $table->softDeletes();

          $table->foreign('periodo_id')->references('id')->on('periodos');
          $table->foreign('asignatura_id')->references('id')->on('asignaturas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno_asignatura_periodos');
    }
}
