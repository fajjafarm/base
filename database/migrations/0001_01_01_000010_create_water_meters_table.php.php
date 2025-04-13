<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('water_meters', function (Blueprint $table) {
            $table->ulid('water_meter_id')->primary();
            $table->ulid('plantroom_id')->nullable();
            $table->string('location');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('plantroom_id')->references('plantroom_id')->on('plantroom_list')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('water_meters');
    }
};