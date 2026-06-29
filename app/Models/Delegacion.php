<?php

namespace App\Models;

use App\Models\Nivel;
use App\Models\Nomenclatura;
use App\Models\Region;
use App\Models\TipoDelegacion;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Observers\DelegacionObserver;

class Delegacion extends Model
{

    protected static function booted(): void
    {
        static::observe(DelegacionObserver::class);
    }

    protected $table = 'delegaciones';

    protected $fillable = [
        'region_id',
        'tipo_delegacion_id',
        'nomenclatura_id',
        'nivel_id',
        'num_delegacional',
        'clave_delegacion',
        'sede_delegacional',
        'fecha_inicio_delegacional',
        'fecha_final_delegacional',
        'direccion_delegacional',
        'cp_delegacional',
        'ciudad_delegacional',
        'estado_delegacional',
    ];

    // La fechas se manejan como objetos Carbon con casts 
    protected function casts(): array
    {
        return [
            'fecha_inicio_delegacional' => 'date',
            'fecha_final_delegacional'  => 'date',
        ];
    }

    // Relaciones
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function tipoDelegacion(): BelongsTo
    {
        return $this->belongsTo(TipoDelegacion::class, 'tipo_delegacion_id');
    }

    public function nomenclatura(): BelongsTo
    {
        return $this->belongsTo(Nomenclatura::class, 'nomenclatura_id');
    }

    public function nivel(): BelongsTo
    {
        return $this->belongsTo(Nivel::class, 'nivel_id');
    }

    public function maestros(): HasMany
    {
        return $this->hasMany(Maestro::class, 'delegacion_id');
    }

    // Accessors
    protected function nombreCompleto(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->nomenclatura->nomenclatura}{$this->num_delegacional} {$this->nivel->nombre }  - {$this->sede_delegacional}",
        );
    }

    public function titular()
    {
        return $this->hasOne(Maestro::class)
            ->whereHas('secretaria', function($query){
                $query -> where('cartera_secretaria','LIKE','%SECRETARIA GENERAL%')
                       -> orWhere('cartera_secretaria','LIKE','%REPRESENTANTE%');
            });
    }
}
