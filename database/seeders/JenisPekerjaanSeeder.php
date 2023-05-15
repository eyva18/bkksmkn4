<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisPekerjaanModel;

class JenisPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisPekerjaanModel::create([
            'id' => 1,
            'jenis_pekerjaan' => 'Musiman'
        ]);
        JenisPekerjaanModel::create([
            'id' => 2,
            'jenis_pekerjaan' => 'Magang'
        ]);
        JenisPekerjaanModel::create([
            'id' => 3,
            'jenis_pekerjaan' => 'Kontrak'
        ]);
        JenisPekerjaanModel::create([
            'id' => 4,
            'jenis_pekerjaan' => 'Pekerja Lepas'
        ]);
        JenisPekerjaanModel::create([
            'id' => 5,
            'jenis_pekerjaan' => 'Wiraswasta'
        ]);
        JenisPekerjaanModel::create([
            'id' => 6,
            'jenis_pekerjaan' => 'Paruh Waktu'
        ]);
        JenisPekerjaanModel::create([
            'id' => 7,
            'jenis_pekerjaan' => 'Purna Waktu'
        ]);
    }
}
