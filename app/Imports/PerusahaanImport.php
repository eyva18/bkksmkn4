<?php

namespace App\Imports;

use App\Models\DudiModel;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;

class PerusahaanImport implements ToModel, WithHeadingRow
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
            'name' => $row['username'],
            'email' => $row['email'],
            'password' => bcrypt($row['password'])
        ]);
        $user->assignRole('dudi');
        return new DudiModel([
            'nama' => $row["nama"],
            'bidang' => $row['bidang'],
            'no_telp' => $row['no_telp'],
            'alamat' => $row['alamat'], 
        ]);
    }
}
