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

        $useralumni = User::create([
            'id' => 2,
            'name' => 'alumni-web',
            'email' => 'alumni@gmail.com',
            'password' => bcrypt('alumni123'),
            'photo_profile' => "Photo_Profile_Alumni/MN2lf1yINs5gcFDvFWQTecvhBruXNFGmiqeCsLb8.jpg"
        ]);
        $useralumni->assignRole('alumni');
        $alumnicreate = AlumniModel::create([
            'NISN' => 1234567,
            'NIS' => 1234567,
            'nama' => "Test Alumni Web",
            'no_hp' => 243878213,
            'biografi' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati aliquid laborum est enim mollitia, cum perferendis tenetur praesentium suscipit excepturi repudiandae ex voluptatibus minima quod, quisquam veniam. Animi error magnam deleniti quia, porro, asperiores, amet ipsam modi hic exercitationem veritatis rem incidunt ipsa eos. Ex, velit sint eum deleniti veritatis quaerat repellat voluptates in saepe obcaecati nisi, recusandae quisquam necessitatibus rem provident neque. Quibusdam ipsa porro, iusto dolore nemo facilis quam tenetur quisquam, sapiente odit explicabo, architecto rerum sint nesciunt optio consequatur aspernatur possimus assumenda deserunt itaque. Rerum quod rem totam vero aperiam itaque fugit officia, consequuntur laudantium ad culpa?",
            'agamaId' => 1,
            'jenis_kelaminId' => 1,
            'alamat' => "Jalan Bridger No.07",
            'tempatTanggalLahir' => "Banjarmasin, 12 Januari 2000",
            'photo_profile' => "Photo_Profile_Alumni/MN2lf1yINs5gcFDvFWQTecvhBruXNFGmiqeCsLb8.jpg",
            'transkrip_nilai' => 90,
            'kode_jurusanId' => 1,
            'kode_lulusId' => 1,
            'user_id'=> $useralumni->id
        ]);
        StatusAlumniModel::create([
            'nisn' => $alumnicreate->NISN,
            'jurusan' => $alumnicreate->kode_jurusanId,
            'tahun_lulus' => $alumnicreate->kode_lulusId,
            'status_bekerja' => 1,
            'status_pendidikan' => 1,
            'universitas' => "Lambung Mangkurat",
            'perusahaan' => "PT Inovasi Informatika Sinergi",
            'user_id'=> $useralumni->id 
        ]);

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

        $dudi = User::create([
            'id' => 4,
            'name' => 'dunia-industri',
            'email' => 'dudi@gmail.com',
            'password' => bcrypt('dudi123')
        ]);
        $dudi->assignRole('dudi');
       
        DudiModel::create([
            'nama' => "PT Test Web Dudi",
            'bidang' => null,
            'no_telp' => null,
            'deskripsi' => null,
            'alamat' => null,
            'logo' => "ph.png",
            'user_id' => $dudi->id,
        ]);
    }
}
