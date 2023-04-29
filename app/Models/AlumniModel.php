<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniModel extends Model
{
    use HasFactory;
    protected $table = 'alumni';
    protected $guarded = ['id'];

    public function jurusan()
    {
        return $this->belongsTo(JurusanModel::class, 'kode_jurusan', 'id');
    }
    public function tahunlulus()
    {
        return $this->belongsTo(TahunLulusModel::class, 'kode_lulus', 'id');
    }
}
