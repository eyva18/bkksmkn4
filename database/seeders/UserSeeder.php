<?php

namespace Database\Seeders;

use App\Models\AlumniModel;
use App\Models\DudiModel;
use App\Models\KepalaSekolahModel;
use App\Models\RiwayatPekerjaanModel;
use App\Models\StatusAlumniModel;
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
            'name' => 'administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'photo_profile' => 'ui-avatars.svg'
        ]);
        $admin->assignRole('admin');

        $kepala_sekolah = User::create([
            'id' => 3,
            'name' => 'kepala-sekolah',
            'email' => 'kepala_sekolah@gmail.com',
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
    }
}
