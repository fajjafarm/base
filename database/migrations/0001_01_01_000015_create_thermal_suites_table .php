<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('thermal_suites', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('client_id');
            $table->string('thermal_name');
            $table->string('thermal_type');
            $table->decimal('sauna_temp', 5, 2);
            $table->decimal('steamroom_temp', 5, 2);
            $table->decimal('lounger_temp', 5, 2);
            $table->integer('check_interval'); // in minutes
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('thermal_suites');
    }
};