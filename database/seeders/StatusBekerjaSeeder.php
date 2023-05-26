<?php

namespace Database\Seeders;

use App\Models\StatusBekerjaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusBekerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusBekerjaModel::create([
            'id' => 1,
            'status_bekerja' => 'Bekerja',
        ]);
        StatusBekerjaModel::create([
            'id' => 2,
            'status_bekerja' => 'Tidak Bekerja',
        ]);
    }
}
