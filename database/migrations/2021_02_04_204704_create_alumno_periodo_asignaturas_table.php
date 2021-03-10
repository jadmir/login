<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnoPeriodoAsignaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_periodo_asignaturas', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('alumno_periodo_id')->nullable();
          $table->unsignedBigInteger('asignatura_id')->nullable();
          $table->string('bimestre', 100);
          $table->string('nota', 100);
          $table->timestamps();
          $table->softDeletes();

          $table->foreign('alumno_periodo_id')->references('id')->on('alumno_periodos');
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
        Schema::dropIfExists('alumno_periodo_asignaturas');
    }
}
