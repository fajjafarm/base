<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaterMeterReadingsTable extends Migration
{
    public function up()
    {
        Schema::create('water_meter_readings', function (Blueprint $table) {
            $table->ulid('reading_id')->primary();
            $table->float('meter_reading');
            $table->float('difference');
            $table->float('plantroom_id');
            $table->float('logged_by');
            $table->timestamps();

            //$table->foreign('logged_by')->references('id')->on('users')->onDelete('cascade');
            // Assuming 'users' table exists for 'logged_by' reference
            // Add foreign key for 'plantroom_id' if there's a separate table for plantrooms
        });
    }

    public function down()
    {
        Schema::dropIfExists('water_meter_readings');
    }
}