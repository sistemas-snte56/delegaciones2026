<?php

namespace Database\Seeders;

use App\Models\TipoDelegacion;
use Illuminate\Database\Seeder;

class TipoDelegacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            ['id' => 1, 'tipo' => 'ACTIVOS'],
            ['id' => 2, 'tipo' => 'JUBILADOS'],
            ['id' => 3, 'tipo' => 'CENTRO DE TRABAJO'],
        ];

        foreach ($tipos as $tipo) {
            TipoDelegacion::updateOrCreate(
                ['id' => $tipo['id']],
                ['tipo' => $tipo['tipo']]
            );
        }

        $this->command->info('Tipos de delegación importados correctamente.');

    }
} 
