<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('action_logs', function (Blueprint $table) {
        $table->id();
        $table->string('action_type');
        $table->string('check_id');
        $table->string('issue')->nullable();
        $table->string('escalation')->nullable();
        $table->text('comments')->nullable();
        $table->string('progress')->nullable();
        $table->string('logged_by')->nullable();
        $table->string('actioned_by')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('action_logs');
}
}