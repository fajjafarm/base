<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingLogsTable extends Migration
{
    public function up()
    {
        Schema::create('training_logs', function (Blueprint $table) {
            $table->id();
            $table->uuid('team_member_id'); // Match UUID type
            $table->foreign('team_member_id')->references('id')->on('team_members')->onDelete('cascade');
            $table->date('date');
            $table->integer('duration');
            $table->enum('type', [
                'Competence',
                'Regular',
                'Department',
                'Fire',
                'COSHH',
                'Qualification',
                'Pool',
                'FirstAid'
            ]);
            $table->date('expiry_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_logs');
    }
}