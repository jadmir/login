<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatewayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateway', function (Blueprint $table) {
          $table->id();
          $table->string('gateway_name');
          $table->unsignedBigInteger('id_instrument');
          $table->boolean('is_active')->default(true);
          $table->timestamps();

          $table->foreign('id_instrument')->references('id')->on('instruments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gateway');
    }
}
