<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashUpsTable extends Migration
{
    public function up()
    {
        Schema::create('cash_ups', function (Blueprint $table) {
            $table->ulid('id')->primary(); // Use ULID as primary key
            $table->date('date');
            $table->string('department');
            $table->json('denominations')->nullable();
            $table->decimal('cash_total', 10, 2)->nullable();
            $table->decimal('pdq_total', 10, 2)->nullable();
            $table->decimal('amex_total', 10, 2)->nullable();
            $table->decimal('x_reading', 10, 2)->nullable();
            $table->decimal('z_reading', 10, 2)->nullable();
            $table->json('expected_takings');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cash_ups');
    }
}