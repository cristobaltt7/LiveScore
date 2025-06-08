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
    Schema::create('squads', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('team_id'); // id del equipo (mismo que usas con favoritos)
        $table->string('name'); // nombre del jugador
        $table->string('position'); // portero, defensa, etc.
        $table->string('number')->nullable();
        $table->string('photo')->nullable(); // opcional
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('squads');
    }
};
