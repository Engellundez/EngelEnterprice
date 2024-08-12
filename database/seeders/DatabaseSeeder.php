<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // set my personal access
            MyAccountSeeder::class,
            SystemSeeder::class,
            RolesSeeder::class,
            RolesUsersSeeder::class
        ]);

        User::factory(5)->create();
    }
}
