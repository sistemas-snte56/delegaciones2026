<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoDelegacion extends Model
{
    protected $table = 'tipo_delegaciones';

    protected $fillable = [
        'tipo',
    ];

    public function delegaciones() : HasMany
    {
        return $this->hasMany(Delegacion::class, 'tipo_delegacion_id');
    }

    public function nomenclaturas() : HasMany
    {
        return $this->hasMany(Nomenclatura::class, 'tipo_delegacion_id');
    }

    public function secretarias() : HasMany
    {
        return $this->hasMany(Secretaria::class, 'tipo_delegacion_id');
    }

    protected function tipo(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value,
            set: fn (?string $value) => $value ? mb_strtoupper($value, 'UTF-8') : null,
        );
    }    
}
