<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DriverLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_location', function (Blueprint $table) {
            $table->id();
            $table->string('driver_name');
            $table->string('trip_id');
            $table->decimal('latitude', 7, 4)->nullable();
            $table->decimal('longitude', 7, 4)->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('driver_location');
    }
}
