<?php

namespace Database\Seeders;

use App\Models\Maestro;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class MaestroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Definir la ruta del archivo JSON dentro de database/seeders/data/
        $path = database_path('seeders/data/maestros.json');

        // 2. Validar la existencia del archivo utilizando la fachada File
        if (! File::exists($path)) {
            $this->command->warn("Archivo no encontrado: {$path}");
            return;
        }

        // 3. Leer el contenido completo del archivo JSON
        $json = File::get($path);

        // 4. Decodificar el JSON a una colección de Laravel para un manejo más limpio
        $maestros = collect(json_decode($json, true));

        // 5. Iterar sobre los registros e insertarlos o actualizarlos en la base de datos
        foreach ($maestros as $maestro) {
            // 1. Limpiamos los campos que puedan traer la palabra "EMPTY"
            // Si es "EMPTY", lo convertimos en null o en una cadena vacía "" según tus necesidades
            $titulo    = $maestro['titulo'] === 'EMPTY' ? null : $maestro['titulo'];
            $nombre    = $maestro['nombre'] === 'EMPTY' ? '' : $maestro['nombre'];
            $apaterno  = $maestro['apaterno'] === 'EMPTY' ? '' : $maestro['apaterno'];
            $amaterno  = $maestro['amaterno'] === 'EMPTY' ? '' : $maestro['amaterno'];
            $direccion = $maestro['direccion'] === 'EMPTY' ? null : $maestro['direccion'];
            $ciudad    = $maestro['ciudad'] === 'EMPTY' ? null : $maestro['ciudad'];
            $estado    = $maestro['estado'] === 'EMPTY' ? null : $maestro['estado'];
            $telefono  = $maestro['telefono'] === 'EMPTY' ? null : $maestro['telefono'];

            Maestro::updateOrCreate(
                ['id' => $maestro['id']], 
                [
                    'delegacion_id' => $maestro['delegacion_id'], // Ojo: tu query busca 'delegacion_id', no 'delegacion_id'
                    'secretaria_id' => $maestro['secretaria_id'], // Ojo: tu query busca 'secretaria_id'
                    'user_id'       => ($maestro['user_id'] === 'NULL' || $maestro['user_id'] === 'EMPTY') ? null : $maestro['user_id'],
                    
                    // Asignamos las variables ya limpias
                    'titulo'        => $titulo,
                    'nombre'        => $nombre,
                    'apaterno'      => $apaterno,
                    'amaterno'      => $amaterno,
                    'genero'        => $maestro['genero'],
                    'email'         => $maestro['email'] === 'empty@email.com' ? null : $maestro['email'],
                    'telefono'      => $telefono,
                    'direccion'     => $direccion,
                    'cp'            => $maestro['cp'] === 'EMPTY' ? null : $maestro['cp'],
                    'ciudad'        => $ciudad,
                    'estado'        => $estado,
                ]
            );
        }

















        // 6. Mensaje de éxito en la consola de Artisan
        $this->command->info('Maestros importados correctamente desde el JSON.');
    }
}