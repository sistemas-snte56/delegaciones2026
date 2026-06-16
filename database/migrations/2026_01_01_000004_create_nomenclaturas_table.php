<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nomenclaturas', function (Blueprint $table) {
            $table->id();
            $table->string('nomenclatura', 150);
            $table->foreignId('tipo_delegacion_id')
                  ->constrained('tipo_delegaciones')
                  ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nomenclaturas');
    }
};
