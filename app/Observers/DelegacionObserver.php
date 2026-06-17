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
        // $delegacion->clave_delegacion = $this->generarClave($delegacion);

        // Generamos la clave antes de guardar para verificar si ya existe una delegación con la misma clave
        $clave = $this->generarClave($delegacion);

        // Busca si ya existe una delegación con la misma clave en la base de datos
        $existeDelegacion = Delegacion::where('clave_delegacion', $clave)->exists();

        // Si ya existe una delegación con la misma clave, lanzamos una excepción para evitar la creación
        if ($existeDelegacion) {
            throw new \Exception("Ya existe una delegación con la clave '{$clave}'.");
        }

        // Si no existe, asignamos la clave generada a la delegación y permitimos que se guarde
        $delegacion->clave_delegacion = $clave;
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
