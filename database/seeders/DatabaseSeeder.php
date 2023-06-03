<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AlumniModel;
use App\Models\DudiModel;
use App\Models\StatusAlumniModel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(JurusanSeeder::class);
        $this->call(JenisKelaminSeeder::class);
        $this->call(AgamaSeeder::class);
        $this->call(TahunLulusSeeder::class);
        $this->call(JenisPendidikanSeeder::class);
        $this->call(JenisPekerjaanSeeder::class);
        $this->call(TingkatPerlombaanSeeder::class);
        $this->call(StatusBekerjaSeeder::class);
        $this->call(StatusPendidikanSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
    }
}
