<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('pickUpLocation'); 
            $table->string('dropOffLocation');
            $table->dateTime('requestTime'); 
            $table->dateTime('tripStart'); 
            $table->dateTime('tripEnd'); 
            $table->integer('distance'); 
            $table->float('duration'); 
            $table->integer('finalPrice'); 
            $table->string('driverName'); 
            $table->float('rate'); 
            $table->boolean('status'); 
            $table->string('driverPicture'); 
            $table->string('driverCar'); 
            $table->string('carModel'); 
            $table->string('keyword'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
