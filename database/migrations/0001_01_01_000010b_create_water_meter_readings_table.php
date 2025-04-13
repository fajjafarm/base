<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('water_meter_readings', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->ulid('water_meter_id'); // ULID to match water_meters.water_meter_id
            $table->decimal('reading_value', 8, 2); // Reading in m³, e.g., 1234.56
            $table->dateTime('reading_date'); // Date and time of reading
            $table->text('notes')->nullable(); // Optional notes
            $table->timestamps(); // created_at, updated_at

            // Foreign key constraint
            $table->foreign('water_meter_id')
                  ->references('water_meter_id')
                  ->on('water_meters')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('water_meter_readings');
    }
};