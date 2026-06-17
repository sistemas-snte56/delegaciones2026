<?php

namespace Database\Seeders;

use App\Models\Nivel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/niveles.csv');

        // leer archivos en el excel
        if(! File::exists($path)) {
            $this->command->warn("Archivo no encontrado: {$path}");
            return;
        }

        // Omitir cabecera de CSV
        $rows = collect(File::lines($path))
            ->skip(1)
            ->filter()
            ->map(fn (string $line) => str_getcsv($line));
            
        // Líneas vacías
        foreach ($rows as $row) {
            Nivel::updateOrCreate(
                ['id' => $row[0]],
                ['nombre' => $row[1]]
            );  
        }
        
        $this->command->info('Niveles importados correctamente.');
    }
}
