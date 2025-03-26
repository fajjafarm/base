<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTrainingSessionTable extends Migration
{
    public function up()
    {
        Schema::create('user_training_session', function (Blueprint $table) { // Changed table name
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->constrained('users')->onDelete('cascade'); // Changed to user_id
            $table->foreignUlid('training_session_id')->constrained('training_sessions')->onDelete('cascade');
            $table->text('comments')->nullable();
            $table->timestamps();
    });
    }
    public function down()
    {
        Schema::dropIfExists('user_training_session');
    }
}