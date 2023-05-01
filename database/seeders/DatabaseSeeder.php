<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AlumniModel;
use App\Models\DudiModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(JurusanSeeder::class);
        $this->call(JenisKelaminSeeder::class);
        $this->call(AgamaSeeder::class);
        $this->call(TahunLulusSeeder::class);
        AlumniModel::factory(10)->create();
        DudiModel::factory(10)->create();
    }
}
