<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nim')->unique();
            $table->string('skill')->nullable();
            $table->string('gender');
            $table->string('foto_profil')->nullable();
            $table->longText('about')->nullable();
            $table->string('status')->nullable();
            $table->string('place')->nullable();
            $table->date('contract')->nullable();
            $table->string('email')->unique();
            $table->string('hp')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('password');
            $table->string('token')->nullable();
            $table->string('role');
            $table->dateTime('premium_expiry')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
