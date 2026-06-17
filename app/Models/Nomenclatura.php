<?php

namespace App\Models;

use App\Models\Delegacion;
use App\Models\TipoDelegacion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nomenclatura extends Model
{
    protected $table = 'nomenclaturas';

    protected $fillable = [
        'nomenclatura',
        'tipo_delegacion_id',
    ];

    // Relaciones
    public function tipoDelegacion(): BelongsTo
    {
        return $this->belongsTo(TipoDelegacion::class, 'tipo_delegacion_id');
    }

    public function secretarias(): HasMany
    {
        return $this->hasMany(Secretaria::class, 'nomenclatura_id');
    }

    public function delegaciones(): HasMany
    {
        return $this->hasMany(Delegacion::class, 'nomenclatura_id');
    }
}
