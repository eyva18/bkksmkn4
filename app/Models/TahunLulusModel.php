<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunLulusModel extends Model
{
    use HasFactory;
    protected $table = 'tahun_lulus';
    protected $fillable = ['tahun_lulus', 'id_jurusan'];
}
