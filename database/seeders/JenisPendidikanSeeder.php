<?php

namespace Database\Seeders;

use App\Models\JenisPendidikanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisPendidikanModel::create([
            'id' => 1,
            'jenis_pendidikan' => 'Kuliah'
        ]);
        JenisPendidikanModel::create([
            'id' => 2,
            'jenis_pendidikan' => 'SMA / SMK'
        ]);
        JenisPendidikanModel::create([
            'id' => 3,
            'jenis_pendidikan' => 'SMP'
        ]);
        JenisPendidikanModel::create([
            'id' => 4,
            'jenis_pendidikan' => 'SD'
        ]);
        JenisPendidikanModel::create([
            'id' => 5,
            'jenis_pendidikan' => 'Kursus'
        ]);
    }
}
