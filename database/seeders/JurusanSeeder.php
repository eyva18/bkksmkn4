<?php

namespace Database\Seeders;

use App\Models\JurusanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JurusanModel::create(['jurusan' => 'Tata Boga']);
        JurusanModel::create(['jurusan' => 'Tata Busana']);
        JurusanModel::create(['jurusan' => 'Tata Kecantikan']);
        JurusanModel::create(['jurusan' => 'Akomodasi Perhotelan']);
        JurusanModel::create(['jurusan' => 'Usaha Perjalanan Wisata']);
        JurusanModel::create(['jurusan' => 'Seni Musik Populer']);
        JurusanModel::create(['jurusan' => 'Rekayasa Perangkat Lunak']);

    }
}
