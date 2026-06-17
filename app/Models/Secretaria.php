<?php

namespace App\Models;

use App\Models\TipoDelegacion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Secretaria extends Model
{
    protected $table = 'secretarias';

    protected $fillable = [
        'cartera_secretaria',
        'tipo_delegacion_id',
    ];

    // Relaciones
    public function tipoDelegacion(): BelongsTo
    {
        return $this->belongsTo(TipoDelegacion::class, 'tipo_delegacion_id');
    }

    public function maestros(): HasMany
    {
        return $this->hasMany(Maestro::class, 'secretaria_id');
    }
}
