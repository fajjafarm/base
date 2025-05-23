<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCprTrainingsTable extends Migration
{
    public function up()
    {
        Schema::create('cpr_trainings', function (Blueprint $table) {
            $table->id();
            $table->uuid('team_member_id'); // Match UUID type
            $table->foreign('team_member_id')->references('id')->on('team_members')->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->string('type');
            $table->string('screenshot')->nullable();
            $table->integer('score')->nullable();
            $table->timestamps();
        });
       
    }

    public function down()
    {
        Schema::dropIfExists('cpr_trainings');
    }
}