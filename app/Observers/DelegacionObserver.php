<?php

namespace App\Observers;

use App\Models\Delegacion;

class DelegacionObserver
{
    /**
     * Handle the Delegacion "creating" event.
     */
    public function creating(Delegacion $delegacion): void
    {
        $delegacion->clave_delegacion = $this->generarClave($delegacion);
    }
    
    public function updating(Delegacion $delegacion): void
    {
        // Si cambia la nomenclatura o el número, regenerar la clave
        if ($delegacion->isDirty(['nomenclatura_id', 'num_delegacional'])) {
            $delegacion->clave_delegacion = $this->generarClave($delegacion);
        }
    }

    private function generarClave(Delegacion $delegacion): string
    {
        $nomenclatura = $delegacion->nomenclatura->nomenclatura;
        $numero       = str_pad($delegacion->num_delegacional, 2, '0', STR_PAD_LEFT);

        return "{$nomenclatura}{$numero}";
    }
}
