<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('first_name');    // Changed from 'name'
            $table->string('surname');       // Added
            $table->string('email')->unique();
            $table->string('password');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('position');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}