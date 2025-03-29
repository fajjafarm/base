<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('plantroom_components', function (Blueprint $table) {
            $table->enum('component_type', ['filter', 'strainer', 'cl_injector', 'ph_injector', 'pac_injector', 'pump'])
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('plantroom_components', function (Blueprint $table) {
            $table->enum('component_type', ['filter', 'strainer', 'cl_injector', 'ph_injector', 'pac_injector'])
                ->change();
        });
    }
};