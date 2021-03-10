<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('id_request');
          $table->double('amount', 10, 2)->nullable();
          $table->string('currency_code', 5)->default('PEN');
          $table->unsignedBigInteger('id_gateway');
          $table->string('email', 150)->nullable();
          $table->string('name', 250)->nullable();
          $table->string('phone', 20)->nullable();
          $table->string('pg_transaction_id', 100)->nullable();
          $table->json('request_data')->nullable();
          $table->dateTime('request_time')->nullable();
          $table->json('response_data')->nullable();
          $table->dateTime('response_time')->nullable();
          $table->string('response_message', 100)->nullable();
          $table->string('browser_version', 250)->nullable();
          $table->string('status', 10)->nullable();
          $table->enum('result', ['SUCCESS', 'FAILED'])->nullable();
          $table->string('transaction_token', 150)->nullable();
          $table->unsignedBigInteger('pago_id');
          $table->timestamps();

          $table->foreign('id_request')->references('id')->on('request');
          $table->foreign('id_gateway')->references('id')->on('gateway');
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
        Schema::dropIfExists('transaction');
    }
}
