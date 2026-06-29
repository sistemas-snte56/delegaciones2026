<?php

namespace App\Models;

use App\Models\Delegacion;
use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maestro extends Model
{
    protected $table = 'maestros';

    protected $fillable = [
        'delegacion_id',
        'secretaria_id',
        'user_id',
        'titulo',
        'nombre',
        'apaterno',
        'amaterno',
        'genero',
        'email',
        'telefono',
        'direccion',
        'cp',
        'ciudad',
        'estado',
    ];

    // Relaciones
    public function delegacion(): BelongsTo
    {
        return $this->belongsTo(Delegacion::class, 'delegacion_id');
    }

    public function secretaria(): BelongsTo
    {
        return $this->belongsTo(Secretaria::class, 'secretaria_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    protected function nombre(): Attribute
    {
        return Attribute::make(
            set : fn (?string $value) => $value
                ? mb_strtoupper(trim($value),'UTF-8')
                : null,
        );
    }

    protected function apaterno(): Attribute
    {
        return Attribute::make(
            set : fn (?string $value) => $value
                ? mb_strtoupper(trim($value),'UTF-8')
                : null,
        );
    }

    protected function amaterno(): Attribute
    {
        return Attribute::make(
            set : fn (?string $value) => $value
                ? mb_strtoupper(trim($value),'UTF-8')
                : null,
        );
    }

    protected function direccion(): Attribute
    {
        return Attribute::make(
            set : fn (?string $value) => $value
                ? mb_strtoupper(trim($value),'UTF-8')
                : null,
        );
    }
    
    protected function ciudad(): Attribute
    {
        return Attribute::make(
            set : fn (?string $value) => $value
                ? mb_strtoupper(trim($value),'UTF-8')
                : null,
        );
    }
    
    protected function estado(): Attribute
    {
        return Attribute::make(
            set : fn (?string $value) => $value
                ? mb_strtoupper(trim($value),'UTF-8')
                : null,
        );
    }

    // Accessors
    protected function nombreCompleto(): Attribute
    {
        return Attribute::make(
            get: fn () => trim("{$this->titulo} {$this->nombre} {$this->apaterno} {$this->amaterno}"),
        );
    }
}
