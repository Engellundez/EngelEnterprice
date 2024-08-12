<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'system_id' => 1,
            'number_rol' => '1',
            'name' => 'Admin',
            'description' => 'Rol que va a controlar todos los sub-programas que dependan de este y este propiamente.'
        ]);
    }
}
