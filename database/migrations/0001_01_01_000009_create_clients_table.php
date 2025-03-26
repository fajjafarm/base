<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->ulid('client_id')->primary();
            $table->string('company_name');
            $table->text('company_address');
            $table->string('company_post_code', 20);
            $table->string('client_contact');
            $table->string('client_phone', 20);
            $table->string('client_email')->unique();
            $table->string('company_website')->nullable();
            $table->string('vat_number', 20)->nullable();
            $table->string('company_registration_number', 20)->nullable();
            $table->text('company_description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}