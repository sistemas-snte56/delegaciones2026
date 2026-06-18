<?php

namespace App\Models;

use App\Models\Delegacion;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    protected $table = 'regiones';
    
    protected $fillable = [
        'region', 'sede',
    ];

    // Relaciones
    public function delegaciones(): HasMany
    {
        return $this->hasMany(Delegacion::class, 'region_id');
    }

    // Accessors
    protected function nombreCompleto() :Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->region} - {$this->sede}"
        );
    }

    protected function region(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value,
            set: fn (?string $value) => $value ? mb_strtoupper($value, 'UTF-8') : null,
        );
    }

    protected function sede(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value,
            set: fn (?string $value) => $value ? mb_strtoupper($value, 'UTF-8') : null,
        );
    }   
}
