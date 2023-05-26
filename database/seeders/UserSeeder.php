<?php

namespace Database\Seeders;

use App\Models\KepalaSekolahModel;
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
            'id' => 1,
            'name' => 'Admin Web',
            'email' => 'admin@web',
            'password' => bcrypt('admin123'),
            'photo_profile' => 'ui-avatars.svg'
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'id' => 2,
            'name' => 'Alumni',
            'email' => 'alumni@web',
            'password' => bcrypt('alumni123')
        ]);
        $user->assignRole('alumni');

        $kepala_sekolah = User::create([
            'id' => 3,
            'name' => 'Drs. Syafruddin Noor, M.Pd.',
            'email' => 'kepala_sekolah@web',
            'password' => bcrypt('kepalasekolah123'),
            'photo_profile' => 'syafruddin-noor.jpeg'
        ]);
        $kepala_sekolah->assignRole('kepala_sekolah');
        KepalaSekolahModel::create([
            'id' => 1,
            'nama' => 'Drs. Syafruddin Noor, M.Pd.',
            'kutipan' => 'Kalau magang itu berarti mereka sudah terjun langsung bekerja, Jadi siswa kami
            sudah siap terjun langsung ke dunia kerja. Harapan kami mereka akan mengikuti
            kelas dan magang kemudian membentuk kompetensi luar biasa untuk masuk dunia
            kerja.',
            'tahun_jabatan' => 'Tahun 2015 s.d. sekarang',
            'jenis_kelamin' => 1,
            'no_telp' => 05113305054,
            'user_id' => 3,
        ]);

        $dudi = User::create([
            'id' => 4,
            'name' => 'Dunia Industri',
            'email' => 'dudi@web',
            'password' => bcrypt('dudi123')
        ]);
        $dudi->assignRole('dudi');

        // $nomor = 25;   
        // $iduser = 5;    
        // for($z=0; $z<=$nomor; $z++) {
        //     $useralumni[$z] = User::create([
        //         'id' => $iduser,
        //         'name' => 'alumni '.$z,
        //         'email' => 'alumni@web'.$z,
        //         'password' => bcrypt('alumni123#'.$z)
        //     ]);
        //     $useralumni[$z]->assignRole('alumni');
        //     $iduser++;
        // }
    }
}
