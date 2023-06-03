<?php

namespace App\Imports;

use App\Models\AlumniModel;
use App\Models\StatusAlumniModel;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlumniImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function headingRow(): int
    {
        return 1;
    }
    public function model(array $row)
    {
        if($row['username'] == null OR $row['email'] == null){
            $user = User::create([
                'name' => $row['nisn'],
                'password' => bcrypt($row['nisn'])
            ]);
        }
        if($row['username'] != null AND $row['password'] != null){
            $user = User::create([
                'name' => $row['username'],
                'password' => bcrypt($row['password'])
            ]);
        }
        $user->assignRole('alumni');
         StatusAlumniModel::create([
             'nisn' => $row['nisn'],
             'jurusan' => $row['kode_jurusanid'],
             'tahun_lulus' => $row['kode_lulusid'],
             'status_bekerja' => 2,
             'status_pendidikan' => 2,
             'universitas' => null,
             'perusahaan' => null,
             'user_id'=> $user->id 
         ]);
        return new AlumniModel([
            'nisn' => $row["nisn"],
            'nis' => $row['nis'],
            'nama' => $row['nama'],
            'no_hp' => $row['no_hp'],
            'agamaId' => $row['agamaid'],
            'jenis_kelaminId' => $row['jenis_kelaminid'],
            'alamat' => $row['alamat'],
            'tempatTanggalLahir' => $row['tempat_lahir'].", ".$row['tanggal_lahir'],
            'user_id' => $user->id,
            'kode_jurusanId' => $row['kode_jurusanid'],
            'kode_lulusId' => $row['kode_lulusid'],
        ]);
    }
}
