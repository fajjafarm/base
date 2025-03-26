<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


class CreateBikeRentalOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('bike_rental_orders', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('order_number')->unique();
            $table->integer('duration');
            $table->date('date');
            $table->json('bike_numbers');
            $table->json('helmet_numbers');
            $table->json('lock_numbers');
            $table->enum('status', ['pending', 'in progress', 'returned'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bike_rental_orders');
    }
}