<?php

namespace Database\Seeders;

use App\Models\JenisKelaminModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisKelaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisKelaminModel::create([
            'id' => 1,
            'jenis_kelamin' => 'Laki-Laki'
        ]);
        JenisKelaminModel::create([
            'id' => 2,
            'jenis_kelamin' => 'Perempuan'
        ]);
    }
}
