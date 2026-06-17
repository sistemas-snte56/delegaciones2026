<?php

namespace Database\Seeders;

use App\Models\Nomenclatura;
use Illuminate\Database\Seeder;

class NomenclaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nomenclaturas = [
            ['id' => 1, 'nomenclatura' => 'D-I-',  'tipo_delegacion_id' => 1],
            ['id' => 2, 'nomenclatura' => 'D-II-', 'tipo_delegacion_id' => 1],
            ['id' => 3, 'nomenclatura' => 'D-III-','tipo_delegacion_id' => 1],
            ['id' => 4, 'nomenclatura' => 'D-IV-', 'tipo_delegacion_id' => 2],
            ['id' => 5, 'nomenclatura' => 'C.T.',  'tipo_delegacion_id' => 3],
        ];

        foreach ($nomenclaturas as $nomenclatura) {
            Nomenclatura::updateOrCreate(
                ['id' => $nomenclatura['id']],
                [
                    'nomenclatura'       => $nomenclatura['nomenclatura'],
                    'tipo_delegacion_id' => $nomenclatura['tipo_delegacion_id'],
                ]
            );
        }

        $this->command->info('Nomenclaturas importadas correctamente.');
    }
}
