<?php

namespace Database\Seeders;

use App\Models\TahunLulusModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunLulusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TahunLulusModel::create(['tahun_lulus' => date('Y')]);
        TahunLulusModel::create(['tahun_lulus' => date('Y')-1]);
        TahunLulusModel::create(['tahun_lulus' => date('Y')-2]);
    }
}
