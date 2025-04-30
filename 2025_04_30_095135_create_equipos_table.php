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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id(); // auto-incrementable
            $table->string('nombre', 100);
            $table->string('escudo_url', 255)->nullable();
            $table->enum('deporte', ['futbol', 'baloncesto', 'tenis', 'otro']);
            $table->timestamps(); // opcional, crea los campos 'created_at' y 'updated_at'
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
