<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maestros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delegacion_id')
                  ->constrained('delegaciones')
                  ->cascadeOnDelete();
            $table->foreignId('secretaria_id')
                  ->constrained('secretarias')
                  ->cascadeOnDelete();
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete()
                  ->cascadeOnUpdate();
            $table->enum('titulo', ['PROF.', 'PROFR.', 'C.'])->nullable();
            $table->string('nombre', 150);
            $table->string('apaterno', 150);
            $table->string('amaterno', 150)->nullable();
            $table->enum('genero', ['MASCULINO', 'FEMENINO', 'OTRO'])->default('MASCULINO');
            $table->string('email', 150)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('direccion', 250)->nullable();
            $table->string('cp', 10)->nullable();
            $table->string('ciudad', 150)->nullable();  // ✅ Sin unique()
            $table->string('estado', 150)->nullable();  // ✅ Sin unique()
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maestros');
    }
};
