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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // auto-incrementable
            $table->string('nombre', 100);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->enum('rol', ['usuario', 'admin'])->default('usuario');
            $table->timestamp('creado_en')->useCurrent();
            $table->timestamps(); // opcional, crea los campos 'created_at' y 'updated_at'
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
