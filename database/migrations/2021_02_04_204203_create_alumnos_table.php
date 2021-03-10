<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
          $table->id();
          $table->string('dni', 8)->unique()->nullable();
          $table->string('ap_paterno', 100)->nullable();
          $table->string('ap_materno', 100)->nullable();
          $table->string('nombres', 100)->nullable();
          $table->string('sexo', 15);
          $table->date('fecha_nacimiento');
          $table->unsignedBigInteger('visitante_id')->nullable();
          $table->unsignedBigInteger('grado_id')->nullable();
          $table->text('observaciones');
          $table->string('condicion', 100);//no se si string o boleano
          $table->string('url_foto');
          $table->string('url_dni');
          $table->timestamps();
          $table->softDeletes();

          $table->foreign('visitante_id')->references('id')->on('visitantes');
          $table->foreign('grado_id')->references('id')->on('grados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}
