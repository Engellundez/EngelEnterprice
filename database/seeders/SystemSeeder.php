<?php

namespace Database\Seeders;

use App\Models\System;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		System::create([
			'name' => 'Init',
			'url' => 'http://localhost:8001'
		]);

		System::create([
			'name' => 'Control de Ingresos',
			'url' => 'http://localhost:8001'
		]);
	}
}
