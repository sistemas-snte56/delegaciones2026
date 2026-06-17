<?php

namespace Database\Seeders;

use App\Models\Secretaria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SecretariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/secretarias.csv');

        if (! File::exists($path)) {
            $this->command->warn('El archivo secretarias.csv no fue encontrado.');
            return;
        }

        $rows = collect(File::lines($path))
            ->skip(1)
            ->filter()
            ->map(fn (string $line) => str_getcsv($line));

        foreach ($rows as $row) {
            Secretaria::updateOrCreate(
                ['id' => $row[0]],
                [
                    'cartera_secretaria'  => $row[1],
                    'tipo_delegacion_id'  => $row[2],
                ]
            );
        }

        $this->command->info('Secretarías importadas correctamente.');
    }
}
