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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('noserie')->nullable();
            $table->string('noactivo')->nullable();
            $table->string('numfactura')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('costo')->nullable();
            $table->string('foto')->nullable();
            $table->enum('estado', ['Bueno', 'Malo'])->default('Bueno');
            $table->enum('ocupado', ['si', 'no'])->default('no');
            $table->text('description')->nullable();
            $table->integer('quantity')->nullable();
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
        Schema::dropIfExists('materials');
    }
};
