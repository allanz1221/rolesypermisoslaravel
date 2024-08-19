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
            $table->enum('rol', ['Alumno', 'Docente','Admin', 'Laboratorio'])->default('Alumno');
            $table->string('expediente')->unique()->nullable();
            $table->string('whatsapp')->unique()->nullable();
            $table->string('foto')->unique()->nullable();
            $table->string('facebook')->unique()->nullable();
            $table->string('x')->unique()->nullable();
            $table->string('tiktok')->unique()->nullable();
            $table->string('instagram')->unique()->nullable();;
            $table->enum('pe', ['IIM', 'IM','Otro'])->default('Otro');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
