<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatewayDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateway_details', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('id_gateway');
          $table->string('key');
          $table->string('value');
          $table->enum('env', ['dev', 'production']);
          $table->boolean('is_active')->default(true);
          $table->timestamps();

          $table->foreign('id_gateway')->references('id')->on('gateway');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gateway_details');
    }
}
