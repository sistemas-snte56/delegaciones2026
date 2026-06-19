<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin =User::create([
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'password' => bcrypt('password2026'),
        ]);

        $admin->assignRole('admin');

        $this->command->info('Usuarios importados correctamente.');
    }
}
