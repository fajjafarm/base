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
            $table->unsignedBigInteger('component_id');
            $table->enum('action', ['Backwash', 'Service']);
            $table->enum('pump_status', ['On', 'Off - Standby', 'Off - Maintenance'])->nullable()->after('injector_action')
            $table->timestamp('performed_at')->useCurrent();
            $table->string('user_id');
            $table->text('notes')->nullable();
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