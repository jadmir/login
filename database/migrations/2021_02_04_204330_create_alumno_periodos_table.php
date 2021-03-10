<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnoPeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_periodos', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('grado_id');
          $table->unsignedBigInteger('periodo_id');
          $table->unsignedBigInteger('alumno_id');
          $table->string('url_dni');
          $table->boolean('is_completo')->default(true);
          $table->string('pago_valido');
          $table->string('condicion_final');// nose si esta bien
          $table->timestamps();
          $table->softDeletes();

          $table->foreign('grado_id')->references('id')->on('grados');
          $table->foreign('periodo_id')->references('id')->on('periodos');
          $table->foreign('alumno_id')->references('id')->on('alumnos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno_periodos');
    }
}
