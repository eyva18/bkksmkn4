<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin Web',
            'email' => 'admin@web',
            'password' => bcrypt('admin123'),
            'photo_profile' => 'ui-avatars.svg'
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Alumni',
            'email' => 'alumni@web',
            'password' => bcrypt('alumni123')
        ]);
        $user->assignRole('alumni');

        $kepala_sekolah = User::create([
            'name' => 'Kepala Sekolah',
            'email' => 'kepala_sekolah@web',
            'password' => bcrypt('kepalasekolah123')
        ]);
        $kepala_sekolah->assignRole('kepala_sekolah');

        $dudi = User::create([
            'name' => 'Dunia Industri',
            'email' => 'dudi@web',
            'password' => bcrypt('dudi123')
        ]);
        $dudi->assignRole('dudi');
    }
}
