<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_detalles', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('pago_id');
          //$table->unsignedBigInteger('id_concepto');
          $table->double('precio_unitario');
          $table->string('cantidad');
          $table->double('total');
          $table->timestamps();

          $table->foreign('pago_id')->references('id')->on('pagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pago_detalles');
    }
}
