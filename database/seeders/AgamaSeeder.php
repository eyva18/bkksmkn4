<?php

namespace Database\Seeders;

use App\Models\AgamaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AgamaModel::create([
            'id' => 1,
            'agama' => 'Islam'
        ]);
        AgamaModel::create([
            'id' => 2,
            'agama' => 'Kristen'
        ]);
        AgamaModel::create([
            'id' => 3,
            'agama' => 'Hindu'
        ]);
        AgamaModel::create([
            'id' => 4,
            'agama' => 'Budha'
        ]);
        AgamaModel::create([
            'id' => 5,
            'agama' => 'Konghucu'
        ]);
    }
}
