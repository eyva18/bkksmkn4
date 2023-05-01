<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusAlumniModel extends Model
{
    use HasFactory;
    protected $table = 'status_alumni';
    protected $guarded = 'id';
    public function tahunlulus()
    {
        return $this->belongsTo(TahunLulusModel::class, 'tahun_lulus', 'id');
    }
    public function jurusan()
    {
        return $this->belongsTo(TahunLulusModel::class, 'tahun_lulus', 'id');
    }
}
