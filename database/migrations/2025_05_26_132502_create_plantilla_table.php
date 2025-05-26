<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('plantilla', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipo_id');
            $table->string('nombre_jugador', 100);
            $table->string('posicion', 50)->nullable();
            $table->integer('edad')->nullable();
            $table->string('nacionalidad', 50)->nullable();
            $table->timestamps();

            // Llave foránea a equipos.id
            $table->foreign('equipo_id')->references('id')->on('equipos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('plantilla');
    }
};
