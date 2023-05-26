<?php

namespace Database\Seeders;

use App\Models\StatusPendidikanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusPendidikanModel::create([
            'id' => 1,
            'status_pendidikan' => 'Melanjutkan Pendidikan',
        ]);
        StatusPendidikanModel::create([
            'id' => 2,
            'status_pendidikan' => 'Tidak Melanjutkan Pendidikan',
        ]);
    }
}
