<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('training_sessions', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('type');
            $table->string('custom_type')->nullable();
            $table->date('date');
            $table->decimal('duration', 5, 2);
            $table->text('description')->nullable();
            $table->string('location');                    // Added
            $table->decimal('pool_depth', 4, 2)->nullable(); // Added (in meters, e.g., 1.50)
            $table->json('equipment_used')->nullable();     // Added (stored as JSON array)
            $table->string('custom_equipment')->nullable(); // Added
            $table->string('trainer');                     // Added
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('training_sessions');
    }
}