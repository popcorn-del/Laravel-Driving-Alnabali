<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_buses', function (Blueprint $table) {
            $table->id();
            $table->string('trip_name');
            $table->string('bus_size');
            $table->string('bus_no');
            $table->string('driver_name');
            $table->string('bus_frequancy');
            $table->timestamps();
            $table->boolean('status');
            $table->string('fake');
            $table->string('supervisor_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_buses');
    }
}
