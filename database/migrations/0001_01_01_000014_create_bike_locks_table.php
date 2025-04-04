<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateBikeLocksTable extends Migration
{
    public function up()
    {
        Schema::create('bike_locks', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('size');
            $table->string('status')->default('ready for hire')->comment('ready for hire, hired, awaiting check, awaiting maintenance, missing');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bike_locks');
    }
}
