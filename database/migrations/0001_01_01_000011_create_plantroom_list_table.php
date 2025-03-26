<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreatePlantroomListTable extends Migration
{
    public function up()
    {
        Schema::create('plantroom_list', function (Blueprint $table) {
            $table->ulid('plantroomid')->primary();
            $table->string('client_id');
            $table->string('plantroom_name');
            $table->decimal('filters');
            $table->decimal('strainers');
            $table->decimal('cl_injector');
            $table->decimal('ph_injector');
            $table->decimal('pac_injector');
            $table->string('info');
            $table->timestamps();

            
        });
    }

    public function down()
    {
        Schema::dropIfExists('plantroom_list');
    }
}