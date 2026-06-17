<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/regiones.csv');

        // Leer archivos en el excel
        if(! File::exists($path)) {
            $this->command->warn("Archivo no encontrado: {$path}");
            return;
        }

        // Omite cabecera de CSV
        $rows = collect(File::lines($path))
            ->skip(1)
            ->filter()
            ->map(fn (string $line) => str_getcsv($line));

        // Líneas vacías
        foreach ($rows as $row) {
            Region::updateOrCreate(
                ['id' => $row[0]],
                [
                    'region' => $row[1],
                    'sede' => $row[2],
                ]
            );
        }

        $this->command->info('Regiones importadas correctamente.');
    }
}
