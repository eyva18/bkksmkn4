<?php

namespace Database\Seeders;

use App\Models\TingkatPerlombaanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TingkatPerlombaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TingkatPerlombaanModel::create([
            'id' => 1,
            'tingkat_lomba' => 'Internasional'
        ]);
        TingkatPerlombaanModel::create([
            'id' => 2,
            'tingkat_lomba' => 'Nasional'
        ]);
        TingkatPerlombaanModel::create([
            'id' => 3,
            'tingkat_lomba' => 'Provinsi'
        ]);
        TingkatPerlombaanModel::create([
            'id' => 4,
            'tingkat_lomba' => 'Kota / Kabupaten'
        ]);
        TingkatPerlombaanModel::create([
            'id' => 5,
            'tingkat_lomba' => 'Kecamatan'
        ]);
    }
}
