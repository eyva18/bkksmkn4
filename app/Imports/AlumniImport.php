<?php

namespace App\Imports;

use App\Models\AlumniModel;
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
        $user = User::create([
            'name' => $row['nisn'],
            'password' => bcrypt($row['nisn'])
        ]);
        $user->assignRole('alumni');
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
        ]);
    }
}
