<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delegaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')
                  ->constrained('regiones')
                  ->cascadeOnDelete();
            $table->foreignId('tipo_delegacion_id')
                  ->constrained('tipo_delegaciones')
                  ->cascadeOnDelete();
            $table->foreignId('nomenclatura_id')
                  ->constrained('nomenclaturas')
                  ->cascadeOnDelete();
            $table->string('num_delegacional', 150);
            $table->string('clave_delegacion', 20)->nullable()->index();
            $table->foreignId('nivel_id')
                  ->constrained('niveles')
                  ->cascadeOnDelete();
            $table->string('sede_delegacional', 150);
            $table->date('fecha_inicio_delegacional');
            $table->date('fecha_final_delegacional');
            $table->string('direccion_delegacional', 250)->nullable();
            $table->string('cp_delegacional', 10)->nullable();
            $table->string('ciudad_delegacional', 150)->nullable();
            $table->string('estado_delegacional', 150)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delegaciones');
    }
};
