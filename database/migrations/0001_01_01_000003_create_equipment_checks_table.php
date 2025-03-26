<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emergency_equipment_checks', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('location');
            $table->string('equipment_type');
            $table->date('check_date');
            $table->boolean('condition');
            $table->text('comments')->nullable();
            $table->string('checked_by');
            $table->timestamps();
        });
    }
    

};
