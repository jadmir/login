<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request', function (Blueprint $table) {
          $table->id();
          $table->text('token');
          $table->string('session_key');
          $table->json('request_data');
          $table->double('amount', 10, 2);
          $table->string('currency_code')->default('PEN');
          $table->unsignedBigInteger('id_gateway')->nullable();
          $table->unsignedBigInteger('pado_id')->nullable();
          $table->timestamps();

          $table->foreign('id_gateway')->references('id')->on('gateway');
          $table->foreign('pado_id')->references('id')->on('pagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request');
    }
}
