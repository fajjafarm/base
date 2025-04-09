// database/migrations/2025_03_29_create_backwash_logs_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('backwash_logs', function (Blueprint $table) {
            $table->id();
            $table->ulid('plantroom_id');
            $table->unsignedBigInteger('component_id')->nullable(); // Nullable for general logs
            $table->enum('reason', ['Scheduled', 'High Pressure', 'Water Clarity', 'Water Balance', 'Maintenance', 'Code Brown'])->nullable();
            $table->decimal('pressure_before', 5, 2)->nullable(); // For filters
            $table->decimal('pressure_after', 5, 2)->nullable(); // For filters
            $table->enum('strainer_action', ['cleaned', 'changed', 'nothing'])->nullable();
            $table->enum('injector_action', ['checked', 'cleaned', 'changed', 'nothing'])->nullable();
            $table->text('notes')->nullable();
            $table->string('user_id');
            $table->timestamp('performed_at')->useCurrent();
            $table->timestamps();

            $table->foreign('plantroom_id')->references('plantroom_id')->on('plantroom_list')->onDelete('cascade');
            $table->foreign('component_id')->references('id')->on('plantroom_components')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('backwash_logs');
    }
};