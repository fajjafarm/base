<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreatePoolListTable extends Migration
{
    public function up()
    {
        Schema::create('pool_list', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->unsignedBigInteger('client_id');
            $table->string('pool_name');
            $table->string('pool_type');
            $table->decimal('length', 8, 2);
            $table->decimal('width', 8, 2);
            $table->decimal('depth', 8, 2);
            $table->decimal('volume', 10, 2);
            $table->decimal('ideal_dpd1', 5, 2);
            $table->decimal('ideal_ph', 5, 2);
            $table->decimal('ideal_alk', 5, 2);
            $table->decimal('ideal_calc', 5, 2);
            $table->decimal('ideal_water_temp', 5, 2);
            $table->decimal('ideal_air_temp', 5, 2);
            $table->timestamps();

            
        });
    }

    public function down()
    {
        Schema::dropIfExists('pool_list');
    }
}