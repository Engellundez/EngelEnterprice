<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rol_users')->insert([
            'user_id' => 1,
            'rol_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
