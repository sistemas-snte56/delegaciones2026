<?php

namespace Database\Seeders;

// use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->create([
        //     'name' => 'Administrador',
        //     'email' => 'admin@email.com',
        //     'password' => bcrypt('password2026'),
        // ]);

        $this->call([

            RoleSeeder::class, 
            TipoDelegacionSeeder::class,
            RegionSeeder::class,
            NivelSeeder::class,
            
            // 1. Movemos UserSeeder hacia arriba (para que existan los usuarios/maestros primero)
            UserSeeder::class, 
            
            // 2. Ya con los usuarios creados, podemos sembrar las Nomenclaturas
            NomenclaturaSeeder::class,
            
            // 3. Al final, las Secretarias, porque ya existen Niveles, Tipos de Delegación y Users/Maestros
            SecretariaSeeder::class,

            DelegacionSeeder::class,

            // 4. Terminamos realizando el Seeder de los Maestros
            MaestroSeeder::class


        ]);
    }
}
