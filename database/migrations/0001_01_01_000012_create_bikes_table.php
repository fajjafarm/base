<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateBikesTable extends Migration
{
    public function up()
    {
        Schema::create('bikes', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('mountain, hybrid, ebike, or kids');
            $table->string('size')->comment('XS, S, M, L, XL');
            $table->string('status')->default('ready for hire')->comment('ready for hire, hired, awaiting check, awaiting maintenance, reserved');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bikes');
    }
}
