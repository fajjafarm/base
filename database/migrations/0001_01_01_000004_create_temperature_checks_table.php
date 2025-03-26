<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemperatureChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temperature_checks', function (Blueprint $table) {
            $table->id(); // Unique ID
            $table->unsignedBigInteger('location_id');
            $table->decimal('temperature', 5, 2); // Assuming temperature to 2 decimal places
            $table->string('checked_by', 50);
            $table->timestamps(); // Adds created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temperature_checks');
    }
}