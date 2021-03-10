<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitantes', function (Blueprint $table) {
          $table->id();
          $table->string('dni', 8)->unique()->nullable();
          $table->string('ap_paterno', 100)->nullable();
          $table->string('ap_materno', 100)->nullable();
          $table->string('nombres', 100)->nullable();
          $table->string('celular', 20)->nullable();
          $table->string('email', 150)->unique();
          $table->boolean('esta_verificado')->default(false);
          $table->date('d_verificado')->nullable();
          $table->string('direccion_envio')->nullable();
          $table->string('password');
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
        Schema::dropIfExists('visitantes');
    }
}
