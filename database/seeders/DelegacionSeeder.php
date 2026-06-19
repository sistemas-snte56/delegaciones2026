<?php

namespace Database\Seeders;

use App\Models\Delegacion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DelegacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/delegaciones.csv');

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
            Delegacion::updateOrCreate(
                ['id' => $row[0]],
                [
                    'region_id'                 => $row[1],
                    'tipo_delegacion_id'        => $row[2],
                    'nomenclatura_id'           => $row[3],
                    'num_delegacional'          => $row[4],
                    'clave_delegacion'          => $row[5],
                    'nivel_id'                  => $row[6],
                    'sede_delegacional'         => $row[7],
                    'fecha_inicio_delegacional' => $row[8],
                    'fecha_final_delegacional'  => $row[9],
                    'direccion_delegacional'    => $row[10],
                    'cp_delegacional'           => $row[11],
                    'ciudad_delegacional'       => $row[12],
                    'estado_delegacional'       => $row[13],
                ],
            );  
        }
        
        $this->command->info('Delegaciones importadas correctamente.');
    }


    // public function run(): void
    // {
    //     $path = database_path('seeders/data/delegaciones.csv');

    //     if (!file_exists($path)) {
    //         $this->command->warn('El archivo delegaciones.csv no fue encontrado.');
    //         return;
    //     }

    //     $delegaciones = array_map('str_getcsv', file($path));

    //     foreach ($delegaciones as $index => $row) {
    //         if ($index === 0) continue; // Omitir cabecera

    //         $row = array_map('trim', $row); // Elimina espacios invisibles

    //         Delegacion::updateOrCreate(
    //             ['id' => $row[0]],
    //             [
    //                 'region_id' => $row[1],
    //                 'tipo_delegacion_id' => $row[2],
    //                 'nomenclatura_id' => $row[3],
    //                 'num_delegacional' => $row[4],
    //                 'clave_delegacion' => $row[5],
    //                 'nivel_id' => $row[6],
    //                 'sede_delegacional' => $row[7],
    //                 'fecha_inicio_delegacional' => $row[8],
    //                 'fecha_final_delegacional' => $row[9],
    //                 'direccion_delegacional' => $row[10],
    //                 'cp_delegacional' => $row[11],
    //                 'ciudad_delegacional' => $row[12],
    //                 'estado_delegacional' => $row[13],
    //             ]
    //         );
    //     }

    //     $this->command->info('delegaciones importadas correctamente.');
    // } 


}
