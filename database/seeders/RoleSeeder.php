<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'coordinador', 'gestor'];

        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role]);
        }

        $this->command->info('Roles creados correctamente.');
    }
}
