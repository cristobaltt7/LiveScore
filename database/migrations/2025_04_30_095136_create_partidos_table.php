<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('partidos', function (Blueprint $table) {
            $table->id(); // auto-incrementable
            $table->foreignId('equipo_local_id')->constrained('equipos');
            $table->foreignId('equipo_visitante_id')->constrained('equipos');
            $table->dateTime('fecha_hora');
            $table->tinyInteger('resultado_local')->nullable();
            $table->tinyInteger('resultado_visitante')->nullable();
            $table->enum('estado', ['pendiente', 'en_juego', 'finalizado'])->default('pendiente');
            $table->timestamps(); // opcional, crea los campos 'created_at' y 'updated_at'
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
