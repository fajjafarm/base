<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('thermal_suite_checks', function (Blueprint $table) {
            $table->id();
            $table->ulid('thermal_suite_id');
            $table->string('user_id');
            $table->enum('status', ['occupied_okay', 'occupied_issue', 'empty_okay', 'empty_issue']);
            $table->text('extra_info')->nullable();
            $table->timestamp('checked_at')->useCurrent();
            $table->timestamps();

            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('thermal_suite_checks');
    }
};