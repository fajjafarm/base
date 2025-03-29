<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plantroom_components', function (Blueprint $table) {
            $table->id();
            $table->ulid('plantroom_id');
            $table->enum('component_type', ['filter', 'strainer', 'cl_injector', 'ph_injector', 'pac_injector', 'pump']);
            $table->integer('component_number');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('plantroom_id')->references('plantroom_id')->on('plantroom_list')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plantroom_components');
    }
};