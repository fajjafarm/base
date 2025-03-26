<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackwashesTable extends Migration
{
    public function up()
    {
        Schema::create('backwashes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pool_id');
            $table->decimal('filter1_before_pressure', 5, 2)->nullable();
            $table->decimal('filter1_after_pressure', 5, 2)->nullable();
            $table->boolean('filter1_backwashed')->default(false);
            $table->boolean('basket1_cleaned')->default(false);
            $table->decimal('filter2_before_pressure', 5, 2)->nullable();
            $table->decimal('filter2_after_pressure', 5, 2)->nullable();
            $table->boolean('filter2_backwashed')->default(false);
            $table->boolean('basket2_cleaned')->default(false);
            $table->decimal('filter3_before_pressure', 5, 2)->nullable();
            $table->decimal('filter3_after_pressure', 5, 2)->nullable();
            $table->boolean('filter3_backwashed')->default(false);
            $table->boolean('basket3_cleaned')->default(false);
            $table->string('reason_for_backwash');
            $table->string('pump1_status');
            $table->string('pump2_status');
            $table->string('pump3_status');
            $table->text('issues')->nullable();
            $table->string('performed_by');
            $table->timestamps();

            });
    }

    public function down()
    {
        Schema::dropIfExists('backwashes');
    }
}