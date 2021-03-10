<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
          $table->id();
          $table->string('dni, 8')->unique()->nullable();
          $table->string('ap_paterno', 100)->nullable();
          $table->string('ap_materno', 100)->nullable();
          $table->string('nombres', 100)->nullable();
          $table->date('fecha_nacimiento')->nullable();
          $table->date('fecha_ingreso')->nullable();
          $table->unsignedBigInteger('grado_id')->nullable();
          $table->unsignedBigInteger('cargo_id')->nullable();
          $table->string('celular', 20)->nullable();
          $table->string('email', 150);
          $table->string('password',);
          $table->timestamps();
          $table->softDeletes();

          $table->foreign('grado_id')->references('id')->on('grados');
          $table->foreign('cargo_id')->references('id')->on('cargos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
