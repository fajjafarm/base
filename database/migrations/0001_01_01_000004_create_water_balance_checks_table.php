<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaterBalanceChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('water_balance_tests', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->float('alkalinity');
            $table->float('calcium_hardness');
            $table->float('ph');
            $table->float('water_balance');
            $table->unsignedBigInteger('pool_id');
            $table->unsignedBigInteger('logged_by');
            $table->timestamps(); // Adds created_at and updated_at columns

            // Assuming you have a pools table where 'id' is the primary key
          //  $table->foreign('pool_id')->references('id')->on('pools')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('water_balance_tests');
    }
}