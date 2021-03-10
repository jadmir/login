<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnoPeriodoCriteriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_periodo_criterios', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('alumno_periodo_id')->nullable();
          $table->unsignedBigInteger('criterio_id')->nullable();
          $table->string('bimestre', 100)->nullable();
          $table->string('nota', 100)->nullable();
          $table->timestamps();
          $table->softDeletes();

          $table->foreign('alumno_periodo_id')->references('id')->on('alumno_periodos');
          $table->foreign('criterio_id')->references('id')->on('criterios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno_periodo_criterios');
    }
}
