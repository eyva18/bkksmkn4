<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniModel extends Model
{
    use HasFactory;
    protected $table = 'alumni';
    protected $fillable = ['NISN', 'NIS', 'nama', 'no_hp', 'biografi', 'agama', 'jk', 'alamat', 'TTL', 'photo_profile', 'transkrif_nilai', 'kode_jurusan', 'kode_lulus'];
    public function jurusan()
    {
        return $this->belongsTo(JurusanModel::class, 'kode_jurusan', 'id');
    }
    public function tahunlulus()
    {
        return $this->belongsTo(TahunLulusModel::class, 'kode_lulus', 'id');
    }
}
